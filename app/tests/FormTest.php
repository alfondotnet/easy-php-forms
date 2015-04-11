<?php
namespace tests;

use lib\Config as Config;

require_once __DIR__ . '/../../vendor/autoload.php';

class FormTest extends IntegrationTest {


    public function testIndexAuthenticated() {

        // We disable the Authentication
        Config::write('auth_required', false); 

        $this->get('/');
        $this->assertEquals('302', $this->response->status());
        $this->assertEquals('/listing', $this->response['Location']);
    }

    public function testCreateFormIndex() {

        $this->get('/form/new');
        $this->assertEquals('200', $this->response->status());     

    }

    public function testSubmitEmptyForm() {

        $this->post('/form/new');
        $this->assertEquals('302', $this->response->status());     
        $this->assertRegExp('/^\/error.*/', $this->response['Location']);     

    }

    public function testCreateAndDelete() {

        // We create a sample form
        $id_form = $this->createFormSample();

        $this->assertEquals('302', $this->response->status());     
        $this->assertRegExp("@^/form/edit/([0-9]+)$@", $this->response['Location']); 

        // We delete the form
        $this->deleteForm($id_form);
        $this->assertEquals('302', $this->response->status());  

    }


    public function testCreateAndPopulate() {

        $id_form = $this->createFormSample();
        
        // We get the form fields ids
        $this->get('/form/edit/'.$id_form);
        preg_match_all("@field_name_([0-9])+@", $this->response->getBody(), $matches);
        $field_names = $matches[1];

        // This fields depends on the test fields of createFormSample
        $fields_populated = array
            (
                'field_'.$field_names[0] => 'Test'
            );

        $this->post('/submitform/'. $id_form, $fields_populated);

        // Delete the form
        $this->deleteForm($id_form);

    }

    /*
    *   Private function createFormSample
    *   returns: (array) 
    *    [0] (string) id of the form created
    */

    private function createFormSample() {

        $post_vars = array
        (
            'field_type_1' => "1", // a type text
            'field_length_1' => "150" // 150 of length
        );

        $this->post('/form/new', $post_vars);
        $path_regexp = "@^/form/edit/([0-9]+)$@";
        preg_match($path_regexp, $this->response['Location'], $path_regexp_matches);

        return $path_regexp_matches[1];
    }

    /*
    *   Private function deleteForm
    *   returns: void
    */

    private function deleteForm($id_form) {
        $this->get('/form/delete/'. $id_form);
    }

}