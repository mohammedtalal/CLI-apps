<?php 
namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class FileSizeCommand extends Command{
	public function configure() {
		$this->setName("ls:size")
			->setDescription('Get files size of folder.')
			->addOption('path', null, InputOption::VALUE_OPTIONAL, 'write folder path', getcwd());
	}

	public function execute(InputInterface $input, OutputInterface $output) {
		$path = $input->getOption('path');

		foreach (glob('/*.*') as $fileName) {
			$output->writeln($fileName.  " <info> size " . filesize($fileName). " in bytes </info>");
		}
	}
}