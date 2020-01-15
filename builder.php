<?php

/**
 * Консольный скрипт, генерирующий исполняемый phar-файл
 * После работы скрипта будет сгенерирован в /build/fucli.phar
 */

$pathDeveloper = realpath(getcwd().'/');
$pathPackage   = realpath(getcwd()."/src/");
$pathVendor    = realpath(getcwd()."/vendor/");

// delete temporary file
if ( file_exists('fucli.phar') )
{
	unlink('fucli.phar');
}


$phar = new Phar("fucli.phar", 0, "fucli.phar");
$phar->setSignatureAlgorithm(\Phar::SHA1);

$phar->startBuffering();

fwrite(STDOUT, "Source root path: ".$pathPackage.PHP_EOL);
fwrite(STDOUT, "Vendor path: ".$pathVendor.PHP_EOL);

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pathDeveloper, RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::SELF_FIRST);

$ignoreFileNames = [
	'/builder.php',
	'/composer.json',
	'/composer.lock',
	'/LICENSE.md',
	'/README.md',
	//'/fucli.phar',
	'/vendor/symfony/console/Tester/ApplicationTester.php',
	'/vendor/symfony/console/Tester/CommandTester.php',
	'/vendor/symfony/console/Tests/ApplicationTest.php',
	'/vendor/symfony/console/Tests/Command/CommandTest.php',
	'/vendor/symfony/console/Tests/Command/HelpCommandTest.php',
	'/vendor/symfony/console/Tests/Command/ListCommandTest.php',
	'/vendor/symfony/console/Tests/Descriptor/AbstractDescriptorTest.php',
	'/vendor/symfony/console/Tests/Descriptor/JsonDescriptorTest.php',
	'/vendor/symfony/console/Tests/Descriptor/MarkdownDescriptorTest.php',
	'/vendor/symfony/console/Tests/Descriptor/ObjectsProvider.php',
	'/vendor/symfony/console/Tests/Descriptor/TextDescriptorTest.php',
	'/vendor/symfony/console/Tests/Descriptor/XmlDescriptorTest.php',
	'/vendor/symfony/console/Tests/Fixtures/application_1.json',
	'/vendor/symfony/console/Tests/Fixtures/application_1.md',
	'/vendor/symfony/console/Tests/Fixtures/application_1.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_1.xml',
	'/vendor/symfony/console/Tests/Fixtures/application_2.json',
	'/vendor/symfony/console/Tests/Fixtures/application_2.md',
	'/vendor/symfony/console/Tests/Fixtures/application_2.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_2.xml',
	'/vendor/symfony/console/Tests/Fixtures/application_astext1.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_astext2.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_asxml1.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_asxml2.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_gethelp.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_renderexception1.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_renderexception2.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_renderexception3.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_renderexception3decorated.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_renderexception4.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_renderexception_doublewidth1.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_renderexception_doublewidth1decorated.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_renderexception_doublewidth2.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_run1.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_run2.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_run3.txt',
	'/vendor/symfony/console/Tests/Fixtures/application_run4.txt',
	'/vendor/symfony/console/Tests/Fixtures/BarBucCommand.php',
	'/vendor/symfony/console/Tests/Fixtures/command_1.json',
	'/vendor/symfony/console/Tests/Fixtures/command_1.md',
	'/vendor/symfony/console/Tests/Fixtures/command_1.txt',
	'/vendor/symfony/console/Tests/Fixtures/command_1.xml',
	'/vendor/symfony/console/Tests/Fixtures/command_2.json',
	'/vendor/symfony/console/Tests/Fixtures/command_2.md',
	'/vendor/symfony/console/Tests/Fixtures/command_2.txt',
	'/vendor/symfony/console/Tests/Fixtures/command_2.xml',
	'/vendor/symfony/console/Tests/Fixtures/command_astext.txt',
	'/vendor/symfony/console/Tests/Fixtures/command_asxml.txt',
	'/vendor/symfony/console/Tests/Fixtures/definition_astext.txt',
	'/vendor/symfony/console/Tests/Fixtures/definition_asxml.txt',
	'/vendor/symfony/console/Tests/Fixtures/DescriptorApplication1.php',
	'/vendor/symfony/console/Tests/Fixtures/DescriptorApplication2.php',
	'/vendor/symfony/console/Tests/Fixtures/DescriptorCommand1.php',
	'/vendor/symfony/console/Tests/Fixtures/DescriptorCommand2.php',
	'/vendor/symfony/console/Tests/Fixtures/DummyOutput.php',
	'/vendor/symfony/console/Tests/Fixtures/Foo1Command.php',
	'/vendor/symfony/console/Tests/Fixtures/Foo2Command.php',
	'/vendor/symfony/console/Tests/Fixtures/Foo3Command.php',
	'/vendor/symfony/console/Tests/Fixtures/Foo4Command.php',
	'/vendor/symfony/console/Tests/Fixtures/Foo5Command.php',
	'/vendor/symfony/console/Tests/Fixtures/Foo6Command.php',
	'/vendor/symfony/console/Tests/Fixtures/FoobarCommand.php',
	'/vendor/symfony/console/Tests/Fixtures/FooCommand.php',
	'/vendor/symfony/console/Tests/Fixtures/FooSubnamespaced1Command.php',
	'/vendor/symfony/console/Tests/Fixtures/FooSubnamespaced2Command.php',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_1.json',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_1.md',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_1.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_1.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_2.json',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_2.md',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_2.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_2.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_3.json',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_3.md',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_3.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_3.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_4.json',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_4.md',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_4.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_argument_4.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_1.json',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_1.md',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_1.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_1.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_2.json',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_2.md',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_2.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_2.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_3.json',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_3.md',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_3.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_3.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_4.json',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_4.md',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_4.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_definition_4.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_option_1.json',
	'/vendor/symfony/console/Tests/Fixtures/input_option_1.md',
	'/vendor/symfony/console/Tests/Fixtures/input_option_1.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_option_1.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_option_2.json',
	'/vendor/symfony/console/Tests/Fixtures/input_option_2.md',
	'/vendor/symfony/console/Tests/Fixtures/input_option_2.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_option_2.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_option_3.json',
	'/vendor/symfony/console/Tests/Fixtures/input_option_3.md',
	'/vendor/symfony/console/Tests/Fixtures/input_option_3.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_option_3.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_option_4.json',
	'/vendor/symfony/console/Tests/Fixtures/input_option_4.md',
	'/vendor/symfony/console/Tests/Fixtures/input_option_4.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_option_4.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_option_5.json',
	'/vendor/symfony/console/Tests/Fixtures/input_option_5.md',
	'/vendor/symfony/console/Tests/Fixtures/input_option_5.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_option_5.xml',
	'/vendor/symfony/console/Tests/Fixtures/input_option_6.json',
	'/vendor/symfony/console/Tests/Fixtures/input_option_6.md',
	'/vendor/symfony/console/Tests/Fixtures/input_option_6.txt',
	'/vendor/symfony/console/Tests/Fixtures/input_option_6.xml',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/command/command_0.php',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/command/command_1.php',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/command/command_2.php',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/command/command_3.php',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/command/command_4.php',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/command/command_5.php',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/command/command_6.php',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/command/command_7.php',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/output/output_0.txt',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/output/output_1.txt',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/output/output_2.txt',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/output/output_3.txt',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/output/output_4.txt',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/output/output_5.txt',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/output/output_6.txt',
	'/vendor/symfony/console/Tests/Fixtures/Style/SymfonyStyle/output/output_7.txt',
	'/vendor/symfony/console/Tests/Fixtures/TestCommand.php',
	'/vendor/symfony/console/Tests/Formatter/OutputFormatterStyleStackTest.php',
	'/vendor/symfony/console/Tests/Formatter/OutputFormatterStyleTest.php',
	'/vendor/symfony/console/Tests/Formatter/OutputFormatterTest.php',
	'/vendor/symfony/console/Tests/Helper/FormatterHelperTest.php',
	'/vendor/symfony/console/Tests/Helper/HelperSetTest.php',
	'/vendor/symfony/console/Tests/Helper/LegacyDialogHelperTest.php',
	'/vendor/symfony/console/Tests/Helper/LegacyProgressHelperTest.php',
	'/vendor/symfony/console/Tests/Helper/LegacyTableHelperTest.php',
	'/vendor/symfony/console/Tests/Helper/ProcessHelperTest.php',
	'/vendor/symfony/console/Tests/Helper/ProgressBarTest.php',
	'/vendor/symfony/console/Tests/Helper/ProgressIndicatorTest.php',
	'/vendor/symfony/console/Tests/Helper/QuestionHelperTest.php',
	'/vendor/symfony/console/Tests/Helper/TableStyleTest.php',
	'/vendor/symfony/console/Tests/Helper/TableTest.php',
	'/vendor/symfony/console/Tests/Input/ArgvInputTest.php',
	'/vendor/symfony/console/Tests/Input/ArrayInputTest.php',
	'/vendor/symfony/console/Tests/Input/InputArgumentTest.php',
	'/vendor/symfony/console/Tests/Input/InputDefinitionTest.php',
	'/vendor/symfony/console/Tests/Input/InputOptionTest.php',
	'/vendor/symfony/console/Tests/Input/InputTest.php',
	'/vendor/symfony/console/Tests/Input/StringInputTest.php',
	'/vendor/symfony/console/Tests/Logger/ConsoleLoggerTest.php',
	'/vendor/symfony/console/Tests/Output/ConsoleOutputTest.php',
	'/vendor/symfony/console/Tests/Output/NullOutputTest.php',
	'/vendor/symfony/console/Tests/Output/OutputTest.php',
	'/vendor/symfony/console/Tests/Output/StreamOutputTest.php',
	'/vendor/symfony/console/Tests/Style/SymfonyStyleTest.php',
	'/vendor/symfony/console/Tests/Tester/ApplicationTesterTest.php',
	'/vendor/symfony/console/Tests/Tester/CommandTesterTest.php',
	'/vendor/symfony/polyfill-mbstring/README.md',
	'/vendor/symfony/console/phpunit.xml.dist',
	'/vendor/symfony/console/composer.json',
	'/vendor/symfony/console/CHANGELOG.md',
	'/vendor/composer/installed.json',
];
foreach ($iterator as $entity) {

	if ( 
		!$entity->isDir() 
		&& stripos($entity->getRealPath(),'.git')===false 
	) 
	{
		$filename = str_replace([$pathDeveloper,'\\','//'], '/', $entity->getRealPath());
		if ( !in_array($filename, $ignoreFileNames) )
		{
			fwrite(STDOUT, "Add file: ".$entity->getRealPath()." in ".$filename.PHP_EOL);
			$phar->addFile( $entity->getRealPath() , $filename );
		}
	}
}

$stub = <<<'EOF'
#!/usr/bin/php
<?php
/*
 * This file is part of Fusion Command Line Interface.
 */
Phar::mapPhar('fucli.phar');
require 'phar://fucli.phar/src/application.php';
__HALT_COMPILER();
EOF;

// Add the stub
$phar->setStub($stub);

$phar->stopBuffering();

fwrite(STDOUT, 'Build completed!'.PHP_EOL);