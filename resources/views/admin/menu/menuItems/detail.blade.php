@extends('admin.index')
@section('css')
    <link rel="stylesheet" href="{{asset("css/bootstrap-fileinput.css")}}">
@endsection

@section('content')
{!! formBegin(route('admin.menu.task')) !!}

{!! dtEditText($label = 'Name', $sizeLabel = 2, $name = 'name',$value = @$data -> name, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập tên menu', $rowsTextarea = 0, $commet = 'Bạn cần nhập tên danh mục', $sizeComment = 4, $editor = 0) !!}

{!! dtEditText($label = 'Alias', $sizeLabel = 2, $name = 'alias',$value = @$data -> alias, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập alias', $rowsTextarea = 0, $commet = 'Trường này có thể tự tạo', $sizeComment = 4, $editor = 0) !!}

{!! dtEditSelectbox($label = 'Menu group', $sizeLabel = 2, $name = 'parent_id', $value = @$data->parent_id, $widthSelect = 6, $heightSelect = 10, $array_select = @$cates, $field_value = 'id', $field_label = 'treename', $sizeHeight = 0, $multi = 0, $add_fisrt_option = 1, $comment = '', $sizeComment = 0) !!}

{!! isset($data->name) ? addInputHidden('name_old', $data->name) : '' !!}
{!! formEnd(@$data) !!}
@endsection

@section('scripts')
    <script src="{{asset("js/bootstrap-fileinput.js")}}"></script>
@endsection