@extends('admin.index')
@section('content')
    <?php
    $filter_config  = array();
    $fitler_config['search'] = 1;
    $list_config[] = array('title'=>'Name','field'=>'name','ordering'=> 0, 'type'=>'text','col_width' => '10%', 'align'=>'center','arr_params'=>array('size'=> 30));
    $list_config[] = array('title'=>'Email','field'=>'email','ordering'=> 0, 'type'=>'text','col_width' => '10%', 'align'=>'center','arr_params'=>array('size'=> 30));
    $list_config[] = array('title'=>'Date','field'=>'date','ordering'=> 0, 'type'=>'text','col_width' => '10%', 'align'=>'center','arr_params'=>array('size'=> 30));
    $list_config[] = array('title'=>'Number person','field'=>'number_person','ordering'=> 0, 'type'=>'text', 'align'=>'center', 'arr_params'=>array('size'=>2));
    $list_config[] = array('title'=>'Sửa','type'=>'edit', 'align'=>'center');
    $list_config[] = array('title'=>'Ngày tạo','field'=>'created_at','ordering'=> 0, 'type'=>'datetime', 'align'=>'center');
    $list_config[] = array('title'=>'Id','field'=>'id','ordering'=> 0, 'type'=>'text', 'align'=>'center');
    ?>

    {!! genarateFormLiting($link = 'admin.order.task', $link_edit = 'admin.order.getEditCate', $prefix = 'order' , $list, $fitler_config, $list_config, @$sort_field, @$sort_direct, $list->links()) !!}
@endsection