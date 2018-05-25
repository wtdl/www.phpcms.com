<?php
/**
 * 深圳网通动力网络技术有限公司
 * User: pengjian (szpengjian@gmail.com)
 * Date: 18-5-24
 * Time: 下午9:52
 */
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
    <form method="post" action="?m=course&c=admin_course&a=add" name="myform" id="myform">
        <table class="table_form" width="100%" cellspacing="0">
            <tbody>
            <tr>
                <th width="80">导入Excel</th>
                <td><input name="file" id="title" class="input-text" type="file" size="50" ></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('load_sub')?> ">&nbsp;<input type="reset" value=" <?php echo L('clear')?> ">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>


