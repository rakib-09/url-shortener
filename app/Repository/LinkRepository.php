<?php

namespace App\Repository;

use App\Models\Link;

class LinkRepository
{
    private int $id;
    private string $shortUrl;
    private string $fullUrl;

    /**
     * @param int $id
     * @return LinkRepository
     */
    public function setId(int $id): LinkRepository
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $shortUrl
     * @return LinkRepository
     */
    public function setShortUrl(string $shortUrl): LinkRepository
    {
        $this->shortUrl = $shortUrl;
        return $this;
    }

    /**
     * @param string $fullUrl
     * @return LinkRepository
     */
    public function setFullUrl(string $fullUrl): LinkRepository
    {
        $this->fullUrl = $fullUrl;
        return $this;
    }

    /**
     * @return Link
     */
    public function create(): Link
    {
        return Link::create([
            'id' => $this->id,
            'short_url' => $this->shortUrl,
            'full_url' => $this->fullUrl
        ]);
    }

    /**
     * @return Link|null
     */
    public function getByShortUrl(): Link|null
    {
        return $this->get(['short_url' => $this->shortUrl]);
    }

    /**
     * @return Link|null
     */
    public function getByFullUrl(): Link|null
    {
        return $this->get(['full_url' => $this->fullUrl]);
    }

    /**
     * @return Link|null
     */
    public function getById(): Link|null
    {
        return $this->get(['id' => $this->id]);
    }

    /**
     * @param array $where
     * @return Link|null
     */
    private function get(array $where): Link|null
    {
        return Link::where($where)->first();
    }
}
