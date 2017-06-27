<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected  $fillable = ['name', 'alas', 'cate_id', 'list_parent', 'link', 'image', 'parent_id', 'target', 'level', 'published', 'ordering'];

    public function menuCate() {
        return $this->belongsTo('App\Menu_cate');
    }

    public function getFillable() {
        return $this->fillable;
    }
}
