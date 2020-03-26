<?php

namespace App\Services;

use GuzzleHttp\Promise\Promise;
use Symfony\Component\DomCrawler\Crawler;

class FortuneCrawlerService
{
    private $crawler;
    private $fortuneOverall;
    private $fortuneLove;
    private $fortuneCareer;
    private $fortuneWealth;

    public function __construct(
        Crawler $crawler,
        FortuneOverall $fortuneOverall,
        FortuneLove $fortuneLove,
        FortuneCareer $fortuneCareer,
        FortuneWealth $fortuneWealth
    )
    {
        $this->crawler = $crawler;
        $this->fortuneOverall = $fortuneOverall;
        $this->fortuneLove = $fortuneLove;
        $this->fortuneCareer = $fortuneCareer;
        $this->fortuneWealth = $fortuneWealth;
    }

    public function getFortuneInfo($html)
    {
        $this->crawler->clear();
        $this->crawler->addHtmlContent($html);
        $date = $this->crawler->filter('#iAcDay > option[selected]')->text();
        $fortuneContent = $this->crawler->filter('div.TODAY_CONTENT');

        return array_merge(
            ['date' => $date],
            $this->fortuneOverall->getDetails($fortuneContent),
            $this->fortuneLove->getDetails($fortuneContent),
            $this->fortuneCareer->getDetails($fortuneContent),
            $this->fortuneWealth->getDetails($fortuneContent)
        );
    }

    public function getLinks($html)
    {
        $this->crawler->clear();
        $this->crawler->addHtmlContent($html);
        $links = $this->crawler->filter('div.STAR12_BOX > ul > li > a')->links();
        $uris = [];
        foreach ($links as $link) {
            $constellation = $link->getNode()->textContent;
            $query = parse_url($link->getUri(), PHP_URL_QUERY);
            parse_str($query, $output);
            $uris[$constellation] = $output['RedirectTo'];
        }

        return $uris;
    }
}