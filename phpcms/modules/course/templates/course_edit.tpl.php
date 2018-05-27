<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
<form method="post" action="?m=course&c=admin_course&a=edit&aid=<?php echo $_GET['aid']?>" name="myform" id="myform">
<table class="table_form" width="100%">
<tbody>
	<tr>
		<th width="80"><?php echo L('course_nickname')?></th>
		<td><input name="course[nickname]" id="title" value="<?php echo new_html_special_chars($an_info['nickname'])?>" class="input-text" type="text" size="50" ></td>
	</tr>
    <tr>
        <th><?php echo L('course_sex')?></th>
        <td>
            <select name="course[sex]">
                <option value="1" <?php echo $an_info['sex']==1 ? 'selected' : ''?>>男</option>
                <option value="2" <?php echo $an_info['sex']==2 ? 'selected' : ''?>>女</option>
            </select>
        </td>
    </tr>
	<tr>
		<th><?php echo L('course_school')?></th>
		<td >
            <input type="text" name="course[school]" value="<?php echo $an_info['school']?>" class="input-text" size="50">
		</td>
	</tr>
    <tr>
        <th><?php echo L('course_number')?></th>
        <td><input type="text" name="course[school_number]" value="<?php echo $an_info['school_number']?>" class="input-text" size="50"></td>
    </tr>
    <tr>
        <th><?php echo L('course_card')?></th>
        <td><input type="text" name="course[card]" value="<?php echo $an_info['card']?>" class="input-text" size="50"></td>
    </tr>
    <tr>
        <th><?php echo L('course_phone') ?></th>
        <td><input type="text" name="course[phone]" value="<?php echo $an_info['phone']?>" class="input-text" size="50"></td>
    </tr>
    <tr>
        <th><?php echo L('course_tel')?></th>
        <td><input type="text" name="course[parents_phone]" value="<?php echo $an_info['parents_phone']?>" class="input-text" size="50"></td>
    </tr>
    <tr>
        <th><?php echo L('course_deny')?></th>
        <td>
            <label><input type="radio" name="course[is_deny]" <?php echo $an_info['is_deny']==0 ? 'checked' : ''?>  value="0"> <?php echo L('user_deny_no')?></label>
            <label><input type="radio" name="course[is_deny]" <?php echo $an_info['is_deny']==1 ? 'checked' : ''?>  value="1"> <?php echo L('user_deny_off')?></label>
    </tr>
    <tr>
        <th><?php echo L('course_time') ?></th>
        <td><input type="text" name="course[addtime]" value="<?php echo date('Y-m-d H:i:s',$an_info['addtime'])?>" readonly="readonly" class="input-text" size="50"></td>
    </tr>
    <tr>
        <th><?php echo L('course_update') ?></th>
        <td>
            <input type="hidden" name="id" value="<?php echo $an_info['id']?>">
            <input type="text" name="course[updatetime]" value="<?php echo date('Y-m-d H:i:s',$an_info['updatetime'])?>" readonly="readonly" class="input-text" size="50">
        </td>
    </tr>
    </tbody>
</table>
<input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> " class="dialog">&nbsp;<input type="reset" class="dialog" value=" <?php echo L('clear')?> ">
</form>
</div>
</body>
</html>
<script type="text/javascript">
function load_file_list(id) {
	$.getJSON('?m=admin&c=category&a=public_tpl_file_list&style='+id+'&module=announce&templates=show&name=announce&pc_hash='+pc_hash, function(data){$('#show_template').html(data.show_template);});
}

$(document).ready(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'220',height:'70'}, function(){this.close();$(obj).focus();})}});
	$('#title').formValidator({onshow:"<?php echo L('input_announce_title')?>",onfocus:"<?php echo L('title_min_3_chars')?>",oncorrect:"<?php echo L('right')?>"}).inputValidator({min:1,onerror:"<?php echo L('title_cannot_empty')?>"}).ajaxValidator({type:"get",url:"",data:"m=announce&c=admin_announce&a=public_check_title&aid=<?php echo $_GET['aid']?>",datatype:"html",cached:false,async:'true',success : function(data) {
        if( data == "1" )
		{
            return true;
		}
        else
		{
            return false;
		}
	},
	error: function(){alert("<?php echo L('server_no_data')?>");},
	onerror : "<?php echo L('announce_exist')?>",
	onwait : "<?php echo L('checking')?>"
	}).defaultPassed();
	$('#starttime').formValidator({onshow:"<?php echo L('select_stardate')?>",onfocus:"<?php echo L('select_stardate')?>",oncorrect:"<?php echo L('right_all')?>"}).defaultPassed();
	$('#endtime').formValidator({onshow:"<?php echo L('select_downdate')?>",onfocus:"<?php echo L('select_downdate')?>",oncorrect:"<?php echo L('right_all')?>"}).defaultPassed();
	$("#content").formValidator({autotip:true,onshow:"",onfocus:"<?php echo L('announcements_cannot_be_empty')?>"}).functionValidator({
	    fun:function(val,elem){
	    //获取编辑器中的内容
		var oEditor = CKEDITOR.instances.content;
		var data = oEditor.getData();
        if(data==''){
		    return "<?php echo L('announcements_cannot_be_empty')?>"
	    } else {
			return true;
		}
	}
	}).defaultPassed();
	$('#style').formValidator({onshow:"<?php echo L('select_style')?>",onfocus:"<?php echo L('select_style')?>",oncorrect:"<?php echo L('right_all')?>"}).inputValidator({min:1,onerror:"<?php echo L('select_style')?>"}).defaultPassed();
});
</script>