<?php

namespace App\Contracts;

interface UrlEngineContract
{
    public function encoder(int $id): string;

    public function decoder(string $shortUrl): int|string;
}
