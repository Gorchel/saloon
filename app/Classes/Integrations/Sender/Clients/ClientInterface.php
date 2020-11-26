<?php

namespace App\Classes\Integrations\Sender\Clients;

interface ClientInterface
{
    public function send(string $template, array $option = []): bool;
}
