<?php

// /submitform/:id controller
// Submit form controller
// A form get submitted and you get redirected where the form says 

$app->post('/form/edit/:id/fields', function ($id) use ($app) {
    
    $c = array();
    $allowed_field_names = Config::read('field_form_elements');
    
    $post_vars = $app->request()->post();
    
    // We iterate through id
    foreach($post_vars as $key=>$var)
    {
        // as keys are name_id
        $explode = explode('_', $key);
        $id_field = array_pop($explode);
        // column name can be placeholder or field_name
        $column_name = implode('_',$explode);

        // We try to avoid as possible possible Database mess
        if(!in_array($column_name,$allowed_field_names))
            continue;

        // We edit the field
        $field = models\Field::find($id_field);
        $field->$column_name = $var;
        $field->save();
    }

    $app->redirect('/form/edit/'. $id);

});

