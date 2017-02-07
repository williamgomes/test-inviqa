<?php
$loader = require_once __DIR__ . "/./vendor/autoload.php";

use Symfony\Component\Console\Application;
use Willy\PaydayGeneratorCommand;

$console = new Application();
$console->add(new PaydayGeneratorCommand());
$console->run();