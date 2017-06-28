@extends('admin.index')
@section('css')
    <link rel="stylesheet" href="{{asset("css/bootstrap-fileinput.css")}}">
@endsection

@section('content')
{!! formBegin(route('admin.order.task')) !!}

{!! dtEditText($label = 'Name', $sizeLabel = 2, $name = 'name',$value = @$data -> name, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập tên', $rowsTextarea = 0, $commet = 'Bạn cần nhập tên danh mục', $sizeComment = 4, $editor = 0) !!}

{!! dtEditText($label = 'Email', $sizeLabel = 2, $name = 'email',$value = @$data -> email, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập email', $rowsTextarea = 0, $commet = '', $sizeComment = 4, $editor = 0) !!}

{!! dtDatePick($label = "Date", $sizeLabel = 2, $name = "date", $value = @$data->date,$sizeInput = 6, $comment = '', $sizeComment = 5) !!}

{!! dtEditSelectbox($label = 'Number person', $sizeLabel = 2, $name = 'number_person', $value = @$data->number_person, $widthSelect = 6, $heightSelect = 10, $array_select = @$number_person, $field_value = 'id', $field_label = 'treename', $sizeHeight = 0, $multi = 0, $add_fisrt_option = 1, $comment = '', $sizeComment = 0) !!}

{{--{!! dtEditImage($label = 'Image', $sizeLabel = 2, $name = 'image', $value = @$data->image ? asset(str_replace('/original/', '/fit(300x200)/', @$data->image)) : asset('images/no-image-small.jpg'), $sizeInput = 6, $comment = '', $sizeComment = 0) !!}--}}

{{--{!! dtEditText($label = 'Category Keywords', $sizeLabel = 2, $name = 'keywords',$value = @$data -> keywords, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập tên danh mục', $rowsTextarea = 0, $commet = '', $sizeComment = 0, $editor = 0) !!}--}}

{{--{!! dtEditText($label = 'Category Description', $sizeLabel = 2, $name = 'description',$value = @$data -> description, $type = 'text', $sizeInput = 10, $placeholder = 'Nhập chi tiết', $rowsTextarea = 5, $commet = '', $sizeComment = 0, $editor = 0) !!}--}}

{!! isset($data->name) ? addInputHidden('name_old', $data->name) : '' !!}
{!! formEnd(@$data) !!}
@endsection

@section('scripts')
    <script src="{{asset("js/bootstrap-fileinput.js")}}"></script>
@endsection