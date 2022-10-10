<?php

namespace BangNokia\WakaTime;

trait MakeHttpRequests
{
    public function get(string $endpoint, array $queries = [])
    {
        return $this->request(
            'GET',
            empty($queries) ? $endpoint : $endpoint.'?'.http_build_query($queries)
        );
    }
}
