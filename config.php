<?php
use lib\Config as Config;
use Illuminate\Database\Capsule\Manager as Capsule;

/*
* Project configuration
* EDITABLE
*/

// Database information
$settings = array(
    'driver' => 'mysql',
    'host' => 'localhost',
    'port' => '',
    'database' => 'forms',
    'username' => 'forms',
    'password' => 'forms',
    'collation' => 'utf8_general_ci',
    'charset' => 'utf8',
    'prefix' => ''
);


// Base path of the project (important if you are installing in inside a subdirectory)
$base_path = '';

// Port of the project
$port_project = '9079';

// Require authentication
$auth_required = true;

// Mails will be sent with this address as sender
$email_from = 'mailer@hellofutu.re';

// Template to use for emails
// (files are located on app/templates/[name].html)
$email_template = 'default';


/*
* END EDITABLE
*/

/*
* Touch only if you know what you are doing
*/

// Allowed input element names on fields form (Form edition)
$field_form_elements = array(
    'field_name',
    'placeholder',
);

// Allowed input element names on contact form (Form edition)
$contact_form_elements = array(
    'contact_name',
    'contact_email'
);


Config::write('field_form_elements', $field_form_elements);
Config::write('contact_form_elements', $contact_form_elements);
Config::write('base_path', $base_path);
Config::write('email_from', $email_from);
Config::write('email_template', $email_template);
Config::write('port_project', $port_project);
Config::write('auth_required', $auth_required);


$capsule = new Capsule;
$capsule->addConnection($settings);
$capsule->setAsGlobal();
$capsule->bootEloquent();
