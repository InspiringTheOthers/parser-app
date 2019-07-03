<?php

namespace App\DTO;

final class CommandDTO
{
    /**
     * @var string
     */
    private $input;

    /**
     * @var string
     */
    private $output;

    /**
     * CommandDTO constructor.
     * @param string $input
     * @param string $output
     */
    public function __construct(string $input, string $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @return string
     */
    public function getInput(): string
    {
        return $this->input;
    }

    /**
     * @return string
     */
    public function getOutput(): string
    {
        return $this->output;
    }
}