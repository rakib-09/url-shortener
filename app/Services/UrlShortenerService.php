<?php

namespace App\Services;

use App\Contracts\UrlEngineContract;
use App\Contracts\UrlVerificationContract;
use App\Models\Link;
use App\Repository\LinkRepository;
use Illuminate\Database\QueryException;
use RuntimeException;

class UrlShortenerService extends Service
{
    private string $fullUrl;
    private string $shortUrl;

    public function __construct(
        private UrlEngineContract $engine,
        private LinkRepository $repository,
        private UrlVerificationContract $urlVerifier
    ) {
    }

    /**
     * @param string $fullUrl
     * @return UrlShortenerService
     */
    public function setFullUrl(string $fullUrl): UrlShortenerService
    {
        $this->fullUrl = $fullUrl;
        return $this;
    }

    /**
     * @param string $shortUrl
     * @return UrlShortenerService
     */
    public function setShortUrl(string $shortUrl): UrlShortenerService
    {
        $this->shortUrl = $shortUrl;
        return $this;
    }

    /**
     * @return Link
     */
    public function encodeUrl(): Link
    {
        try {
            $linkRepo = $this->repository->setFullUrl($this->fullUrl);
            $encodedUrl = $linkRepo->getByFullUrl();
            if ($encodedUrl) {
                return $encodedUrl;
            }
            if (!$this->urlVerifier->isSafeUrl($this->fullUrl)) {
                throw new RuntimeException("Unsafe URL!");
            }

            return $this->insertIntoDB($linkRepo);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                return $this->insertIntoDB($linkRepo);
            }
        }
    }

    /**
     * @return Link
     */
    public function decodeUrl(): Link
    {
        $filteredUrl = str_replace('base_url', '', $this->shortUrl);
        $id = $this->engine->decoder($filteredUrl);
        if ($id) {
            $link = $this->repository->setId($id)->getById();
            if ($link) {
                return $link;
            }
        }
        throw new RuntimeException('Sorry! invalid URL.');
    }

    private function insertIntoDB($linkRepo)
    {
        $id = UniqueIdGenerator::getId();
        $shortUrl = $this->engine->encoder($id);
        return $linkRepo->setId($id)->setShortUrl($shortUrl)->create();
    }
}
