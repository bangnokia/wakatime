<?php

namespace BangNokia\WakaTime\Resources;

class Project extends Resource
{
    public string $id;

    public string $name;

    public ?string $repository;

    public ?string $badge;

    public ?string $color;

    public bool $hasPublicUrl;

    public string $humanReadableHeartbeatAt;

    public string $lastHeartbeatAt;

    public string $url;

    public string $urlencodedName;

    public string $createdAt;
}
