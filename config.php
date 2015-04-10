<?php
use lib\Config as Config;
use Illuminate\Database\Capsule\Manager as Capsule;

/*
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

// Project Config
// omit the trailing '/'

//$base_path = 'http://localhost:9079';
$base_path = '';

// Mails will be sent with these headers
$email_from = 'mailer@hellofutu.re';
$email_template = 'default';

$field_form_elements = array(
    'field_name',
    'placeholder',
);

$contact_form_elements = array(
    'contact_name',
    'contact_email'
);

/*
* END EDITABLE
*/

Config::write('field_form_elements', $field_form_elements);
Config::write('contact_form_elements', $contact_form_elements);
Config::write('base_path', $base_path);
Config::write('email_from', $email_from);
Config::write('email_template', $email_template);


$capsule = new Capsule;
$capsule->addConnection($settings);
$capsule->setAsGlobal();
$capsule->bootEloquent();
