<?php
namespace MyMiddleware;

use lib\Config;
use Illuminate\Database\Capsule\Manager as DB;

class Auth extends \Slim\Middleware
{
  
    private $allowed_resources;

    public function __construct()
    {
        $this->allowed_resources =  array('user','submitform','render');
    }

    public function call()
    {
        // This resource is being requested, we check
        // if the resource is public or private,
        // in that case we ask for login   

        $explode = explode('/', $this->app->request()->getResourceUri());
        $resource_requested = $explode[1];

        if (in_array($resource_requested, $this->allowed_resources) ||
            (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']))
        {
            return $this->next->call();
        } else {
            $this->app->redirect($this->app->urlFor('login'));
        }
        
    }
 
 
}