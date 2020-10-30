<?php

namespace Fusion\Command;

use Symfony\Component\Console;

class Base extends Console\Command\Command
{

	const OBJ_TYPE_FILE = 'file';
	const OBJ_TYPE_DIR  = 'dir';

	/**
	 * Return inner file path
	 * 
	 * @param string $fileName 
	 * @throws Exception local object not found
	 * @return string
	 */
	protected function getPharPath( $fileName )
	{
		$localPath = "phar://fucli.phar/res/".$this->getResourcePath()."/".$fileName;

		if ( !file_exists($localPath) )
		{
			throw new \Exception("Local path ".$localPath." not found");
		}

		return $localPath;
	}

	/**
	 * Return command source files path
	 * 
	 * @return string
	 */
	protected function getResourcePath()
	{
		return '';
	}

	/**
	 * Return install disk object list
	 * 
	 * @return array
	 */
	protected function getPathStructure()
	{
		return [];
	}

}