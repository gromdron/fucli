<?php

namespace Fusion\Command;

use Symfony\Component\Console\Input;
use Symfony\Component\Console\Output;
use Symfony\Component\Console\Style;

class MakeInstall extends Base
{
	protected function configure()
	{
		$this
			->setName('make:install')
			->setDescription('Create install path in local project structure')
			->setHelp("This command will create a install directory in php_interface");
	}

	/**
	 * @see parent::getResourcePath()
	 * @return string
	 */
	protected function getResourcePath()
	{
		return 'install';
	}

	/**
	 * @see parent::getPathStructure()
	 * @return string
	 */
	protected function getPathStructure()
	{
		return [
			[
				'PATH'   => '/local/php_interface/install/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => '/local/php_interface/install/steps/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => '/local/php_interface/install/files/',
				'TYPE'   => static::OBJ_TYPE_DIR,
			],
			[
				'PATH'   => '/local/php_interface/install/setup.php',
				'TYPE'   => static::OBJ_TYPE_FILE,
				'SOURCE' => 'setup.php', 
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