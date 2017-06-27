<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProductImages
 *
 * @property int $id
 * @property string $image
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Query\Builder|\App\ProductImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductImages whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductImages whereImage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductImages whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductImages whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductImages extends Model
{

    protected $table = 'product_images';
    protected  $fillable = ['image', 'product_id'];

    public function product() {
        return $this->belongsTo('App\Product');
    }

}
