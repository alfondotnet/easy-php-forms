<?php
namespace generators;


class Field {

    /*
    * Creates a HTML input text 
    */
    public function text($name, $default='', $placeholder='', $html5_attrs='')
    {
        return '<input type="text" name="'.$name.'" class="form-control" placeholder="'.$placeholder.'" value="'. $default .'" '.$html5_attrs.'/>';
    }
}