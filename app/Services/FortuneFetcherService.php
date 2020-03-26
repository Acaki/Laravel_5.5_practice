<?php

namespace App\Services;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

class FortuneFetcherService
{
    const FORTUNE_PAGE_URL = 'http://astro.click108.com.tw/';

    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchChildren($urls)
    {
        $promises = [];
        foreach ($urls as $constellation => $url) {
            $promises[$constellation] = $this->httpClient->getAsync($url);
        }
        $responses = Promise\settle($promises)->wait();
        $contents = [];
        foreach ($responses as $constellation => $response) {
            $contents[$constellation] = $response['value']->getBody()->getContents();
        }

        return $contents;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function fetchRoot()
    {
        $response = $this->httpClient->get(self::FORTUNE_PAGE_URL);
        $statusCode = $response->getStatusCode();
        if ($statusCode !== 200) {
            throw new Exception('Error retrieving home page.');
        }

        return $response->getBody()->getContents();
    }
}