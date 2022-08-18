<?php

namespace BangNokia\Wakatime;

class WakaTime
{
    protected string $serviceUrl = 'https://wakatime.com/api/v1';

    protected string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
}
