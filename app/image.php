<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    public static $rules = [
        'file' => 'required|mimes:png,gif,jpeg,jpg,bmp'
    ];

    public static $messages = [
        'file.mimes' => 'Uploaded file is not in image format',
        'file.required' => 'Image is required'
    ];

    protected $table = 'images';
    protected  $fillable = ['original_name', 'filename', 'slug_icon', 'slug_original'];

}
