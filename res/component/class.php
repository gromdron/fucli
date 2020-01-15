<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
use \Bitrix\Main\Engine;
//use \Bitrix\Main\Config\Option;
//use \Bitrix\Main\Localization\Loc;

//Loc::loadMessages(__FILE__);

class StubComponent 
	extends \CBitrixComponent
	implements 
		Engine\Contract\Controllerable,
		Main\Errorable
{

	/** @var Main\ErrorCollection */
	protected $errorCollection;

	public function __construct($component = null)
	{
		parent::__construct($component);
		$this->errorCollection = new Main\ErrorCollection();
	}

	/**
	 * Return true if collection has errors.
	 *
	 * @return boolean
	 */
	public function hasErrors()
	{
		if ($this->errorCollection instanceof Main\ErrorCollection)
		{
			return !$this->errorCollection->isEmpty();
		}

		return false;
	}

	/**
	 * Getting array of errors.
	 *
	 * @return Error[]
	 */
	public function getErrors()
	{
		if ($this->errorCollection instanceof Main\ErrorCollection)
		{
			return $this->errorCollection->toArray();
		}

		return [];
	}

	/**
	 * Returns an error with the necessary code.
	 *
	 * @param string|int $code The code of the error.
	 *
	 * @return Error|null
	 */
	public function getErrorByCode($code)
	{
		if ($this->errorCollection instanceof Main\ErrorCollection)
		{
			return $this->errorCollection->getErrorByCode($code);
		}

		return null;		
	}

	/**
	 * @see Engine\Contract\Controllerable::configureActions()
	 * @return array
	 */
	public function configureActions()
	{
		return [
			'test' => [
				'prefilters' => [
					new Engine\ActionFilter\Authentication()
				],
    			'postfilters' => []
    		]
		];
	}

	public function testAction( $errorNumbers = 0 )
	{
		for($i=0; $i<$errorNumbers; $i++)
		{
			$this->errorCollection->add( new Main\Error('Error №'.$i) );
		}

		return [
			'result'
		];
	}

	/**
	 * This function prepare component params
	 * @param  array $params 
	 * @return array
	 */
	public function onPrepareComponentParams( $params )
	{
		//$params["IBLOCK_ID"] = intval($params['IBLOCK_ID']);

		return $params;
	}

	/**
	 * Main component function
	 * @return void
	 */
	public function executeComponent()
	{
		$this->arResult = [
			//'TITLE' => Loc::getMessage('COMPONENT_TITLE')
		];
		
		$this->includeComponentTemplate();
	}
}