<?php
defined('IN_PHPCMS') or exit('No permission resources.');
class index
{
    private $db;
    public function __construct()
    {
        pc_base::load_app_func('global');
        pc_base::load_sys_class('format', '', 0);
        $this->db = pc_base::load_model('course_model');
    }

    /**
     * 提交资料到平台
     */
    public function init()
    {
        if (!empty($_POST['data'])) {
            $data = $_POST['data'];
            $data['addtime'] = time();
            $data['updatetime'] = time();
            if ($this->db->insert($data)) {
                showmessage(L('course_insert_ok'),'?m=course&c=index');
            } else {
                showmessage(L('course_insert_error'),'goback');
            }
        }
        include template('course', 'index');
    }


    /**
     * 搜索视图
     */
    public function search()
    {
        include template('course', 'search');
    }

    /**
     * 搜索结果列表
     */
    public function lists(){
        if (!empty($_GET['s'])) {
            $data = $_GET;
            //删除多余的参数
            unset($data['s'],$data['m'],$data['c'],$data['a'],$data['page']);
            $where = " is_deny=0 ";
            //组合搜索条件
            foreach ($data as $key => $val) {
                if (empty($val)) {
                    continue;
                }
                $where .= " AND ".$key.=" LIKE '%".$val."%'";
            }
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            //获取缓存配置信息
            $setting = getcache('course_system','commons');
            $pagesize = $setting['course_pages'];
            $limit = ($page-1)*$pagesize.",".$pagesize;
            //搜索数据
            $school = $this->db->select($where,'*',$limit);
            //统计条数
            $total = $this->db->count($where);
            //执行分页效果
            $pages = pages($total, $page, $pagesize);
        }
        include template('course', 'list');
    }

    public function detail(){
        if (!empty($_GET['id'])) {
            $result = $this->db->get_one(array('id'=>trim($_GET['id'])));
            if (!$result) {
                showmessage('信息不存在','goback');
            }
            include template('course', 'show'); 
        }
    }

}