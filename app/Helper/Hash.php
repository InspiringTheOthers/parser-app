<?php

namespace App\Helper;

final class Hash
{
    /**
     * @param string $text
     * @return string
     */
    public static function make(string $text): string
    {
        return sha1($text);
    }
}