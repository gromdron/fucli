<?php

/**
 * This file contain old legacy code include constant initialization
 * All code in this file in next updates should be moved into new
 * app structure if can.
 * 
 * For constant definitions:
 *     - each constant must contain a reasonable prefix and postfix
 *     - each constant must use english named
 * Example: 
 *     STRUCTURE_IBLOCK_ID is a valid constant
 *     INFOBLOK_VIZUALNOY_STRUCTURI is a invalid
 *
 * Additional in this file you can:
 *
 * 1. Include lang file:
 *    \Bitrix\Main\Localization\Loc::loadMessages(__FILE__);
 *    Then create lang/<LID>/legacy.php with phrases
 *
 * 2. Debug Vue app with:
 *    define('VUEJS_DEBUG', true);
 *    define('VUEJS_LOCALIZATION_DEBUG', true);
 *
 * 3. Define `custom_mail` function
 *
 * 4. Configure theme override
 *
 * and etc
 */