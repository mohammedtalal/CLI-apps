#! /usr/bin/env php 
<?php 
use GuzzleHttp\Client;
use Symfony\Component\Console\Application;

require 'vendor/autoload.php';

$app = new Application('CLI Apps Training', '1.0');

$app->add(new Acme\SayHelloCommand);
$app->add(new Acme\NewCommand(new GuzzleHttp\Client));
$app->add(new Acme\RenderCommand);
$app->add(new Acme\FileSizeCommand);
$app->add(new Acme\lsCommand);

$app->run();