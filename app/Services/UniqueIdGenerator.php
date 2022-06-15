<?php

namespace App\Services;

final class UniqueIdGenerator
{
    public static function getId(): int
    {
        return abs(crc32(uniqid('', true)));
    }
}
