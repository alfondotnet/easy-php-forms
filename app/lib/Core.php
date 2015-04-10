<?php

namespace lib;

use lib\Config;

class Core {

    private static $instance;

    private function __construct() {

    }

    public static function getInstance() {
        if (!isset(self::$instance))
        {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

}