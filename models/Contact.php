<?php
namespace models;

use Illuminate\Database\Capsule\Manager as DB;

class Contact extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'contacts';

    public function getForm()
    {
        return $this->belongsTo('Form');
    }

    public function toArray()
    {
        $array = parent::toArray();
        return $array;
    }

}