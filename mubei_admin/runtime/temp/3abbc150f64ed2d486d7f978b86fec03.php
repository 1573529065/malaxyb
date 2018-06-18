<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:100:"D:\phpStudy\PHPTutorial\WWW\malaxyb\mubei_admin\public/../application/index\view\user\edit_user.html";i:1528640034;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>会员管理</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="__static__/media/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="__static__/media/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

    <link href="__static__/media/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <link href="__static__/media/css/style-metro.css" rel="stylesheet" type="text/css"/>

    <link href="__static__/media/css/style.css" rel="stylesheet" type="text/css"/>

    <link href="__static__/media/css/style-responsive.css" rel="stylesheet" type="text/css"/>

    <link href="__static__/media/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

    <link href="__static__/media/css/uniform.default.css" rel="stylesheet" type="text/css"/>

    <!-- END GLO__static__/BAL MANDATORY STYLES -->

    <!-- BEGIN P__static__/AGE LEVEL STYLES -->

    <link href="__static__/media/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>

    <link href="__static__/media/css/daterangepicker.css" rel="stylesheet" type="text/css" />

    <link href="__static__/media/css/fullcalendar.css" rel="stylesheet" type="text/css"/>

    <link href="__static__/media/css/jqvmap.css" rel="stylesheet" type="text/css" media="screen"/>

    <link href="__static__/media/css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>

    <!-- END PAGE LEVEL STYLES -->

    <link rel="shortcut icon" href="__static__/media/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body >


<div class="portlet box blue ">

    <div class="portlet-title">

        <div class="caption"><i class="icon-reorder"></i>编辑用户</div>
    </div>

    <div class="portlet-body form">

        <!-- BEGIN FORM-->

        <form action="#" class="form-horizontal form-bordered form-row-stripped">

            <div class="control-group">

                <label class="control-label">uid</label>

                <div class="controls">

                    <input type="text" id="u_id" value="<?php echo $user['u_id']; ?>" disabled="true" class="m-wrap span12">

                </div>

            </div>

            <div class="control-group">

                <label class="control-label">用户昵称</label>

                <div class="controls">

                    <input type="text" id="user" value="<?php echo $user['user']; ?>"  class="m-wrap span12">

                </div>

            </div>

            <div class="control-group">

                <label class="control-label">手机号码</label>

                <div class="controls">

                    <input type="text" id="tel" value="<?php echo $user['tel']; ?>"  class="m-wrap span12">

                </div>

            </div>

            <div class="control-group">

                <label class="control-label">资产</label>

                <div class="controls">

                    <input type="text" id="balance" value="<?php echo $user['balance']; ?>"  class="m-wrap span12">

                </div>

            </div>

            <div class="control-group">

                <label class="control-label">积分</label>

                <div class="controls">

                    <input type="text" id="assets" value="<?php echo $user['assets']; ?>"  class="m-wrap span12">

                </div>

            </div>
            
            <div class="control-group">

                <label class="control-label">登录密码</label>

                <div class="controls">

                    <input type="password" id="pass" value=""  class="m-wrap span12">

                </div>

            </div>
            <div class="control-group">

                <label class="control-label">确认登录密码</label>

                <div class="controls">

                    <input type="password" id="pass1" value=""  class="m-wrap span12">

                </div>

            </div>

            <div class="control-group">

                <label class="control-label">支付密码</label>

                <div class="controls">

                    <input type="password" id="pay_pass" value=""  class="m-wrap span12">

                </div>

            </div>
            <div class="control-group">

                <label class="control-label">确认支付密码</label>

                <div class="controls">

                    <input type="password" id="pay_pass1" value=""  class="m-wrap span12">

                </div>

            </div>


            <div class="form-actions">

                <button type="button" class="btn blue" onclick="send()"><i class="icon-ok"></i> 更新</button>


            </div>

        </form>

        <!-- END FORM-->

    </div>

</div>

<script type="text/javascript" src="__static__/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__static__/hui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__static__/hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__static__/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script src="__static__/layer/mobile/layer.js"></script>
<link rel="stylesheet" href="__static__/layer/mobile/need/layer.css">

<script>

    jQuery(document).ready(function() {

        App.init(); // initlayout and core plugins

        Index.init();

        Index.initJQVMAP(); // init index page's custom scripts

        Index.initCalendar(); // init index page's custom scripts

        Index.initCharts(); // init index page's custom scripts

        Index.initChat();

        Index.initMiniCharts();

        Index.initDashboardDaterange();

        Index.initIntro();

    });



    function admin_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }


    function send(){

        if(!(/^1(3|4|5|7|8)\d{9}$/.test($('#tel').val()))){
            alert("手机号码有误，请重填");
        }else{
            $.ajax({
                url: "<?php echo url('index/user/edit_user_p2'); ?>",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    u_id: $('#u_id').val(),
                    user: $('#user').val(),
                    tel: $('#tel').val(),
                    balance: $('#balance').val(),
                    assets: $('#assets').val(),
                    pass: $('#pass').val(),
                    pass1: $('#pass1').val(),
                    pay_pass: $('#pay_pass').val(),
                    pay_pass1: $('#pay_pass1').val()
                },
                success: function (res) {
                    if(res.code == 2) {
                        layer.open({
                            content: res.msg
                            , skin: 'msg'
                            , time: 1
                        });
                    } else if (res.code == 1) {
                        layer.open({
                            content: res.msg
                            , skin: 'msg'
                            , time: 1
                        });
                        setTimeout(function(){window.location.reload()},500);
                    }
                }, fail: function (res) {

                }
            });

        }

    }
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>