<?php

namespace App\Services\ShortenerEngine;

use App\Constants\AlphaChars;
use App\Constants\InvChars;
use App\Contracts\UrlEngineContract;

class Base62Encoder implements UrlEngineContract
{
    /** @var int */
    private const BASE = 62;

    public function encoder(int $id): string
    {
        $shortUrl = '';
        while ($id > 0) {
            $remainder = $id % self::BASE;
            $shortUrl .= AlphaChars::LIST[$remainder];
            $id = (int)($id / self::BASE);
        }

        return $shortUrl;
    }

    public function decoder(string $shortUrl): int
    {
        $count = strlen($shortUrl) - 1;
        $baseId = 0;
        $url = str_split(strrev($shortUrl));
        foreach ($url as $char) {
            $baseId += InvChars::LIST[$char] * (self::BASE ** $count--);
        }
        return $baseId;
    }

}
