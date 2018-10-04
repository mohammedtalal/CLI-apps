<?php 
namespace Acme;

use Acme\CommandsInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RenderCommand extends Command {
	public function configure() {
		$this->setName("render")
			 ->setDescription('Render some tabular data.');
	}

	public function execute(InputInterface $input, OutputInterface $output) {
		$table = new Table($output);

		$table->setHeaders(['Names', 'emails', 'Job title'])
			  ->setRows([
			  	['John', 'john@gmail.com', 'Senior PHP Developer'],
			  	['Sia', 'sia@gmail.com', 'Senior Softwate Architecture'],
			  ])
			  ->render();
	}

}