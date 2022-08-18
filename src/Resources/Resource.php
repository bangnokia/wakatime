<?php

namespace BangNokia\WakaTime\Resources;

class Resource
{
    protected array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;

        $this->fill();
    }

    protected function fill(): void
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);
            $this->{$key} = $value;
        }
    }

    private function camelCase(string $key): string
    {
        return lcfirst(str_replace('_', '', ucwords($key, '_')));
    }
}
