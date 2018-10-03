#! /usr/bin/env php 
<?php 
use Acme\NewCommand;
use Acme\SayHelloCommand;
use GuzzleHttp\Client;
use Symfony\Component\Console\Application;

require 'vendor/autoload.php';

$app = new Application('CLI Apps Training', '1.0');

$app->add(new SayHelloCommand);
$app->add(new NewCommand(new GuzzleHttp\Client));
$app->run();