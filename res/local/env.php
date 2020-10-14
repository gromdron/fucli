<?php

/**
 * This file parse env file and assign bitrix core env dictionary 
 * File moved from DOCUMENT_ROOT directory for security reasons
 */
use \Bitrix\Main;

$envPath = dirname($_SERVER['DOCUMENT_ROOT']);

if ( file_exists($envPath.'/.env') )
{
	$env = Main\Context::getCurrent()->getEnvironment();

	$iniParams = \parse_ini_file($envPath.'/.env', true, INI_SCANNER_TYPED);

	foreach ($iniParams as $key => $value)
	{
		$env->set($key, $value);
	}
}