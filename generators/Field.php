<?php
namespace generators;


class Field {

    /*
    * Creates a HTML input text 
    */
    public function text($name, $default='', $placeholder='')
    {
        return '<input type="text" name="'.$name.'" class="form-control" placeholder="'.$placeholder.'" value="'. $default .'" />';
    }
}