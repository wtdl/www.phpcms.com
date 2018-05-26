<?php
/**
 * 深圳福道文化传播公司
 * domain: http://www.fudaojt.com
 * User: pengjian
 * Time: 下午4:59
 */
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_app_class('admin','admin',0);
pc_base::load_app_func('course');

class admin_course extends admin {

    private $db; 
    public $username;
    public function __construct()
    {
        parent::__construct();
        $this->db = pc_base::load_model('course_model');
    }


    public function init(){
        // exportExcel('用户数据');
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $data = $this->db->listinfo('', 'id ASC', $page, 15);
        foreach ($data as &$row){
            $row['sex'] = $row['sex']==1 ? '男' : '女';
            $row['is_deny'] = empty($row['is_deny']) ? '开启' : '关闭';
        }
        include $this->admin_tpl('course_list');
    }

    /**
     * 配置在线课程
     */
    public function setting(){
        if (!empty($_POST)){
            if (setcache('course_system',array('course_setting'=>trim($_POST['course_setting'])),'commons')) {
                showmessage(L('course_update_ok'),'?m=course&c=admin_course&a=init');
            }
            showmessage(L('course_update_error'),'goback');
        }
        $course_system = getcache('course_system','commons');
        include $this->admin_tpl('course_setting');
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
    public function add()
    {
        if (!empty($_POST['course'])) {
            $data = $_POST['course'];
            $data['addtime'] = time();
            $data['updatetime'] = time();
            if ($this->db->insert($data)) {
                showmessage(L('course_insert_ok'), '?m=course&c=admin_course&a=init&s=1');
            }
            showmessage(L('course_insert_error'), HTTP_REFERER);
        }
        include $this->admin_tpl('course_add');
    }

    /**
     * 编辑课程
     */
    public function edit(){
        if (!empty($_POST['id'])){
            $update = $_POST['course'];
            unset($update['addtime']);
            $update['updatetime'] = time();
            $this->db->update($update,array('id'=>trim($_POST['id'])));
            showmessage(L('course_update_ok'),'goback');
        }
        $an_info = $this->db->get_one(array('id'=>trim($_GET['aid'])));
        include $this->admin_tpl('course_edit');

    }

    /**
     * 删除
     */
    public function delete(){

        if (!empty($_POST['aid'])){
            $data = $_POST['aid'];
            foreach ($data as $key=>$val){
                $this->db->delete(array('id'=>$val));
            }
            showmessage(L('course_delete_ok'),'goback');
        }
        showmessage(L('course_delete_ok'),'goback');
    }

    /**
     * 批量处理
     */
    public function public_approval(){
        __print($_GET);
    }

    /**
     * 导出学生
     */
    public function export(){
        __print($_GET);
    }

    /**
     * 导入学生
     */
    public function load(){
        include $this->admin_tpl('course_load');
    }
}