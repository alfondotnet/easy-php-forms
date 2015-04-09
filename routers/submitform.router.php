<?php

// /submitform/:id controller
// Submit form controller
// A form gets submitted and you get redirected where the form says 

$app->post('/submitform/:id', function ($id) use ($app) {
    
    $c = array();
   
    // We grab the form
    $form = models\Form::find($id);
    // We grab its responses
    $response = new models\ModelBuilder;
    $response::fromTable('responses_'.$id);
    $response->form_id = $id;

    $response->save();

    $app->redirect($form->redirect);

});

