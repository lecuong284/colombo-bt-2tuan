<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Cate
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property int $order
 * @property int $parent_id
 * @property string $keywords
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereParentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cate whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Cate extends Model
{
    //
    protected $table = 'cates';
    protected  $fillable = ['name', 'alias', 'order', 'parent_id', 'list_parents', 'keywords', 'description'];

    public function product() {
        return $this->hasMany('App\Product');
    }

    public function getFillable() {
        return $this->fillable;
    }
}
