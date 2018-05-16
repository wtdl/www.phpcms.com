<?php
/**
 * 深圳福道文化传播公司
 * domain: http://www.fudaojt.com
 * User: pengjian
 * Time: 下午4:25
 */
defined('IN_PHPCMS') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class course_model extends model {
    function __construct() {
        $this->db_config = pc_base::load_config('database');
        $this->db_setting = 'default';
        $this->table_name = 'course';
        parent::__construct();
    }
}