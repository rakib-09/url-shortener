<?php

namespace App\Contracts;

interface UrlVerificationContract
{
    public function isSafeUrl(string $url): bool;
}
