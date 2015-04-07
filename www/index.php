<?php

require '../vendor/autoload.php';
require '../config.php';


// We load Slim Extras so we can extend Twig

//$twigView = new \Slim\Views\Twig();
$twigView = new \Slim\Extras\Views\Twig(); 

$app = new \Slim\Slim(array(
    'debug' => true,
    'view' => $twigView,
    'templates.path' => '../templates/',
));

// We extend TWIG defining generators for the dynamic form fields
$env = $app->view()->getEnvironment();
$env->addGlobal('field_generator', new \generators\Field());


// Automatically load router files
$routers = glob('../routers/*.router.php');

foreach ($routers as $router) {
    require $router;
}

$app->run();