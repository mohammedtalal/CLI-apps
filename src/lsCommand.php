<?php 
namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

class lsCommand extends Command{
	public function configure() {
		$this->setName("ls")
			->addArgument('path', InputArgument::OPTIONAL, 'directory path');
	}

	public function execute(InputInterface $input, OutputInterface $output) {
		//path to directory to scan
		$directory = $input->getArgument('path');
		 
		//get all files in specified directory
		$files = glob($directory . "*");
		 
		//print each file name
		foreach($files as $file)
		{
		 	//check to see if the file is a folder/directory
		 	if(is_dir($file)) {
		  		$output->writeln("<info>{$file}</info>");
			}

			$output->writeln("<comment>{$file}</comment>");
		}
	}
}