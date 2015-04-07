<?php
// GET index route
$app->get('/listing', function () use ($app) {
    
    $c = array();

    $form = new models\Form();

    $c['forms'] = array();

    $app->render('pages/listing.html', $c);

});