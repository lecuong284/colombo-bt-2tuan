<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class GroupMenu extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
		'name',
		'published',
		'ordering',
	];
    public function getFillable() {
        return $this->fillable;
    }
}
