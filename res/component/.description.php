<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;

$arComponentDescription = [
	"NAME"        => Loc::getMessage("COMPONENT_NAME"),
	"DESCRIPTION" => Loc::getMessage("COMPONENT_DESC"),
	"CACHE_PATH"  => "Y",
	"PATH"        => [
		"ID"    => "service",
		"CHILD" => [
			"ID"   => "fusion",
			"NAME" => GetMessage("COMPONENT_VENDOR")
		]
	],
];