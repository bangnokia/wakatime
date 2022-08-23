<?php

namespace BangNokia\WakaTime;

use BangNokia\WakaTime\Contracts\WakaTime as WakaTimeContract;
use BangNokia\WakaTime\Resources\Project;
use BangNokia\WakaTime\Resources\Summaries;
use GuzzleHttp\Client;

class WakaTime implements WakaTimeContract
{
    use MakeHttpRequests;

    protected string $serviceUrl = 'https://wakatime.com/api/v1';

    protected string $apiKey;

    protected Client $client;

    protected string $user = 'current';

    public function __construct(string $apiKey, Client $client = null)
    {
        $this->setApiKey($apiKey);

        if ($client !== null) {
            $this->client = $client;
        }
    }

    protected function setApiKey(string $apiKey): static
    {
        $this->apiKey = $apiKey;

        $this->client = new Client([
            'base_uri' => $this->serviceUrl,
            'headers'  => [
                'Authorization' => 'Basic '.base64_encode($this->apiKey),
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ],
        ]);

        return $this;
    }

    public function setUser(string $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function setClient($client): static
    {
        $this->client = $client;

        return $this;
    }

    public function request(string $method, string $endpoint, array $payload = []): array
    {
        $options = !empty($payload) ? ['json' => $payload] : [];

        $response = $this->client->request($method, $endpoint, $options);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function projects(): Paginator
    {
        $response = $this->get('users/'.$this->user.'/projects');

        return Paginator::fromResponse($response)->apply(Project::class);
    }

    public function summaries(array $parameters): Summaries
    {
        $response = $this->get("users/$this->user/summaries", $parameters);

        return new Summaries($response);
    }
}
