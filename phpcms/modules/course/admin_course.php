<?php
/**
 * 深圳福道文化传播公司
 * domain: http://www.fudaojt.com
 * User: pengjian
 * Time: 下午4:59
 */
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
pc_base::load_app_func('course','course');

class admin_course extends admin {

    private $db; public $username;
    public function __construct()
    {
        parent::__construct();
        $this->username = param::get_cookie('admin_username');
        $this->db = pc_base::load_model('course_model');
    }


    public function init(){
        exit();
        include $this->admin_tpl('course_list');
    }

}