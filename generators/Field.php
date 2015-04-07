<?php
namespace generators;


class Field {

    /*
    * Creates a HTML input text 
    */
    public function text($name)
    {
        return '<input type="text" name="'.$name.'" />';
    }
}