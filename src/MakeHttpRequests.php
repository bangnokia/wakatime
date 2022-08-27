<?php

namespace BangNokia\WakaTime;

trait MakeHttpRequests
{
    public function get(string $endpoint, array $queries)
    {
        return $this->request('GET', $endpoint.'?'.http_build_query($queries));
    }
}
