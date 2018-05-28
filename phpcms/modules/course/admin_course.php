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
pc_base::load_sys_class('attachment','',0);    //加载类 
pc_base::load_app_func('global','attachment'); //加载函数库 

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
        $data = $this->db->listinfo('', 'id DESC', $page, 15);
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
            $setting['course_export_max'] = trim($_POST['course_export_max']);
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
            if ($_GET['export']) {
                $this->export($_GET);
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
    public function export($data){
        $header = array('数据库编号','姓名','性别','学校','高中报名编号','身份证号码','手机号码','家长电话','当前状态','添加时间','更新时间');
        if ($data['aid']) {
            $ids = trim(implode(',', $data['aid']),',');
            $result = $this->db->SELECT(' id IN('.$ids.')');
            $data = $this->resultOk($result);
        }else{
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $setting = getcache('course_system','commons');
            $pagesize = $setting['course_export_max'];
            $limit = ($page-1)*$pagesize.",".$pagesize;
            $result = $this->db->SELECT(" 1 LIMIT {$limit}");
            $data = $this->resultOk($result);

        }
        exportExcel('报名课程',$header,$data);
    }

    /**
     * 处理错误数据
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function resultOk($data){
        foreach ($data as &$value) {
            $value['sex'] = $value['sex'] == 1 ? '男' : '女';
            $value['is_deny'] = $value['is_deny'] == 0 ? '开启' : '关闭';
            $value['addtime'] = date('Y-m-d H:i:s',time());
            $value['updatetime'] = date('Y-m-d H:i:s',time());
        }
        return $data;
    }

    /**
     * 导入学生
     */
    public function load(){
        if (!empty($_POST)) {
            $siteid = $this->get_siteid();  
            $site_setting = get_site_setting($siteid);  
            $site_allowext = $site_setting['upload_allowext'];  
            //文件上传  
            $attachment = new attachment($module,$catid,$siteid);  
            $attachment->set_userid($this->userid);  
            $a = $attachment->upload('file',$site_allowext);  
            $upload_root = pc_base::load_config('system','upload_path');  //载入配置  
            $filename = $upload_root.$attachment->uploadedfiles[0]['filepath'];
            $data = importExecl($filename);
            unset($data[1]);
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key]['nickname'] = $value['B'];
                $result[$key]['sex'] = $value['C'] == '男' ? 1 : 0;
                $result[$key]['school'] = $value['D'];
                $result[$key]['school_number'] = $value['E'];
                $result[$key]['card'] = $value['F'];
                $result[$key]['phone'] = $value['G'];
                $result[$key]['parents_phone'] = $value['H'];
                $result[$key]['is_deny'] = $value['I'] == '开启' ? 0 : 1;
                $result[$key]['addtime'] = strtotime($value['J']);
                $result[$key]['updatetime'] = strtotime($value['K']);
            }
            unset($data);
            foreach ($result as $key => $val) {
                $this->db->insert($result[$key]);
            }
            showmessage('导入成功','?m=course&c=admin_course&a=index');
        }
        include $this->admin_tpl('course_load');
    }
}