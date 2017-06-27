<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Image;

class ImageResizeController extends Controller
{
    public function resizes(Request $request) {
        $image = $request->file('image');
        $name = substr($image->getClientOriginalName(), 0, strlen($image->getClientOriginalName()) - 4);
        $input['imagename'] = $name.'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('images/original');

        $path = $image->move($destinationPath, $input['imagename']);
        $thumbSvc = new Image();

        // Resize
        $thumbSvc->setImage($path)
            ->setSize(1024)
            ->setDestPath('/images/move')
            ->save('resize');
    }
}
