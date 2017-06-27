@extends('admin.index')

@section('content')
    <?php
    $filter_config  = array();
    $fitler_config['search'] = 1;
    $list_config[] = array('title'=>'Name','field'=>'name','ordering'=> 1, 'type'=>'text','col_width' => '10%', 'align'=>'left','arr_params'=>array('size'=> 30));
    //$list_config[] = array('title'=>'Keywords','field'=>'keywords','ordering'=> 1, 'type'=>'editText','col_width' => '10%', 'align'=>'left','arr_params'=>array('size'=> 30));
    //$list_config[] = array('title'=>'Description','field'=>'description','ordering'=> 1, 'type'=>'editText','col_width' => '10%', 'align'=>'left','arr_params'=>array('size'=> 30));
    $list_config[] = array('title'=>'Ordering','field'=>'ordering','ordering'=> 1, 'type'=>'editText','arr_params'=>array('size'=>2));
    $list_config[] = array('title'=>'Sửa','type'=>'edit', 'align'=>'center');
    $list_config[] = array('title'=>'Ngày tạo','field'=>'created_at','ordering'=> 1, 'type'=>'datetime');
    $list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 1, 'type'=>'text', 'align'=>'center');
    ?>

    {!! genarateFormLiting($link = 'admin.menuGroup.task', $link_edit = 'admin.menuGroup.getEditCate', $prefix = 'groupMenu' , $list, $fitler_config, $list_config, @$sort_field, @$sort_direct, $list->links()) !!}
@endsection