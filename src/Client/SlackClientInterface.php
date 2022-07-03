<?php

declare(strict_types=1);

namespace App\Client;

interface SlackClientInterface
{
    public function executeRequest(string $content): string;
}