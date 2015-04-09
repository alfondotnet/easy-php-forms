<?php
namespace models;

use Illuminate\Database\Capsule\Manager as DB;

// Credit:
// http://stackoverflow.com/questions/18044577/laravel-4-dynamic-table-names-using-settable

class ModelBuilder extends \Illuminate\Database\Eloquent\Model {

    protected static $_table;


    public static function fromTable($table, $parms = Array()){
        $ret = null;
        if (class_exists($table)){
            $ret = new $table($parms);
        } else {
            $ret = new static($parms);
            $ret->setTable($table);
        }
        return $ret;
    }

    public function setTable($table)
    {
        static::$_table = $table;
    }

    public function getTable()
    {
        return static::$_table;
    }
}
