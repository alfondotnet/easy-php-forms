<?php
// GET index route
$app->get('/', function () use ($app) {
    $app->redirect($app->urlFor('listing'));
})->name('index');