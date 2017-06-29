<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{

    protected $fillable = [
        'name',
        'alias',
        'cate_id',
        'price',
        'summary',
        'special'
    ];

    public function getFillable() {
        return $this->fillable;
    }

    public function cateFood() {
        return $this->belongsTo('App\Models\CateFood');
    }

}
