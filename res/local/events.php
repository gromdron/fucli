<?php

/**
 * This file contains a full list of custom event handlers
 * Code the handlers need NOT be contained in this file. 
 * It needs to be made relevant to the PSR-[0-4] structure, classes
 */

$eventManager = \Bitrix\Main\EventManager::getInstance();

/**
 * For new core of bitrix use
 *     $eventManager->addEventHandler( #module#, #handler#, [#namespace#, #function#]);
 * 
 * For old core of bitrix use
 *     $eventManager->addEventHandlerCompatible( #module#, #handler#, [#namespace#, #function#]);
 */
