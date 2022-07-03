<?php

declare(strict_types=1);

namespace App\Client;

interface DiscordClientInterface
{
    public function executeRequest(string $content): string;
}