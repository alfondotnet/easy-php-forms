<?php
use lib\Config;
use Illuminate\Database\Capsule\Manager as DB;

/*
* GET CONTROLLERS
*/


// /form/edit/:id controller
// Edit Form controller
// When accessing /form/edit/:id via GET,
// the from edition will be rendered

$app->get('/form/edit/:id', function ($id) use ($app) {
    
    $c = array();

    // We grab the form
    $form =  models\Form::find($id);
    // We grab its fields
    $fields = $form->fields;
    // We grab its contacts
    $contacts = $form->contacts;

    // We grab the different field types
    $field_types = models\Type::all();

    $c['form'] = $form;
    $c['fields'] = $fields;
    $c['contacts'] = $contacts;
    $c['field_types'] = $field_types;

    $app->render('pages/editform.html', $c);

});


// /form/edit/:id/contacts/add controller
// Contacts add controller
// When accessing /form/edit/:id/contacts/add via GET,
// a new contact is created for that forms

$app->get('/form/edit/:id/contacts/add', function ($id) use ($app) {
    
    $c = array();

    // We have to create a new contact and default it
    $contact = new models\Contact;

    $contact->contact_name = 'New contact';
    $contact->contact_email = 'new@email.com';
    $contact->save();

    // We attach the form id to the new form created
    $contact->form()->attach($id);

    $app->redirect('/form/edit/'. $id);
});


// /form/edit/:id_form/contacts/remove/:id_contact controller
// Contacts add controller
// When accessing /form/edit/:id/contacts/add via GET,
// a new contact is created for that forms
// TODO: check integrity in the relationship

$app->get('/form/edit/:id_form/contacts/remove/:id_contact', function ($id_form,$id_contact) use ($app) {
    
    $c = array();

    // First we have to find the contact
    $contact = models\Contact::find($id_contact);
    
    // Detach it from the pivot table and remove it
    $contact->form()->detach($id_form);
    $contact->delete();

    $app->redirect('/form/edit/'. $id_form);
});



// /form/new controller
// New Form controller
// When accessing /form/new via GET,
// a form will be presented to the user to specify number of fields and types

$app->get('/form/new', function () use ($app) {
    
    $c = array();
   
    // We grab the different field types
    $field_types = models\Type::all();

    $c['field_types'] = $field_types;

    $app->render('pages/newform.html', $c);

});


// /form/delete/:id controller
// Delete Form controller
// When accessing /form/new via GET,
// a form will be presented to the user to specify number of fields and types
// TODO: Use migrations

$app->get('/form/delete/:id', function ($id) use ($app) {
    
    $c = array();
   
    // We grab the form
    $form = models\Form::find($id);
    // First we have to delete it's responses
    // If we cannot DROP, we out before anything else breaks
    try{
        DB::statement('DROP TABLE responses_'. $id);
    } catch (Illuminate\Database\QueryException $e) {
        $exp = 'You must grant DROP permissions to your user in order to be able to delete forms';
        $app->redirect('/error?error='.$e->getMessage().'&exp='.$exp,$c);
    }
    
    // Now we delete the fields
    $form->fields()->delete();
    
    // We delete the contacts
    $form->contacts()->detach();

    // And we delete the form
    $form->delete();

    $app->redirect('/', $c);

});



// /form/responses/:id controller
// View Form responses controller
// When accessing /form/responses/:id via GET,
// a list will be presented to the user with the responses of the form

$app->get('/form/responses/:id', function ($id) use ($app) {
    
    $c = array();
   
    // We grab the form
    $form = models\Form::find($id);
    // We grab its contacts
    $contacts = $form->contacts;
    // We grab its fields (will be referenced by their ids on the responses)
    $fields = $form->fields;

    // We grab its responses
    $responses = models\ModelBuilder::fromTable('responses_'.$id)->all();

    $c['form'] = $form;
    $c['responses'] = $responses;
    $c['contacts'] = $contacts;
    $c['fields'] = $fields;

    $app->render('pages/responses.html', $c);

});



// /form/responses/:id_form/delete/:id_response controller
// Delete responses associated to a form

$app->get('/form/responses/:id_form/delete/:id_response', function ($id_form,$id_response) use ($app) {
    
    $c = array();

    // We grab its responses
    $response = models\ModelBuilder::fromTable('responses_'.$id_form)->find($id_response);
    $response->delete();

    $app->redirect('/form/responses/'. $id_form);

});






// /form/render/:id controller
// Render a form
// When accessing /form/render/:id via GET,
// the form will be rendered

$app->get('/form/render/:id', function ($id) use ($app) {
    
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


/*
* POST CONTROLLERS 
*/

// /form/new/ controller
// Create new form
// TODO: Use Schema::create

$app->post('/form/new', function () use ($app) {
    
    $c = array();

    $post_vars = $app->request()->post();
    
    // We add a new form
    $form = new models\Form;
    $form->form_name = 'New form';
    $form->save();


    // We need to create a table responses associated
    // to each new form created
    // example 
    /*
        CREATE TABLE IF NOT EXISTS `responses_2` (
          `id` int(11) NOT NULL,
          `field_1` varchar(100) NOT NULL,
          `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
          `form_id` int(11) NOT NULL
        ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
    */

    $create_table_statement = 'CREATE TABLE IF NOT EXISTS `responses_'. $form->id .'` (';
    $create_table_statement .= '`id` int(11) NOT NULL AUTO_INCREMENT,';

    // We add the default fields
    $i = 1;
    foreach($post_vars as $key=>$var)
    {
        // We skip everything that is not a field type
        // as field lengths for example
        if (substr($key, 0, 10) != 'field_type') continue;
        $key_id = end(explode('_',$key));

        // We create the new field
        $field = new models\Field;
        $field->field_name = 'New field '.$i;
        $field->form_id = $form->id;
        $field->type_id = $var;
        $field->placeholder = '';
        $field->length = $app->request()->post('field_length_'. $key_id);
        $field->save();

        $field_type = models\Type::find($field->type_id);

        // SQL FORMAT
        // In the database, the SQL format is stored. 
        // When a size is specified, such as varchar(size), the following format is used
        // type(**length**), so **length** will be replaced with the actual length, being stored in the Type model
        $sql_format = str_replace('**length**', $field->length, $field_type->sql_format);

        $create_table_statement .= '`field_'.$field->id.'` '.$sql_format.',';

        $i++;
    }

    $create_table_statement .= '`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,';
    $create_table_statement .= '`updated_at` timestamp NOT NULL DEFAULT \'0000-00-00 00:00:00\',';
    $create_table_statement .= '`form_id` int(11) NOT NULL,';
    $create_table_statement .= 'primary key(id)';

    $create_table_statement = rtrim($create_table_statement, ",");
    $create_table_statement .= ') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';


    // And now we have to add indexes

    $add_keys_statement ="
    ALTER TABLE `responses_".$form->id."`
    ADD KEY `form_id` (`form_id`),
    ADD CONSTRAINT `responses_".$form->id."_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`);";

    DB::statement($create_table_statement);
    DB::statement($add_keys_statement);

    $app->redirect('/form/edit/'. $form->id);

});



// /form/edit/:id/general controller
// Edit General controller
// Name for the form gets updated

$app->post('/form/edit/:id/general', function ($id) use ($app) {
    
    $c = array();

    $form_name = $app->request()->post('form_name');
    $redirect = $app->request()->post('redirect');

    // We edit the form
    $form = models\Form::find($id);
    $form->form_name = $form_name;
    $form->redirect = $redirect;
    $form->save();
    
    $app->redirect('/form/edit/'. $id);

});


// /form/edit/:id/contacts controller
// Edit Contacts controller
// Contact names and emails are updated

$app->post('/form/edit/:id/contacts', function ($id) use ($app) {
    
    $c = array();
    $allowed_field_names = Config::read('contact_form_elements');
    
    $post_vars = $app->request()->post();
    
    // We iterate through id
    foreach($post_vars as $key=>$var)
    {
        // as keys are name_id
        $explode = explode('_', $key);
        $id_contact = array_pop($explode);
        // column name can be placeholder or field_name
        $column_name = implode('_',$explode);

        // We try to avoid as possible possible Database mess
        if(!in_array($column_name,$allowed_field_names))
            continue;


        // We edit the field
        $contact = models\Contact::find($id_contact);
        $contact->$column_name = $var;
        $contact->save();
    }

    $app->redirect('/form/edit/'. $id);

});


// /form/edit/:id/fields controller
// Edit Fields controller
// Name and placeholders for the current fields are updated
// type or number of fields cannot be updated for performance reasons

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


