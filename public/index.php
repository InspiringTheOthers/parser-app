#!/usr/bin/env php
<?php

use App\Helper\CommandHelper;
use App\DTO\CommandDTO;
use App\ValueObject\Domain;

require('./vendor/autoload.php');
require('./config/app.php');

$commandHelper = new CommandHelper($commandConfig);

$options = getopt($consoleConfig['options'], $consoleConfig['aliases']);

$commandName = key($options);

$commandValue = $options[$commandName];
$vocabularyValue = $vocabularyConfig[$commandName];

if (!empty($commandValue)) {
    $domain = new Domain($commandValue);
    $commandValue = $domain->get();
}

$commandDTO = new CommandDTO($commandValue, $vocabularyValue);

$commandClass = $commandHelper->verifyCommandExistence($commandName)->getCommandClass();

echo $commandClass->run($commandDTO) . PHP_EOL;