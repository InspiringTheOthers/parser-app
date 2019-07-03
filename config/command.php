<?php

return [
    'parse' => [
        'class' => \App\Console\Command\ParseCommand::class,
        'enabled' => true
    ],
    'help' => [
        'class' => \App\Console\Command\HelpCommand::class,
        'enabled' => true
    ],
    'report' => [
        'class' => \App\Console\Command\ReportCommand::class,
        'enabled' => true
    ]
];