<?php
    namespace App\Helper;
    /**
     * Created by PhpStorm.
     * User: Admin
     * Date: 6/6/2017
     * Time: 10:14 AM
     */
    class Toolbar
    {
        private $buttons = array();
        public function __construct()
        {
            $this->title = "Hệ thống quản lý nội dung(CMS)";
            $this->buttons = array();
            $this->buttons_html = array();
        }
        public function addButton($task = 'task', $alt = 'task', $msg = '', $img = '')
        {
            $array = array(
                'task' => $task,
                'alt' => $alt,
                'msg' => $msg,
                'img' => $img
                );
            $buttons = isset($this->buttons) ? $this->buttons : array();
            $buttons[] = $array;
            $this->buttons = $buttons;
        }

        public function showButtons()
        {

            $html = "";
            if (!empty($this->buttons) || !empty($this->buttons_html)) {
                $buttons = $this->buttons;

                $html .= " <div id=\"wrap-toolbar\" class=\"wrap-toolbar\">";
                for ($i = 0; $i < count($buttons); $i++) {
                    $item = $buttons[$i];
                    if ($item['msg']) {
                        $html .= "<a class=\"toolbar\" onclick=\"javascript:if(document.adminForm.boxchecked.value==0){alert('" .
                            $item['msg'] . "');}else{submitbutton('" . $item['task'] . "')} \" href=\"javascript:void(0)\" >";
                    } else {
                        $html .= "<a class=\"toolbar\" onclick=\"javascript: submitbutton('" . $item['task'] ."')\" href=\"javascript:void(0)\" >";
                    }
                    $html .= '<i class="fa ' . $item['img'] . '"></i>';
                    $html .= $item['alt'];
                    $html .= "</a>";
                }
                $html .= " </div><!--end: .wrap-toolbar-->";
            }
            return $html;
        }
        public function showButton($prefix = 'List') {
            $fun = 'showButtom' . $prefix; // gán tiền tố prefix để làm hàm
            $this->$fun();
            return $this->showButtons();
        }

        public function showButtomList() {
            $this->addButton('add','Add','','fa-plus-circle');
            $this->addButton('save_all','Save','','fa-save');
            $this->addButton('edit','Edit','Bạn phải chọn ít nhất một bản ghi','fa-pencil');
            $this->addButton('remove','Remove','Bạn phải chọn ít nhất một bản ghi','fa-trash-o');
            $this->addButton('published','Published','Bạn phải chọn ít nhất một bản ghi','fa-check-circle-o');
            $this->addButton('unpublished','Unpublished','Bạn phải chọn ít nhất một bản ghi','fa-dot-circle-o');
        }

        public function showButtomDetail() {
            $this->addButton('save-add', 'Save & new', '', 'fa-newspaper-o');
            $this->addButton('apply', 'Apply', '', 'fa-check');
            $this->addButton('save', 'Save', '', 'fa-save');
            $this->addButton('back', 'Cancel', '', 'fa-reply');
        }
    }