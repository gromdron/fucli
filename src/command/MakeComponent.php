<?php

namespace Fusion\Command;

use Symfony\Component\Console\Input;
use Symfony\Component\Console\Output;
use Symfony\Component\Console\Style;

class MakeComponent extends Base
{
	protected function configure()
	{
		$this
			->setName('make:component')
			->setDescription('Create empty component')
			->setHelp("This command will create empty component");
	}

	/**
	 * @see parent:getResourcePath()
	 * 
	 * @return string
	 */
	protected function getResourcePath()
	{
		return 'component';
	}

	protected function getComponentStructure( $vendor, $componentName )
	{
		return [
			// Base structure
			[
				'PATH'   => 'class.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'class.php', 
			],
			[
				'PATH'   => 'templates/.default/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => 'templates/.default/template.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'templates/.default/template.php', 
			],

			// Technical data
			[
				'PATH'   => '.parameters.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => '.parameters.php', 
			],
			[
				'PATH'   => '.description.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => '.description.php', 
			],

			// Lang files
			[
				'PATH'   => 'lang/ru/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => 'lang/ru/.description.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'lang/ru/.description.php', 
			],
			[
				'PATH'   => 'lang/ru/.parameters.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'lang/ru/.parameters.php', 
			],
			[
				'PATH'   => 'lang/ru/class.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'lang/ru/class.php', 
			],
			[
				'PATH'   => 'templates/.default/lang/ru/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => 'templates/.default/lang/ru/template.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'templates/.default/lang/ru/template.php', 
			],
		];
	}

	protected function execute(Input\InputInterface $input, Output\OutputInterface $output)
	{
		$io = new Style\SymfonyStyle($input, $output);

		$destination = $io->ask('Destination path (local/bitrix)', 'local', function($destination){

			if ( !in_array($destination, ['local','bitrix']) )
			{
				throw new \RuntimeException('Only [local] and [bitrix] can be destination');
			}

			if ( $destination=='local' && !file_exists(getcwd().'/local/') )
			{
				throw new \RuntimeException('You choose local directory, but local not exist. Run make:local command first or choose [bitrix].');
			}

			return $destination;
		});

		$vendor = $io->ask('Vendor name', 'fusion', function($vendor){

			if ( !preg_match('#([0-9a-zA-Z.]*)#', $vendor) )
			{
				throw new \RuntimeException('Incorrect vendor name. Vendor name can contain only [0-9], [a-zA-Z] and dots');
			}

			$firstLetter = substr($vendor, 0, 1);
			if ( !preg_match('#[a-zA-Z]#', $firstLetter) )
			{
				throw new \RuntimeException('Incorrect vendor name. First letter must be a char');
			}

			if ( $vendor=='bitrix' )
			{
				throw new \RuntimeException('Vendor name "bitrix" restricted');
			}

			return $vendor;
		});

		$component = $io->ask('Component name', 'empty.component', function($component){

			if ( !preg_match('#([0-9a-zA-Z.]*)#', $component) )
			{
				throw new \RuntimeException('Incorrect component name. Component name can contain only [0-9], [a-zA-Z] and dots');
			}

			return $component;
		});

		$componentPath = getcwd().'/'.$destination.'/components/'.$vendor.'/'.$component.'/';
		
		if ( file_exists($componentPath) )
		{
			$io->error('This component already exist');
			return;
		}

		if ( !mkdir($componentPath, 0755, true) )
		{
			$io->error('Internal error when create directory '.getcwd().$path['PATH']);
			return;
		}

		foreach ($this->getComponentStructure($vendor, $component) as $path)
		{
			if ( $path['TYPE'] == static::OBJ_TYPE_DIR )
			{
				if ( !mkdir($componentPath.$path['PATH'], 0755, true) )
				{
					$io->error('Internal error when create directory '.getcwd().$path['PATH']);
					return;
				}
			}
			else
			{
				$file = file_get_contents($this->getPharPath( $path['SOURCE'] ));
				file_put_contents($componentPath.$path['PATH'], $file);
			}
		}

		$io->success('Component successfully generated in '.$componentPath);
	}
}