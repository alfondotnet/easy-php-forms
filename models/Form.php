<?php
namespace models;

use Illuminate\Database\Capsule\Manager as DB;

class Form extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'forms';

    public function getResponses($form_id)
    {
        return DB::table("responses_{$form_id}")->count();
    }

    public function fields()
    {
        return $this->hasMany('models\Field');
    }

    public function contacts()
    {
        return $this->hasMany('models\Contact');
    }

    public function getNumberFields()
    {
        return count($this->fields->toArray());
    }

    public function save(array $options = array()) 
    {
        parent::save($options);
    }

    public function toArray()
    {
        $array = parent::toArray();
        return $array;
    }

}