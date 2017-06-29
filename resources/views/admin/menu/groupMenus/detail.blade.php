@extends('admin.index')
@section('css')
    <link rel="stylesheet" href="{{asset("css/bootstrap-fileinput.css")}}">
@endsection

@section('content')
{!! formBegin(route('admin.menuGroup.task')) !!}

{!! dtEditText($label = 'Group Name', $sizeLabel = 2, $name = 'name',$value = @$data -> name, $type = 'text', $sizeInput = 6, $placeholder = 'Nhập tên nhóm', $rowsTextarea = 0, $commet = 'Bạn cần nhập tên danh mục', $sizeComment = 4, $editor = 0) !!}

{!! isset($data->name) ? addInputHidden('name_old', $data->name) : '' !!}
{!! formEnd(@$data) !!}
@endsection

@section('scripts')
    <script src="{{asset("js/bootstrap-fileinput.js")}}"></script>
@endsection