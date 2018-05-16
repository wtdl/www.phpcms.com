<?php
defined('IN_PHPCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'course', 'parentid'=>29, 'm'=>'course', 'c'=>'admin_course', 'a'=>'init', 'data'=>'s=1', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'course_add', 'parentid'=>$parentid, 'm'=>'course', 'c'=>'admin_course', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'edit_course', 'parentid'=>$parentid, 'm'=>'course', 'c'=>'admin_course', 'a'=>'edit', 'data'=>'s=1', 'listorder'=>0, 'display'=>'0'));
$menu_db->insert(array('name'=>'check_course', 'parentid'=>$parentid, 'm'=>'course', 'c'=>'admin_course', 'a'=>'init', 'data'=>'s=2', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'overdue', 'parentid'=>$parentid, 'm'=>'course', 'c'=>'admin_course', 'a'=>'init', 'data'=>'s=3', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'del_course', 'parentid'=>$parentid, 'm'=>'course', 'c'=>'admin_course', 'a'=>'delete', 'data'=>'', 'listorder'=>0, 'display'=>'0'));
$language = array('course'=>'报名课程', 'course_add'=>'添加课程', 'edit_course'=>'编辑课程', 'check_course'=>'审核课程', 'overdue'=>'过期课程', 'del_course'=>'删除课程');
?>