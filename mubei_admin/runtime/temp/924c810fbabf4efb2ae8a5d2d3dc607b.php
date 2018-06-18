<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:99:"D:\phpStudy\PHPTutorial\WWW\malaxyb\mubei_admin\public/../application/index\view\menu\quanxian.html";i:1525949356;s:99:"D:\phpStudy\PHPTutorial\WWW\malaxyb\mubei_admin\public/../application/index\view\common\common.html";i:1525949356;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>分配权限</title>

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
    <style>
        #overlay {  background: #000;  display: none;  filter: alpha(opacity=50); /* IE的透明度 */  opacity: 0.5;  /* 透明度 */  position: absolute;  top: 0;  left: 0;  width: 100%;  height: 100%;  z-index: 100; /* 此处的图层要大于页面 */  }
        .alert{ padding: 0; width:310px;  position:absolute;  top:-40%;  left:50%;  margin: -101px 0 0 -151px; border: 1px solid #e5e5e5;border-radius: 4px; z-index: 101;}
        .alert .alert_h2{  padding: 0 0 0 8px; margin:0;font-size:14px;  background:#ffffff;  text-align:left;color:#000 ;  border-bottom: 1px solid #e5e5e5;position: relative}
        .alert .top_alert{  position: absolute;right: 5px;top:0;text-decoration:none;font-size: 26px;color: #cccccc;}
        .alert .alert_con{  background:#fff; }
        .alert .alert_con p{  color:#000;  line-height:30px; margin-bottom:0;}
        .alert .alert_con #ds{  text-align: center }
        .alert .alert_con #ts{   padding-left:8px; border-bottom: 1px solid #e5e5e5;}
        .alert .alert_con .btn_alert{
            width: 80%; padding:3px 10px;  color:#fff;  cursor:pointer;  background:#72D1FF;  border:1px solid #72D1FF;  border-radius:4px;  text-decoration:none;}
        .alert .alert_con .btn_alert:hover{  background:#4FB2EF;  border:1px solid #4FB2EF;  border-radius:4px; text-decoration:none; }
    </style>

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

                        分配权限

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="javascript:;">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">分配权限</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>



                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>分配权限</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">

                            <thead class="cf">

                            <tr>

                                <th class="numeric">管理员级别</th>
                                <th class="numeric">操作</th>

                            </tr>

                            </thead>

                            <tbody id="order">
                            <tr style="text-align: center">
                                <!--<td data-title="Company">AUSTRALIAN AGRICULTURAL COMPANY LIMITED.</td>-->
                                <td data-title="管理员级别" class="numeric">普通管理员</td>

                                <td data-title="最后登陆IP" class="numeric" style="padding: 10px 0 0 0 ;">
                                    <div class="btn-group" >
                                        <a class="btn green" href="javascript:;" onclick="jur()" data-toggle="dropdown">
                                            分配权限
                                        </a>
                                    </div>
                                </td>

                            </tr>

                            </tbody>

                        </table>
                    </div>

                </div>

                <div id="overlay"></div>
                <div class="alert" id="alert" style="display:none">
                    <form action="<?php echo url('index/menu/jur_edit'); ?>" method="post" name="level" style="margin: 0;">
                        <h2 class="alert_h2">分配</h2>
                        <a href="javascript:;" class="top_alert" onclick="removealet()">&#215;</a>
                        <div class="alert_con">
                            <p id="ts" style="padding-top: 20px;">
                                <?php foreach($menu as $v){ ?>
                                <label style="line-height:18px;font-size: 16px;text-align: center">
                                    <?php if($v['me_level']>=2){ ?>
                                    <input style="margin: 0;" checked="checked"
                                           name="<?php echo $v['me_id']?>" type='checkbox'
                                           value="<?php echo $v['me_id']?>"  /><?php echo $v['me_name']; ?></label>
                                    <?php }else{ ?>
                                    <input style="margin: 0;"
                                            name="<?php echo $v['me_id']?>" type='checkbox'
                                           value="<?php echo $v['me_id']?>"  /><?php echo $v['me_name']; ?></label>
                                    <?php }}?>

                            </p>
                            <p id="ds" style="line-height:70px">
                                <input type="submit" id="dss" style="line-height: 30px;" class="btn_alert" value="确定"/>
                            </p>

                        </div>
                    </form>

                </div>
                <script type="text/javascript">
                    function is_hide(){ $(".alert").animate({"top":"-75%"}, 300) }
                    function is_show(){ $(".alert").show().animate({"top":"25%"}, 300) }
                    function xiao(){
                        $(document).mouseup(function(e){
                            var _con = $('#alert');   // 设置目标区域
                            if(!_con.is(e.target) && _con.has(e.target).length === 0){
                                is_hide();hideOverlay()
                            }
                        });
                    }
                    function showOverlay() {
                        $("#overlay").height(pageHeight());
                        $("#overlay").width(pageWidth());
                        $("#overlay").fadeTo(200, 0.5);
                    }
                    /* 隐藏覆盖层 */
                    function hideOverlay() {
                        $("#overlay").fadeOut(200);
                    }
                    /* 当前页面高度 */
                    function pageHeight() {
                        return document.body.scrollHeight;
                    }
                    /* 当前页面宽度 */
                    function pageWidth() {
                        return document.body.scrollWidth;
                    }
                    function alert(){
                        showOverlay();
                        is_show();
                        xiao();
                    }

                    function removealet(){
                        is_hide();hideOverlay();
                    }
                    function jur(){
                        alert();
                    }


                </script>
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