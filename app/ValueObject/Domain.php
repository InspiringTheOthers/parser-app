<?php

namespace App\ValueObject;

use App\Exception\ParserException;
use Exception;

final class Domain
{
    private const DEFAULT_SCHEME = 'https://';

    /**
     * @var string
     */
    private $url;

    /**
     * Domain constructor.
     * @param string $url
     * @throws Exception
     */
    public function __construct(string $url)
    {
        $parsedUrl = parse_url($url);

        if (filter_var($url, FILTER_VALIDATE_URL) === false && empty($parsedUrl['path'])) {
            throw new ParserException('Domain is not correct!');
        }

        $this->url = $url;

        if (empty($parsedUrl['scheme'])) {
            $this->url = self::DEFAULT_SCHEME . $this->url;
        }
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->url;
    }
}