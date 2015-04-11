<?php
namespace tests;

use \lib\Config as Config;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ .'/../../config.php';

/**
 * @backupGlobals disabled
 */
class IntegrationTest extends \PHPUnit_Framework_TestCase {


    public function request($method, $path, $options=array()) {
 
        // Capture STDOUT
        ob_start();

        // Prepare a mock environment
        
        \Slim\Environment::mock(array_merge(array(
            'REQUEST_METHOD' => $method,
            'SERVER_PORT' => Config::read('port_project'),
            'PATH_INFO' => $path,
            'SERVER_NAME' => 'http://localhost:9076',
        ), $options));

 
        // Run the application
        require __DIR__ . '/../../www/bootstrap.php';

        $this->app = $app;
        $this->request = $app->request();
        $this->response = $app->response();

        // We fire the routes
        $this->app->run();

        // Return STDOUT
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

}
