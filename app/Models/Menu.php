<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Menu extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'alias',
        'list_parents',
        'link',
        'image',
        'parent_id',
        'target',
        'level',
        'published',
        'ordering',
    ];

}
