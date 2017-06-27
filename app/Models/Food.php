<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Food extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'alias',
        'cate_id',
        'price',
        'summary',
        'published',
        'special',
        'ordering'
    ];

    public function getFillable() {
        return $this->fillable;
    }

    public function cateFood() {
        return $this->belongsTo('App\Models\CateFood');
    }

}
