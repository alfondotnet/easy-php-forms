<?php
// This file is isolated in order for PHPUnit to work
require_once __DIR__ .'/session_start.php';

use lib\Config as Config;

require_once __DIR__. '/../vendor/autoload.php';
require_once __DIR__. '/../config.php';


$twigView = new \Slim\Views\Twig();
//$twigView = new \Slim\Extras\Views\Twig(); 

$app = new \Slim\Slim(array(
    'debug' => true,
    'view' => $twigView,
    'templates.path' => __DIR__. '/../app/templates/',
));

// We set the content-type
$app->contentType('text/html; charset=utf-8');

// We add the Auth middleware
if(Config::read('auth_required'))
    $app->add(new \MyMiddleware\Auth());

// We extend TWIG defining generators for the dynamic form fields
$twig = $app->view()->getEnvironment();
$twig->addGlobal('field_generator', new \generators\Field());

// We pass the base path to our templates
$twig->addGlobal('base_path', Config::read('base_path'));


// Automatically load router files
$routers = glob(__DIR__. '/../app/routers/*.router.php');

foreach ($routers as $router) {
    require $router;
}