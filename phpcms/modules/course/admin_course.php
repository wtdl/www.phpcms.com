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
        $data = $this->db->select();
        foreach ($data as &$row){
            $row['sex'] = $row['sex']==1 ? '男' : '女';
            $row['is_deny'] = empty($row['is_deny']) ? '开启' : '关闭';
        }
        include $this->admin_tpl('course_list');
    }

    /**
     * 搜索结果列表
     */
    public function listorder(){
        if (!empty($_POST)){
            $where = array(
                $_POST['type'] => trim($_POST['keyword'])
            );
            $data = $this->db->select($where);
            include $this->admin_tpl('course_list');
        }else{
            showmessage('非法提交','goback');
        }
    }


    /**
     * 添加报名
     */
    public function add(){
        if ($_GET['mid']){
            $result = $this->db->get_one($_GET['mid']);
        }
        include $this->admin_tpl('course_add');
    }

    /**
     * 编辑课程
     */
    public function edit(){
        if (!empty($_POST['id'])){
            $id = trim($_GET['id']);
            $result = $this->db->get_one($id);
        }else{
            showmessage('操作异常','goback');
        }
        include $this->admin_tpl('course_edit');

    }

    /**
     * 删除
     */
    public function delete(){

    }


    /**
     * 导出学生
     */
    public function export(){

    }

    /**
     * 导入学生
     */
    public function load(){
        include $this->admin_tpl('course_load');
    }
}