<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/www/wwwroot/mubei8.com/mall/public/../application/index/view/address/index.html";i:1527578562;s:80:"/www/wwwroot/mubei8.com/mall/public/../application/index/view/common/common.html";i:1527652641;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> 
<html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>收货地址管理</title>

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

                <a href="/mall/public/<?php echo $v['me_url']; ?>">

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

                        收货地址管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">收货地址管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                
                <a href="javascript:add_address();" style="float: left" class="btn blue"><i class="icon-plus">添加收货地址</i></a>
                 <form action="<?php echo url('index/Address/search'); ?>" method='post' style="float:left;margin:0 5px">                  
                <input type="text" placeholder="请输入用户id/用户昵称/用户真实姓名"name='search' value=''>
                <span>状态:</span>
                <select name="status" id="status" >
                    <option value="-1" selected >状态</option>
                    <option value="0" >已禁用</option>
                    <option value="1" >已启用</option>
                </select>
                 开始时间:
                <input type="text"  id="test1" placeholder="yyyy-MM-dd" name='time1' value= <?php echo $time1; ?>>
                 结束时间:
                <input type="text"  id="test2" placeholder="yyyy-MM-dd" name='time2' value =<?php echo $time2; ?> >
                <input type="submit"  value="确认" class='btn green'/>
                </form>






                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>用户列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">

                            <thead class="cf">

                            <tr>

                                <th class="numeric">用户id</th>
                                <th class="numeric">用户昵称</th>
                                <th class="numeric">用户真实姓名</th>
                                 <th class="numeric">状态</th>
                                <th class="numeric">添加时间</th>
                               
                                
                                <th class="numeric">操作</th>
                                
                            </tr>

                            </thead>

                            <tbody id="order">
                            <?php if(is_array($userinfo) || $userinfo instanceof \think\Collection || $userinfo instanceof \think\Paginator): $key = 0; $__LIST__ = $userinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($key % 2 );++$key;?>
                            <tr style="text-align: center">
                                <td data-title="用户id"><?php echo $data['u_id']; ?></td>
                                <td data-title="用户昵称"><?php echo $data['user']; ?></td>
                                <td data-title="用户昵称"><?php echo $data['u_name']; ?></td>
                                <td class="numeric"> <button class="<?php if($data['status'] == 1): ?>layui-btn<?php else: ?>layui-btn layui-btn-danger<?php endif; ?>" id = 'btn<?php echo $key; ?>' onclick = 'changestatus(<?php echo $data['u_id']; ?>)'><?php if($data['status'] == 1): ?>已启用<?php else: ?>已禁用<?php endif; ?></button></td>                                                                                
                                <td data-title="添加时间" class="numeric"><?php echo date('Y-m-d H:i:s',$data['time']); ?></td>
                            
                                
                                
                                <td data-title="操作" class="numeric">
                                    <div class="btn-group">
                                        <a class="btn green" href="javascript:address_info(<?php echo $data['u_id']; ?>)" >
                                            <i class="icon-user"></i> 收货地址详情                                          
                                        </a>                                      
                                    </div>


                                </td>
                                
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            </tbody>

                        </table>
                       <?php echo $userinfo->render(); ?>
                      
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
    /**
     * [changestatus 修改用户状态]
     * @Author    wyc
     * @DateTime  2018-05-29T15:22:14+0800
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @param     {[type]}                 u_id [description]
     * @return    {[type]}                      [description]
     */
    function changestatus(u_id){
     $.ajax({
                    type: "post",
                    url: "<?php echo url('index/address/changeStatus'); ?>",
                    dataType: "json",
                    data: {                      
                        u_id:u_id
                    },
                    success: function (res) {
                        //if(res.code == 1) {
                           layer.msg(res.msg);
                            setInterval('location.reload()',1000);
                        //}
                    }, fail: function (res) {
                        alert("网络错误");
                    }
                }); 

}
    //删除地址
  	function del_address(address_id){
  		layer.confirm('是否确认删除该收货地址？', {
		  btn: ['确认', '取消'] //可以无限个按钮
		  ,yes: function(index, layero){
		    $.ajax({
                type: "post",
                url: "<?php echo url('index/Address/delAddress'); ?>",
                dataType: "json",
                data: {
                    address_id:address_id,
                },
                success: function (res) {
                    if(res.code == 1) {
                    	layer.msg('删除成功',{time:2000})
                    	$('#tr'+address_id).hide();
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
    
  

  	
    function changeStatus(address_id,u_id){
     $.ajax({
                    type: "post",
                    url: "<?php echo url('index/address/updateAddressStatus'); ?>",
                    dataType: "json",
                    data: {
                        address_id:address_id,
                        is_default:$('#default'+address_id).val(),
                        u_id:u_id
                    },
                    success: function (res) {
                        if(res.code == 1) {
                           layer.msg('成功');
                           if(res.data == 1){
                            $('.moren').each(function(){
                                $(this).addClass('layui-btn-normal');
                                $(this).html('非默认');
                                $(this).val(0);


                            })
                           }
                           
                           $('#default'+address_id).toggleClass('layui-btn-normal');
                           $('#default'+address_id).html(res.msg);
                           $('#default'+address_id).val(res.data);
                        }else{
                        	layer.msg(res.msg);
                          
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
    function address_info(u_id){
        //layer.msg('卧槽');
         layer.open({
                  type: 1,
                  title: '收货地址详情',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['800px' , '800px'],
                  content: $('#table')
                            
                 });
        $.ajax({
       			type:'POST',
       			url:'<?php echo url('getAddress'); ?>',
       			data:{
       				u_id:u_id
       			},
       			dataType:'json',
       			success:function(res){
       				 html = '';

		            if(res.code == 1){
		                for (var i = 0; i < res.data.length; i++) {

		               a =  '<tr id="tr'+res.data[i].address_id+'">'+
		                    '<th>'+res.data[i].address_id+'</th>'+
		                    '<th>'+res.data[i].address+'</th>'+
		                    '<th>'+res.data[i].delivery_name+'</th>'+
                            '<th>'+res.data[i].contact+'</th>'+
		                    '<th>'+timestampToTime2(res.data[i].add_time)+'</th>'
		                 b =   res.data[i].is_default == 1 
		                 ?'<th><button class="layui-btn moren" value = 1 id = "default'+res.data[i].address_id+'"onclick="changeStatus('+res.data[i].address_id+','+res.data[i].u_id+')">默认</th>'
		                 :'<th><button value = 0 id = "default'+res.data[i].address_id+'" class="layui-btn layui-btn-normal moren" onclick="changeStatus('+res.data[i].address_id+','+res.data[i].u_id+')">非默认</th>';
		                  c =  '<th><a class="btn purple" href="javascript:del_address('+res.data[i].address_id+')">'+
		                                            '<i class="icon-user"></i>删除</a></th>'                                         
		                                                                            
		                                    
		                  '</tr>' 
		                  html += a+b+c;
		                }
		            }else{
		                html='暂无数据';
		            }
       				   $('#body').html(html);  
       					

       			}
       			})
        
        
     
         
     

        


           
 
     }
     function add_address(){
        //layer.msg('卧槽');
         layer.open({
                  type: 1,
                  title: '添加收货地址',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['800px' , '300px'],
                  content: $('#hide')
                            
                 });
         layui.use('form', function(){

        var form = layui.form;

       form.on('submit',function(data){
       		$.ajax({
       			type:'POST',
       			url:'<?php echo url('addAddress'); ?>',
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
    
    
    
    
    

   
    
</script>


<!-- END JAVASCRIPTS -->

</body>
<div id = 'hide'>
<form class="layui-form" id= 'form1' > 
  <div class="layui-form-item" >
    <label class="layui-form-label">用户id</label>
    <div class="layui-input-inline">
      <input type="text" name="u_id" id= 'u_id' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
     <label class="layui-form-label">收货人姓名</label>
    <div class="layui-input-inline">
      <input type="text" name="delivery_name" id= 'delivery_name' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
    
  </div>
  <div class="layui-form-item" >
   <label class="layui-form-label">联系方式</label>
    <div class="layui-input-block">
      <input type="text" name="contact" id= 'contact' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
</div>
   <div class="layui-form-item" >
    <label class="layui-form-label">收货地址</label>
    <div class="layui-input-inline">
      <input type="text" name="address" id= 'address' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify='required' >
    </div>
    <label class="layui-form-label">是否默认</label>
    <div class="layui-input-inline">
      <select name="is_default" lay-filter="aihao" id='is_default'>
       
        <option value="0" selected="">否</option>
        <option value="1">是</option>
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

<div class="layui-form" id = 'table'>
  <table class="layui-table">

    <thead>
      <tr>
        <th>地址id</th>
        <th>收货地址</th>
        <th>收货人名字</th>
        <th>联系方式</th>
        <th >时间</th>
        <th >是否默认</th>
        <th>操作</th>
      </tr> 
    </thead>
    <tbody id= 'body'>
     
    </tbody>
  </table>
</div>
<!-- END BODY -->

</html>