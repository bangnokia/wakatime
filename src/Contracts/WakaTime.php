<?php

namespace BangNokia\WakaTime\Contracts;

interface WakaTime
{
    public function projects(string $user = 'current');
}
