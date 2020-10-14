<?php

/**
 * Project configuration 
 * 
 * Maker project from current bitrix portal
 * Need to create/deploy new mechanics
 * 
 * Console run only
 */


if (php_sapi_name() != 'cli')
{
	die();
}

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS",true);
define("BX_NO_ACCELERATOR_RESET", true);
define("BX_CRONTAB", true);
define("STOP_STATISTICS", true);
define("NO_AGENT_STATISTIC", "Y");
define("DisableEventsCheck", true);
define("NO_AGENT_CHECK", true);

$_SERVER['DOCUMENT_ROOT'] = realpath('/home/bitrix/www');
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

/** Include bitrix core */
require_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";

@session_destroy();

use \Fusion\Tools;

$steps = [
];

foreach ($steps as $step)
{
	$stepPath = realpath(__DIR__.'/steps/').'/'.$step.'.php';

	try
	{
		if ( !file_exists($stepPath) )
		{
			throw new \Exception("Installer file not found {$step}");
		}

		require_once $stepPath;
	}
	catch ( \Throwable $e )
	{
		Tools\Console::write("Step '{$step}' error: \r\n".$e->getMessage(), 'red');
	}

}