<?php

namespace BangNokia\WakaTime\Resources;

class Summaries extends Resource
{
    public function __construct(array $attributes)
    {
        parent::__construct($attributes);

        // custom fill data for this resource
    }

    public array $data;

    public array $cummulativeTotal;

    public string $start;

    public string $end;
}
