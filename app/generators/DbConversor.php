<?php
namespace generators;

class DbConversor {

    public static function convert($type,$value)
    {
        switch ($type) {
            case 'checkbox':
                return ($value == 'on')? 1: 0;
                break;
            
            default:
                return $value;
                break;
        }
    }

}