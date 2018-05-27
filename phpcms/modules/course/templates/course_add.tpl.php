<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div class="pad-10">
<form method="post" action="?m=course&c=admin_course&a=add" name="myform" id="myform">
<table class="table_form" width="100%" cellspacing="0">
<tbody>
<tr>
    <th width="80"><?php echo L('course_nickname')?></th>
    <td><input name="course[nickname]" id="title" class="input-text" type="text" size="50" ></td>
</tr>
<tr>
    <th><?php echo L('course_sex')?></th>
    <td>
        <select name="course[sex]">
            <option value="1" >男</option>
            <option value="2" >女</option>
        </select>
    </td>
</tr>
<tr>
    <th><?php echo L('course_school')?></th>
    <td >
        <input type="text" name="course[school]"  class="input-text" size="50">
    </td>
</tr>
<tr>
    <th><?php echo L('course_number')?></th>
    <td><input type="text" name="course[school_number]"  class="input-text" size="50"></td>
</tr>
<tr>
    <th><?php echo L('course_card')?></th>
    <td><input type="text" name="course[card]" class="input-text" size="50"></td>
</tr>
<tr>
    <th><?php echo L('course_phone') ?></th>
    <td><input type="text" name="course[phone]" class="input-text" size="50"></td>
</tr>
<tr>
    <th><?php echo L('course_tel')?></th>
    <td><input type="text" name="course[parents_phone]" class="input-text" size="50"></td>
</tr>
<tr>
    <th><?php echo L('course_deny')?></th>
    <td>
        <input type="radio" checked name="course[is_deny]" value="0"> <?php echo L('user_deny_no')?>
        <input type="radio" name="course[is_deny]" value="1"> <?php echo L('user_deny_off')?>
</tr>
<tr>
    <td>
        <input type="submit" name="dosubmit" id="dosubmit" value=" <?php echo L('ok')?> ">&nbsp;<input type="reset" value=" <?php echo L('clear')?> ">
    </td>
</tr>
	</tbody>
</table>
</form>
</div>
</body>
</html>
<script type="text/javascript">
function load_file_list(id) {
	if (id=='') return false;
	$.getJSON('?m=admin&c=category&a=public_tpl_file_list&style='+id+'&module=announce&templates=show&name=announce&pc_hash='+pc_hash, function(data){$('#show_template').html(data.show_template);});
}

$(document).ready(function(){
	$.formValidator.initConfig({formid:"myform",autotip:true,onerror:function(msg,obj){window.top.art.dialog({content:msg,lock:true,width:'220',height:'70'}, function(){this.close();$(obj).focus();})}});
	$('#title').formValidator({onshow:"<?php echo L('input_announce_title')?>",onfocus:"<?php echo L('title_min_3_chars')?>",oncorrect:"<?php echo L('right')?>"}).inputValidator({min:1,onerror:"<?php echo L('title_cannot_empty')?>"}).ajaxValidator({type:"get",url:"",data:"m=announce&c=admin_announce&a=public_check_title",datatype:"html",cached:false,async:'true',success : function(data) {
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
	});
	$('#starttime').formValidator({onshow:"<?php echo L('select_stardate')?>",onfocus:"<?php echo L('select_stardate')?>",oncorrect:"<?php echo L('right_all')?>"});
	$('#endtime').formValidator({onshow:"<?php echo L('select_downdate')?>",onfocus:"<?php echo L('select_downdate')?>",oncorrect:"<?php echo L('right_all')?>"});
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
	});
	$('#style').formValidator({onshow:"<?php echo L('select_style')?>",onfocus:"<?php echo L('select_style')?>",oncorrect:"<?php echo L('right_all')?>"}).inputValidator({min:1,onerror:"<?php echo L('select_style')?>"});
});
</script>