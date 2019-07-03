<?php

namespace App\Interfaces;

use DOMDocument;

interface ComponentInterface
{
    /**
     * @param HandlerInterface $handler
     * @param DOMDocument $dom
     * @param string $baseUrl
     * @return array
     */
    public function parse(HandlerInterface $handler, DOMDocument $dom, string $baseUrl): array;
}