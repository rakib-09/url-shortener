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
        $this->fullUrl = rtrim($fullUrl, '/');
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
            throw new RuntimeException("Something went wrong!");
        }
    }

    /**
     * @return Link
     */
    public function decodeUrl(): Link
    {
        $id = $this->engine->decoder($this->shortUrl);
        if ($id) {
            $link = $this->repository->setId($id)->getById();
            if ($link) {
                return $link;
            }
        }
        throw new RuntimeException('Sorry! invalid URL.');
    }

    /**
     * @param LinkRepository $linkRepo
     * @return Link
     */
    private function insertIntoDB(LinkRepository $linkRepo): Link
    {
        $id = UniqueIdGenerator::getId();
        $shortUrl = $this->engine->encoder($id);
        return $linkRepo->setId($id)->setShortUrl($shortUrl)->create();
    }
}
