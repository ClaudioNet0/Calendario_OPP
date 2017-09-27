<?php
session_start();
require 'vendor/autoload.php';
require 'config/config.php';
require 'config/constants.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer("resources/views/");

require 'app/routes.php';
$app->run();