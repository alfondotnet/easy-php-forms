<?php
use lib\Config;
use Illuminate\Database\Capsule\Manager as DB;

// /render/:id controller
// Render a form
// When accessing /render/:id via GET,
// the form will be rendered

$app->get('/render/:id', function ($id) use ($app) {
    
    $c = array();
   
    // We grab the form
    $form = models\Form::find($id);
    // We grab its fields
    $fields = $form->fields;

    // Base path
    $c['base_path'] = Config::read('base_path');
    $c['form'] = $form;
    $c['fields'] = $fields;

    $app->render('pages/render.html', $c);

});
