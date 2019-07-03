<?php

namespace App\Service;

use App\Component\ParseComponent;
use App\Handler\ImageHandler;
use App\Handler\UrlHandler;
use App\Helper\Counter;
use App\Interfaces\ComponentInterface;
use App\Interfaces\HttpClientInterface;
use DOMDocument;
use App\Http\Client\HttpClient;
use App\Exception\ParserException;

final class ParseService
{
    private const DEFAULT_AMOUNT_URLS = 10;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var DOMDocument
     */
    private $dom;

    /**
     * @var ParseComponent
     */
    private $component;

    /**
     * @var ImageHandler
     */
    private $imageHandler;

    /**
     * @var UrlHandler
     */
    private $urlHandler;

    /**
     * @var array
     */
    private $result = [];

    /**
     * @var array
     */
    private $urls = [];

    /**
     * ParseService constructor.
     * @param HttpClientInterface $httpClient
     * @param DOMDocument $dom
     * @param ComponentInterface $component
     */
    public function __construct(HttpClientInterface $httpClient, DOMDocument $dom, ComponentInterface $component)
    {
        $this->httpClient = $httpClient;
        $this->dom = $dom;
        $this->counter = new Counter();
        $this->component = $component;
        $this->imageHandler = new ImageHandler();
        $this->urlHandler = new UrlHandler();
    }

    /**
     * @param string $baseUrl
     * @return ParseService
     */
    public function parse(string $baseUrl): ParseService
    {
        $this->urls[] = $this->getCorrectBaseUrl($baseUrl);

        try {
            array_walk($this->urls, function ($url) use ($baseUrl) {
                $this->getNeededAttributesFromCurrentUrl($baseUrl, $url);
            });
        } catch (ParserException $e) {
        }

        return $this;
    }

    /**
     * @param string $baseUrl
     * @param string $url
     * @throws ParserException
     */
    private function getNeededAttributesFromCurrentUrl(string $baseUrl, string $url)
    {
        if ($this->counter->getCurrentValue() === self::DEFAULT_AMOUNT_URLS) {
            throw new ParserException();
        }

        $page = $this->httpClient->setUrl($url)->get();

        if ($page !== null) {
            $this->dom->loadHTML($page);

            $images = $this->component->parse($this->imageHandler, $this->dom, $baseUrl);
            $links = $this->component->parse($this->urlHandler, $this->dom, $baseUrl);

            $this->addNewLinksToExistingUrlArray($links);
            $this->result = array_merge($this->result, $images, $links);
        }

        $this->counter->plus();
    }

    /**
     * @param array $links
     */
    private function addNewLinksToExistingUrlArray(array $links): void
    {
        foreach ($links as $link) {
            $this->urls[] = $link;
        }
    }

    /**
     * @param $baseUrl
     * @return string
     */
    private function getCorrectBaseUrl($baseUrl): string
    {
        return $baseUrl . '/';
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return array_unique($this->result);
    }
}