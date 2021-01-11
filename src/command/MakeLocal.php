<?php

namespace Fusion\Command;

use Symfony\Component\Console\Input;
use Symfony\Component\Console\Output;
use Symfony\Component\Console\Style;

class MakeLocal extends Base
{
	protected function configure()
	{
		$this
			->setName('make:local')
			->setDescription('Create local directory with default project structure')
			->setHelp("This command will create a local directory with php_interface, components etc.");
	}

	/**
	 * @see parent::getResourcePath()
	 * @return string
	 */
	protected function getResourcePath()
	{
		return 'local';
	}

	/**
	 * @see parent::getPathStructure()
	 * @return string
	 */
	protected function getPathStructure()
	{
		return [
			[
				'PATH'   => '/local/php_interface/classes/Fusion/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => '/local/php_interface/console/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => '/local/tools/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => '/local/components/fusion/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => '/local/php_interface/init.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'init.php', 
			],
			[
				'PATH'   => '/local/php_interface/events.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'events.php', 
			],
			[
				'PATH'   => '/local/php_interface/legacy.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'legacy.php', 
			],
			[
				'PATH'   => '/local/php_interface/kernel.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'kernel.php', 
			],
		];
	}

	protected function execute(Input\InputInterface $input, Output\OutputInterface $output)
	{
		$io = new Style\SymfonyStyle($input, $output);

		if ( file_exists(getcwd().'/local/') )
		{
			$io->error('Local directory already exist in '.getcwd());
			return;
		}

		foreach ($this->getPathStructure() as $path)
		{
			if ( $path['TYPE'] == static::OBJ_TYPE_DIR )
			{
				if ( !mkdir(getcwd().$path['PATH'], 0755, true) )
				{
					$io->error('Internal error when create directory '.getcwd().$path['PATH']);
					return;
				}
			}
			else
			{
				$file = file_get_contents($this->getPharPath( $path['SOURCE'] ));
				file_put_contents(getcwd().$path['PATH'], $file);
			}
		}

		$io->success('Local directory created!');
	}
}