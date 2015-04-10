<?php
namespace models;

use Illuminate\Database\Capsule\Manager as DB;

class Type extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'types';

    public function toArray()
    {
        $array = parent::toArray();
        return $array;
    }

}