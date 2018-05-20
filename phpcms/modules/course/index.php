<?php
defined('IN_PHPCMS') or exit('No permission resources.');

class index{
    private $db;
    public function __construct()
    {
        $this->db = pc_base::load_model('course_model');
    }

    /**
     * 报名
     */
    public function init(){
        include template('course','index');
    }


    /**
     * 搜索成绩
     */
    public function search(){
        include template('course','search');
    }


    public function lists(){
        include template('course','list');
    }


    /**
     * 添加报名
     */
    public function save(){

        if ($_POST['data']){
            $data = $_POST['data'];
            $data['addtime'] = time();
            $data['updatetime'] = time();
            if($this->db->insert($data)){
                showmessage('录入成功');
            }else{
                showmessage('录入失败');
            }
        }else{
            showmessage('非法数据');
        }

    }

}