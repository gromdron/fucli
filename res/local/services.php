<?php

/**
 * This file store additional requirements for project
 * etc: service locator initialization
 * 
 * @see https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=14032&LESSON_PATH=3913.5062.14032
 */

use \Bitrix\Main;

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