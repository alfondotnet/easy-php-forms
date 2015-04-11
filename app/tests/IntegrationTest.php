<?php
namespace tests;

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * @backupGlobals disabled
 */
class IntegrationTest extends \PHPUnit_Framework_TestCase {

    public function request($method, $path, $options=array()) {
 
        // Capture STDOUT
        ob_start();
        
        //$this->processIsolation = true;


        // Prepare a mock environment
        \Slim\Environment::mock(array_merge(array(
            'REQUEST_METHOD' => $method,
            'PATH_INFO' => $path,
            'SERVER_NAME' => 'localhost:9076',
        ), $options));

        // Run the application
        require_once __DIR__ . '/../../www/bootstrap.php';

        $this->app = $app;
        $this->request = $app->request();
        $this->response = $app->response();

        // Return STDOUT
        return ob_get_clean();
    }

    public function get($path, $options=array()) {
        $this->request('GET', $path, $options);
    }


    public function testIndex() {
        $this->get('/');
        $this->assertEquals(1,1);
    }

}
