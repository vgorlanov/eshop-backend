<?php


namespace App\Library\Cart;


use App\Models\Services\Sale;
use Predis\Client;

class RedisCartStore implements CartStoreInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $key;

    public function __construct()
    {
        $config = config('database.redis.default');
        $this->client = new Client($config);
    }

    /**
     * @inheritDoc
     */
    public function add(Sale $model): void
    {
        $value = $this->all();

        if (isset($value[$model->getId()])) {
            $value[$model->getId()]['count']++;
        } else {
            $value[$model->getId()] = [
                'data'  => $model,
                'count' => 1,
            ];
        }

        $this->client->set($this->key, json_encode($value));
    }


    /**
     * @inheritDoc
     */
    public function remove(int $id): void
    {
        $value = $this->all();

        if($value[$id]['count'] > 1) {
            $value[$id]['count']--;
        } else {
            unset($value[$id]);
        }

        $this->client->set($this->key, json_encode($value));
    }

    /**
     * @inheritDoc
     */
    public function all(): array
    {
        return (array)json_decode($this->client->get($this->key), true);
    }

    /**
     * @inheritDoc
     */
    public function flush(): void
    {
        $this->client->del([$this->key]);
    }

    /**
     * @inheritDoc
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }
}
