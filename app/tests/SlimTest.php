<?php
namespace tests;

// Settings to make all errors more obvious during testing
//error_reporting(-1);
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
define('PROJECT_ROOT', realpath(__DIR__ . '/..'));
 
 
class SlimTest extends \PHPUnit_Framework_TestCase
{
    protected $app;
 
    public function getSlimInstance()
    {
 
        $app = '';
 
        // Include our core application file
        require PROJECT_ROOT . '/www/index.php';
        $this->app = $app;
        return $this->app;
    }
 
    // Abstract way to make a request to SlimPHP, this allows us to mock the
    // slim environment
    public function request($method, $path, $options = array())
    {
        // Capture STDOUT
        ob_start();
 
        // Prepare a mock environment
        \Slim\Environment::mock(array_merge(array(
            'REQUEST_METHOD' => $method,
            'PATH_INFO'      => $path,
            'SERVER_NAME'    => 'local.dev',
        ), $options));
 
        // Establish some useful references to the slim app properties
        $this->request  = $this->app->request();
        $this->response = $this->app->response();
        // Execute our app
        $this->app->run();
 
        // Return the application output. Also available in `response->body()`
        return ob_get_clean();
    }
 
    public function get($path, $options = array())
    {
        return $this->request('GET', $path, $options);
    }
 
    public function post($path, $postVars = array(), $options = array())
    {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('POST', $path, $options);
    }
 
    public function patch($path, $postVars = array(), $options = array())
    {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('PATCH', $path, $options);
    }
 
    public function put($path, $postVars = array(), $options = array())
    {
        $options['slim.input'] = http_build_query($postVars);
        return $this->request('PUT', $path, $options);
    }
 
    public function delete($path, $options = array())
    {
        return $this->request('DELETE', $path, $options);
    }
 
    public function head($path, $options = array())
    {
        return $this->request('HEAD', $path, $options);
    }
 
};