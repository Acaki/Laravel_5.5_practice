<?php

namespace App\Console\Commands;

use App\Services\FortuneCrawlerService;
use App\Services\FortuneFetcherService;
use App\Fortunes;
use Illuminate\Console\Command;

class CrawlFortunes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fortunes:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl fortunes from click108.com.tw';

    private $fortuneFetcherService;
    private $fortuneCrawlerService;

    /**
     * Create a new command instance.
     *
     * @param FortuneFetcherService $fortuneFetcherService
     * @param FortuneCrawlerService $fortuneCrawlerService
     */
    public function __construct(
        FortuneFetcherService $fortuneFetcherService,
        FortuneCrawlerService $fortuneCrawlerService
    )
    {
        parent::__construct();
        $this->fortuneFetcherService = $fortuneFetcherService;
        $this->fortuneCrawlerService = $fortuneCrawlerService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $body = $this->fortuneFetcherService->fetchRoot();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        $links = $this->fortuneCrawlerService->getLinks($body);
        $contents = $this->fortuneFetcherService->fetchChildren($links);
        foreach ($contents as $constellation => $content) {
            $info = $this->fortuneCrawlerService->getFortuneInfo($content);
            $date = $info['date'];
            unset($info['date']);
            Fortunes::updateOrCreate(['constellation' => $constellation, 'date' => $date], $info);
        }
    }
}
