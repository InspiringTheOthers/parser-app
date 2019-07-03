<?php

defined('LOG_DIR') or define('LOG_DIR', './storage/logs/');
defined('REPORT_DIR') or define('REPORT_DIR', './storage/reports/');

$commandConfig = require('./config/command.php');
$vocabularyConfig = require('./config/vocabulary.php');
$consoleConfig = require('./config/console.php');

error_reporting(E_ERROR | E_PARSE);