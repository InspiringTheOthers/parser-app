<?php

namespace App\Console\Command;

use App\Component\ParseComponent;
use App\Formatter\TextFormatter;
use App\Interfaces\CommandInterface;
use App\Storage\CsvStorage;
use App\ValueObject\Domain;
use App\DTO\CommandDTO;
use App\Http\Client\HttpClient;
use DOMDocument;
use App\Service\ParseService;

final class ParseCommand implements CommandInterface
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
     * @var ParseService
     */
    private $parseService;

    /**
     * ParseCommand constructor.
     */
    public function __construct()
    {
        $this->parseService = $this->getParseService();
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

        $parseResults = $this->parseService->parse($url)->getResults();
        $outputLayout = $this->textFormatter->color($commandDTO->getOutput(), TextFormatter::GREEN_COLOR);
        $path = $this->storage->save($url, $parseResults);

        return str_replace('{path}', $path, $outputLayout);
    }

    /**
     * @return ParseService
     */
    private function getParseService(): ParseService
    {
        $httpClient = new HttpClient();
        $dom = new DOMDocument();
        $component = new ParseComponent();

        return new ParseService($httpClient, $dom, $component);
    }
}