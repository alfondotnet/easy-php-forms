<?php
// GET index route
$app->get('/listing', function () use ($app) {
    
    $c = array();

    $forms = models\Form::all();

    $c['forms'] = $forms;

    $app->render('pages/listing.html', $c);

});