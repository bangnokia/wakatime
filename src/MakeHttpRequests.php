<?php

namespace BangNokia\WakaTime;

trait MakeHttpRequests
{
    public function get(string $endpoint)
    {
        return $this->request('GET', $endpoint);
    }
}