<?php

namespace App\Console\Commands\Indexer;

use App\Library\Search\SearchInterface;
use App\Models\Product;
use Illuminate\Console\Command;

class Indexer extends Command
{
    /**
     * @var SearchInterface
     */
    protected SearchInterface $search;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'indexer:run {model? }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexer content for search';

    /**
     * list of models for indexer
     *
     * @var array
     */
    protected array $models = [];

    /**
     * Create a new command instance.
     *
     * @param SearchInterface $search
     */
    public function __construct(SearchInterface $search)
    {
        parent::__construct();

        $this->models = app()->config['search']['types'];
        $this->search = $search;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $models = ($model = strtolower($this->argument('model'))) ? [$this->models[$model]] : $this->models;

        $this->info('indexer is running');
        foreach ($models as $model) {
            $this->add($model::get());
        }
        $this->info('indexer is done');
    }

    /**
     * add all
     */
    public function index(): void
    {
        $this->add(Product::get());
    }

    /**
     * update all
     */
    public function reindex(): void
    {
        $this->update(Product::get());
    }

    /**
     * clear all
     */
    public function flush(): void
    {
        $this->search->flush();

        $this->info('indexer cleared');
    }

    /**
     * @param $models
     */
    private function add($models): void
    {
        foreach ($models as $model) {
            $this->search->index($model);
            $this->info(get_class($model) . ' ' . $model->id . ' indexed');
        }
    }

    /**
     * @param $models
     */
    private function update($models): void
    {
        foreach ($models as $model) {
            $this->search->update($model);
            $this->info(get_class($model) . ' ' . $model->id . ' updated');
        }
    }
}
