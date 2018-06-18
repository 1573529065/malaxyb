<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:102:"E:\phpStudy\PHPTutorial\WWW\hpay_admin\public/../application/index\view\assets\xbaotransfermanage.html";i:1527057298;s:90:"E:\phpStudy\PHPTutorial\WWW\hpay_admin\public/../application/index\view\common\common.html";i:1525511179;}*/ ?>
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

                        信宝转账管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">信宝转账管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                
                <a href="javascript:transferTo();" style="float: left;margin:auto 5px" class="btn blue"><i class="icon-plus"></i>转入</a>
                &nbsp;&nbsp;&nbsp;
                <a href="javascript:turnOut();" style="float: left;margin:auto 5px" class="btn red"><i class="icon-plus"></i>转出</a>
                
				<form action="<?php echo url('index/assets/xbaoTransferManage'); ?>" method='post' style="float:left">
                <select name="record" id="record">
                	<option value="0" <?php if($value == 0): ?>selected<?php endif; ?>>查看所有记录</option>
                	<option value="1" <?php if($value == 1): ?>selected<?php endif; ?>>查看所有转入记录</option>
                	<option value="2" <?php if($value == 2): ?>selected<?php endif; ?>>查看所有转出记录</option>
                </select>
                <input type="submit"  value="确认" class='btn green'/>
                </form>
                <a href="javascript:exportExcel();" style="float: left;margin:auto 5px" class="btn green"><i class="icon-plus"></i>导出excel表格</a>

                






                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>转账列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">
                            <?php if(!$data->isEmpty()){ ?>
                            <thead class="cf">

                            <tr>
                                 <th class="numeric">id</th>
                                <th class="numeric">转账类型</th>
                                <th class="numeric">金额</th>
                                <th class="numeric">时间</th>
                                <th class="numeric">用户id</th>
                               
                                
                                
                            </tr>

                            </thead>
                            <?php } ?>
                            <tbody id="order">
                                <?php if(!$data->isEmpty()){ if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res): $mod = ($i % 2 );++$i;?>
                           <tr>
                                 <th class="numeric"><?php echo $res['t_id']; ?></th>
								<th class="numeric"><?php if($res['type'] == 1): ?>转入<?php else: ?>转出<?php endif; ?></th>
                                <th class="numeric"><?php echo $res['money']; ?></th>
                                <th class="numeric"><?php echo date('Y-m-d H:i:s',$res['time']); ?></th>
                                <th class="numeric"><?php echo $res['u_id']; ?></th>
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

        $('#transfer').hide();
        $('#turnout').hide();
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
    //导出excel表格
    function exportExcel(){
        if($('#order').children().length <= 0){
            layer.msg('暂无数据导出');
        }else{
            window.location.href = '/public/index/assets/xbaoTransferRecordExport/type/'+$('#record').val();
        }
    }
/**
 * [transferTo 信宝转入]
 * @Author    wyc
 * @DateTime  2018-05-22T19:15:54+0800
 * @copyright [copyright]
 * @license   [license]
 * @version   [version]
 * @return    {[type]}                 [description]
 */
function transferTo(){
        layer.open({
                  type: 1,
                  title: '信宝转入',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['400px' , '300px'],
                  content: $('#transfer')
                 });
    layui.use('form',function(){
        var form = layui.form;
        form.verify({  
        //判断是否为负数
        is_fushu:function(value){
            if(value < 0){
                return '不能是负数';
            }
        },
        //100的倍数
        int:function(value){
            if(value % 100 != 0){
                return '只能是100的倍数'
            }
        }
  });  
        form.on('submit',function(data){
             $.ajax({
                    type: "post",
                    url: "<?php echo url('index/assets/xbaoTransferto'); ?>",
                    dataType: "json",
                    data:{
                        'u_id':$('#uid').val(),
                        'money':$('#money').val()
                    },
                    success: function (res) {
                      
                       if(res.code==0){
                            layer.msg(res.msg);
                            $('#uid').focus();
                        }else if(res.code == 1){
                            layer.msg(res.msg);
                            $('#money').focus();
                        }else{
                             setInterval('window.parent.location.reload()',2000);

                                layer.msg('转入成功',{time:1000})
                        }


                    }, fail: function (res) {
                        alert("网络错误");
                    }
                }); 

        })
    })


        
}
   
/**
 * [turnOut 信宝转出]
 * @Author    wyc
 * @DateTime  2018-05-22T19:16:21+0800
 * @copyright [copyright]
 * @license   [license]
 * @version   [version]
 * @return    {[type]}                 [description]
 */
function turnOut(){

        layer.open({
                  type: 1,
                  title: '信宝转出',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['400px' , '300px'],
                  content: $('#turnout')
                 });
    layui.use('form',function(){
        var form = layui.form;
        form.verify({  
        //判断是否为负数
        is_fushu:function(value){
            if(value < 0){
                return '不能是负数';
            }
        },
        //100的倍数
        int:function(value){
            if(value % 100 != 0){
                return '只能是100的倍数'
            }
        }
  });  
        var form = layui.form;
        form.on('submit',function(data){
             $.ajax({
                    type: "post",
                    url: "<?php echo url('index/assets/xbaoTurnOut'); ?>",
                    dataType: "json",
                    data:{
                        'u_id':$('#uid1').val(),
                        'money':$('#money1').val()
                    },
                    success: function (res) {
                      
                       if(res.code==0){
                            layer.msg(res.msg);
                            $('#uid').focus();
                        }else if(res.code == 1){
                            layer.msg(res.msg);
                            $('#money').focus();
                        }else{
                             setInterval('window.parent.location.reload()',2000);

                                layer.msg('转出成功',{time:1000})
                        }


                    }, fail: function (res) {
                        alert("网络错误");
                    }
                }); 

        })
    })

}
  

   
     

      
    
    
    
    
</script>


<!-- END JAVASCRIPTS -->

</body>
<div id = 'transfer'>
<form id= 'form' class = 'layui-form'> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
  <div class="layui-form-item">
    <label class="layui-form-label">用户id</label>
    <div class="layui-input-block">
<input type="text" name="uid" id= 'uid' placeholder="请输入" autocomplete="off" class="layui-input" value='' lay-verify ='required'>
    </div>
  </div>
   <div class="layui-form-item" >
    <label class="layui-form-label">转入资产</label>
    <div class="layui-input-block">
      <input type="text" name="title" id= 'money' placeholder="请输入100的倍数" autocomplete="off" class="layui-input" value='' lay-verify ='required|number|int|is_fushu'>
    </div>
  </div> 
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit=""  type='button'>立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
  <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
</form>
</div>
<div id = 'turnout'>
<form id= 'form1' class = 'layui-form'> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
  <div class="layui-form-item">
    <label class="layui-form-label">用户id</label>
    <div class="layui-input-block">
        <input type="text" name="uid" id= 'uid1' placeholder="请输入" autocomplete="off" class="layui-input" value='' lay-verify ='required'>
    </div>
  </div>
   <div class="layui-form-item" >
    <label class="layui-form-label">转出资产</label>
    <div class="layui-input-block">
      <input type="text" name="title" id= 'money1' placeholder="请输入" autocomplete="off" class="layui-input" value='' lay-verify ='required|number|int|is_fushu'>
    </div>
  </div> 
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" type='button' >立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
  <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
</form>
</div>

<!-- END BODY -->

</html>