<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class FortuneLove implements FortuneCategory
{
    private $selector = 'span.txt_pink';

    public function getDetails(Crawler $parentCrawler)
    {
        $rank = $parentCrawler->filter($this->selector);
        $score = substr_count($rank->text(), '★');
        $description = $rank->closest('p')->nextAll()->text();

        return [
            'love_fortune_score' => $score,
            'love_fortune_description' => $description
        ];
    }
}