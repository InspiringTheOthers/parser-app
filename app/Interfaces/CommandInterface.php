<?php

namespace App\Interfaces;

use App\DTO\CommandDTO;

interface CommandInterface
{
    /**
     * @param CommandDTO $commandDTO
     * @return string
     */
    public function run(CommandDTO $commandDTO): string;
}