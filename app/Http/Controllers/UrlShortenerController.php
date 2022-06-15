<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Services\UrlShortenerService;

class UrlShortenerController extends Controller
{
    public function __construct(private UrlShortenerService $service)
    {
    }

    public function create(UrlShortenerRequest $request)
    {
        $data = $request->validated();
        return $this->service->setFullUrl($data['full_url'])->encodeUrl();
    }

    public function show(string $link)
    {
       return $this->service->setShortUrl($link)->decodeUrl();
    }
}
