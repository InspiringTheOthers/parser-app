<?php

namespace App\Handler;

use App\Interfaces\HandlerInterface;
use DOMDocument;

final class UrlHandler implements HandlerInterface
{
    private const TAG_ALIAS = 'a';
    private const TAG_LINK = 'href';

    /**
     * @var array
     */
    private $resultContainer = [];

    /**
     * @param DOMDocument $dom
     * @param $baseUrl
     * @return array
     */
    public function getAttributes(DOMDocument $dom, $baseUrl): array
    {
        $result = $this->resultContainer;
        $elements = $dom->getElementsByTagName(self::TAG_ALIAS);

        foreach ($elements as $element) {
            $elementAttribute = $element->getAttribute(self::TAG_LINK);

            $receivedUrl = filter_var($elementAttribute, FILTER_VALIDATE_URL) !== false ? $elementAttribute : $baseUrl . $elementAttribute;

            if (array_search($receivedUrl, $result) === false) {
                $result[] = $receivedUrl;
            }
        }

        return $result;
    }
}