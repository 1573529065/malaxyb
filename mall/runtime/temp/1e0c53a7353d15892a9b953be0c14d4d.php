<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:92:"E:\phpStudy\PHPTutorial\WWW\hpay_admin\public/../application/index\view\user\send_money.html";i:1525949321;}*/ ?>
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

        <div class="caption"><i class="icon-reorder"></i>发送资产</div>
    </div>

    <div class="portlet-body form">

        <!-- BEGIN FORM-->

        <form action="#" class="form-horizontal form-bordered form-row-stripped">

            <div class="control-group">

                <label class="control-label">会员uid</label>

                <div class="controls">

                    <input type="text" id="uid" value="<?php echo $user['u_id']?>" disabled="true" class="m-wrap span12">

                </div>

            </div>



            <div class="control-group">

                <label class="control-label">当前资产</label>

                <div class="controls">

                    <input type="text" value="<?php echo $user['balance']?>" disabled="true" class="m-wrap span12">

                </div>

            </div>



            <div class="control-group">

                <label class="control-label">当前积分</label>

                <div class="controls">

                    <input type="text" value="<?php echo $user['assets']?>" disabled="true" class="m-wrap span12">

                </div>

            </div>

            <div class="control-group">

                <label class="control-label">请选择发送类型</label>

                <div class="controls">

                    <select data-placeholder="Your Favorite Type of Bear" class="chosen-with-diselect span6" tabindex="-1" id="selCSI">


                        <option value="1">资产</option>

                        <option value="3">积分</option>


                    </select>

                </div>

            </div>

            <div class="control-group">

                <label class="control-label">发送</label>

                <div class="controls">

                    <input type="number" placeholder="请输入资产" class="m-wrap span12" id="money">

                </div>

            </div>

            <div class="form-actions">

                <button type="button" class="btn blue" onclick="send()"><i class="icon-ok"></i> 发送</button>

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
        if(!$('#money').val()){
            layer.open({
                content: '请填写金额'
                , skin: 'msg'
                , time: 1
            });
        }else{
            $.ajax({
                url: "<?php echo url('index/user/change_money'); ?>",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    money: $('#money').val(),
                    u_id: $('#uid').val(),
                    type: $("#selCSI option:checked").val()
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