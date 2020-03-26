<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class FortuneOverall implements FortuneCategory
{
    private $selector = 'span.txt_green';

    public function getDetails(Crawler $parentCrawler)
    {
        $rank = $parentCrawler->filter($this->selector);
        $score = substr_count($rank->text(), '★');
        $description = $rank->closest('p')->nextAll()->text();

        return [
            'overall_fortune_score' => $score,
            'overall_fortune_description' => $description
        ];
    }
}