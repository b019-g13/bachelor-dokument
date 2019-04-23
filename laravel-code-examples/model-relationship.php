<?php

namespace App;

class Component extends \Illuminate\Database\Eloquent\Model
{
    public function type()
    {
        return $this->belongsTo('App\Type');
    }
}
