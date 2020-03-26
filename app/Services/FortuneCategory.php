<?php

namespace App\Services;

use Symfony\Component\DomCrawler\Crawler;

interface FortuneCategory
{
    public function getDetails(Crawler $parentCrawler);
}