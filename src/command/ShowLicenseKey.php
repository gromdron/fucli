<?php

namespace Fusion\Command;

use Symfony\Component\Console\Input;
use Symfony\Component\Console\Output;
use Symfony\Component\Console\Style;

class ShowLicenseKey extends Base
{
	protected function configure()
	{
		$this
			->setName('show:license')
			->setDescription('Display bitrix license key')
			->setHelp("This command will show you a license key");
	}

	protected function execute(Input\InputInterface $input, Output\OutputInterface $output)
	{
		$io = new Style\SymfonyStyle($input, $output);

		if ( !file_exists(getcwd().'/bitrix/license_key.php') )
		{
			$io->error('File, contains license key not found!');
			return;
		}

		require_once(getcwd().'/bitrix/license_key.php');

		if ( !empty($LICENSE_KEY) )
		{
			$io->success('Your license key is: '.$LICENSE_KEY);
			return;
		}

		$io->error('File found, but key is undefined!');
	}
}