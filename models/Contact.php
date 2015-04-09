<?php
namespace models;

use Illuminate\Database\Capsule\Manager as DB;

class Contact extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'contacts';

    public function form()
    {
        return $this->belongsToMany('models\Form');
    }

    public function toArray()
    {
        $array = parent::toArray();
        return $array;
    }

}