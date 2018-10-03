<?php 
namespace Acme;

use GuzzleHttp\ClientInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ZipArchive;

class NewCommand extends Command {

	private $client;
	public function __construct(ClientInterface $client) {
		$this->client = $client;
		Parent::__construct();
	}

	public function configure() {
		$this->setName("new")
			 ->setDescription('Create a new Laravel application.')
			 ->addArgument('name', InputArgument::REQUIRED);
	}

	public function execute(InputInterface $input, OutputInterface $output) {
		//assert that the folder doesnt already exist
		$directory = getcwd() . '/' . $input->getArgument('name');

		$output->writeln('<info>Crafting application...</info>');
		
		$this->assertApplicationDoesNotExist($directory, $output);

		//Download nightly version of laravel app
		$this->download($zipFile = $this->makeFileName())
			 ->extract($zipFile, $directory)
			 ->cleanUp($zipFile);
		
		$output->writeln('<comment>Application Ready!!</comment>');
	}

	/*
	 * func assertApplicationDoesNotExist
	 * check if directory exist or not 
	*/
	private function assertApplicationDoesNotExist($directory, OutputInterface $output) {
		if (is_dir($directory)) {
			$output->writeln('<error>Apllication already exists!</error>');
			exit(1); // general error status code for something wrong.
		}
	}

	private function makeFileName() {
		return getcwd() . '/laravel_'.md5(time().uniqid()) . '.zip';
	}

	private function download($zipFile) {
		$response = $this->client->get('http://cabinet.laravel.com/latest.zip')->getBody();
		file_put_contents($zipFile, $response);
		return $this;
	}

	private function extract($zipFile, $directory) {
		$archive = new ZipArchive;

		$archive->open($zipFile);
		$archive->extractTo($directory);
		$archive->close();

		return $this;
	}

	private function cleanUp($zipFile) {
		@chmod($zipFile, 0777);
		@unlink($zipFile);

		return $this;
	}

}