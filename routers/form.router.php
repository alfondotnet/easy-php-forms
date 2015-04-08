<?php
// GET index route
$app->get('/form/edit/:id', function ($id) use ($app) {
    
    $c = array();

    // We grab the form
    $form =  models\Form::find($id);
    // We grab its fields
    $fields = $form->fields;
    // We grab its contacts
    $contacts = $form->contacts;

    $c['form'] = $form;
    $c['fields'] = $fields;
    $c['contacts'] = $contacts;
    
    $app->render('pages/editform.html', $c);

});