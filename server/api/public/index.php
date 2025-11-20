<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/init.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, false, false);

$routes = require __DIR__ . '/../src/routes.php';
$routes($app);

// Run application
$app->run();