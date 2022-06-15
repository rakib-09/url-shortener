<?php

namespace App\Contracts;

interface UrlEngineContract
{
    public function encoder($id): string;

    public function decoder($shortUrl): int|string;
}
