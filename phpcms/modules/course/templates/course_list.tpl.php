<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-lr-10">
<form name="myform" action="?m=course&c=admin_course&a=listorder" method="post">
<div class="table-list">
    <select name="type">
        <option value="nickname"><?php echo L('course_nickname')?></option>
        <option value="school"><?php echo L('course_school')?></option>
        <option value="school_number"><?php echo L('course_number')?></option>
        <option value="card"><?php echo L('course_card')?></option>
        <option value="phone"><?php echo L('course_phone')?></option>
    </select>
    <input type="text" name="keyword" placeholder="搜索内容">
    <input type="submit" value="搜索">
</div>
<div class="table-list">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
            <th align="center"><input type="checkbox" value="" id="check_box" onclick="selectall('aid[]');"></th>
			<th align="center"><?php echo L('course_nickname')?></th>
			<th align="center"><?php echo L('course_sex')?></th>
			<th align="center"><?php echo L('course_school')?></th>
			<th align="center"><?php echo L('course_number')?></th>
			<th align="center"><?php echo L('course_card')?></th>
			<th align="center"><?php echo L('course_phone')?></th>
            <th align="center"><?php echo L('course_tel')?></th>
            <th align="center"><?php echo L('course_deny')?></th>
            <th align="center"><?php echo L('course_time')?></th>
            <th align="center"><?php echo L('course_update')?></th>
            <th align="center"><?php echo L('course_btn')?></th>
            </tr>
        </thead>
    <tbody>
 <?php 
if(is_array($data)){
	foreach($data as $course){
?>   
	<tr>
	<td align="center"><input type="checkbox" name="aid[]" value="<?php echo $course['id']?>"></td>
	<td align="center"><?php echo $course['nickname']?></td>
	<td align="center"><?php echo $course['sex']?></td>
	<td align="center"><?php echo $course['school']?></td>
    <td align="center"><?php echo $course['school_number']?></td>
    <td align="center"><?php echo $course['card']?></td>
    <td align="center"><?php echo $course['phone']?></td>
    <td align="center"><?php echo $course['parents_phone']?></td>
    <td align="center"><?php echo $course['is_deny']?></td>
    <td align="center"><?php echo date('Y-m-d H:i:s', $course['addtime'])?></td>
    <td align="center"><?php echo date('Y-m-d H:i:s', $course['updatetime'])?></td>
	<td align="center">
	<?php if ($_GET['s']==1) {?><a href="?m=course&c=index&aid=<?php echo $course['id']?>" title="<?php echo L('preview')?>"  target="_blank"><?php }?><?php echo L('index')?><?php if ($_GET['s']==1) {?></a><?php }?> |
	<a href="javascript:edit('<?php echo $course['id']?>', '<?php echo safe_replace($course['nickname'])?>');void(0);"><?php echo L('edit')?></a>

    </td>
	</tr>
<?php 
	}
}
?>
<tr>
    <td colspan="12"><?php echo $pages?></td>
</tr>
</tbody>
    </table>
  
    <div class="btn"><label for="check_box"><?php echo L('selected_all')?>/<?php echo L('cancel')?></label>
        <?php if($_GET['s']==1) {?><input name='submit' type='submit' class="button" value='<?php echo L('cancel_all_selected')?>' onClick="document.myform.action='?m=course&c=admin_course&a=public_approval&passed=0'"><?php } elseif($_GET['s']==2) {?><input name='submit' type='submit' class="button" value='<?php echo L('pass_all_selected')?>' onClick="document.myform.action='?m=course&c=admin_course&a=public_approval&passed=1'"><?php }?>&nbsp;&nbsp;
		<input name="submit" type="submit" class="button" value="<?php echo L('remove_all_selected')?>" onClick="document.myform.action='?m=course&c=admin_course&a=delete';return confirm('<?php echo L('affirm_delete')?>')">&nbsp;&nbsp;</div>  </div>
 <div id="pages"><?php echo $this->db->pages;?></div>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function edit(id, title) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'<?php echo L('edit_course')?>--'+title, id:'edit', iframe:'?m=course&c=admin_course&a=edit&aid='+id ,width:'700px',height:'400px'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;
	var form = d.document.getElementById('dosubmit');form.click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
</script>