<?php

namespace App\Services;

abstract class Service
{
    public static function baseUrl(): string
    {
        return url('/');
    }
}
