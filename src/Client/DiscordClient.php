<?php

namespace App\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final class DiscordClient implements DiscordClientInterface
{
    private string $discordWebhookUrl;

    public function __construct(
        HttpClientInterface $httpClient,
        string $discordWebhookUrl
    ) {
        $this->httpClient = $httpClient;
        $this->discordWebhookUrl = $discordWebhookUrl;
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

        $response = $this->httpClient->request('POST', $this->discordWebhookUrl, $options);

        return $response->getContent();
    }
}