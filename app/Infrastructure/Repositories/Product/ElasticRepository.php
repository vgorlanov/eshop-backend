<?php


namespace App\Infrastructure\Repositories\Product;


use App\Library\Search\SearchInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator as Pagination;

class ElasticRepository implements ProductRepository
{
    /**
     * search client
     *
     * @var SearchInterface
     */
    private SearchInterface $client;

    /**
     * type index for search
     *
     * @var string
     */
    private string $type = 'product';

    public function __construct()
    {
        $this->client = app()->get(SearchInterface::class);
    }

    /**
     * @inheritDoc
     */
    public function byId(int $id): Product
    {
        $client = $this->client->setTypes($this->type);

        if($client->has($id)) {
            $data = $this->client->setTypes($this->type)->find($id);

            return (new Product())->fill($data);
        }

        // todo NotFoundException
    }

    /**
     * @inheritDoc
     */
    public function paginate(Request $request): AbstractPaginator
    {
        $result = $this->client
            ->setTypes($this->type)
            ->setLimit($request->get('per'))
            ->setOrder($request->get('order'))
            ->setMust($request->get('must'))
            ->search($request->get('search'), $request->get('page'));

        return new Pagination($result['data'], $result['total']['value'], $request->get('per'));
    }
}
