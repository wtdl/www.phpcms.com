<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimal-ui, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="szwtdl.cn,Pixel grid studio">
    <title><?php echo L('phpcms_logon')?></title>
    <link href="<?php echo JS_PATH?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo JS_PATH?>bootstrapreset.css" rel="stylesheet">
    <link href="<?php echo JS_PATH?>pxgridsicons.min.css" rel="stylesheet">
    <link href="<?php echo JS_PATH?>style.css" rel="stylesheet">
    <link href="<?php echo JS_PATH?>responsive.css" rel="stylesheet" media="screen">
    <link href="<?php echo JS_PATH?>animation.css" rel="stylesheet">
    <script src="<?php echo JS_PATH?>modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="<?php echo JS_PATH?>jquery.min.js"></script>
    <script type="text/javascript">
        var cookie_pre = "LRy_";var cookie_domain = '';var cookie_path = '';var web_url = 'https://www.wuzhicms.com/';
        var set_iframe_url = true;    </script>
    <script src="<?php echo JS_PATH?>base.js"></script>
    <script src="<?php echo JS_PATH?>wuzhicms.js"></script>
    <script src="<?php echo JS_PATH?>jquery-easing.js"></script>
    <script src="<?php echo JS_PATH?>responsivenav.js"></script>
    
    <!--[if lt IE 9]>
    <script src="<?php echo JS_PATH?>html5shiv.js"></script>
    <script src="<?php echo JS_PATH?>respond.min.js"></script>
    <![endif]-->

    <!--[if lt IE 8]>
    <link rel="stylesheet" href="https://www.wuzhicms.com/res/css/ie7/ie7.css">
    <!<![endif]-->
</head>
<body class="login-body" onload="javascript:document.myform.username.focus();">
<div class="container fadeInDown">
    <form class="form-signin" id="form_login" action="index.php?m=admin&c=index&a=login&dosubmit=1" method="post" onsubmit="return checkform();">
        <div class="form-signin-heading"></div>
        <div class="login-wrap">
            <div class="loginlogo center"><img src="https://www.wuzhicms.com/res/images/login_logo.png"></div>
            <div class="form-group">
                <div class="input-group" id="username_error">
                    <div class="input-group-addon">
                        <i class="icon-user"></i>
                    </div>
                    <input type="text" class="form-control" name="username" id="username" placeholder="用户名" autocomplete="off" autofocus="">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group" id="password_error">
                    <div class="input-group-addon">
                        <i class="icon-key5"></i>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" placeholder="密码" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group" id="codeid_error">
                    <div class="input-group-addon">
                        <i class="icon-qrcode"></i>
                    </div>
                    <input type="text" id="codeid" name="code" class="form-control" placeholder="验证码" onfocus="javascript:document.getElementById('code_img').src='<?php echo SITE_PROTOCOL.SITE_URL.WEB_PATH;?>api.php?op=checkcode&m=admin&c=index&a=checkcode&?rd='+Math.random();void(0);">
                    <div class="input-group-addon" id="logincode">
                        <?php echo form::checkcode('code_img')?>
                    </div>
                </div>
            </div>
            <button type="submit" name="dosubmit" class="btn btn-shadow btn-danger btn-block btn-login">登 录</button>
        </div>
        <div class="form-signin-bottom center">Copyright © 2014 szwtdl.cn <a href="http://www.szwtdl.cn/" target="_blank">xxx企业 版权所有</a></div>
    </form>
</div>
<script src="https://www.wuzhicms.com/res/js/bootstrap.min.js"></script>
<script src="https://www.wuzhicms.com/res/js/focuse.js"></script>
<script type="text/javascript">
   function addclass_slide(id,errid,classname) {
       $('#'+id).animate({
           opacity: 'show'
       }, 1000,function() {
           $('#'+errid).addClass(classname);
       });


   }
   function checkform() {
       $('#username_error').removeClass('validate-has-error');
       $('#password_error').removeClass('validate-has-error');
       $('#codeid_error').removeClass('validate-has-error');
        if($('#username').val()=='') {
           addclass_slide('username','username_error','validate-has-error');
           $('#username').focus();
           return false;
        }
       if($('#password').val()=='') {
           addclass_slide('password','password_error','validate-has-error');
           $('#password').focus();
           return false;
       }
       if($('#codeid').val()=='') {
           addclass_slide('codeid','codeid_error','validate-has-error');
           $('#codeid').focus();
           return false;
       }
}



$(function(){

  if(top.location.href != self.location.href){
      $('#form_login').attr('target','top');
  }

});
</script>

</body>
</html>