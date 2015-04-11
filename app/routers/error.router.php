<?php
// GET index route
$app->get('/error', function () use ($app) {

    $c = array();

    $c['error'] = $app->request()->get('error');
    $c['explanation'] = $app->request()->get('exp');

    $app->render('pages/error.html', $c);
})->name('error');