<?php

namespace App\Interfaces;

use DOMDocument;

interface HandlerInterface
{
    /**
     * @param DOMDocument $dom
     * @param $baseUrl
     * @return array
     */
    public function getAttributes(DOMDocument $dom, $baseUrl): array;
}