<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:91:"D:\phpStudy\PHPTutorial\WWW\malaxyb\mall\public/../application/index\view\seller\index.html";i:1527685508;s:92:"D:\phpStudy\PHPTutorial\WWW\malaxyb\mall\public/../application/index\view\common\common.html";i:1528738885;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>商家管理</title>

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

                <a href="/mall/public/index.php/<?php echo $v['me_url']; ?>">

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

                        商家管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">商家管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                
                <a href="javascript:add_seller();" style="float: left" class="btn blue"><i class="icon-plus">添加商家</i></a>
                 <form action="<?php echo url('index/Seller/search'); ?>" method='post' style="float:left;margin:0 5px">
                   <input type="text" placeholder="商家用户名/手机号码/店铺名/分类名"name='search' value='' >
                   
                <span>状态:</span>
                <select name="status" id="status" >
                    <option value="-1"  selected>所有状态</option>
                    <option value="0" >已禁用</option>
                    <option value="1" >已启用</option>
                </select>
                 开始时间:
                <input type="text"  id="test1" placeholder="yyyy-MM-dd" name='time1' value=<?php echo $time1; ?>>
                 结束时间:
                <input type="text"  id="test2" placeholder="yyyy-MM-dd" name='time2' value = <?php echo $time2; ?>>
                <input type="submit"  value="确认" class='btn green'/>
                </form>
                <a href="javascript:exportExcel()" class="btn blue">导出excel表</a>
            





                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>商家列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">

                            <thead class="cf">

                            <tr>

                                <th class="numeric">商家id</th>
                                <th class="numeric">商家用户名</th>
                                <th class="numeric">手机号码</th>
                                <th class="numeric">店铺名</th>
                                <th class="numeric">所属分类</th>
                                <th class="numeric">登录ip</th>
                                <th class="numeric">添加时间</th>
                                <th class="numeric">登录时间</th>
								 <th class="numeric">状态</th>
                                
                                <th class="numeric">操作</th>
                                
                            </tr>

                            </thead>

                            <tbody id="order">
                            <?php if(is_array($seller) || $seller instanceof \think\Collection || $seller instanceof \think\Paginator): $i = 0; $__LIST__ = $seller;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?>
                            <tr style="text-align: center" id='seller<?php echo $data['admin_id']; ?>'>
                                <td data-title="商家id"><?php echo $data['admin_id']; ?></td>
                                <td data-title="商家用户名"><?php echo $data['account']; ?></td>
                                <td data-title="商家手机号码"><?php echo $data['mobile']; ?></td>
                                <td data-title="商家店铺名"><?php echo $data['shop_name']; ?></td>
                                <td data-title="所属分类"><?php echo $data['name']; ?></td>
                                <td data-title="登录ip"><?php echo $data['login_ip']; ?></td>
                                                                                                                 
                                <td data-title="添加时间" class="numeric"><?php echo date('Y-m-d H:i:s',$data['add_time']); ?></td>
                                <td data-title="登录时间" class="numeric"><?php echo date('Y-m-d H:i:s',$data['login_time']); ?></td>
								<td data-title="状态" class="numeric">
                                   
                                    <button class="<?php if($data['status'] == 1): ?>layui-btn<?php else: ?>layui-btn layui-btn-danger<?php endif; ?>" id = 'btn<?php echo $key; ?>' onclick = 'changestatus(<?php echo $data['admin_id']; ?>,<?php echo $key; ?>)'><?php if($data['status'] == 1): ?>已启用<?php else: ?>已禁用<?php endif; ?></button>
                                    
                                    
                                </td>      
                                
                                
                                <td data-title="操作" class="numeric">
                                    <div class="btn-group">
                                        <a class="btn green" href="javascript:update_seller(<?php echo $data['admin_id']; ?>)" >
                                            <i class="icon-user"></i> 修改                                          
                                        </a>                                      
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn purple" href="javascript:del_seller(<?php echo $data['admin_id']; ?>)">
                                            <i class="icon-user"></i> 删除                                           
                                        </a>                                      
                                    </div>


                                </td>
                                
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            </tbody>

                        </table>
                       <?php echo $seller->render(); ?>
                      
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
        layui.use(['laydate','form'], function(){
          var laydate = layui.laydate;
           var form = layui.form;
          //alert(laydate);
          
          //常规用法
          laydate.render({
            elem: '#test1'
          });
          laydate.render({
            elem: '#test2'
          });

        })
    	$('#hide').hide();
        $('#hide1').hide();
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
    function exportExcel(){
        //alert($('#order').children().length);
        if($('#order').children().length <= 0){
            layer.msg('暂无数据导出');
        }else{
            if($('input[name="search"]').val() == ''){
                window.location.href = '/mall/public/index/Seller/sellerExport/status/'+$('select[name="status"]').val()+'/time1/'+$('#test1').val()+'/time2/'+$('#test2').val();
            
            }else{
                 window.location.href = '/mall/public/index/Seller/sellerExport/search/'+$('input[name="search"]').val()+'/status/'+$('select[name="status"]').val()+'/time1/'+$('#test1').val()+'/time2/'+$('#test2').val();
            }
        }
                   
    }
    //删除商家
  	function del_seller(admin_id){
  		layer.confirm('是否确认删除该商家？', {
		  btn: ['确认', '取消'] //可以无限个按钮
		  ,yes: function(index, layero){
		    $.ajax({
                type: "post",
                url: "<?php echo url('index/Seller/delSeller'); ?>",
                dataType: "json",
                data: {
                    admin_id:admin_id,
                },
                success: function (res) {
                    if(res.code == 1) {
                    	layer.msg('删除成功',{time:2000})
                    	$('#seller'+admin_id).hide();
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
    
  

  	
    function changestatus(admin_id,key){
     $.ajax({
                    type: "post",
                    url: "<?php echo url('index/Seller/updateSellerStatus'); ?>",
                    dataType: "json",
                    data: {
                        admin_id:admin_id,
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
     function renderForm(){
     	layui.use('form',function(){
     		var form  = layui.form;
     		form.render();
     	})
     }
     function add_seller(){
        //layer.msg('卧槽');
         layer.open({
                  type: 1,
                  title: '添加商家',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['800px' , '300px'],
                  content: $('#hide')
                            
                 });
         $.ajax({
         	type:'GET',
         	url:'<?php echo url('addSeller'); ?>',
         	dataType:'json',
         	success:function(res){
         		//console.log(res);
         		$('select[name="classify_id"]').html(res.msg)
         		renderForm();
         		//alert($('select[name="classify"]').html())
         	}
         })
         layui.use('form', function(){

        var form = layui.form;
        form.render('select');
        form.verify({
        	mobile:function(value){
        		if(!/^(13|14|15|16|17|18|19)\d{9}$/.test(value)){
        			return '请输入正确的手机号码';
        		}
        	}
        })

       form.on('submit',function(data){
       		$.ajax({
       			type:'POST',
       			url:'<?php echo url('addSeller1'); ?>',
       			data:data.field,
       			dataType:'json',
       			success:function(res){
       				layer.msg(res.msg,{time:1000});
       				if(res.code ==1){
       					setInterval('location.reload()',2000);
       				}else if(res.code == -1){
       					$('#u_id').focus();
       				}
       				     
       					

       			}
       			})
       })
        
     
         
     

        


        })
    }
    function update_seller(admin_id){
        //layer.msg('卧槽');
         layer.open({
                  type: 1,
                  title: '修改商家',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['800px' , '300px'],
                  content: $('#hide1')
                            
                 });
         $.ajax({
         	type:'GET',
         	url:'<?php echo url('updateSeller'); ?>',
         	data:{admin_id:admin_id},
         	dataType:'json',
         	success:function(res){
         		//console.log(res);
         		$('select[name="classify_id1"]').html(res.option)
         		$('#admin_id').val(res.data.admin_id);
         		$('#account1').val(res.data.account);
         		//$('#pass1').val(res.data.pass);
         		$('#mobile1').val(res.data.mobile);
         		$('#shop_name1').val(res.data.shop_name);
         		$('#status1').val(res.data.status);

         		renderForm();
         		//alert($('select[name="classify"]').html())
         	}
         })
         layui.use('form', function(){

        var form = layui.form;
        form.render('select');
        form.verify({
        	mobile:function(value){
        		if(!/^(13|14|15|16|17|18|19)\d{9}$/.test(value)){
        			return '请输入正确的手机号码';
        		}
        	}
        })

       form.on('submit',function(data){
       		$.ajax({
       			type:'POST',
       			url:'<?php echo url('updateSeller1'); ?>',
       			data:data.field,
       			dataType:'json',
       			success:function(res){
       				layer.msg(res.msg,{time:1000});
       				if(res.code ==1){
       					setInterval('location.reload()',2000);
       				}else if(res.code == -1){
       					
       				}
       				     
       					

       			}
       			})
       })
        }) 
        }
    
    
    
    
    

   
    
</script>


<!-- END JAVASCRIPTS -->

</body>
<div id = 'hide'>
<form class="layui-form" id= 'form1' > 
  <div class="layui-form-item" >
    <label class="layui-form-label">商家用户名</label>
    <div class="layui-input-inline">
      <input type="text" name="account" id= 'u_id' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
     <label class="layui-form-label">商家密码</label>
    <div class="layui-input-inline">
      <input type="text" name="pass" id= 'delivery_name' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
    
  </div>
  <div class="layui-form-item" >
   <label class="layui-form-label">所属分类</label>
    <div class="layui-input-inline">
      <select name="classify_id" id="classify">

      	
      </select>
    </div>
    <label class="layui-form-label">手机号码</label>
    <div class="layui-input-inline">
       <input type="text" name="mobile" id= 'delivery_name' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required|mobile' >
    </div>
</div>
   <div class="layui-form-item" >
   	<label class="layui-form-label">店铺名</label>
    <div class="layui-input-inline">
       <input type="text" name="shop_name" id= 'delivery_name' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
    <label class="layui-form-label">状态</label>
    <div class="layui-input-inline">
      <select name="status" lay-filter="aihao" id='is_default'>
       
        <option value="0" >禁用</option>
        <option value="1" selected>启用</option>
      </select>
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
<div id = 'hide1'>
<form class="layui-form" id= 'form1' > 
  <div class="layui-form-item" >
    <label class="layui-form-label">商家用户名</label>
    <div class="layui-input-inline">
      <input type="text" name="account1" id= 'account1' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
     <label class="layui-form-label">商家密码</label>
    <div class="layui-input-inline">
      <input type="text" name="pass1" id= 'pass1' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
      <input type="hidden" name="admin_id" id= 'admin_id' placeholder="请输入" autocomplete="off" class="layui-input" value=''>
    </div>
    
  </div>
  <div class="layui-form-item" >
   <label class="layui-form-label">所属分类</label>
    <div class="layui-input-inline">
      <select name="classify_id1" >

      	
      </select>
    </div>
    <label class="layui-form-label">手机号码</label>
    <div class="layui-input-inline">
       <input type="text" name="mobile1" id= 'mobile1' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required|mobile' >
    </div>
</div>
   <div class="layui-form-item" >
   	<label class="layui-form-label">店铺名</label>
    <div class="layui-input-inline">
       <input type="text" name="shop_name1" id= 'shop_name1' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
    <label class="layui-form-label">状态</label>
    <div class="layui-input-inline">
      <select name="status1" id = 'status1' lay-filter="aihao" id='is_default'>
       
        <option value="0" >禁用</option>
        <option value="1" selected>启用</option>
      </select>
    </div>
  </div>
 <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="add"  type='button'>修改</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>

</form>
</div>


<!-- END BODY -->

</html>