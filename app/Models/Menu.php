<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

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

    public function getFillable() {
        return $this->fillable;
    }

}
