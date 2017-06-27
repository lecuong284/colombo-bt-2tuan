<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Product
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property int $price
 * @property string $intro
 * @property string $content
 * @property string $image
 * @property string $keywords
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $cate_id
 * @property int $user_id
 * @property-read \App\Cate $cate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductImages[] $productImages
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereAlias($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCateId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereIntro($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereKeywords($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUserId($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    //
    protected $table = 'products';
    protected  $fillable = ['name', 'alias', 'price', 'intro', 'content', 'image', 'keywords', 'description', 'cate_id', 'user_id'];

    public function cate() {
        return $this->belongsTo('App\Cate');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function productImages() {
        return $this->hasMany('App\ProductImages');
    }
}
