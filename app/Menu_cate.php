<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_cate extends Model
{
    protected $table = 'menu_cates';
    protected  $fillable = ['name', 'published', 'ordering'];

    public function menu() {
        return $this->hasMany('App\Menu_cate');
    }

    public function getFillable() {
        return $this->fillable;
    }
}
