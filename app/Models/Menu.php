<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = [
        'name',
        'alias',
        'list_parents',
        'parent_id'
    ];

    public function getFillable() {
        return $this->fillable;
    }

}
