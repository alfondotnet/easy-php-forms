<?php
// GET index route
$app->get('/listing', function () use ($app) {
    
    $c = array();

    $forms = models\Form::all();

    // We add the number of responses depending on entries in the dynamically-created table
    // associated to each form
    foreach ($forms as $f)
    {
       $f['responses'] = $f->getResponses($f->form_id);
       $c['forms'][] = $f;
    }

    $app->render('pages/listing.html', $c);

});