<?php

namespace App\Interfaces;

interface StorageInterface
{
    /**
     * @param string $domain
     * @param array $data
     * @return string
     */
    public function save(string $domain, array $data): string;

    /**
     * @param string $domain
     * @return string
     */
    public function getReportFilePath(string $domain): string;
}