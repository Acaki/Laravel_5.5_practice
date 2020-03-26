<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class FortuneWealth implements FortuneCategory
{
    private $selector = 'span.txt_orange';

    public function getDetails(Crawler $parentCrawler)
    {
        $rank = $parentCrawler->filter($this->selector);
        $score = substr_count($rank->text(), '★');
        $description = $rank->closest('p')->nextAll()->text();

        return [
            'wealth_fortune_score' => $score,
            'wealth_fortune_description' => $description
        ];
    }
}