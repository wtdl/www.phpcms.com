<?php
/**
 * 深圳网通动力网络技术有限公司
 * User: pengjian (szpengjian@gmail.com)
 * Date: 18-5-25
 * Time: 下午11:18
 */
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
    <form method="post" action="?m=course&c=admin_course&a=setting" name="myform" id="myform">
        <table class="table_form" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <th width="80">是否需要登录</th>
                    <td>
                        <label><input type="radio" name="course_setting" <?php echo $course_system['course_setting'] ==1 ? 'checked' : ''?>  value="1"> 需要</label>
                        <label><input type="radio" name="course_setting" <?php echo $course_system['course_setting'] ==2 ? 'checked' : ''?> value="2"> 不需要</label>
                    </td>
                </tr>
                <tr>
                    <th width="80">前台每页数量</th>
                    <td><input type="text" class="input-text" name="pages" value="<?php echo $course_system['course_pages']?>"></td>
                </tr>
                <tr>
                    <th width="80">最大导出数量</th>
                    <td><input type="text" class="input-text" name="course_export_max" value="<?php echo $course_system['course_export_max']?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> ">&nbsp;
                        <input type="reset" value=" <?php echo L('clear')?> ">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>
