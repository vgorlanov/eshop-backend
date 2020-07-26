<?php


namespace App\Console\Commands\Indexer;


class Flush extends Indexer
{
    /**
     * @var string
     */
    protected $signature = 'indexer:flush';

    /**
     * @var string
     */
    protected $description = 'clear all index';

    public function handle()
    {
        $this->search->flush();

        $this->info('indexer cleared');
    }
}
