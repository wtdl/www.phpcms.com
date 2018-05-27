<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template('content', 'header'); ?>
<div class="main">
    <form method="get" action="<?php echo APP_PATH;?>index.php?m=course&c=index&a=lists">
        <input type="hidden" name="m" value="course">
        <input type="hidden" name="c" value="index">
        <input type="hidden" name="a" value="lists">
        <input type="hidden" name="s" value="1">
        <p>姓名: <input type="text" name="nickname"> </p>
        <p>高考报名号: <input type="text" name="school_number"> </p>
        <p>身份证号码: <input type="text" name="card"> </p>
        <p>
            <input type="submit" value="搜索">
        </p>
    </form>
    <a href="<?php echo APP_PATH;?>index.php?m=course&c=index">去录入信息</a>

</div>
<?php include template('content', 'footer'); ?>