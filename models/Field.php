<?php
namespace models;

use Illuminate\Database\Capsule\Manager as DB;

class Field extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'fields';

    public function getForm()
    {
        return $this->belongsTo('Form');
    }

    public function type()
    {
        return $this->belongsTo('models\Type');
    }

    public function getTypeString()
    {
        $type = Type::find($this->type_id);
        return $type->name;
    }

    public function toArray()
    {
        $array = parent::toArray();
        return $array;
    }

}