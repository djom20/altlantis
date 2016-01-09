<?php
	/**
	  Console Class
	*
	* @Consoleor Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;
	use Symfony\Component\Console\Command\Command;
	use Symfony\Component\Console\Input\InputArgument;
	use Symfony\Component\Console\Input\InputInterface;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Output\OutputInterface;

	if(!class_exists('Console'))
	{
		class Console extends Command
		{
			protected $console;

			public function __construct()
			{
				$this->console = new Application();
				$this->console->run();
			}

			protected function configure()
			{
				$this
					->setName('atlantis:greet')
					->setDescription('Greet someone')
					->addArgument(
						'name',
						InputArgument::OPTIONAL,
						'Who do you want to greet?'
					)
					->addOption(
					   'yell',
					   null,
					   InputOption::VALUE_NONE,
					   'If set, the task will yell in uppercase letters'
					)
				;
			}

			protected function execute(InputInterface $input, OutputInterface $output)
		    {
		        $name = $input->getArgument('name');
		        if ($name) {
		            $text = 'Hello '.$name;
		        } else {
		            $text = 'Hello';
		        }

		        if ($input->getOption('yell')) {
		            $text = strtoupper($text);
		        }

		        $output->writeln($text);
		    }
		}
	}