<?php

/**
 * This file store additional requirements for project
 * etc: env data, service locator initialization
 * 
 * @see https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=14032&LESSON_PATH=3913.5062.14032
 */

use \Bitrix\Main;

/**
 * Env section
 * File moved from DOCUMENT_ROOT directory for security reasons
 */
$envPath = dirname($_SERVER['DOCUMENT_ROOT']);

if ( file_exists($envPath.'/.env') )
{
	$env = Main\Context::getCurrent()->getEnvironment();

	$iniParams = \parse_ini_file($envPath.'/.env', true, INI_SCANNER_TYPED);

	foreach ($iniParams as $key => $value)
	{
		$env->set($key, $value);
	}
	unset($iniParams);
}
unset($envPath);

/**
 * Service locator section
 *   if exist
 */
if ( class_exists('Main\DI\ServiceLocator') )
{
	$serviceLocator = Main\DI\ServiceLocator::getInstance();

	/**
	 * service location naming convention:
	 *     * must contant vendor.
	 *     * must be lowercase
	 *         OK: 'fusion.exchange.service', 'sber.payment.service'
	 *         BAD: 'FUSION_SOME_SERVICE', 'COOL_SERVICE', 'TaSk.SerViCE.i18n'
	 * 
	 * Examples:
	 * 
	 * $serviceLocator->addInstanceLazy('fusion.some.service', [
	 *     'constructor' => static function () use ($serviceLocator) {
	 *         return new \Fusion\SomeModule\Services\SecondService('foo', 'bar');
	 *     }
	 * ]);
	 * 
	 * $serviceLocator->addInstanceLazy('fusion.some.service', [
	 *     'className' => \Fusion\SomeModule\Services\SomeService::class,
	 * ]);
	 * 
	 */
}