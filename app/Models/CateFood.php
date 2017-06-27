<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CateFood extends Model implements Transformable
{
    use TransformableTrait;

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
