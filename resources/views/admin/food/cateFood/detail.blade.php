@extends('admin.index')
@section('css')
    <link rel="stylesheet" href="{{asset("css/bootstrap-fileinput.css")}}">
@endsection

@section('content')
{!! formBegin(route('admin.cateFood.task')) !!}

{!! dtEditText($label = 'Name', $sizeLabel = 2, $name = 'name',$value = @$data -> name, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập tên món ăn', $rowsTextarea = 0, $commet = 'Bạn cần nhập tên danh mục', $sizeComment = 4, $editor = 0) !!}

{!! dt_checkbox($label = 'Published', $sizeLabel = 2, $name = 'published',$value = @$data -> published, $sizeInput = 6, $defautl = 1) !!}
{!! dtEditText($label = 'Alias', $sizeLabel = 2, $name = 'alias',$value = @$data -> alias, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập alias', $rowsTextarea = 0, $commet = 'Trường này có thể tự tạo', $sizeComment = 4, $editor = 0) !!}

{!! dtEditText($label = 'Category Order', $sizeLabel = 2, $name = 'ordering',$value = @$data -> ordering, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập thứ tự', $rowsTextarea = 0, $commet = 'Bạn cần nhập tên danh mục', $sizeComment = 0, $editor = 0) !!}

{{--{!! dtEditSelectbox($label = 'Category Parent', $sizeLabel = 2, $name = 'parent_id', $value = @$data->parent_id, $widthSelect = 6, $heightSelect = 10, $array_select = @$cates, $field_value = 'id', $field_label = 'treename', $sizeHeight = 0, $multi = 0, $add_fisrt_option = 1, $comment = '', $sizeComment = 0) !!}

{!! dtEditImage($label = 'Image', $sizeLabel = 2, $name = 'image', $value = @$data->image ? asset(str_replace('/original/', '/fit(300x200)/', @$data->image)) : asset('images/no-image-small.jpg'), $sizeInput = 6, $comment = '', $sizeComment = 0) !!}

{!! dtEditText($label = 'Category Keywords', $sizeLabel = 2, $name = 'keywords',$value = @$data -> keywords, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập tên danh mục', $rowsTextarea = 0, $commet = '', $sizeComment = 0, $editor = 0) !!}

{!! dtEditText($label = 'Category Description', $sizeLabel = 2, $name = 'description',$value = @$data -> description, $type = 'text', $sizeInput = 10, $placeholder = 'Nhập chi tiết', $rowsTextarea = 5, $commet = '', $sizeComment = 0, $editor = 0) !!}--}}

{!! isset($data->name) ? addInputHidden('name_old', $data->name) : '' !!}
{!! formEnd(@$data) !!}
@endsection

@section('scripts')
    <script src="{{asset("js/bootstrap-fileinput.js")}}"></script>
@endsection