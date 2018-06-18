<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"E:\phpStudy\PHPTutorial\WWW\mall\public/../application/index\view\goodsclassify\index.html";i:1527217613;s:84:"E:\phpStudy\PHPTutorial\WWW\mall\public/../application/index\view\common\common.html";i:1527572840;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>商品分类管理</title>

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
            <li class="start <?php if($fun == $v['me_url']){echo 'active';}?>" >

                <a href="/public/<?php echo $v['me_url']; ?>">

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

                        商品分类管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">商品分类管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                
                <a href="javascript:add_classify();" style="float: left" class="btn blue"><i class="icon-plus"></i>添加商品分类</a>
                






                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>分类列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">

                            <thead class="cf">

                            <tr>

                                <th class="numeric">分类id</th>
                                <th class="numeric">分类名字</th>
                                <th class="numeric">状态</th>
                                <th class="numeric">添加时间</th>

                                
                                <th class="numeric">操作</th>
                                
                            </tr>

                            </thead>

                            <tbody id="order">
                            <?php if(is_array($class) || $class instanceof \think\Collection || $class instanceof \think\Paginator): $key = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($key % 2 );++$key;?>
                            <tr style="text-align: center">
                                <td data-title="分类id"><?php echo $data['classify_id']; ?></td>
                                <td data-title="分类名字"><?php echo $data['name']; ?></td>
                                
                                <td data-title="状态" class="numeric">
                                   
                                    <button class="<?php if($data['status'] == 1): ?>layui-btn<?php else: ?>layui-btn layui-btn-danger<?php endif; ?>" id = 'btn<?php echo $key; ?>' onclick = 'changestatus(<?php echo $data['classify_id']; ?>,<?php echo $key; ?>)'><?php if($data['status'] == 1): ?>已启用<?php else: ?>已禁用<?php endif; ?></button>
                                    
                                    
                                </td>                                                             
                                <td data-title="添加时间" class="numeric"><?php echo date('Y-m-d H:i:s',$data['add_time']); ?></td>

                                
                                
                                <td data-title="操作" class="numeric">
                                    <div class="btn-group">
                                        <a class="btn green" href="javascript:update_classify(<?php echo $data['classify_id']; ?>,'<?php echo $data['name']; ?>')" >
                                            <i class="icon-user"></i> 修改                                          
                                        </a>                                      
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn purple" href="javascript:del_crowd(<?php echo $data['classify_id']; ?>)">
                                            <i class="icon-user"></i> 删除                                           
                                        </a>                                      
                                    </div>
                                    


                                </td>
                                
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            </tbody>

                        </table>
                       <?php echo $class->render(); ?>
                      
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

    	$('#hide').hide();
        $('#hide1').hide();
        $('#table').hide();
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

    //删除商品分类
  	function del_crowd(cf_id){
  		layer.confirm('是否确认删除该商品分类？', {
		  btn: ['确认', '取消'] //可以无限个按钮
		  ,yes: function(index, layero){
		    $.ajax({
                type: "post",
                url: "<?php echo url('index/goodsClassify/delGoodsClassify'); ?>",
                dataType: "json",
                data: {
                    cf_id:cf_id,
                },
                success: function (res) {
                    if(res.code == 1) {
                    	layer.msg('删除成功',{time:2000})
                    	setInterval("window.location.reload()",2000);
                    }else{
                    	layer.msg('删除失败',{time:2000});
                    	setInterval("window.location.reload()",2000);
                      
                    }
                }, fail: function (res) {
                    alert("网络错误");
                }
            });
		  }
		}, function(index, layero){
		  //按钮【按钮一】的回调
		}, function(index){
		  //按钮【按钮二】的回调
		});
  	}
    
    /**
     * [timestampToTime 时间戳转时间]
     * @Author    wyc
     * @DateTime  2018-05-21T15:24:40+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @param     {[type]}                 timestamp [description]
     * @return    {[type]}                           [description]
     */
    function timestampToTime(timestamp) {
        var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        Y = date.getFullYear() + '-';
        M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        D = date.getDate() + ' ';
        return Y+M+D;
    }
    function timestampToTime1(timestamp){
        var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        h = date.getHours() + ':';
        m = date.getMinutes() + ':';
        s = date.getSeconds();
        return h+m+s;
    }
    function timestampToTime2(timestamp){
        var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
        Y = date.getFullYear() + '-';
        M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
        D = date.getDate() + ' ';
        h = date.getHours() + ':';
        m = date.getMinutes() + ':';
        s = date.getSeconds();
        return Y+M+D+h+m+s;
    }

  	function update_classify(cf_id,name){
  		
        
     layer.open({
                  type: 1,
                  title: '修改分类',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['300px' , '180px'],
                  content: $('#hide')
                 });
    	$('#title').val(name);
      //各种基于事件的操作，下面会有进一步介绍
      layui.use('form',function(){
      	var form = layui.form;
      	form.on('submit',function(){
      		 $.ajax({
                    type: "post",
                    url: "<?php echo url('index/goodsClassify/updateGoodsClassify'); ?>",
                    dataType: "json",
                    data: {
                        cf_id:cf_id,
                        name:$('#title').val()
                    },
                    success: function (res) {
                    	
                        if(res.code == 1) {
                           layer.msg('修改成功',{time:1000});
                           setInterval('location.reload()',2000);
                        }else{
                        	layer.msg('修改失败',{time:1000});
                          
                        }
                    }, 
                    fail: function (res) {
                        alert("网络错误");
                    }
                });     
      	})
      })
           


  		   
  	}
    function changestatus(classify_id,key){
     $.ajax({
                    type: "post",
                    url: "<?php echo url('index/goodsClassify/updateClassifyStatus'); ?>",
                    dataType: "json",
                    data: {
                        classify_id:classify_id,
                    },
                    success: function (res) {
                        if(res.code == 1) {
                           layer.msg('成功');
                           $('#btn'+key).toggleClass('layui-btn-danger');
                           $('#btn'+key).html(res.data);
                        }else{

                          
                        }
                    }, fail: function (res) {
                        alert("网络错误");
                    }
                }); 

}
    function add_classify(){
        //layer.msg('卧槽');
         layer.open({
                  type: 1,
                  title: '添加商品分类',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['300px' , '180px'],
                  content: $('#hide1')
                            
                 });
         layui.use('form', function(){

        var form = layui.form;

       form.on('submit',function(data){
       		$.ajax({
       			type:'POST',
       			url:'<?php echo url('addClassify'); ?>',
       			data:data.field,
       			dataType:'json',
       			success:function(res){
       				layer.msg(res.msg,{time:1000});
       				if(res.code ==1){
       					setInterval('location.reload()',2000);
       				}
       				     
       					

       			}
       			})
       })
        
        
     
         
     

        


           
    })
     }
    
    
    
    

   
    
</script>


<!-- END JAVASCRIPTS -->

</body>
<div id = 'hide1'>
<form class="layui-form" id= 'form1' > 
  <div class="layui-form-item" >
    <label class="layui-form-label">商品分类</label>
    <div class="layui-input-block">
      <input type="text" name="classify" id= 'title1' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
  </div>
  
 <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="add"  type='button'>添加</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>

</form>
</div>

<div id = 'hide'>
<form class="layui-form" id= 'form' > <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
  <div class="layui-form-item" >
    <label class="layui-form-label">商品分类</label>
    <div class="layui-input-block">
      <input type="text" name="classify" id= 'title' placeholder="请输入" autocomplete="off" class="layui-input" value='' lay-verify ='required'>
    </div>
  </div>
  
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="update" type= 'button'>修改</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
  <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
</form>
</div>

<!-- END BODY -->

</html>