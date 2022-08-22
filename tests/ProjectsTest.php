<?php

use BangNokia\WakaTime\Paginator;
use BangNokia\WakaTime\WakaTime;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

it('can get list projects of user', function () {
    $api = new WakaTime('api-key', $http = Mockery::mock(Client::class));

    $http->shouldReceive('request')->once()
        ->with('GET', 'users/current/projects', [])
        ->andReturn(new Response(200, [], '{"data": [{"id": 1, "name": "Project 1"}]}'));

    $projects = $api->projects();

    $this->assertInstanceOf(Paginator::class, $projects);
    $this->assertEquals(1, $projects->count());
});
