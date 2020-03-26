<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

class FortuneCareer implements FortuneCategory
{
    private $selector = 'span.txt_blue';

    public function getDetails(Crawler $parentCrawler)
    {
        $rank = $parentCrawler->filter($this->selector);
        $score = substr_count($rank->text(), '★');
        $description = $rank->closest('p')->nextAll()->text();

        return [
            'career_fortune_score' => $score,
            'career_fortune_description' => $description
        ];
    }
}