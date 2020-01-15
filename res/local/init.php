<?php

/**
 * - /local/classes/{Path|raw}/{*|raw}.php
 * - /local/classes/{Path|ucfirst,lowercase}/{*|ucfirst,lowercase}.php
 */
spl_autoload_register(function($sClassName)
{

	$sClassFile = __DIR__.'/classes';

	if ( file_exists($sClassFile.'/'.str_replace('\\', '/', $sClassName).'.php') )
	{
		require_once($sClassFile.'/'.str_replace('\\', '/', $sClassName).'.php');
	}

	$arClass = explode('\\', strtolower($sClassName));
	foreach($arClass as $sPath )
	{
	    $sClassFile .= '/'.ucfirst($sPath);
	}
	$sClassFile .= '.php';
	if (file_exists($sClassFile))
	{
		require_once($sClassFile);
	}
});

/**
 * File with event handlers
 */
require_once(__DIR__.'/events.php');

/**
 * File with project constants
 */
require_once(__DIR__.'/constants.php');

/**
 * For composer projects
 */
if ( file_exists(__DIR__.'/vendor/autoload.php') )
{
	require_once(__DIR__.'/vendor/autoload.php');
}