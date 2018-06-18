<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"D:\phpStudy\WWW\new_vpay_admin\public/../application/index\view\menu\config.html";i:1523783369;s:82:"D:\phpStudy\WWW\new_vpay_admin\public/../application/index\view\common\common.html";i:1523783187;}*/ ?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>参数配置</title>

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

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->

    <link rel="stylesheet" type="text/css" href="__static__/media/css/bootstrap-fileupload.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/jquery.gritter.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/chosen.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/select2_metro.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/jquery.tagsinput.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/clockface.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/bootstrap-wysihtml5.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/datepicker.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/timepicker.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/colorpicker.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/bootstrap-toggle-buttons.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/daterangepicker.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/datetimepicker.css" />

    <link rel="stylesheet" type="text/css" href="__static__/media/css/multi-select-metro.css" />

    <link href="__static__/media/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>

    <!-- END PAGE LEVEL STYLES -->

    <link rel="shortcut icon" href="__static__/media/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

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



            <li class="start <?php if($fun == 'index'){echo 'active';}?>" style="margin: 10% 0 0 0;">

                <a href="<?php echo url('index/index/index'); ?>">

                    <i class="icon-home"></i>

                    <span class="title">会员管理</span>

                    <span class="selected"></span>

                </a>

            </li>
            <li class="start <?php if($fun == 'card'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/card'); ?>">

                    <i class="icon-sitemap"></i>

                    <span class="title">用户银行卡</span>

                    <span class="selected"></span>

                </a>

            </li>
            <li class="start <?php if($fun == 'add_card'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/add_card'); ?>">

                    <i class="icon-sitemap"></i>

                    <span class="title">添加银行</span>

                    <span class="selected"></span>

                </a>

            </li>

            <!--<li class="start <?php if($fun == 'dizhi'){echo 'active';}?>" >-->

                <!--<a href="<?php echo url('index/menu/dizhi'); ?>">-->

                    <!--<i class="icon-sitemap"></i>-->

                    <!--<span class="title">用户地址</span>-->

                    <!--<span class="selected"></span>-->

                <!--</a>-->

            <!--</li>-->

            <!--<li class="start <?php if($fun == 'shop'){echo 'active';}?>" >-->

                <!--<a href="<?php echo url('index/menu/shop'); ?>">-->

                    <!--<i class="icon-sitemap"></i>-->

                    <!--<span class="title">资讯管理</span>-->

                    <!--<span class="selected"></span>-->

                <!--</a>-->

            <!--</li>-->
            <li class="start <?php if($fun == 'user_money_order'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/user_money_order'); ?>">

                    <i class="icon-table"></i>

                    <span class="title">用户余额记录</span>

                    <span class="selected"></span>

                </a>

            </li>

            <!--<li class="start <?php if($fun == 'user_score_order'){echo 'active';}?>" >-->

                <!--<a href="<?php echo url('index/menu/user_score_order'); ?>">-->

                    <!--<i class="icon-table"></i>-->

                    <!--<span class="title">用户流通记录</span>-->

                    <!--<span class="selected"></span>-->

                <!--</a>-->

            <!--</li>-->
            <li class="start <?php if($fun == 'user_assets_order'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/user_assets_order'); ?>">

                    <i class="icon-table"></i>

                    <span class="title">用户积分记录</span>

                    <span class="selected"></span>

                </a>

            </li>


            <li class="start <?php if($fun == 'sell'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/sell'); ?>">

                    <i class="icon-folder-open"></i>

                    <span class="title">卖出挂单</span>

                    <span class="selected"></span>

                </a>

            </li>


            <li class="start <?php if($fun == 'purshare'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/purshare'); ?>">

                    <i class="icon-dollar"></i>

                    <span class="title">买入挂单</span>

                    <span class="selected"></span>

                </a>

            </li>

            <!--<li class="start <?php if($fun == 'share'){echo 'active';}?>" >-->

                <!--<a href="<?php echo url('index/menu/share'); ?>">-->

                    <!--<i class="icon-youtube-play"></i>-->

                    <!--<span class="title">分享记录</span>-->

                    <!--<span class="selected"></span>-->

                <!--</a>-->

            <!--</li>-->

            <li class="start  <?php if($fun == 'noticemanage'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/noticemanage'); ?>">

                    <i class=" icon-trello"></i>

                    <span class="title">发布公告</span>

                    <span class="selected"></span>

                </a>

            </li>


            <li class="start <?php if($fun == 'feedback'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/feedback'); ?>">

                    <i class="icon-stackexchange"></i>

                    <span class="title">投诉建议</span>

                    <span class="selected"></span>

                </a>

            </li>


            <li class="start <?php if($fun == 'message'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/message'); ?>">

                    <i class="icon-file"></i>

                    <span class="title">消息记录</span>

                    <span class="selected"></span>

                </a>

            </li>
            <li class="start <?php if($fun == 'config'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/config'); ?>">

                    <i class="icon-cogs"></i>

                    <span class="title">参数配置</span>

                    <span class="selected"></span>

                </a>

            </li>

            <li class="start <?php if($fun == 'about'){echo 'active';}?>" >

                <a href="<?php echo url('index/menu/about'); ?>">

                    <i class="icon-cogs"></i>

                    <span class="title">编辑关于</span>

                    <span class="selected"></span>

                </a>

            </li>




        </ul>

        <!-- END SIDEBAR MENU -->

    </div>
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

                    参数配置

                </h3>

                <ul class="breadcrumb">

                    <li>

                        <i class="icon-home"></i>

                        <a href="javascript:;">首页</a>

                        <i class="icon-angle-right"></i>

                    </li>

                    <li><a href="javascript:;">参数配置</a></li>


                </ul>

                <!-- END PAGE TITLE & BREADCRUMB-->

            </div>

        </div>

        <!-- END PAGE HEADER-->

        <div id="dashboard">

            <!-- BEGIN DASHBOARD STATS -->



            <!-- END DASHBOARD STATS -->

            <div class="clearfix"></div>


            <div class="portlet box blue">

                <div class="portlet-title">

                    <div class="caption"><i class="icon-reorder"></i>参数配置</div>


                </div>


                <div class="portlet-body form">

                    <!-- BEGIN FORM-->

                    <form action="#" class="form-horizontal">

                        <div class="control-group">

                            <label class="control-label"><?php echo $config1['co_name']?></label>

                            <div class="controls">

                                <input type="number" id="target<?php echo $config1['co_id']?>" onchange="check(<?php echo $config1['co_id']?>)" placeholder="medium" value="<?php echo $config1['co_config']?>" class="m-wrap medium">

                                <span class="help-inline">单位:百分比</span>

                            </div>

                        </div>
                        <div class="control-group">

                            <label class="control-label"><?php echo $config2['co_name']?></label>

                            <div class="controls">

                                <input type="number" id="target<?php echo $config2['co_id']?>" onchange="check(<?php echo $config2['co_id']?>)"  placeholder="medium" value="<?php echo $config2['co_config']?>" class="m-wrap medium">

                                <span class="help-inline">单位:百分比</span>

                            </div>

                        </div>
                        <div class="control-group">

                            <label class="control-label"><?php echo $config3['co_name']?></label>

                            <div class="controls">

                                <input type="number" id="target<?php echo $config3['co_id']?>" onchange="check(<?php echo $config3['co_id']?>)"  placeholder="medium" value="<?php echo $config3['co_config']?>" class="m-wrap medium">

                                <span class="help-inline">单位:百分比</span>

                            </div>

                        </div>



                        <div class="control-group">

                            <label class="control-label"><?php echo $config4['co_name']?></label>

                            <div class="controls">

                                <input type="number" id="target<?php echo $config4['co_id']?>" onchange="check(<?php echo $config4['co_id']?>)" placeholder="medium" value="<?php echo $config4['co_config']?>" class="m-wrap medium">

                                <span class="help-inline">单位:百分比</span>

                            </div>

                        </div>


                        <div class="control-group">

                            <label class="control-label"><?php echo $config5['co_name']?></label>


                            <div class="controls">

                                <input type="number" id="target<?php echo $config5['co_id']?>" onchange="check1(<?php echo $config5['co_id']?>)" placeholder="medium" value="<?php echo $config5['co_config']?>" class="m-wrap medium">

                                <span class="help-inline">单位:百分比</span>

                            </div>
                        </div>



                        <div class="control-group">

                            <label class="control-label"><?php echo $config6['co_name']?></label>

                            <div class="controls">

                                <div class="input-append bootstrap-timepicker-component">

                                    <input disabled="true" id="target<?php echo $config6['co_id']?>" onchange="check(<?php echo $config6['co_id']?>)" class="m-wrap m-ctrl-small timepicker-24" placeholder="<?php echo date('H:i:s',$config6['co_config'])?>" type="text">

                                    <span class="add-on"><i class="icon-time"></i></span>

                                </div>

                            </div>

                        </div>

                        <div class="control-group">

                            <label class="control-label"><?php echo $config7['co_name']?></label>

                            <div class="controls">

                                <input type="number" id="target<?php echo $config7['co_id']?>" onchange="check(<?php echo $config7['co_id']?>)" placeholder="medium" value="<?php echo $config7['co_config']?>" class="m-wrap medium">

                                <span class="help-inline">单位:千分比</span>

                            </div>

                        </div>







                        <div class="form-actions">

                            <button type="button" onclick="ticket()" class="btn blue">确认修改</button>


                        </div>

                    </form>

                    <!-- END FORM-->

                </div>

            </div>
            <div class="clearfix"></div>


            <div style="width: 100%;height: 450px;"></div>

        </div>



        <!--<div style="height: 200px;width: 100%;"></div>-->
    </div>

    <!-- END PAGE CONTAINER-->

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

<script type="text/javascript" src="__static__/media/js/ckeditor.js"></script>

<script type="text/javascript" src="__static__/media/js/bootstrap-fileupload.js"></script>

<script type="text/javascript" src="__static__/media/js/chosen.jquery.min.js"></script>

<script type="text/javascript" src="__static__/media/js/select2.min.js"></script>

<script type="text/javascript" src="__static__/media/js/wysihtml5-0.3.0.js"></script>

<script type="text/javascript" src="__static__/media/js/bootstrap-wysihtml5.js"></script>

<script type="text/javascript" src="__static__/media/js/jquery.tagsinput.min.js"></script>

<script type="text/javascript" src="__static__/media/js/jquery.toggle.buttons.js"></script>

<script type="text/javascript" src="__static__/media/js/bootstrap-datepicker.js"></script>

<script type="text/javascript" src="__static__/media/js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript" src="__static__/media/js/clockface.js"></script>

<script type="text/javascript" src="__static__/media/js/date.js"></script>

<script type="text/javascript" src="__static__/media/js/daterangepicker.js"></script>

<script type="text/javascript" src="__static__/media/js/bootstrap-colorpicker.js"></script>

<script type="text/javascript" src="__static__/media/js/bootstrap-timepicker.js"></script>

<script type="text/javascript" src="__static__/media/js/jquery.inputmask.bundle.min.js"></script>

<script type="text/javascript" src="__static__/media/js/jquery.input-ip-address-control-1.0.min.js"></script>

<script type="text/javascript" src="__static__/media/js/jquery.multi-select.js"></script>

<script src="__static__/media/js/bootstrap-modal.js" type="text/javascript" ></script>

<script src="__static__/media/js/bootstrap-modalmanager.js" type="text/javascript" ></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="__static__/media/js/app.js"></script>

<script src="__static__/media/js/form-components.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script>

    jQuery(document).ready(function() {

        // initiate layout and plugins

        App.init();

        FormComponents.init();

    });


    var target_data=new Array();
    function check(id){
        var money=$("#target"+id).val();

        if(money > 10){
            alert('不可大于10');
        }else{
            if(money == ''){
                money=0;
            }
            var data_in=ifArrVal(target_data,id);
            if(target_data.length > 0 && isArray(data_in)==true ){
                for(var i = 0;i < target_data.length;i++){
                    if(target_data[i][1] == id){
                        target_data[i][0]=money;
                    }
                }
            }else if(target_data.length > 0 && data_in == 1){
                addArray(money,id);
            }else if(target_data.length == 0 ){
                addArray(money,id);
            }
        }


    }

    function check1(id){
        var money=$("#target"+id).val();

        if(money % 100 != 0){
            alert('必须为100的整数倍');
        }else{
            if(money == ''){
                money=0;
            }
            var data_in=ifArrVal(target_data,id);
            if(target_data.length > 0 && isArray(data_in)==true ){
                for(var i = 0;i < target_data.length;i++){
                    if(target_data[i][1] == id){
                        target_data[i][0]=money;
                    }
                }
            }else if(target_data.length > 0 && data_in == 1){
                addArray(money,id);
            }else if(target_data.length == 0 ){
                addArray(money,id);
            }
        }


//        }else if(money == ''){
//
//        }
    }
    function ticket(){
        var data_json=tojson(target_data);
        console.log(data_json);
        $.ajax({
            url: "<?php echo url('index/menu/change_config'); ?>",
            type: 'POST',
            dataType: 'JSON',
            data: {
                data: data_json
            },
            success: function (res) {
                console.log(data_json);
                if(res.code == 1) {
                    alert('修改成功');
                    setTimeout(function(){window.location.reload()},500);
                }
            }
        });

    }
    function tojson(arr){
        if(!arr.length) return null;
        var i = 0;
        len = arr.length,
                array = [];
        for(;i<len;i++){
            array.push({"config":arr[i][0],"cid":arr[i][1]});
        }
        return JSON.stringify(array);
    }

    function addArray(money,id){
        var target=new Array();
        target[0]=money;
        target[1]=id;
        target_data.push(target);
    }

    function ifArrVal(arr,value){
        var num = 0;
        var id=new Array();
        for(var i = 0;i < arr.length;i++){
            if(arr[i][1] != value){
                num+=1;
            }else if(arr[i][1] == value){
                id.push(i);
            }
        }
        if(arr.length == num){
            return 1;
        }else{
            return id;
        }
    }

    function isArray(o){
        return Object.prototype.toString.call(o)=='[object Array]';
    }

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>