<?php

namespace BangNokia\WakaTime;

class Paginator
{
    protected array $data;

    protected int $page;

    protected int $nextPage;

    protected int $prevPage;

    protected int $total;

    protected int $totalPages;

    public function __construct()
    {

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
