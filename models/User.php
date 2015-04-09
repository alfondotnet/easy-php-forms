<?php
namespace models;

use Illuminate\Database\Capsule\Manager as DB;

class User extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'users';

    public function toArray()
    {
        $array = parent::toArray();
        return $array;
    }

}