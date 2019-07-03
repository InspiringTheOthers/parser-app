<?php

namespace App\Console\Command;

use App\DTO\CommandDTO;
use App\Interfaces\CommandInterface;
use App\Storage\CsvStorage;
use App\ValueObject\Domain;
use App\Formatter\TextFormatter;

final class ReportCommand implements CommandInterface
{
    /**
     * @var TextFormatter
     */
    private $textFormatter;

    /**
     * @var CsvStorage
     */
    private $storage;

    /**
     * ReportCommand constructor.
     */
    public function __construct()
    {
        $this->storage = new CsvStorage();
        $this->textFormatter = new TextFormatter();
    }

    /**
     * @param CommandDTO $commandDTO
     * @return string
     */
    public function run(CommandDTO $commandDTO): string
    {
        $url = $commandDTO->getInput();

        $path = $this->storage->getReportFilePath($url);
        $outputLayout = $this->textFormatter->color($commandDTO->getOutput(), TextFormatter::YELLOW_COLOR);

        return str_replace('{path}', $path, $outputLayout);
    }
}