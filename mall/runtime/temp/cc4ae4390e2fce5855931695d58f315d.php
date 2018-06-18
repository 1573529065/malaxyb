<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"E:\phpStudy\PHPTutorial\WWW\mall1\public/../application/index\view\order\index.html";i:1527246763;s:85:"E:\phpStudy\PHPTutorial\WWW\mall1\public/../application/index\view\common\common.html";i:1527133126;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>订单管理</title>

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

                        订单管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">订单管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                
                <a href="javascript:add_goods();" style="float: left" class="btn blue"><i class="icon-plus"></i>添加商品</a>
                






                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>订单列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">

                            <thead class="cf">

                            <tr>

                                <th class="numeric">订单id</th>
                                <th class="numeric">订单编号</th>
                                <th class="numeric">用户id</th>
                                <th class="numeric">商品名</th>
                                <th class="numeric">商品分类名</th>
								<th class="numeric">商品单价</th>
								<th class="numeric">购买数量</th>
								<th class="numeric">商品总价</th>
								<th class="numeric">收货地址</th>
								<th class="numeric">订单状态</th>
								<th class="numeric">下单时间</th>
                                
                                <th class="numeric">操作</th>
                                
                            </tr>

                            </thead>
							
                            <tbody id="order">
                            <?php if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): $key = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($key % 2 );++$key;?>
                            <tr>
                            	<th class="numeric"><?php echo $data['order_id']; ?></th>
                            	<th class="numeric"><?php echo $data['order_sn']; ?></th>
                                <th class="numeric"><?php echo $data['u_id']; ?></th>
                                <th class="numeric"><?php echo $data['goods_name']; ?></th>
                                <th class="numeric"><?php echo $data['name']; ?></th>
								<th class="numeric"><?php echo $data['price']; ?></th>
								<th class="numeric"><?php echo $data['num']; ?></th>
								<th class="numeric"><?php echo $data['total_price']; ?></th>
								<th class="numeric"><?php echo $data['address']; ?></th>
								<th class="numeric">
									 <button class="<?php if($data['status'] == 0): ?>layui-btn layui-btn-danger<?php elseif($data['status'] == 1): ?>layui-btn layui-btn-warm<?php elseif($data['status'] == 2): ?>layui-btn layui-btn-normal<?php else: ?>layui-btn<?php endif; ?>" id = 'btn<?php echo $key; ?>' ><?php if($data['status'] == 0): ?>未付款<?php elseif($data['status'] == 1): ?>已付款<?php elseif($data['status'] == 2): ?>已发货<?php else: ?>已完成<?php endif; ?>
									 </button>
								</th>
								<th class="numeric"><?php echo date('Y-m-d H:i:s',$data['add_time']); ?></th>

                                
                                <th class="numeric">
                                	<div class="btn-group">
                                        <a class="btn green" href="javascript:update_order(<?php echo $data['order_id']; ?>)" >
                                            <i class="icon-user"></i> 修改                                          
                                        </a>                                      
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn purple" href="javascript:del_order(<?php echo $data['order_id']; ?>)">
                                            <i class="icon-user"></i> 删除                                           
                                        </a>                                      
                                    </div>
                                </th>
                                </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            </tbody>

                        </table>
                       
                      
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

    //删除商品
  	function del_order(order_id){
  		layer.confirm('是否确认删除该订单？', {
		  btn: ['确认', '取消'] //可以无限个按钮
		  ,yes: function(index, layero){
		    $.ajax({
                type: "post",
                url: "<?php echo url('index/order/delOrder'); ?>",
                dataType: "json",
                data: {
                    order_id:order_id,
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
    


  	function update_order(order_id){
  		
        
     layer.open({
                  type: 1,
                  title: '修改订单',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['800px' , '300px'],
                  content: $('#hide')
                 });
     	 $.ajax({
                    type: "post",
                    url: "<?php echo url('index/order/updateOrder'); ?>",
                    dataType: "json",
                    data: {
                        order_id:order_id
                    },
                    success: function (res) {
                    	//console.log(res);
                        if(res.code == 1) {
                        	//$("#classify_id").attr("value",res.data.classify_id);
                        	$("*[name='price']").val(res.data.price);

                        	$("*[name='num']").val(res.data.num);
                        	$("*[name='total_price']").val(res.data.total_price);
                        	$('#address_id').html(res.data.addressInfo);
                        	$("*[name='status']").val(res.data.status);
                        	$("*[name='num']").blur(function(){
                        		//alert(typeof(parseInt($("*[name='price']").val())));
                        		//alert(parseFloat($("*[name='price']").val()) * parseFloat($("*[name='num']").val(res.data.num)));
                        		a = parseFloat($("*[name='price']").val()* $("*[name='num']").val()).toFixed(2) ;
                        		//alert(typeof(a));
                        		$("*[name='total_price']").val(a);
                        	})
                        	      layui.use('form',function(){
                        	      	var form = layui.form; 
                        	      	form.render('select');
                        	      	form.verify({
                        	      		//正整数
                        	      		int:function(value){
                        	      			if(!/^[1-9]\d*$/.test(value)){
                        	      				return '只能为正整数';
                        	      			}
                        	      		}
                        	      	});
						        	form.on('submit',function(){
								      		 $.ajax({
								                    type: "post",
								                    url: "<?php echo url('index/order/updateOrder1'); ?>",
								                    dataType: "json",
								                    data: {
								                    	order_id:order_id,
								                    	price:$("*[name='price']").val(),
								                       	total_price:$("*[name='total_price']").val(),
									       				num:$("*[name='num']").val(),
									       				address_id:$("#address_id").val(),
									       				status:$("*[name='status']").val()
									       				

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
                    }, 
                    fail: function (res) {
                        alert("网络错误");
                    }
                });     


      
          	   
  	}
   
    
     
    
    
    
    

   
    
</script>


<!-- END JAVASCRIPTS -->

</body>

<div id = 'hide'>

<form class="layui-form" id= 'form1' > 
  <div class="layui-form-item" >
    <label class="layui-form-label">商品单价</label>
    <div class="layui-input-inline">
		 <input type="text" name="price"  placeholder="请输入" autocomplete="off" class="layui-input" lay-verify='required' disabled="disabled">
    </div>
    <label class="layui-form-label">购买数量</label>
    <div class="layui-input-inline">
        <input type="text" name="num"  placeholder="请输入" autocomplete="off" class="layui-input" lay-verify='required|int' >
    </div>
  </div>
  <div class="layui-form-item" >
    
    
    <label class="layui-form-label">商品总价</label>
    <div class="layui-input-inline">
        <input type="text" name="total_price"  placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required'disabled="disabled" >
    </div>
    <label class="layui-form-label">收货地址</label>
    <div class="layui-input-inline">
		<select name="address_id" lay-filter="aihao" id='address_id'>
       
    
      </select>
    </div>
  </div>
<div class="layui-form-item" >
    
    
    <label class="layui-form-label">订单状态</label>
   <div class="layui-input-inline">
      <select name="status" lay-filter="aihao" id='status'>
       
        <option value="0" >未付款</option>
        <option value="1" >已付款</option>
        <option value="2" >已发货</option>
        <option value="3" >已完成</option>
      </select>
    </div>
    
  </div>
 <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn wocao" lay-submit="" lay-filter="add"  type='button'>修改</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>

</form>
</div>



<!-- END BODY -->

</html>
