<?php

namespace App\Helper;

use App\Exception\ParserException;

final class CommandHelper
{
    /**
     * @var array
     */
    private $commands;

    /**
     * @var
     */
    private $class;

    /**
     * CommandHelper constructor.
     * @param array $commands
     */
    public function __construct(array $commands)
    {
        $this->commands = $commands;
    }

    /**
     * @param string $incomingCommand
     * @return CommandHelper
     * @throws ParserException
     */
    public function verifyCommandExistence(string $incomingCommand): CommandHelper
    {
        if ($incomingCommand === null || array_key_exists($incomingCommand, $this->commands) === false || $this->commands[$incomingCommand]['enabled'] === false) {
            throw new ParserException('Such command does not exist!');
        }

        $this->class = $this->commands[$incomingCommand]['class'];

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCommandClass()
    {
        return new $this->class();
    }
}