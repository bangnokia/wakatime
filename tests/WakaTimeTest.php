<?php

it('can make request to wakatime', function () {
    $http = Mockery::mock(GuzzleHttp\Client::class);
    $wakatime = new BangNokia\WakaTime\WakaTime('322', $http);

    $http->shouldReceive('request')->once()->with('GET', 'users/current/projects')
        ->andReturn(new \GuzzleHttp\Psr7\Response(200, [], '{"data": []}'));

    $wakatime->projects();
});
