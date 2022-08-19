<?php

use BangNokia\WakaTime\WakaTime;

it('can get list projects of user', function () {
    $api = new WakaTime('api-key');
    $projects = $api->projects();

    $this->assertInstanceOf(\BangNokia\WakaTime\Paginator::class, $projects);
});
