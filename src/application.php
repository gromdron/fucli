<?php

/**
 * General file includes all registred commands
 * usable by symfony console
 */

require_once(__DIR__.'/../vendor/autoload.php');

use \Fusion\Command;
use \Symfony\Component\Console;


$application = new Console\Application();

$application->add(new Command\ShowLicenseKey());

$application->add(new Command\MakeLocal());

$application->add(new Command\MakeComponent());

$application->add(new Command\MakeInstall());

$application->run();