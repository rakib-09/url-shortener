<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlShortenerRequest;
use App\Http\Resources\UrlShortenerResource;
use App\Services\UrlShortenerService;
use Illuminate\Http\JsonResponse;

class UrlShortenerController extends Controller
{
    public function __construct(private UrlShortenerService $service)
    {
    }

    public function create(UrlShortenerRequest $request): JsonResponse
    {
        $data = $request->validated();
        $encodedUrl = $this->service->setFullUrl($data['full_url'])->encodeUrl();
        return $this->payload(new UrlShortenerResource($encodedUrl));
    }

    public function show(string $link): JsonResponse
    {
        $decodedUrl = $this->service->setShortUrl($link)->decodeUrl();
        return $this->payload(new UrlShortenerResource($decodedUrl));
    }
}
