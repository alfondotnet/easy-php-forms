<?php
namespace tests;
require_once __DIR__ . '/../vendor/autoload.php';


class FormTest extends SlimTest
{

    protected $_site;

    public function setUp()
    {
        $this->app = $this->getSlimInstance();
        $this->_site = 'hfforms';
    }

    public function testCanBeCreated()
    {
        // We create a new form
        $form = models\Form;
    }

}