<?php
    /**
     * Created by PhpStorm.
     * User: Admin
     * Date: 6/6/2017
     * Time: 2:46 PM
     */

    /*không được chứa class chỉ ở dạng function*/
    function formBegin($action = ''){
        $html = '<section class="content">';
        $html .= '<form action="'.url($action).'" name="adminForm" method="post" enctype="multipart/form-data" class="form-horizontal">';
        return $html;
    }

    function formEnd($data = array(),$seo = 0){
        $html = '';
        if($seo){

            /*demo*/
            /*$html .= dtDatePick($label = "Công bố", $sizeLabel = 2, $name = "created_time", $value = date('Y-m-d H:i:s'),$sizeInput = 5, $comment = 'Chọn thời gian công bố', $sizeComment = 5);
            $html .= hr();
            $html .= dtEditSelectbox($label = 'Danh mục', $sizeLabel = 2, $name = 'Danh mục', $value = 1, $sizeSelect = 10, $array_select = array('danh mục 1', 'danh mục 2', 'danh mục 3', 'danh mục 4', 'danh mục 5'), $field_value = 'id', $field_label = 'name', $sizeHeight = 0, $multi = 0, $add_fisrt_option = 1, $comment = '', $sizeComment = 0);*/

            $html .= hr();

            $html .= dtEditText($label = 'SEO title', $sizeLabel = 2, $name = 'seo_title',$value = @$data -> seo_title, $type = 'text', $sizeInput = 8, $placeholder = 'Title SEO, tối đa 67 ký tự', $rowsTextarea = 1, $commet = 'số ký tự là', $sizeComment = 2, $editor = 0);

            $html .= dtEditText($label = 'SEO meta keyword', $sizeLabel = 2, $name = 'seo_keyword',$value = @$data -> seo_keyword, $type = 'text', $sizeInput = 10, $placeholder = '', $rowsTextarea = 1, $commet = '', $sizeComment = 0, $editor = 0);

            $html .= dtEditText($label = 'SEO meta description', $sizeLabel = 2, $name = 'seo_description',$value = @$data -> seo_description, $type = 'text', $sizeInput = 10, $placeholder = 'SEO', $rowsTextarea = 5, $commet = '', $sizeComment = 0, $editor = 0);
        }
        if(@$data->id) {
            $html .= '<input type="hidden" value="'.$data->id.'" name="id">';
        }
        $html .= '<input type="hidden" name="task" id="task" value="">';
        $html .= csrf_field();
        $html .= '</form>';
        $html .= '</section>';
        return $html;
    }

    /*function input and textarea and editor*/
    function dtEditText($label, $sizeLabel = 2, $name, $value, $type = '', $sizeInput = 10, $placeholder = '', $rowsTextarea = 0, $comment = '', $sizeComment = 0, $editor = 0){
        if(!isset($value))
            $value = '';
        $html = '<div class="form-group">';
        $html .= '<label class="control-label col-sm-'. $sizeLabel .'">'. $label . '</label>';
        $html .= '<div class="col-sm-'. $sizeInput .'">';
        if($rowsTextarea > 1){
            if(!$editor){
                $html .=  '<textarea rows="'.$rowsTextarea.'" cols="5" name="'.$name.'" class="form-control" id="'.$name.'" placeholder="'.$placeholder.'">'.$value.'</textarea>';
            } else {
    //				$html .=  '<textarea rows="10" cols="10" name="'.$name.'" id="'.$name.'" >'.$value.'</textarea>';
    //				$html .= "<script>CKEDITOR.replace( '".$name."');</script>";
                $k = 'oFCKeditor_'.$name;
                $oFCKeditor[$k] = new FCKeditor($name) ;
                $oFCKeditor[$k]->BasePath	=  '../libraries/wysiwyg_editor/' ;
                $oFCKeditor[$k]->Value		= stripslashes(@$value);
                $oFCKeditor[$k]->Width = 100;
                $oFCKeditor[$k]->Height = $rowsTextarea;
                $oFCKeditor[$k]->Create() ;
            }
        }else{
            $html .= '<input type="'. $type .'" name="'.$name.'" id="'.$name.'" class="form-control" placeholder="'.$placeholder.'" value="'.htmlspecialchars($value).'"/>';
        }
        $html .= '</div>';
        if($comment && $sizeComment)
            $html .= '<span class="comment col-sm-'. $sizeComment .'">'.ucfirst($comment).'<span class="number-char"> </span></span>';
        $html .=  '</div>';
        return $html;
    }

    function dt_checkbox($label, $sizeLabel = 2, $name, $value, $sizeInput = 10, $default = 1, $array_value = array(1 => 'Có', 0 => 'Không' ), $comment = '', $sizeComment = 0 ){
        $html = '<div class="form-group">';
        $html .= '<label class="control-label col-sm-'. $sizeLabel .'">'. $label . '</label>';
        $html .= '<div class="col-sm-'. $sizeInput .'">';
        $compare = isset($value)?$value:$default;
        foreach($array_value as $key => $item){
            if($compare == $key){
                $html .= '<input type="radio" name="'.$name.'" value="'.$key.'" checked="checked" />'.$item.'&nbsp;&nbsp;';
            }else{
                $html .= '<input type="radio" name="'.$name.'" value="'.$key.'" />'.$item.'&nbsp;&nbsp;';
            }
        }
        $html .= '</div>';
        if($comment && $sizeComment)
            $html .= '<span class="comment col-sm-'. $sizeComment .'">'.ucfirst($comment).'<span class="number-char"> </span></span>';
        $html .=  '</div>';
        return $html;
    }

    /*function dt_edit_image*/
    function dtEditImage($label, $sizeLabel = 2, $name, $value, $sizeInput = 6, $comment = '', $sizeComment = 0){
        $html = '<div class="form-group">';
        $html .= '<label class="control-label col-sm-'. $sizeLabel .'">'. $label . '</label>';
        $html .= '<div class="col-sm-'. $sizeInput .'">';
        $html .= '<div class="fileinput fileinput-new" data-provides="fileinput">';
        $html .=    '<div class="fileinput-new thumbnail" style="width: 200px; height: 135px;">';

        $html .=    '<img src="'.$value.'"/><br/><br/>';
        $html .=    '</div>';
        $html .=    '<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 210px; max-height: 126px;">';
        $html .=    '</div>';

        $html .=    '<div>';
        $html .=        '<span class="btn default btn-file">';
        $html .=            '<span class="fileinput-new"> Chọn ảnh </span>';
        $html .=            '<span class="fileinput-exists"> Change </span>';
        $html .=            '<input type="file" name="image" />';
        $html .=        '</span>';
        $html .=        '<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput"> Xóa </a>';
        $html .=    '</div>';
        $html .= '</div>';

        $html .= '</div>';
        if($comment)
            $html .= '<span class="comment col-sm-'. $sizeComment .'">'.ucfirst($comment).'<span class="number-char"> </span></span>';
        $html .= '</div>';
        return $html;
    }

    function hr(){
        return  '<hr class="sepa"/>';
    }

    /*function select box*/
    function dtEditSelectbox($label, $sizeLabel = 2, $name, $value, $widthSelect = 10, $heighSelect = 0, $array_select = array(), $field_value = 'id', $field_label = 'name', $sizeHeight = 1, $multi = 0, $add_fisrt_option = 0, $comment = '', $sizeComment = 0){
        $html = '<div class="form-group">';
        $html .= '<label class="control-label col-sm-'. $sizeLabel .'">'. $label . '</label>';
        $html .= '<div class="col-sm-'. $widthSelect .'">';
        if(!$multi){
            /*$html_sized = $sizeHeight > 1 ? "size=$sizeHeight":"" ;*/
            $html .= '<select name="'.$name.'" id="'.$name.'" class="form-control" size = "'.$heighSelect.'">';
            $compare  = 0;
            if(isset($value))
                $compare = $value;
            else
                $compare = '';

            if($add_fisrt_option){
                $checked = "";
                if(!$compare)
                    $checked = "selected=\"selected\"";
                $html .= '<option  value="0" '.$checked.'>-- '.ucfirst($label).' --</option>';
            }
            $j = 0;
            if(count($array_select)){

                if(is_object(end($array_select))){

                    foreach ($array_select as $select_item) {
                        $checked = "";
                        if(!$compare && !$j && !$add_fisrt_option){
                            $checked = "selected=\"selected\"";
                        } else {
                            if($compare === ($select_item->$field_value))
                                $checked = "selected=\"selected\"";
                        }
                        $html .= '<option value="'.$select_item->$field_value.'" '. $checked.'>'.ucfirst($select_item -> $field_label).'</option>';
                        $j ++;
                    }
                } else {
                    foreach ($array_select as $name) {
                        $checked = "";
                        if(!$compare && !$j && !$add_fisrt_option){
                            $checked = "selected=\"selected\"";
                        } else {
                            if($compare == $name->id)
                                $checked = "selected=\"selected\"";
                        }
                        $html .= '<option value="'.$name->id.'" '. $checked.'>'.ucfirst($name->name).'</option>';
                        $j ++;
                    }
                }
            }
            $html .= '</select>';
        }else{
            // not working
            $html_sized = $sizeHeight > 1 ? "size=$sizeHeight":"" ;
            $html .= '<select name="'.$name.'[]" id="'.$name.'" '.$html_sized.' class="form-control" multiple>';
            $array_value  = isset($value)?explode(',',$value):array();
    //			$compare  = 0;
    //			if(@$value)
    //				$compare = $value;
            $j = 0;
            if(count($array_select)){
                if(is_object(end($array_select))){
                    foreach ($array_select as $select_item) {
                        $checked = "";
                        if(in_array($select_item->$field_value,$array_value))
                            $checked = "selected=\"selected\"";
                        $html .= '<option value="'.$select_item->$field_value.'" '. $checked.'>'.ucfirst($select_item -> $field_label).'</option>';
                        $j ++;
                    }
                } else {
                    foreach ($array_select as $key => $name) {
                        if(in_array($name,$array_value))
                            $checked = "selected=\"selected\"";
                        $html .= '<option value="'.$key.'" '. $checked.'>'.ucfirst($name).'</option>';
                        $j ++;
                    }
                }
            }
            $html .= '</select>';
        }
        $html .= '</div>';
        if($comment && $sizeComment)
            $html .= '<span class="comment col-sm-'. $sizeComment .'">'.ucfirst($comment).'</span>';
        $html .= '</div>';
        return $html;
    }

    function dtDatePick($label, $sizeLabel = 2, $name, $value,$sizeInput = 5, $comment = '', $sizeComment = 0) {
        if (! isset ( $value ))
            $value = '';
        $html = '<div class="form-group">';
        $html .= '<label class="control-label col-sm-'. $sizeLabel .'">'. $label . '</label>';
        $html .= '<div class="col-sm-'. $sizeInput .' input-group date" id="datetimepicker">';
        $html .= '		<input type="text" name="' . $name . '" class="form-control" id="' . $name . '" value="' . htmlspecialchars ( $value ) . '"/>';
        $html .= '		<span class="input-group-addon">
                    <span class="fa fa-calendar">
                    </span>
                </span>';
        $html .=  '</div>';
        if ($comment && $sizeComment) $html .=  '<span class="comment col-sm-'. $sizeComment .'">' . $comment . '</span>';
        $html .=  '</div>';
        return $html;
    }

    /**
     * @param string $link
     * @param string $prefix
     * @param array $list
     * @param array $fitler_config
     * @param array $list_config
     * @param string $sort_field
     * @param string $sort_direct
     * @return string
     */
    function genarateFormLiting($link = '', $link_edit = '', $prefix = '', $list = array(), $fitler_config = array(), $list_config = array(), $sort_field = '', $sort_direct = '', $pagination){
        if(!count($list_config)){
            return;
        }
        /*begin fill part filter*/
        $html_filter = count($fitler_config)? createFilter($fitler_config,$prefix) : '';
        /*end fill part filter*/
        $html_begin = '<section class="content">';
        $html_begin .= '<form action="'.route($link).'" name="adminForm" method="post">';
        $i = 1;
        $arr_head  = array();
        $arr_config = array();
        $arr_field_change = array();
        /*begin fill title tin tag th*/
        /*no-col là không tiển thị tilte*/
        foreach($list_config as $item){
            $col = $i;
            if(isset($item['no_col']))
                $col = $item['no_col'];
            if(!isset($arr_head[$col])){
                $col_width = isset($item['col_width'])?'width="'.$item['col_width'].'"':'';
                if(!isset($item['ordering']) || empty($item['ordering'])){
                    $arr_head[$col] = '<th class="title" '.$col_width.' >'.$item['title'].'</th>';
                }else{
                    $arr_head[$col] = '<th class="title" '.$col_width.' >'.orderTable($item['title'], $item['field'],@$sort_field,@$sort_direct).'</th>';
                }
                $arr_config[$col] = array();
            }
            $arr_config[$col][] = $item;
            $type = isset($item['type'])?$item['type']:'text';
            if($type == 'editText' || $type == 'editSelectbox'){
                $arr_field_change[] = $item['field'];
            }
            $i ++;
        }
        /*end fill title in tag th*/
        $html_head = '<table class="table table-bordered table-striped dataTable table-hover"><thead><tr>';
        $html_head .= '<th width="3%">STT</th><th width="3%"><input type="checkbox" onclick="checkAll('.count($list).')" value="" name="toggle"></th>';
        $html_head .= implode($arr_head, '');
        $html_head .= '</tr></thead>';
        $html_body = '<tbody>';
        /*begin fill data in tag tr*/
        if(!count($list)){
        }else{
            $i = 0;
            foreach($list as $row){
                $link_view = route($link_edit, ['id' => $row->id]);
                $html_body .= '<tr class="row'.($i%2).'">';
                $html_body .= '<td align="center">'.($i+1).'<input type="hidden" name="id_'.$i.'" value="'.$row->id.'"/> </td>';
                $html_body .= '<td><input type="checkbox" onclick="isChecked(this.checked);" value="'.$row->id.'"  name="id[]" id="cb'.$i.'"> </td>';
                foreach($arr_config as $col){
                    if(!count($col)){
                        continue;
                    }
                    if(isset($col[0]['align']))
                        $html_body .= '<td align = "'.$col[0]['align'].'">';
                    else
                        $html_body .= '<td>';
                    $j = 0;
                    foreach($col as $item){

                        if($j > 0)
                            $html_body .= '<br/><div class="break_line">&nbsp;</div>';
                        $type = isset($item['type'])?$item['type']:'text';
                        $display_label = isset($item['display_label'])?$item['display_label']:0;
                        if($display_label)
                            $html_body .= $item['title'].': ';

                        switch($type){
                            case 'published':
                                $html_body .= published("cb".($i), $row->published?"unpublished":"published");
                                break;
                            case 'label':
                                $j --;
                                break;
                            case 'change_status':
                                $function = isset($item['arr_params']['function'])?$item['arr_params']['function']: $item['field'];
                                $html_body .= changeStatus("cb".($i),$row[$item['field']]?"un".$function:$function);
                                break;
                            case 'edit':
                                $html_body .= edit($link_view);
                                break;
                            /*case 'reply':
                                $html_body .= reply("index.php?module=".$module."&view=".$view."&task=reply&id=".$row->id);
                                break;*/
                            case 'datetime':
                                $html_body .= date('d/m/Y H:i',strtotime($row[$item['field']]));
                                break;
                            case 'time':
                                $html_body .= date('H:i',$row[$item['field']]);
                                break;
                            case 'date':
                                $html_body .= date('d/m/Y',strtotime($row[$item['field']]));
                                break;
                            case 'editText':
                                $size = isset($item['arr_params']['size'])?$item['arr_params']['size']: 10;
                                $rows = isset($item['arr_params']['rows'])?$item['arr_params']['rows']: 1;
                                $html_body .= editText($item['field'],$row[$item['field']],$i,$size,$rows);
                                break;
                            case 'editSelectbox':
                                $arry_select = isset($item['arr_params']['arry_select'])?$item['arr_params']['arry_select']: array();
                                $field_value = isset($item['arr_params']['field_value'])?$item['arr_params']['field_value']: 'id';
                                $field_label = isset($item['arr_params']['field_label'])?$item['arr_params']['field_label']: 'name';
                                $multi = isset($item['arr_params']['multi'])?$item['arr_params']['multi']: 0;
                                $size = isset($item['arr_params']['size'])?$item['arr_params']['size']: 1;
                                $html_body .= editSelectbox($item['field'],$row[$item['field']],$i,$arry_select,$field_value,$field_label,$size,$multi);
                                break;
                            case 'image':
                                $link_img = $row[$item['field']];
                                if(isset($item['arr_params']['search']) && isset($item['arr_params']['replace'])){
                                    $link_img = str_replace($item['arr_params']['search'], $item['arr_params']['replace'], $link_img);
                                }
                                //with,height
                                $html_size = '';
                                $width = isset($item['arr_params']['width'])?$item['arr_params']['width']:0;
                                $height = isset($item['arr_params']['height'])?$item['arr_params']['height']:0;
                                if($width)
                                    $html_size .= ' width = "'.$width.'"';
                                if($height)
                                    $html_size .= ' height = "'.$height.'"';
                                //link
                                $have_link_edit = isset($item['arr_params']['have_link_edit'])?$item['arr_params']['have_link_edit']:0;
                                if($have_link_edit)
                                    $html_body .= '<a href="'.$link_view.'"><img src="'.$link_img.'" '.$html_size.' /></a>';
                                else
                                    $html_body .= '<img src="'.$link_img.'" '.$html_size.' />';
                                break;
                            case 'text':
                            default:
                                if(isset($item['arr_params']['function']) && !empty($item['arr_params']['function'])){
                                    $function = $item['arr_params']['function'];
                                    $html_body .= 	$function($row[$item['field']]);
                                }else{
                                    if(isset($item['arr_params']['have_link_edit']) && !empty($item['arr_params']['have_link_edit']))
                                        $html_body .= '<a href="'.$link_view.'" >'.$row[$item['field']].'</a>';
                                    else
                                        $html_body .= $row[$item['field']];
                                    break;
                                }
                        }
                        $j ++;
                    }
                    $html_body .= '</td>';
                }
                $html_body .= '</tr>';
                $i++;
            }
        }
        /*end fill data in tag tr*/
        $html_body .= '</tbody></table>';
        $html_footer = '<div class="footer_form">';
        /*if(isset($pagination)) {
            $html_footer .=  $pagination->showPagination();
        }*/
        $html_footer .= '</div>';
        $html_field_change =  count($arr_field_change)?implode($arr_field_change, ','):'';

        $html_footer .=csrf_field();
        $html_footer .='<input type="hidden" value="'.@$sort_field.'" name="sort_field" />';
        $html_footer .='<input type="hidden" value="'.@$sort_direct.'" name="sort_direct" />';
        $html_footer .='<input type="hidden" value="'.($i+1).'" name="total">';
        //$html_footer .='<input type="hidden" value="'.FSInput::get('page',0,'int').'" name="page">';
        $html_footer .='<input type="hidden" value="'.$html_field_change.'" name="field_change">';
        $html_footer .='<input type="hidden" value="" name="task">';
        $html_footer .='<input type="hidden" value="0" name="boxchecked">';

        $html = $html_begin.$html_filter.$html_head.$html_body.$html_footer.'</form>'.$pagination.'</section>';
        return $html;
    }

    /*function filter*/
    function createFilter($row,$prefix){
        if(!count($row))
            return;
        $ss_keysearch  = isset($_SESSION[$prefix.'keysearch']) ? $_SESSION[$prefix.'keysearch']:'';
        $html = '';
        $html .= '<div class="row">';
        $html .= '<div class="filter_area col-sm-6">';
        $html .= '	<table>';
        $html .= '		<tr>';

        $html_text = '';
        if(isset($row['text_count'])){
            $count = $row['text_count'];
            for($i = 0; $i < $count; $i ++) {
                $text_item = $row['text'][$i];
                $ss_text   = isset($_SESSION[$prefix.'text'.$i]) ? $_SESSION[$prefix.'text'.$i]:'';
                $type = isset($text_item['type'])?$text_item['type']:'';
                $html_text .= '			<td align="left" >';
                $html_text .= 	$text_item['title'];
                $html_text .= 	'<input type="text" clas="form-control" name="text'.$i.'" id="text'.$i.'" value="'.$ss_text.'" />';

                $html_text .= '			</td>';
            }
            $html .= '			<input type="hidden" name="text_count" value="'.$count.'" />';
        }

        if(isset($row['search'])){
            $html .= '    <td align="left" style="width: 64%">';
            $html .= '      <input type="text" name="keysearch" id="search" value="'.$ss_keysearch.'" class="text_area form-control"  />';
            $html .= '    </td>';
            $html .= $html_text;
            $html .= '<td>';
            $html .= '				<button class="btn btn-primary" style="margin-left: 4px;" onclick="this.form.submit();">Search</button>';
            $html .= '				<button class="btn btn-default" onclick="document.getElementById(\'search\').value=\'\';';
            if(isset($row['text_count'])){
                $count = $row['text_count'];
                for($i = 0; $i < $count; $i ++) {
                    $html .= '				document.getElementById(\'text'.$i.'\').value=\'\'; ';
                }
            }
            $html .= '				this.form.getElementById(\'filter_state\').value=\'\';this.form.submit();">'. 'Reset' .'</button>';
            $html .= '			</td>';
        }
        if(isset($row['filter_count'])){
            $count = $row['filter_count'];
            $html .= '			<input type="hidden" name="filter_count" value="'.$count.'" />';
            for($i = 0; $i < $count; $i ++) {
                $filter_item = $row['filter'][$i];
                $ss_filter   = isset($_SESSION[$prefix.'filter'.$i]) ? $_SESSION[$prefix.'filter'.$i]:'';
                $type = isset($filter_item['type'])?$filter_item['type']:'';
                if($type == 'yesno'){
                    $field = isset($filter_item['field'])?$filter_item['field']:'name';
                    $html .= '			<td nowrap="nowrap">';
                    $html .= '				<select name="filter'.$i.'" class="type" onChange="this.form.submit()">';
                    $html .= '					<option value="2"> -- '.$filter_item['title'].' -- </option>';


                    $selected_no = $ss_filter === 0? "selected='selected'":"";
                    $selected_yes = $ss_filter === 1? "selected='selected'":"";
                    $html .= "<option value='1'  ".$selected_yes."> ". 'Yes' . "</option>";
                    $html .= "<option value='0'  ".$selected_no."> ". 'No' . "</option>";

                    $html .= '				</select>';
                    $html .= '			</td>';
                    continue;
                }

                $field = isset($filter_item['field'])?$filter_item['field']:'name';
                $html .= '			<td nowrap="nowrap">';
                $html .= '				<select name="filter'.$i.'" class="type" onChange="this.form.submit()">';
                $html .= '					<option value="0"> -- '.$filter_item['title'].' -- </option>';
                if(isset($filter_item['list']))
                    if($filter_item['list']) {
                        if(isset($filter_item['type'])) {
                            if($type == 'land'){
                                global $commons;
                                $cOptgroup = '';
                                foreach ($filter_item['list'] as $item) {
                                    if($item->type == '')
                                        continue;
                                    if($cOptgroup != $item->type && $item->type != ''){
                                        $cOptgroup = $item->type;
                                        $html .='<optgroup label="'.$commons->land_type[$cOptgroup].'">';
                                    }
                                    if ($item->id == $ss_filter) {
                                        $html .= "<option value='" . $item->id . "'  selected='selected'> " . $item->$field . "</option>";
                                    } else {
                                        $html .= "<option value='" . $item->id . "'>" . $item->$field . "</option>";
                                    }
                                }
                                $html .='</optgroup>';
                            }
                        }else
                            foreach ($filter_item['list'] as $item) {
                                if ($item->id == $ss_filter) {
                                    $html .= "<option value='" . $item->id . "'  selected='selected'> " . $item->$field . "</option>";
                                } else {
                                    $html .= "<option value='" . $item->id . "'>" . $item->$field . "</option>";
                                }
                            }
                    }
                $html .= '				</select>';
                $html .= '			</td>';
            }
        }
        $html .= '		</tr>';
        $html .= '	</table>';
        $html .= '</div>';
        /*$html .= '<div class="col-sm-6">';
        $html .= '<div class="dataTables_length" id="example1_length">';
        $html .= '    <label>Show ';
        $html .= '    <select name="example1_length" aria-controls="example1" class="form-control input-sm">';
        $html .= '        <option value="10">10</option>';
        $html .= '        <option value="25">25</option>';
        $html .= '        <option value="50">50</option>';
        $html .= '        <option value="100">100</option>';
        $html .= '    </select> entries</label></div>';
        $html .= '</div>';
        $html .= '</div>';*/
        $html .= '</div>';
        return $html;
    }

    function orderTable($title_field,$field_select, $field_sorting , $sort_direct)
    {
        $sort_direct = $sort_direct?$sort_direct:'asc';
        $sort_direct_continue = $sort_direct == 'asc' ? 'desc' : 'asc';
        if($field_select == $field_sorting)
        {
            $html  =  "<a title=\"Click to sort by this column\" href=\"javascript:tableOrdering('$field_select','$sort_direct_continue','');\">";
            $html .= $title_field ;
            $html .= "<i class=\"fa fa-sort-".$sort_direct."\"></i>";
            $html .= "</a>";

        }
        else
        {
            $html =  "<a title=\"Click to sort by this column\" href=\"javascript:tableOrdering('$field_select','$sort_direct_continue','');\">$title_field</a>";
        }
        return $html ;
    }

    function published($cid, $status)
    {
        if($status != 'published')
        {

            $html =  "<a title=\"Disable item\" onclick=\"return listItemTask('$cid','$status')\" href=\"javascript:void(0);\"><i class=\"fa fa-dot-circle-o\"></i></a>";
        }
        else
        {
            $html =  "<a title=\"Enable item\" onclick=\"return listItemTask('$cid','$status')\" href=\"javascript:void(0);\"><i class=\"fa fa-check-circle-o\"></i></a>";
        }
        return $html;
    }

    function changeStatus($cid, $status)
    {
        if(substr(trim($status),0,2) == 'un')
        {
            $html =  "<a title=\"Disable item\" onclick=\"return listItemTask('$cid','$status')\" href=\"javascript:void(0);\">
			<i class=\"fa fa-dot-circle-o\"></i></a>";
        }
        else
        {
            $html =  "<a title=\"Enable item\" onclick=\"return listItemTask('$cid','$status')\" href=\"javascript:void(0);\">
			<i class=\"fa fa-check-circle-o\"></i></a>";
        }
        return $html;
    }

    function edit($link)
    {
        $html =  "<a title=\"Views\" href=\"$link\">";
        $html .="<i class=\"fa fa-pencil-square-o\" style='font-size: 20px;
    margin-top: 4px;'></a>";
        return $html;
    }

    function editText($name,$value,$i,$size = 3,$rows = 1){
        if($rows > 1){
            $html = '<textarea rows="'.$rows.'" cols="'.$size.'" name="'.$name.'_'.$i.'" >'.htmlspecialchars($value).'</textarea>';
            $html .= '<input type="hidden" name="'.$name.'_'.$i.'_original'.'" value="'.htmlspecialchars($value).'"/>';
        }else{
            $html = '<input type="text" name="'.$name.'_'.$i.'"  value="'.htmlspecialchars($value).'" size="'.$size.'"/>';
            $html .= '<input type="hidden" name="'.$name.'_'.$i.'_original'.'" value="'.htmlspecialchars($value).'"/>';
        }
        return $html;
    }

    function editSelectbox($name,$value,$i,$arry_select = array(),$field_value = 'id', $field_label='name',$size = 1,$multi  = 0){
        if(!$multi){
            $html_sized = $size > 1 ? "size=$size":"" ;
            $html = '<select name="'.$name.'_'.$i.'" id="'.$name.'_'.$i.'" '.$html_sized.'>';
            $compare  = 0;
            if(@$value)
                $compare = $value;
            $j = 0;
            if(count($arry_select) && $arry_select){
                if(is_object(end($arry_select))){
                    foreach ($arry_select as $select_item) {
                        $checked = "";
                        if(!$compare && !$j){
                            $checked = "selected=\"selected\"";
                        } else {
                            if($compare === ($select_item->$field_value))
                                $checked = "selected=\"selected\"";
                        }
                        $html .= '<option value="'.$select_item->$field_value.'" '. $checked.'>'.$select_item -> $field_label.'</option>';
                        $j ++;
                    }
                } else {
                    foreach ($arry_select as $key => $name) {
                        $checked = "";
                        if(!$compare && !$j){
                            $checked = "selected=\"selected\"";
                        } else {
                            if($compare == $key)
                                $checked = "selected=\"selected\"";
                        }
                        $html .= '<option value="'.$key.'" '. $checked.'>'.$name.'</option>';
                        $j ++;
                    }
                }
            }
            $html .= '</select>';
            $html .= '<input type="hidden" name="'.$name.'_'.$i.'_original'.'" value="'.$value.'"/>';
        } else {
            $html_sized = $size > 1 ? "size=$size":"" ;
            $html = '<select name="'.$name.'_'.$i.'[]" id="'.$name.'_'.$i.'" '.$html_sized.'  multiple="multiple">';
            $array_value  = isset($value)?explode(',',$value):array();
            $j = 0;
            if(count($arry_select)){
                if(is_object(end($arry_select))){
                    foreach ($arry_select as $select_item) {
                        $checked = "";
                        if(in_array($select_item->$field_value,$array_value))
                            $checked = "selected=\"selected\"";
                        $html .= '<option value="'.$select_item->$field_value.'" '. $checked.'>'.$select_item -> $field_label.'</option>';
                        $j ++;
                    }
                } else {
                    foreach ($arry_select as $key => $name) {
                        if(in_array($name,$array_value))
                            $checked = "selected=\"selected\"";

                        $html .= '<option value="'.$key.'" '. $checked.'>'.$name.'</option>';
                        $j ++;
                    }
                }
            }
            $html .= '</select>';
            $html .= '<input type="hidden" name="'.$name.'_'.$i.'_original'.'" value="'.$value.'"/>';
        }

        return $html;
    }
    /**
     * Add input[type="hidden"]
     */
    function addInputHidden($name = '', $key = ''){
        return '<input type="hidden" name="'.$name.'" value="'.$key.'" />';
    }


    /*create alias*/
    function stringStandart($str)
    {
        $str  =  parseString($str);
        $str = preg_replace('/\s\s+/', ' ', $str);
        $str = str_replace(' ','-',$str);
        $str = strtolower ( $str);
        return $str;
    }

    /*
        * Remove viet sign and replace " " to "-"
        */

    function parseString($str){
        $arr=array("&ldquo;","&rdquo;","&lsquo;","&rsquo;","&quot;","'","&gt;","&lt;");
        $str=str_replace($arr, "-", $str);
        $arr=array(";",".","!",":","~","@","#","$","%","^","&","*","(",")","=","+","|","\\","/","?",",","'",'"','“','”','>','<','quot;');
        $str=str_replace($arr, "", $str);
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);

        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        $str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }