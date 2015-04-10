<?php
session_start();

use lib\Config as Config;

require_once '../vendor/autoload.php';
require_once '../config.php';

// We load Slim Extras so we can extend Twig

$twigView = new \Slim\Views\Twig();
//$twigView = new \Slim\Extras\Views\Twig(); 

$app = new \Slim\Slim(array(
    'debug' => true,
    'view' => $twigView,
    'templates.path' => '../app/templates/',
));

// We set the content-type
$app->contentType('text/html; charset=utf-8');

// We add the Auth middleware
$app->add(new \MyMiddleware\Auth());

// We extend TWIG defining generators for the dynamic form fields
$twig = $app->view()->getEnvironment();
$twig->addGlobal('field_generator', new \generators\Field());

// We pass the base path
$twig->addGlobal('base_path', Config::read('base_path'));


// Automatically load router files
$routers = glob('../app/routers/*.router.php');

foreach ($routers as $router) {
    require $router;
}