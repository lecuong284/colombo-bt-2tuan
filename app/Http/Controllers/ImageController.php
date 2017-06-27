<?php

namespace App\Http\Controllers;
use App\Helper\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function size(Request $request) {
        $method = [
            ['method' => 'fit','width' => '300','height' => '200'],
            ['method' => 'resize','width' => '400','height' => '400'],
            ['method' => 'crop','width' => '300','height' => '200'],
        ];

        $moduleName = 'cate';
        $pathGet = $moduleName.'/'.date('Y/m').'/original';
        $pathSet = $moduleName.'/'.date('Y/m');
        $watermark = [
            'image' => 'images/logo.png',
            'position' => 'center'
        ];
        $imageQuality = 100;


        $image = $request->file('image');
        $nameOldImg = substr($image->getClientOriginalName(), 0, strlen($image->getClientOriginalName()) - 4);
        $newNameImg = $nameOldImg.'-'.time().'.'.$image->getClientOriginalExtension();
        $destDir = public_path('images/');
        $arr_folder = explode ( '/', $pathGet );
        foreach ($arr_folder as $item) {
            $destDir.= $item;
            if (!File::isDirectory($destDir)) {
                File::makeDirectory($destDir);
            }
            $destDir.='/';
        }

        $image->move($destDir, $newNameImg);

        $images = new Images($method, $moduleName, $newNameImg, $pathGet, $pathSet, $watermark, $imageQuality);
        $images->resize();
    }
}

