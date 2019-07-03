<?php

namespace App\Console\Command;

use App\Formatter\TextFormatter;
use App\DTO\CommandDTO;
use App\Interfaces\CommandInterface;

final class HelpCommand implements CommandInterface
{
    /**
     * @var TextFormatter
     */
    private $textFormatter;

    /**
     * HelpCommand constructor.
     */
    public function __construct()
    {
        $this->textFormatter = new TextFormatter();
    }

    /**
     * @param CommandDTO $commandDTO
     * @return string
     */
    public function run(CommandDTO $commandDTO): string
    {
        $outputValue = $commandDTO->getOutput();
        $outputValue = $this->textFormatter->color($outputValue, TextFormatter::LIGHT_BLUE_COLOR);

        return $outputValue;
    }
}