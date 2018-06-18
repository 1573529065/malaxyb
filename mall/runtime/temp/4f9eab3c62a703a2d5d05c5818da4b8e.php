<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:82:"/home/wwwroot/default/hpay_admin/public/../application/index/view/index/index.html";i:1525660718;s:84:"/home/wwwroot/default/hpay_admin/public/../application/index/view/common/common.html";i:1525511179;}*/ ?>
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

<body class="page-header-fixed" style="padding-bottom: 5%;">

<!-- BEGIN HEADER -->

<div class="header navbar navbar-inverse navbar-fixed-top">

    <!-- BEGIN TOP NAVIGATION BAR -->

    <div class="navbar-inner">

        <div class="container-fluid">
            <!-- BEGIN LOGO -->

            <a class="brand" href="<?php echo url('index/index/'); ?>">

                <img src="__static__/media/image/logo.png" alt="logo"/>

            </a>

            <!-- END LOGO -->

            <!-- BEGIN RESPONSIVE MENU TOGGLER -->

            <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

                <img src="__static__/media/image/menu-toggler.png" alt="" />

            </a>

            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN TOP NAVIGATION MENU -->

            <ul class="nav pull-right">

                <!-- BEGIN NOTIFICATION DROPDOWN -->


                <!-- BEGIN USER LOGIN DROPDOWN -->

                <li class="dropdown user">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <!--<img alt="" src="__static__/media/image/avatar1_small.jpg" />-->

                        <span class="username"><?php echo $admin['account']?></span>

                        <i class="icon-angle-down"></i>

                    </a>

                    <ul class="dropdown-menu">


                        <li><a href="<?php echo url('index/login/update_pass'); ?>"><i class="icon-lock"></i>修改密码</a></li>

                        <li><a href="<?php echo url('index/login/out_login'); ?>"><i class="icon-key"></i>退出登陆</a></li>

                    </ul>

                </li>

                <!-- END USER LOGIN DROPDOWN -->

            </ul>

            <!-- END TOP NAVIGATION MENU -->

        </div>

    </div>

    <!-- END TOP NAVIGATION BAR -->

</div>

<!-- END HEADER -->

<!-- BEGIN CONTAINER -->

<div class="page-container">

    <!-- BEGIN SIDEBAR -->

    <div class="page-sidebar nav-collapse collapse">

        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu">

            <li>

                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

                <div class="sidebar-toggler hidden-phone"></div>

                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

            </li>

            <li style="margin: 10% 0 0 0;"></li>

            <?php foreach($menu as $v){ ?>
            <li class="start <?php if($fun == $v['me_class']){echo 'active';}?>" >

                <a href="<?php echo url($v['me_url']); ?>">

                    <i class="<?php echo $v['me_ico']?>"></i>

                    <span class="title"><?php echo $v['me_name']; ?></span>

                    <span class="selected"></span>

                </a>

            </li>
            <?php }?>




        </ul>

        <!-- END SIDEBAR MENU -->

    </div>

    <!-- END SIDEBAR -->

    <!-- BEGIN PAGE -->

    <div class="page-content">

        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <div id="portlet-config" class="modal hide">

            <div class="modal-header">

                <button data-dismiss="modal" class="close" type="button"></button>

                <h3>Widget Settings</h3>

            </div>

            <div class="modal-body">

                Widget settings form goes here

            </div>

        </div>

        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <!-- BEGIN PAGE CONTAINER-->

        <div class="container-fluid">

            <!-- BEGIN PAGE HEADER-->

            <div class="row-fluid">

                <div class="span12">

                    <!-- BEGIN STYLE CUSTOMIZER -->

                    <div class="color-panel hidden-phone">


                        <div class="color-mode">

                            <p>THEME COLOR</p>

                            <ul class="inline">

                                <li class="color-black current color-default" data-style="default"></li>

                                <li class="color-blue" data-style="blue"></li>

                                <li class="color-brown" data-style="brown"></li>

                                <li class="color-purple" data-style="purple"></li>

                                <li class="color-grey" data-style="grey"></li>

                                <li class="color-white color-light" data-style="light"></li>

                            </ul>

                            <label>

                                <span>Layout</span>

                                <select class="layout-option m-wrap small">

                                    <option value="fluid" selected>Fluid</option>

                                    <option value="boxed">Boxed</option>

                                </select>

                            </label>

                            <label>

                                <span>Header</span>

                                <select class="header-option m-wrap small">

                                    <option value="fixed" selected>Fixed</option>

                                    <option value="default">Default</option>

                                </select>

                            </label>

                            <label>

                                <span>Sidebar</span>

                                <select class="sidebar-option m-wrap small">

                                    <option value="fixed">Fixed</option>

                                    <option value="default" selected>Default</option>

                                </select>

                            </label>

                            <label>

                                <span>Footer</span>

                                <select class="footer-option m-wrap small">

                                    <option value="fixed">Fixed</option>

                                    <option value="default" selected>Default</option>

                                </select>

                            </label>

                        </div>

                    </div>

                    <!-- END BEGIN STYLE CUSTOMIZER -->

                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->

                    <h3 class="page-title">

                        会员管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">会员管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->

                <div class="row-fluid">

                    <div class="span3 responsive" data-tablet="span6" data-desktop="span3">

                        <div class="dashboard-stat blue">

                            <div class="visual">

                                <i class="icon-comments"></i>

                            </div>

                            <div class="details">

                                <div class="number">

                                    <?php echo $user_today?>

                                </div>

                                <div class="desc">
                                   今日注册会员
                                </div>

                            </div>

                            <a class="more" href="javascript:;" onclick="admin_add('今日注册会员','<?php echo url('index/index/look_html?account='.$user_today); ?>','400','400')" >

                                查看详情 <i class="m-icon-swapright m-icon-white"></i>

                            </a>

                        </div>

                    </div>

                    <div class="span3 responsive" data-tablet="span6" data-desktop="span3">

                        <div class="dashboard-stat green">

                            <div class="visual">

                                <i class="icon-shopping-cart"></i>

                            </div>

                            <div class="details">

                                <div class="number"> <?php echo $user_con?></div>

                                <div class="desc">会员总数</div>

                            </div>

                            <a class="more" href="javascript:;" onclick="admin_add('会员总数','<?php echo url('index/index/look_html_t?account='.$user_today); ?>','400','400')">

                                查看详情 <i class="m-icon-swapright m-icon-white"></i>

                            </a>

                        </div>

                    </div>

                    <div class="span3 responsive" data-tablet="span6  fix-offset" data-desktop="span3">

                        <div class="dashboard-stat purple">

                            <div class="visual">

                                <i class="icon-globe"></i>

                            </div>

                            <div class="details">

                                <div class="number"><?php echo $user_vip ?></div>

                                <div class="desc">vip会员数量</div>

                            </div>

                            <a class="more" href="javascript:;" onclick="admin_add('vip会员','<?php echo url('index/index/look_html_v?account='.$user_today); ?>','400','400')">

                                查看详情<i class="m-icon-swapright m-icon-white"></i>

                            </a>

                        </div>

                    </div>

                </div>


                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                <?php if($admin['type'] != 2){ ?>
                <a href="javascript:;" style="float: left" onclick="admin_add('添加用户','<?php echo url('index/user/add_user'); ?>','400','400')"class="btn blue"><i class="icon-plus"></i>添加用户</a>
                <?php }?>
                <form action="<?php echo url('index/index/select_user'); ?>" method="post">
                    <div class="form-search"  style="float: left;width: 80%;margin-bottom: 1%;" >

                        <div class="chat-form" style="margin: 0 0 0 1%;padding: 0; width: 100%">

                            <div class="input-cont" style="width: 82%;float: left">

                                <input type="text" style="width: 100%;" id="u_id" name="u_id" placeholder="用户id或手机号" class="m-wrap">

                            </div>

                            <div style="float: right;width: 11%;">
                                <button style="width: 100%;" type="submit" class="btn green">搜索 &nbsp; <i class="m-icon-swapright m-icon-white"></i></button>
                            </div>


                        </div>

                    </div>
                </form>


                <a href="javascript:;" style="float: left;margin-left: 3%;" onclick="select_user_all()" class="btn blue"><i class="icon-plus"></i>显示全部</a>


                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>会员列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">

                            <thead class="cf">

                            <tr>

                                <th>用户uid</th>
                                <th class="numeric">用户昵称</th>
                                <th class="numeric">手机号码</th>
                                <th class="numeric">余额</th>
                                <!--<th class="numeric">流通资产</th>-->
                                <th class="numeric">积分</th>
                                <th class="numeric">最上级会员</th>
                                <th class="numeric">上级会员</th>

                                <th class="numeric">会员代级</th>
                                <th class="numeric">是否为VIP会员</th>
                                <!--<th class="numeric">会员等级</th>-->
                                <th class="numeric">注册时间</th>
                                <th class="numeric">上次登陆ip</th>
                                <?php if($admin['type'] != 2){ ?>
                                <th class="numeric">操作</th>
                                <?php }?>
                            </tr>

                            </thead>

                            <tbody id="order">
                            <?php foreach($user as $v ){ ?>
                            <tr style="text-align: center">
                                <td data-title="用户uid"><?php echo $v['u_id']?></td>
                                <!--<td data-title="Company">AUSTRALIAN AGRICULTURAL COMPANY LIMITED.</td>-->
                                <td data-title="用户昵称" class="numeric"><?php echo $v['user']?></td>
                                <td data-title="手机号码" class="numeric"><?php echo $v['tel']?></td>
                                <td data-title="余额" class="numeric"><?php echo $v['balance']?></td>
                                <td data-title="积分" class="numeric"><?php echo $v['assets']?></td>
                                <td data-title="最上级会员" class="numeric"><?php if($v['best_uid'] == 0){ echo '初级会员'; }else{ echo $v['best_uid'];}?></td>
                                <td data-title="上级会员" class="numeric"><?php if($v['f_uid'] == 0){ echo '初级会员'; }else{ echo $v['f_uid'];}?></td>
                                <td data-title="会员代级" class="numeric"><?php if($v['era'] == 0){ echo '初'; }else{ echo '第'.$v['era'];}?>代</td>
                                <td data-title="是否为VIP会员" class="numeric"><?php echo $v['vip_static']==1? '是':'否'?></td>
                                <td data-title="注册时间" class="numeric"><?php echo date('Y-m-d H:i:s', $v['time']) ?></td>
                                <td data-title="上次登陆ip" class="numeric"><?php echo $v['last_ip'] ?></td>
                                <?php if($admin['type'] != 2){ ?>
                                <td data-title="操作" class="numeric">
                                    <div class="btn-group">
                                        <a class="btn green" href="#" data-toggle="dropdown">
                                            <i class="icon-user"></i> 会员管理
                                            <i class="icon-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:;" onclick="admin_add('发送信息','<?php echo url('index/user/send_message?account='.$v['u_id']); ?>','400','400')"><i class="icon-pencil"></i>发送信息</a></li>
                                            <li><a href="javascript:;" onclick="admin_add('发送余额','<?php echo url('index/user/send_money?account='.$v['u_id']); ?>','400','400')"><i class="icon-pencil"></i>发送余额</a></li>
                                            <li><a href="javascript:;" onclick="admin_add('删除用户','<?php echo url('index/user/delete_user?account='.$v['u_id']); ?>','400','400')"><i class="icon-trash"></i>删除用户</a></li>
                                        </ul>
                                    </div>

                                    <div class="btn-group">
                                        <a class="btn purple" href="#" data-toggle="dropdown">
                                            <i class="icon-user"></i> 会员详情
                                            <i class="icon-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:;" onclick="admin_add('下级会员','<?php echo url('index/user/subordinate?account='.$v['u_id']); ?>','400','400')"><i class="icon-plus"></i>查看下级会员</a></li>
                                            <li><a href="javascript:;" onclick="admin_add('余额记录','<?php echo url('index/user/money_order?account='.$v['u_id']); ?>','400','400')"><i class="icon-trash"></i>查看余额记录</a></li>
                                            <li><a href="javascript:;" onclick="admin_add('积分记录','<?php echo url('index/user/assets_order?account='.$v['u_id']); ?>','400','400')"><i class="icon-remove"></i>查看积分记录</a></li>
                                        </ul>
                                    </div>
                                    <?php if($v['status'] == 1){ ?>
                                    <div class="btn-group">
                                        <a class="btn red " href="javascript:;" onclick="dongjie(<?php echo $v['u_id']?>)"  data-toggle="dropdown" >
                                           冻结
                                        </a>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="btn-group">
                                        <a class="btn green" href="javascript:;" onclick="qiyong(<?php echo $v['u_id']?>)"  data-toggle="dropdown" >
                                            启用
                                        </a>
                                    </div>
                                    <?php } if($v['vip_static'] == 1){ ?>
                                    <div class="btn-group">
                                        <a class="btn red " href="javascript:;" onclick="vip2(<?php echo $v['u_id']?>)"  data-toggle="dropdown" >
                                            取消vip
                                        </a>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="btn-group">
                                        <a class="btn green" href="javascript:;" onclick="vip1(<?php echo $v['u_id']?>)"  data-toggle="dropdown" >
                                            升级为vip
                                        </a>
                                    </div>
                                    <?php } ?>


                                </td>
                                <?php }?>
                            </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        <?php echo $user->render(); ?>
                    </div>

                </div>

                <div style="width: 100%;height: 250px;"></div>

            </div>



            <!--<div style="height: 200px;width: 100%;"></div>-->
        </div>

        <!-- END PAGE CONTAINER-->

    </div>

    <!-- END PAGE -->

</div>

<!-- END CONTAINER -->



<!-- BEGIN FOOTER -->

<div class="footer">

    <div class="footer-inner">

        2018 &copy; Metronic by keenthemes.Collect from <a href="" title="" target="_blank"></a> - More Templates <a href="" target="_blank" title=""></a>

    </div>

    <div class="footer-tools">

			<span class="go-top">

			<i class="icon-angle-up"></i>

			</span>

    </div>

</div>

<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src="__static__/media/js/jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="__static__/media/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="__static__/media/js/bootstrap.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>

<script src="__static__/media/js/excanvas.min.js"></script>

<script src="__static__/media/js/respond.min.js"></script>

<![endif]-->

<script src="__static__/media/js/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.blockui.min.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.cookie.min.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.uniform.min.js" type="text/javascript" ></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="__static__/media/js/jquery.vmap.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.vmap.russia.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.vmap.world.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.vmap.europe.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.vmap.germany.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.vmap.usa.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.vmap.sampledata.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.flot.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.flot.resize.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.pulsate.min.js" type="text/javascript"></script>

<script src="__static__/media/js/date.js" type="text/javascript"></script>

<script src="__static__/media/js/daterangepicker.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.gritter.js" type="text/javascript"></script>

<script src="__static__/media/js/fullcalendar.min.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.easy-pie-chart.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery.sparkline.min.js" type="text/javascript"></script>

<!-- END PAGE__static__/ LEVEL PLUGINS -->

<!-- BEGIN PA__static__/GE LEVEL SCRIPTS -->

<script src="__static__/media/js/app.js" type="text/javascript"></script>

<script src="__static__/media/js/index.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->


<script type="text/javascript" src="__static__/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__static__/hui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__static__/hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__static__/hui/static/h-ui.admin/js/H-ui.admin.js"></script>

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

    function select_user(){
        var uid=$('#uid').val();
        if(!uid){
            alert('请填写手机号或uid');
        }else{
            $.ajax({
                url: "<?php echo url('index/index/select_user'); ?>",
                type: 'POST',
                dataType: 'JSON',
                data: {
                    u_id: uid
                },
                success: function (res) {

                    if(res.code==1){
                        $('#order').empty();
                        $('#order').append(res.msg);
                    }else{
                        alert(res.msg);
                    }
                }, fail: function (res) {

                }
            });
        }

    }
    function vip1(uid){
        $.ajax({
            url: "<?php echo url('index/index/user_vip1'); ?>",
            type: 'POST',
            dataType: 'JSON',
            data: {
                u_id: uid
            },
            success: function (res) {
                if(res.code==1){
                    alert(res.msg);
                    setTimeout(function(){window.location.reload()},500);
                }else{
                    alert(res.msg);
                }
            }, fail: function (res) {

            }
        });


    }

    function vip2(uid){
        $.ajax({
            url: "<?php echo url('index/index/user_vip2'); ?>",
            type: 'POST',
            dataType: 'JSON',
            data: {
                u_id: uid
            },
            success: function (res) {
                if(res.code==1){
                    alert(res.msg);
                    setTimeout(function(){window.location.reload()},500);
                }else{
                    alert(res.msg);
                }
            }, fail: function (res) {

            }
        });


    }
    function qiyong(uid){
        $.ajax({
            url: "<?php echo url('index/index/user_status_f'); ?>",
            type: 'POST',
            dataType: 'JSON',
            data: {
                u_id: uid
            },
            success: function (res) {
                if(res.code==1){
                    alert(res.msg);
                    setTimeout(function(){window.location.reload()},500);
                }else{
                    alert(res.msg);
                }
            }, fail: function (res) {

            }
        });


    }


    function select_user_all(){
        setTimeout(function(){window.location.reload() },200);
    }

    function dongjie(uid){
        $.ajax({
            url: "<?php echo url('index/index/user_status_t'); ?>",
            type: 'POST',
            dataType: 'JSON',
            data: {
                u_id: uid
            },
            success: function (res) {
                if(res.code==1){
                    alert(res.msg);
                    setTimeout(function(){window.location.reload()},500);
                }else{
                    alert(res.msg);
                }
            }, fail: function (res) {

            }
        });


    }


</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>