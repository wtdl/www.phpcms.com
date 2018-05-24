<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('content', 'header'); ?>
<div class="main">
    <!--<?php if(empty($school)) { ?>-->
    <form method="post" action="<?php echo APP_PATH;?>index.php?m=course&c=index&a=lists">
        <p>姓名: <input type="text" name="data[nickname]"> </p>
        <p>高考报名号: <input type="text" name="data[school_number]"> </p>
        <p>身份证号码: <input type="text" name="data[card]"> </p>
        <p>
            <input type="submit" value="保存">
            <input type="reset" value="重置">
        </p>
    </form>
    <a href="<?php echo APP_PATH;?>index.php?m=course&c=index">去录入信息</a>
    <!--<?php } else { ?>-->
        <table>
            <tr>
                <th>姓名</th>
                <th>高考报名号</th>
                <th>学校名称</th>
                <th>身份证号码</th>
                <th>性别</th>
                <th>录入日期</th>
            </tr>
            <!--<?php $n=1; if(is_array($school)) foreach($school AS $key => $val) { ?>-->
            <tr>
                <td><?php echo $val['nickname'];?></td>
                <td><?php echo $val['school_number'];?> </td>
                <td><?php echo $val['school'];?></td>
                <td><?php echo $val['card'];?></td>
                <td><!--<?php if($val['sex']==1) { ?>--> 男<!--<?php } else { ?>--><!--<?php } ?>--></td>
                <td><?php echo date('Y-m-d',$val['addtime'])?></td>
            </tr>
            <!--<?php $n++;}unset($n); ?>-->
        </table>
        <a href="<?php echo APP_PATH;?>index.php?m=course&c=index&a=search">去查询</a>
    <!--<?php } ?>-->

</div>
<?php include template('content', 'footer'); ?>