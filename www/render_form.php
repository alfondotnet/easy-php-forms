<?php
// This file renders a form specified by $_hf_form_id 
$_hf_form_id = 71;
if (!isset($_hf_form_id)) die();

require_once 'bootstrap.php'; // we require our index file

$form_render_route = $app->router->getNamedRoute('render'); 
$form_render_route->setParams(array('id'=> $_hf_form_id));

$form_render_route->dispatch();

?>