<?php

namespace App\Services\UrlVerification;

use App\Contracts\UrlVerificationContract;
use Illuminate\Support\Facades\Http;
use RuntimeException;

use function config;

class GoogleVerificationService implements UrlVerificationContract
{
    private string $googleUrl;
    private string $apiKey;
    private string $clientId;
    private string $clientVersion;
    private array $threatTypes;
    private array $platformTypes;

    public function __construct()
    {
        $this->googleUrl = config('safe-browsing.google.url');
        $this->apiKey = config('safe-browsing.google.api_key');
        $this->clientId = config('safe-browsing.google.clientId');
        $this->clientVersion = config('safe-browsing.google.clientVersion');
        $this->threatTypes = config('safe-browsing.google.threatTypes');
        $this->platformTypes = config('safe-browsing.google.threatPlatforms');
    }

    /**
     * @param string $url
     * @return bool
     */
    public function isSafeUrl(string $url): bool
    {
        $this->checkApiKey();
        $result = $this->getApiResponse($url);
        return !(is_array($result) && isset($result['matches']));
    }

    /**
     * @return void
     */
    private function checkApiKey(): void
    {
        if (empty($this->apiKey)) {
            throw new RuntimeException('API Key is required');
        }
    }

    /**
     * @param string $url
     * @return array|string
     */
    private function getApiResponse(string $url): array|string
    {
        $googleUrl = $this->googleUrl . '?key=' . $this->apiKey;
        $data = [
            'client' => [
                'clientId' => $this->clientId,
                'clientVersion' => $this->clientVersion,
            ],
            'threatInfo' => [
                'threatTypes' => $this->threatTypes,
                'platformTypes' => $this->platformTypes,
                'threatEntryTypes' => ['URL'],
                'threatEntries' => [
                    [
                        'url' => $url,
                    ],
                ],
            ],
        ];
        $response = Http::post($googleUrl, $data);
        if ($response->failed()) {
            throw new RuntimeException($response->json('error.message'));
        }

        return $response->json();
    }
}
