@extends('admin.index')

@section('content')
{!! formBegin(route('admin.food.task')) !!}

{!! dtEditText($label = 'Title', $sizeLabel = 2, $name = 'name',$value = @$data -> name, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập tiêu đề', $rowsTextarea = 0, $commet = 'Bạn cần nhập tên danh mục', $sizeComment = 4, $editor = 0) !!}

{!! dtEditText($label = 'Alias', $sizeLabel = 2, $name = 'alias',$value = @$data -> alias, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập alias', $rowsTextarea = 0, $commet = 'Trường này có thể tự tạo', $sizeComment = 4, $editor = 0) !!}

{!! dtEditText($label = 'Price', $sizeLabel = 2, $name = 'price',$value = @$data -> price, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập giá', $rowsTextarea = 0, $commet = '', $sizeComment = 0, $editor = 0) !!}

{!! dt_checkbox($label = 'Special', $sizeLabel = 2, $name = 'special',$value = @$data -> special, $sizeInput = 6, $defautl = 0) !!}

{!! dtEditSelectbox($label = 'Category', $sizeLabel = 2, $name = 'cate_id', $value = @$data->cate_id, $widthSelect = 6, $heightSelect = 10, $array_select = @$cates, $field_value = 'id', $field_label = 'treename', $sizeHeight = 0, $multi = 0, $add_fisrt_option = 0, $comment = '', $sizeComment = 0) !!}

{!! dtEditText($label = 'Summary', $sizeLabel = 2, $name = 'summary',$value = @$data -> summary, $type = 'text', $sizeInput = 10, $placeholder = 'Nhập tóm tắt', $rowsTextarea = 0, $commet = '', $sizeComment = 0, $editor = 0) !!}

{!! isset($data->name) ? addInputHidden('name_old', $data->name) : '' !!}
{!! formEnd(@$data) !!}
@endsection