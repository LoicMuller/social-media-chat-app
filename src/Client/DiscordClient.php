<?php

namespace App\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final class DiscordClient implements DiscordClientInterface
{
    private string $webhookUrl;

    public function __construct(
        HttpClientInterface $httpClient,
        string $webhookUrl
    ) {
        $this->httpClient = $httpClient;
        $this->webhookUrl = $webhookUrl;
    }

    public function executeRequest(string $content): string
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'content' => $content,
            ]
        ];

        $response = $this->httpClient->request('POST', $this->webhookUrl, $options);

        return $response->getContent();
    }
}