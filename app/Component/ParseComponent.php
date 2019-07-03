<?php

namespace App\Component;

use App\Interfaces\HandlerInterface;
use DOMDocument;

final class ParseComponent
{
    /**
     * @param HandlerInterface $handler
     * @param DOMDocument $dom
     * @param string $baseUrl
     * @return array
     */
    public function parse(HandlerInterface $handler, DOMDocument $dom, string $baseUrl): array
    {
        return $handler->getAttributes($dom, $baseUrl);
    }
}