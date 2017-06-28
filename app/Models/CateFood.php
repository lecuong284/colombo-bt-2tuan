<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CateFood extends Model
{

    protected $fillable = [
        'name',
        'alias',
        'published',
        'ordering'
    ];

    public function getFillable() {
        return $this->fillable;
    }

    public function food() {
        return $this->hasMany('App\Models\Food');
    }

}
