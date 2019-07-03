<?php

namespace App\Storage;

use App\Exception\ParserException;
use App\Helper\Hash;
use App\Interfaces\StorageInterface;
use App\ValueObject\Domain;

final class CsvStorage implements StorageInterface
{
    private const FILE_EXTENSION = '.csv';
    private const READ_MODE = 'r';
    private const WRITE_MODE = 'w';

    /**
     * @param string $domain
     * @param array $data
     * @return string
     */
    public function save(string $domain, array $data): string
    {
        $filename = $this->getFilename($domain);
        $file = $this->getFileResource($filename, self::WRITE_MODE);

        fputcsv($file, $data);

        return $filename;
    }

    /**
     * @param string $domain
     * @return string
     */
    public function getReportFilePath(string $domain): string
    {
        $filename = $this->getFilename($domain);
        $file = $this->getFileResource($filename, self::READ_MODE);

        return $filename;
    }

    /**
     * @param string $filename
     * @param string $mode
     * @return resource
     * @throws ParserException
     */
    private function getFileResource(string $filename, string $mode)
    {
        $file = fopen($filename, $mode);

        if (empty($file)) {
            throw new ParserException('Such file does not exist!');
        }

        return $file;
    }

    /**
     * @param string $domain
     * @return string
     */
    private function getFilename(string $domain): string
    {
        return REPORT_DIR . Hash::make($domain) . self::FILE_EXTENSION;
    }
}