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
        if ($_POST['data']) {
            $data = $_POST['data'];
            $data['addtime'] = time();
            $data['updatetime'] = time();
            if ($this->db->insert($data)) {
                showmessage('录入成功');
            } else {
                showmessage('录入失败');
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
        if ($_POST['data']) {
            $data = $_POST['data'];
            if (!empty($data)) {
                $where = [];
                foreach ($data as $key => $val) {
                    if (empty($val)) {
                        continue;
                    }
                    $where[$key] = $val;
                }
                $where['is_deny'] = 0;
                $school = $this->db->select($where, '*', 20, 'id DESC');
            }
        }
        include template('course', 'search');
    }

}