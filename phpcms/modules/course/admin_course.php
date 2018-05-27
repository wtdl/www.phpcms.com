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

    /**
     * 列表
     * @return [type]
     */
    public function index()
    {
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
            $setting['course_setting'] = trim($_POST['course_setting']);
            $setting['course_pages'] = trim($_POST['pages']);
            if (setcache('course_system',$setting,'commons')) {
                showmessage(L('course_update_ok'),'?m=course&c=admin_course&a=index');
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
        if (!empty($_GET['s'])){
            $data = $_GET;
            if ($_GET['submit']) {
                $this->delete($_GET);
            }
            unset($data['s'],$data['m'],$data['c'],$data['a'],$data['page']);
            $where="{$data['type']} LIKE '%".trim($data['keyword'])."%'";
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            //获取缓存配置信息
            $pagesize = 15;
            $limit = ($page-1)*$pagesize.",".$pagesize;
            $data = $this->db->select($where,'*',$limit);
            $total = $this->db->count($where);
            $this->db->pages = pages($total, $page, $pagesize);
            foreach ($data as &$row){
                $row['sex'] = $row['sex']==1 ? '男' : '女';
                $row['is_deny'] = empty($row['is_deny']) ? '开启' : '关闭';
            }
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
                showmessage(L('course_insert_ok'), '?m=course&c=admin_course&a=index');
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
    public function delete($data){
        if (!empty($data['aid'])){
            $data = $data['aid'];
            foreach ($data as $key=>$val){
                $this->db->delete(array('id'=>$val));
            }
            showmessage(L('course_delete_ok'),'?m=course&c=admin_course&a=index');
        }
        showmessage(L('course_delete_error'),'goback');
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