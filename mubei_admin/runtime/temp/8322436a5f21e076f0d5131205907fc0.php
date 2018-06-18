<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:96:"D:\phpStudy\PHPTutorial\WWW\malaxyb\mubei_admin\public/../application/index\view\menu\admin.html";i:1525949356;s:99:"D:\phpStudy\PHPTutorial\WWW\malaxyb\mubei_admin\public/../application/index\view\common\common.html";i:1525949356;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>管理员管理</title>

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

                        管理员管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="javascript:;">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">管理员管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                <a href="javascript:;" style="float: left" onclick="admin_add('添加管理员','<?php echo url('index/user/add_admin'); ?>','400','400')"class="btn blue">
                    <i class="icon-plus"></i>添加管理员</a>





                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>管理员列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">

                            <thead class="cf">

                            <tr>

                                <th>管理用户名</th>
                                <th class="numeric">管理员级别</th>
                                <th class="numeric">添加时间</th>
                                <th class="numeric">最后登陆IP</th>
                                <th class="numeric">城市</th>
                                <th class="numeric">操作系统</th>
                                <th class="numeric">操作</th>

                            </tr>

                            </thead>

                            <tbody id="order">
                            <?php foreach($user as $v ){ ?>
                            <tr style="text-align: center">
                                <td data-title="管理用户名"><?php echo $v['account']?></td>
                                <!--<td data-title="Company">AUSTRALIAN AGRICULTURAL COMPANY LIMITED.</td>-->
                                <td data-title="管理员级别" class="numeric">普通管理员</td>

                                <td data-title="添加时间" class="numeric"><?php echo date('Y-m-d H:i:s', $v['time']) ?></td>
                                <td data-title="最后登陆IP" class="numeric"><?php echo $v['ip'] ?></td>
                                <td data-title="城市" class="numeric"><?php echo $v['city'] ?></td>
                                <td data-title="操作系统" class="numeric"><?php echo $v['system'] ?></td>
                                <td data-title="操作" class="numeric">
                                    <div class="btn-group">
                                        <a class="btn green" href="#" data-toggle="dropdown">
                                            <i class="icon-user"></i> 管理员管理
                                            <i class="icon-angle-down"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="javascript:;" onclick="admin_add('修改密码','<?php echo url('index/user/change_pass?account='.$v['account']); ?>','400','400')">
                                                <i class="icon-pencil"></i>修改密码</a></li>
                                            <li><a href="javascript:;" onclick="delete_n(<?php echo $v['a_id']?>)">
                                                <i class="icon-trash"></i>删除管理员</a></li>
                                        </ul>
                                    </div>


                                    <?php if($v['status'] == 1){ ?>
                                    <div class="btn-group">
                                        <a class="btn red " href="javascript:;" onclick="dongjie(<?php echo $v['a_id']?>)"  data-toggle="dropdown" >
                                           冻结
                                        </a>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="btn-group">
                                        <a class="btn green" href="javascript:;" onclick="qiyong(<?php echo $v['a_id']?>)"  data-toggle="dropdown" >
                                            启用
                                        </a>
                                    </div>
                                    <?php } if($v['type'] != 2){ ?>
                                    <div class="btn-group">
                                        <a class="btn red " href="javascript:;" onclick="dongjie1(<?php echo $v['a_id']?>)"  data-toggle="dropdown" >
                                            取消操作权限
                                        </a>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="btn-group">
                                        <a class="btn green" href="javascript:;" onclick="qiyong1(<?php echo $v['a_id']?>)"  data-toggle="dropdown" >
                                            启用操作权限
                                        </a>
                                    </div>
                                    <?php } ?>




                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                        <?php echo $user->render(); ?>
                    </div>

                </div>
                <div id="myModal1" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="false" style="display: none;height: 200px;">

                    <div class="modal-header">

                        <button type="button" class="close" onclick="delete_t()" data-dismiss="modal" aria-hidden="true"></button>

                        <h3 id="myModalLabel1">提示</h3>

                    </div>

                    <div class="modal-body">

                        <p>确认删除此管理员？</p>

                    </div>

                    <div class="modal-footer">

                        <button class="btn" id="nonot" data-dismiss="modal" onclick="delete_t()" aria-hidden="true">取消</button>

                        <button class="btn yellow" id="yes">确定</button>

                    </div>

                </div>


                <div style="width: 100%;height: 500px;"></div>

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




    function delete_t(){
        $('#myModal1').toggle("fast");
    }
    function delete_n(nid){
        $('#myModal1').toggle("fast");
        $('#yes').click(function(){
            $.ajax({
                type: "post",
                url: "<?php echo url('index/menu/delete_admin'); ?>",
                dataType: "json",
                data: {
                    aid:nid
                },
                success: function (res) {
                    if(res.code == 2) {
                        alert(res.msg);
                    } else if (res.code == 1) {
                        alert(res.msg);
                        setTimeout(function(){window.location.reload()},500);
                    }
                }, fail: function (res) {
                    alert("网络错误");
                }
            });
        });

    }

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

    function dongjie(uid){
        $.ajax({
            url: "<?php echo url('index/index/user_status_tt'); ?>",
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
            url: "<?php echo url('index/index/user_status_ff'); ?>",
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



    function dongjie1(uid){
        $.ajax({
            url: "<?php echo url('index/index/user_status_ttt'); ?>",
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

    function qiyong1(uid){
        $.ajax({
            url: "<?php echo url('index/index/user_status_fff'); ?>",
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




</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>