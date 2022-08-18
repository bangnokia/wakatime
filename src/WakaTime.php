<?php

namespace BangNokia\WakaTime;

use BangNokia\Wakatime\Contracts\WakaTime as WakaTimeContract;
use GuzzleHttp\Client;
use Psr\Http\Client\ClientInterface;

class WakaTime implements WakaTimeContract
{
    protected string $serviceUrl = 'https://wakatime.com/api/v1';

    protected string $apiKey;

    protected Client $client;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;

        $this->client = $this->makeDefaultClient();
    }

    protected function makeDefaultClient(): ClientInterface
    {
        return new Client([
            'base_uri' => $this->serviceUrl,
            'timeout'  => 30,
        ]);
    }

    public function setClient($client): static
    {
        $this->client = $client;

        return $this;
    }

    public function request(string $method, string $endpoint, array $payload = []): array
    {
        $response = $this->client->request($method, $endpoint, [
            'json'    => $payload,
            'headers' => [
                'Authorization' => "Basic ".base64_encode($this->apiKey),
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function projects(string $user = 'current'): Paginator
    {
        $response = $this->request('GET', '/users/'.$user.'/projects');

        return new Paginator($response['data'], $response['pagination']);
    }
}
