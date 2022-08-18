<?php

namespace BangNokia\WakaTime;

use BangNokia\WakaTime\Resources\Resource;

class Paginator extends Resource
{
    protected array $data;

    protected int $page;

    protected int $nextPage;

    protected int $prevPage;

    protected int $total;

    protected int $totalPages;

    public function __construct(array $attributes)
    {
        parent::__construct($attributes);
    }

    public static function fromResponse(array $response): static
    {
        return new static($response);
    }

    public function apply(string $class): static
    {
        $this->data = array_map(
            fn($item) => new $class($item),
            $this->data
        );

        return $this;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function page(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function nextPage(): int
    {
        return $this->nextPage;
    }

    /**
     * @return int
     */
    public function prevPage(): int
    {
        return $this->prevPage;
    }

    /**
     * @return int
     */
    public function total(): int
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function totalPages(): int
    {
        return $this->totalPages;
    }
}
