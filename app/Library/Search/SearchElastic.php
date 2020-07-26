<?php


namespace App\Library\Search;


use App\Models\Services\Searchable;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;


class SearchElastic implements SearchInterface
{
    /**
     * @var Client
     */
    private Client $elastic;

    /**
     * fields to search
     *
     * @var array
     */
    protected array $fields = ['name', 'description'];

    /**
     * @var int
     */
    private int $limit = 10;

    /**
     * @var object
     */
    private object $config;

    /**
     * @var array
     */
    private array $types;

    /**
     * @var array
     */
    private array $order = ['created_at' => 'asc'];

    /**
     * @var array
     */
    private array $must = [];

    /**
     * SearchElastic constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = (object)$config;

        $this->types = array_keys($this->config->types);

        $hosts = $this->config->host . ':' . $this->config->port;

        $this->elastic = ClientBuilder::create()->setHosts([$hosts])->build();
    }

    /**
     * @inheritDoc
     */
    public function search(string $string = null, int $page = 1): array
    {
        $from = $page > 1 ? $this->limit * ($page - 1) : 0;

        $filter = $must = [];
        if(count($this->must)) {
            foreach ($this->must as $key => $value) {
                $filter[] = ['term' => [$key => $value]];
            }
        }

        if($string !== null) {
            $must = [
                'multi_match' => [
                    'query'     => $string,
                    'fields'    => $this->fields,
                    'fuzziness' => (int)$this->config->fuzziness,
                ]
            ];
        }

        $params = [
            'index' => $this->types,
            'body'  => [
                'from'  => $from,
                'size'  => $this->limit,
                'sort'  => $this->order,
                'query' => [
                    'bool' => [
                        'must'   => $must,
                        'filter' => $filter
                    ],
                ],
            ],
        ];

        $result = $this->elastic->search($params);

        return [
            'data'  => $this->response($result),
            'page'  => $page,
            'total' => $result['hits']['total'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): array
    {
        return $this->elastic->get([
            'index' => $this->types,
            'id'    => current($this->types) . $id,
        ])['_source'];
    }

    /**
     * @inheritDoc
     */
    public function has(int $id): bool
    {
        return $this->elastic->exists([
            'index' => $this->types,
            'id'    => current($this->types) . $id,
        ]);
    }


    /**
     * @inheritDoc
     */
    public function index(Searchable $model): array
    {
        return $this->elastic->index($this->getData($model));
    }

    /**
     * @inheritDoc
     */
    public function update(Searchable $model): array
    {
        return $this->elastic->index($this->getData($model));
    }

    /**
     * @inheritDoc
     */
    public function delete(Searchable $model): void
    {
        if ($this->has($model->getId())) {
            $this->elastic->delete($this->getHeader($model));
        }
    }

    /**
     * @inheritDoc
     */
    public function flush(): void
    {
        $this->elastic->indices()->delete(['index' => $this->types]);
    }

    /**
     * @inheritDoc
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTypes($types): self
    {
        $this->types = is_array($types) ? $types : [$types];

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setOrder(array $order): self
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMust(array $must): self
    {
        $this->must = $must;

        return $this;
    }

    /**
     * @param array $result
     * @return array
     */
    private function response(array $result): array
    {
        $response = [];
        foreach ($result['hits']['hits'] as $hit) {
            $response[] = $hit['_source'];
        }

        return $response;
    }

    /**
     * get id for elastic
     *
     * @param Searchable $model
     * @return string
     */
    private function getModelId(Searchable $model): string
    {
        return $model->getType() . $model->getId();
    }

    /**
     * data for indexer
     *
     * @param Searchable $model
     * @return array
     */
    private function getData(Searchable $model): array
    {
        return array_merge($this->getHeader($model), ['body' => $model->getData()]);
    }

    /**
     * return header for elastic
     *
     * @param Searchable $model
     * @return array
     */
    private function getHeader(Searchable $model): array
    {
        return [
            'index' => $model->getType(),
            'id'    => $this->getModelId($model),
        ];
    }

}
