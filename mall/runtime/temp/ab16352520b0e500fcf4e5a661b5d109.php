<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/home/wwwroot/default/hpay_admin/public/../application/index/view/menu/feedback.html";i:1525511180;s:84:"/home/wwwroot/default/hpay_admin/public/../application/index/view/common/common.html";i:1525511179;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>反馈建议</title>

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

                    反馈建议

                </h3>

                <ul class="breadcrumb">

                    <li>

                        <i class="icon-home"></i>

                        <a href="javascript:;">首页</a>

                        <i class="icon-angle-right"></i>

                    </li>

                    <li><a href="javascript:;">反馈建议</a></li>


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

                <!--<div class="input-cont">-->

                <!--<input class="m-wrap" type="text" placeholder="搜索会员">-->

                <!--</div>-->

                <!--<div class="btn-cont">-->

                <!--<span class="arrow"></span>-->

                <!--<a href="javascript:;" class="btn blue icn-only"><i class="icon-ok icon-white"></i></a>-->

                <!--</div>-->

            </div>
            <div class="clearfix"></div>
            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-cogs"></i>反馈建议</div>


                </div>

                <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                    <table class="table-bordered table-striped table-condensed cf">

                        <thead class="cf">

                        <tr>
                            <th>用户uid</th>
                            <th class="numeric">反馈内容</th>
                            <th class="numeric">时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($order as $vo ){ ?>
                        <tr style="text-align: center">
                            <td data-title="公告标题"><?php echo $vo['u_id']?></td>
                            <td data-title="公告内容"><?php echo $vo['f_text']?></td>
                            <td data-title="时间" class="numeric"><?php echo date('Y-m-d H:i:s', $vo['time']) ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>

                    </table>
                    <?php echo $order->render(); ?>
                </div>

            </div>
            <!--<a href="#myModal1" role="button" class="btn btn-primary" data-toggle="modal">Modal Dialog</a>-->
            <div style="width: 100%;height: 450px;"></div>




        </div>



        <!--<div style="height: 200px;width: 100%;"></div>-->
    </div>

    <!-- END PAGE CONTAINER-->

</div>

<!-- END PAGE -->

</div>

<!-- END CONTAINER -->
<div id="overlay"></div>


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
<!--<script src="__static__/layer/mobile/layer.js"></script>-->

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


    function notice_add(){
        $("#form-admin-add").toggle("fast");
    }

    function admin_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }

    $('#nonot').click(function(){
        $('#myModal1').toggle("fast");
        hideOverlay();
    });



    function delete_n(nid){
        showOverlay();
        $('#myModal1').toggle("fast");
        $('#yes').click(function(){
            $.ajax({
                type: "post",
                url: "<?php echo url('index/menu/noticeManage_y'); ?>",
                dataType: "json",
                data: {
                    nid:nid
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
                    alert("网络错误");
                }
            });
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

    function send() {
        var title = document.getElementById('title').value;
        var content = document.getElementById('content').value;
        $.ajax({
            type: "post",
            url: "<?php echo url('index/menu/noticeManage_c'); ?>",
            dataType: "json",
            data: {
                title:title,
                content: content
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
                alert("网络错误");
            }
        });
    }
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>