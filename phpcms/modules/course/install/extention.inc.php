<?php
defined('IN_PHPCMS') or exit('Access Denied');
defined('INSTALL') or exit('Access Denied');
$parentid = $menu_db->insert(array('name'=>'course', 'parentid'=>29, 'm'=>'course', 'c'=>'admin_course', 'a'=>'init', 'data'=>'s=1', 'listorder'=>0, 'display'=>'1'), true);
$menu_db->insert(array('name'=>'course_add', 'parentid'=>$parentid, 'm'=>'course', 'c'=>'admin_course', 'a'=>'add', 'data'=>'', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'course_setting', 'parentid'=>$parentid, 'm'=>'course', 'c'=>'admin_course', 'a'=>'setting', 'data'=>'s=1', 'listorder'=>0, 'display'=>'1'));
$menu_db->insert(array('name'=>'course_load', 'parentid'=>$parentid, 'm'=>'course', 'c'=>'admin_course', 'a'=>'init', 'data'=>'s=2', 'listorder'=>0, 'display'=>'1'));
$language = array('course'=>'报名课程', 'course_setting'=>'课程配置', 'course_load'=>'导入Excel', 'course_add'=>'录入课程');
?>