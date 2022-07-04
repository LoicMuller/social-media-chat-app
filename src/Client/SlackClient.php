<?php

namespace App\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final class SlackClient implements SlackClientInterface
{
    private string $slackWebhookUrl;

    public function __construct(
        HttpClientInterface $httpClient,
        string $slackWebhookUrl
    ) {
        $this->httpClient = $httpClient;
        $this->slackWebhookUrl = $slackWebhookUrl;
    }

    public function executeRequest(string $content): string
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'text' => $content,
            ]
        ];

        $response = $this->httpClient->request('POST', $this->slackWebhookUrl, $options);

        return $response->getContent();
    }
}