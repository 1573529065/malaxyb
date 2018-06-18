<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:103:"E:\phpStudy\PHPTutorial\WWW\hpay_admin\public/../application/index\view\assets\digitalassetsmanage.html";i:1527064411;s:90:"E:\phpStudy\PHPTutorial\WWW\hpay_admin\public/../application/index\view\common\common.html";i:1525511179;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>众筹管理</title>

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
    <link href="__static__/layui/css/layui.css" rel="stylesheet" type="text/css"/>

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

                        数字资产管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">数字资产管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                 <a href="javascript:exportExcel();" style="float: left;margin:auto 5px" class="btn green"><i class="icon-plus"></i>导出excel表格</a>


                






                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>数字资产列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">
                            <?php if(!$data->isEmpty()){ ?>
                            <thead class="cf">

                            <tr>
                                <th class="numeric">d_id</th>
                                <th class="numeric">u_id</th>
                                <th class="numeric">数字资产</th>
                                <th class="numeric">信宝总资产</th>
                                <th class="numeric">信宝可用资产</th>
                                <th class="numeric">信宝昨日收益</th>
                                <th class="numeric">vip等级</th>
                               
                                
                                
                            </tr>

                            </thead>
                            <?php } ?>
                            <tbody id="order">
                                <?php if(!$data->isEmpty()){ if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <th class="numeric"><?php echo $res['d_id']; ?></th>
                                <th class="numeric"><?php echo $res['u_id']; ?></th>
                                <th class="numeric"><input type="text" value = '<?php echo $res['digital_asset']; ?>' onblur="changeDigitalAssets(this.value,<?php echo $res['d_id']; ?>,<?php echo $res['u_id']; ?>)"></th>
                                <th class="numeric"><input type="text" value = '<?php echo $res['xbao_total_assets']; ?>'  onblur="changeXbaoTotalAssets(this.value,<?php echo $res['d_id']; ?>)"></th>
                                <th class="numeric"><input type="text" value = '<?php echo $res['xbao_available_assets']; ?>'  onblur="changeXbaoAvailableAssets(this.value,<?php echo $res['d_id']; ?>)"></th>
                                <th class="numeric"><?php echo $res['xbao_yesterday_profit']; ?></th>
                               <?php if($res['xbao_vip_grade'] == -1): ?>
                               <th class="numeric">非vip</th>
                               <?php elseif($res['xbao_vip_grade'] == 0): ?>
                               <th class="numeric">v0</th>
                                <?php elseif($res['xbao_vip_grade'] == 1): ?>
                                <th class="numeric">v1</th>
                                <?php elseif($res['xbao_vip_grade'] == 2): ?>
                                <th class="numeric">v2</th>
                                <?php else: ?>
                                <th class="numeric">v3</th>
                                <?php endif; ?>
                                
                            </tr>
                           <?php endforeach; endif; else: echo "" ;endif; }else{ ?>
                           <div>暂无数据</div>
                            <?php } ?>
                            
                            </tbody>

                        </table>
                       <?php echo $data->render(); ?>
                      
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
<script type="text/javascript" src="__static__/layui/layui.js"></script>

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
     function isNumber(value) {         //验证是否为正数
    var patrn = /^\d+(\.\d+)?$/;
    if (patrn.exec(value) == null || value == "") {
        return false;
    } else {
        return true;
    }
}
    /**
     * [changeDigitalAssets 修改数字资产]
     * @Author    wyc
     * @DateTime  2018-05-23T16:01:07+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @return    {[type]}                 [description]
     */
    function changeDigitalAssets(value,d_id,u_id){
        if(!isNumber(value)){
            layer.msg('只能是正数');
            setInterval('location.reload()',2000);
        }else{
            $.ajax({
            url:'<?php echo url("index/assets/changeDigitalAssets"); ?>',
            type:'POST',
            dataType:'json',
            data:{
                digital_asset:value,
                d_id:d_id,
                u_id:u_id
            },
            success:function(res){
                if(res.code == 1){
                    layer.msg('修改成功');
                    setInterval('location.reload()',2000);

                }else{
                      layer.msg('修改失败');
                    setInterval('location.reload()',2000);
                }
            }
        })
        }
        
    }
    /**
     * [changeXbaoTotalAssets 修改数字总资产]
     * @Author    wyc
     * @DateTime  2018-05-23T16:28:26+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @param     {[type]}                 value [description]
     * @param     {[type]}                 d_id  [description]
     * @param     {[type]}                 u_id  [description]
     * @return    {[type]}                       [description]
     */
     function changeXbaoTotalAssets(value,d_id){
        if(!isNumber(value)){
            layer.msg('只能是正数');
            setInterval('location.reload()',2000);
        }else{
            $.ajax({
            url:'<?php echo url("index/assets/changeXbaoTotalAssets"); ?>',
            type:'POST',
            dataType:'json',
            data:{
                digital_asset:value,
                d_id:d_id

            },
            success:function(res){
                if(res.code == 1){
                    layer.msg('修改成功');
                    setInterval('location.reload()',2000);

                }else{
                      layer.msg('修改失败');
                    setInterval('location.reload()',2000);
                }
            }
        })
        }
        
    }
    /**
     * [changeXbaoAvailableAssets 修改信宝可用资产]
     * @Author    wyc
     * @DateTime  2018-05-23T16:31:18+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @param     {[type]}                 value [description]
     * @param     {[type]}                 d_id  [description]
     * @return    {[type]}                       [description]
     */
    function changeXbaoAvailableAssets(value,d_id){
        if(!isNumber(value)){
            layer.msg('只能是正数');
            setInterval('location.reload()',2000);
        }else{
            $.ajax({
            url:'<?php echo url("index/assets/changeXbaoAvailableAssets"); ?>',
            type:'POST',
            dataType:'json',
            data:{
                digital_asset:value,
                d_id:d_id

            },
            success:function(res){
                if(res.code == 1){
                    layer.msg('修改成功');
                    setInterval('location.reload()',2000);

                }else{
                      layer.msg('修改失败');
                    setInterval('location.reload()',2000);
                }
            }
        })
        }
    }

 //导出excel表格
    function exportExcel(){
        if($('#order').children().length <=0){
            layer.msg('暂无数据导出');
        }else{
             window.location.href = '/public/index/assets/digitalAssetsExport';
        }
                   
    }
    

   
     

      
    
    
    
    
</script>


<!-- END JAVASCRIPTS -->

</body>


<!-- END BODY -->

</html>