<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helper\ImageRepository;

class MultiImagesController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    public function getUpload()
    {
        return view('admin.upload');
    }

    public function postUpload(Request $request)
    {
        $photo = $request->all();
        $response = $this->image->upload($photo);
        return $response;

    }

    public function deleteUpload(Request $request)
    {
        $filename = $request->id;

        if(!$filename)
        {
            return 0;
        }

        $response = $this->image->delete( $filename );

        return $response;
    }
}
