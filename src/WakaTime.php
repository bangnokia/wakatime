<?php

namespace BangNokia\WakaTime;

use BangNokia\WakaTime\Contracts\WakaTime as WakaTimeContract;
use BangNokia\WakaTime\Resources\Project;
use GuzzleHttp\Client;

class WakaTime implements WakaTimeContract
{
    use MakeHttpRequests;

    protected string $serviceUrl = 'https://wakatime.com/api/v1';

    protected string $apiKey;

    protected Client $guzzleClient;

    public function __construct(string $apiKey, Client $client = null)
    {
        $this->setApiKey($apiKey);

        if ($client !== null) {
            $this->guzzleClient = $client;
        }
    }

    protected function setApiKey(string $apiKey): static
    {
        $this->apiKey = $apiKey;

        $this->guzzleClient = new Client([
            'base_uri' => $this->serviceUrl,
            'headers'  => [
                'Authorization' => 'Basic '.base64_encode($this->apiKey),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ],
        ]);

        return $this;
    }

    public function setClient($client): static
    {
        $this->guzzleClient = $client;

        return $this;
    }

    public function request(string $method, string $endpoint, array $payload = []): array
    {
        $options = !empty($payload) ? ['json' => $payload] : [];

        $response = $this->guzzleClient->request($method, $endpoint, $options);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function projects(string $user = 'current'): Paginator
    {
        $response = $this->get('users/'.$user.'/projects');

        return Paginator::fromResponse($response)->apply(Project::class);
    }

}
