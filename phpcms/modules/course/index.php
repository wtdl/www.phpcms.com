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
     * 报名
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
     * 搜索成绩
     */
    public function search()
    {
        include template('course', 'search');
    }

    /**
     * 搜索结果列表
     */
    public function lists(){
        if (!empty($_POST['data'])) {
            $data = $_POST['data'];
            $where = [];
            foreach ($data as $key => $val) {
                if (empty($val)) {
                    continue;
                }
                $where[$key] = $val;
            }
            $where['is_deny'] = 0;
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $school = $this->db->listinfo($where, 'id ASC', $page, 15);
        }
        include template('course', 'list');
    }

}