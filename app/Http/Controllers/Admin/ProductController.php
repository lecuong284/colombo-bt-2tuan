<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\ToolBar;
use App\Cate;
class ProductController extends Controller
{

    public function __construct()
    {
        $toolBar = new ToolBar();
        $toolBar->setTitle("Sản phẩm");
        $toolBar->addButton('add','Add','','fa-plus-circle');
        $toolBar->addButton('edit','Edit','Bạn phải chọn ít nhất một bài viết','fa-pencil');
        $toolBar->addButton('remove','Remove','Bạn phải chọn ít nhất một bài viết','fa-trash-o');
        $toolBar->addButton('published','Published','Bạn phải chọn ít nhất một bài viết','fa-check-circle-o');
        $toolBar->addButton('unpublished','Unpublished','Bạn phải chọn ít nhất một bài viết','fa-circle-o');

        $title = $toolBar->showTitle();
        $button = $toolBar->show_head_form();


        $this->model = new Cate();
        parent::__construct();
    }
}
