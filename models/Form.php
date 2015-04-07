<?php

namespace models;

class Form extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'forms';

    public function getResponses()
    {
        
    }

    public function toArray()
    {
        $array = parent::toArray();
        $array['responses'] = $this->getResponses();
        return $array;
    }

}