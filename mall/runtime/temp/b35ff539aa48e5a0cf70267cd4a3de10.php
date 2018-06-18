<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:102:"E:\phpStudy\PHPTutorial\WWW\hpay_admin\public/../application/index\view\assets\crowdfundingmanage.html";i:1526975714;s:90:"E:\phpStudy\PHPTutorial\WWW\hpay_admin\public/../application/index\view\common\common.html";i:1525511179;}*/ ?>
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

                        众筹管理

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html">首页</a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#">众筹管理</a></li>


                    </ul>

                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>

            <!-- END PAGE HEADER-->

            <div id="dashboard">

                <!-- BEGIN DASHBOARD STATS -->



                <!-- END DASHBOARD STATS -->

                <div class="clearfix"></div>
                
                <a href="javascript:add_crowd();" style="float: left" class="btn blue"><i class="icon-plus"></i>添加众筹</a>
                






                <div class="chat-form">
                </div>
                <div class="clearfix"></div>
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-cogs"></i>众筹列表</div>
                    </div>
                    <div class="portlet-body no-more-tables" style="padding-bottom: 5%;">

                        <table class="table-bordered table-striped table-condensed cf">

                            <thead class="cf">

                            <tr>

                                <th class="numeric">众筹id</th>
                                <th class="numeric">标题</th>
                                <th class="numeric">图片</th>
                                <th class="numeric">总金额</th>
                                <!--<th class="numeric">流通资产</th>-->
                                <th class="numeric">目前金额</th>
                                <th class="numeric">筹备人数</th>
                                <th class="numeric">筹备金额比</th>

                                <th class="numeric">限制购买币数</th>
                                <th class="numeric">状态</th>
                                <th class="numeric">开始时间</th>
                                <th class="numeric">结束时间</th>
                                
                                <th class="numeric">操作</th>
                                
                            </tr>

                            </thead>

                            <tbody id="order">
                            <?php if(is_array($crowdInfo) || $crowdInfo instanceof \think\Collection || $crowdInfo instanceof \think\Paginator): $key = 0; $__LIST__ = $crowdInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($key % 2 );++$key;?>
                            <tr style="text-align: center">
                                <td data-title="用户uid"><?php echo $data['cf_id']; ?></td>
                                <td data-title="标题"><?php echo $data['title']; ?></td>
                                <td data-title="图片" class="numeric"><img src="<?php echo $data['cf_img']; ?>" style = 'height:100px;width:100px'alt=""></td>
                                <td data-title="总金额" class="numeric"><?php echo $data['amount']; ?></td>
                                <td data-title="目前金额" class="numeric"><?php echo $data['current']; ?></td>
                                <td data-title="众筹人数" class="numeric"><?php echo $data['num']; ?></td>
                                <td data-title="众筹金额比" class="numeric"><?php echo $data['proportion']; ?></td>
                                <td data-title="限制购买币数" class="numeric"><?php echo $data['limited']; ?></td>
                                
                                <td data-title="状态" class="numeric">
                                   
                                    <button class="<?php if($data['status'] == 1): ?>layui-btn<?php else: ?>layui-btn layui-btn-danger<?php endif; ?>" id = 'btn<?php echo $key; ?>' onclick = 'changestatus(<?php echo $data['cf_id']; ?>,<?php echo $key; ?>)'><?php if($data['status'] == 1): ?>已启用<?php else: ?>已禁用<?php endif; ?></button>
                                    
                                    
                                </td>                                                             
                                <td data-title="开始时间" class="numeric"><?php echo date('Y-m-d H:i:s',$data['time']); ?></td>
                                <td data-title="结束时间" class="numeric"><?php echo date('Y-m-d H:i:s',$data['end_time']); ?></td>

                                
                                
                                <td data-title="操作" class="numeric">
                                    <div class="btn-group">
                                        <a class="btn white" href="javascript:get_crowd_order(<?php echo $data['cf_id']; ?>)">
                                            <i class="icon-user"></i> 详情                                           
                                        </a>                                      
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn green" href="javascript:update_crowd(<?php echo $data['cf_id']; ?>)" >
                                            <i class="icon-user"></i> 修改                                          
                                        </a>                                      
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn purple" href="javascript:del_crowd(<?php echo $data['cf_id']; ?>)">
                                            <i class="icon-user"></i> 删除                                           
                                        </a>                                      
                                    </div>
                                    


                                </td>
                                
                            </tr>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                            
                            </tbody>

                        </table>
                       <?php echo $crowdInfo->render(); ?>
                      
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


  	function del_crowd(cf_id){
  		layer.confirm('是否确认删除该众筹？', {
		  btn: ['确认', '取消'] //可以无限个按钮
		  ,yes: function(index, layero){
		    $.ajax({
                type: "post",
                url: "<?php echo url('index/assets/delCrowd'); ?>",
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
    function del_crowd_order(fo_id){
        layer.confirm('是否确认删除该众筹订单？', {
          btn: ['确认', '取消'] //可以无限个按钮
          ,yes: function(index, layero){
            $.ajax({
                type: "post",
                url: "<?php echo url('index/assets/delCrowdOrder'); ?>",
                dataType: "json",
                data: {
                    fo_id:fo_id,
                },
                success: function (res) {
                    if(res.code == 1) {
                        layer.msg('删除成功',{time:2000})
                        //get_crowd_order()
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

  	function update_crowd(cf_id){
  		layui.use(['form','laydate'], function(){
        var form = layui.form;
        var laydate = layui.laydate;
        laydate.render({
            elem:'#time1'
            
        })
        laydate.render({
            elem:'#time2',
            type:'time'
            
        })
        laydate.render({
            elem:'#time3'
            
        })
        laydate.render({
            elem:'#time4',
            type:'time'
            
        })

        form.verify({  
        //判断是否为负数
        is_fushu:function(value){
            if(value < 0){
                return '不能是负数';
            }
        },
        //小数点位数
        decimal_place:function(value){
            var arr = value.split('.');
            if(arr[1].length>4){
                return '小数点后面不能超过4位小数';
            }
        },
        //是否为小数
        is_decimal:function(value){
            if(value.match(/\./)){
                return '不能是小数';
            }
        },
        //0-100的数
        int:function(value){
            if(value > 100 || value < 0){
                return '只能是0-100的数';
            }
        }

  });  
         
             form.on('submit(update)', function (data) {
                if($('#currentAmount').val() > $('#totalAmount').val()){
                    layer.msg('当前金额不能超过总金额');
                    $('#currentAmount').focus();
                    return false;
                }
//var datas=data.field;
var action=data.form.action;
$.ajax({
        url:"<?php echo url('index/assets/updateCrowd1'); ?>",
        data:{
            cf_id:$('#cf_id').val(),
            title:$('#title').val(),
            image:$('#img').attr('src'),
            amount:$('#totalAmount').val(),
            current:$('#currentAmount').val(),
            num:$('#num').val(),
            proportion:$('#proportion').val(),
            limit:$('#limit').val(),
            time1:$('#time1').val(),
            time2:$('#time2').val(),
            time3:$('#time3').val(),
            time4:$('#time4').val(),

                    },
        type:"POST",
        dataType:"json",
        success: function (res) {
            var index = parent.layer.getFrameIndex(window.name);
                               if(res.code == 1){
                                
                    
                    parent.layer.close(index);

                    //layer.closeAll();
                    setInterval('window.parent.location.reload()',2000);

                                layer.msg('修改成功',{time:1000})

                               }else{
                                //parent.layer.close(index);
                                setInterval('window.parent.location.reload()',2000);
                                 layer.msg('修改失败',{time:1000})
                               }
                            },
        error:function(error){

        }
});
return false;
});           
        
     layer.open({
                  type: 1,
                  title: '修改众筹',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['800px' , '720px'],
                  content: $('#hide')
                 });
      //各种基于事件的操作，下面会有进一步介绍
        });
            $.ajax({
                    type: "post",
                    url: "<?php echo url('index/assets/updateCrowd'); ?>",
                    dataType: "json",
                    data: {
                        cf_id:cf_id,
                    },
                    success: function (res) {
                        if(res.code == 1) {
                           
                            $('#cf_id').val(res.data.cf_id);
                            $('#title').val(res.data.title);
                            //alert($('#title').val());
                            $('#img').attr('src',res.data.cf_img);
                            $('#totalAmount').val(res.data.amount);
                            //alert($('#totalAmount').val());
                            $('#currentAmount').val(res.data.current);
                            $('#num').val(res.data.num);
                            $('#proportion').val(res.data.proportion);
                            $('#limit').val(res.data.limited);
                            time = timestampToTime(res.data.time);
                            $('#time1').val(time);
                             time2 = timestampToTime1(res.data.time);
                            $('#time2').val(time2);
                            time3 = timestampToTime(res.data.end_time);
                            $('#time3').val(time3);
                             time4 = timestampToTime1(res.data.end_time);
                            $('#time4').val(time4);
                        }else{

                          
                        }
                    }, fail: function (res) {
                        alert("网络错误");
                    }
                });     

layui.use('upload', function(){
      var $ = layui.jquery
      ,upload = layui.upload;
      
      //普通图片上传
      var uploadInst = upload.render({
        elem: '#test1'
        ,url: 'uploadImg'
        ,before: function(obj){
          //预读本地文件示例，不支持ie8
          obj.preview(function(index, file, result){
            $('#demo1').attr('src', result); //图片链接（base64）
          });
        }
        ,done: function(res){
            layer.msg('上传成功',{time:1000});
            $('#img').attr('src','__public__/'+res.img);
          //如果上传失败
          /*if(res.code > 0){
            return layer.msg('上传失败');
          }*/
          //上传成功
        }
        ,error: function(){
          //演示失败状态，并实现重传
          var demoText = $('#demoText');
          demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
          demoText.find('.demo-reload').on('click', function(){
            uploadInst.upload();
          });
        }
      });
})
  		   
  	}
    function changestatus(cf_id,key){
     $.ajax({
                    type: "post",
                    url: "<?php echo url('index/assets/updateCrowdStatus'); ?>",
                    dataType: "json",
                    data: {
                        cf_id:cf_id,
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
    function add_crowd(){
        //layer.msg('卧槽');
         layer.open({
                  type: 1,
                  title: '添加众筹',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['800px' , '720px'],
                  content: $('#hide1')
                            
                 });
         layui.use(['form','laydate','upload'], function(){
         var $ = layui.jquery
      ,upload = layui.upload;
        var form = layui.form;
        var laydate = layui.laydate;
        laydate.render({
            elem:'#time5'
            
        })
        laydate.render({
            elem:'#time6',
            type:'time'
            
        })
        laydate.render({
            elem:'#time7'
            
        })
        laydate.render({
            elem:'#time8',
            type:'time'
            
        })

        
        
      
      //普通图片上传
      var uploadInst = upload.render({
        elem: '#test2'
        ,url: 'uploadImg'
        ,before: function(obj){
          //预读本地文件示例，不支持ie8
          obj.preview(function(index, file, result){
            $('#demo1').attr('src', result); //图片链接（base64）
          });
        }
        ,done: function(res){
            layer.msg('上传成功',{time:1000});
            $('#img1').attr('src','__public__/'+res.img);
          //如果上传失败
          /*if(res.code > 0){
            return layer.msg('上传失败');
          }*/
          //上传成功
        }
        ,error: function(){
          //演示失败状态，并实现重传
          var demoText = $('#demoText');
          demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
          demoText.find('.demo-reload').on('click', function(){
            uploadInst.upload();
          });
        }
      });
         
     

        


           
    })
     }
    
    
    
    

   
    
</script>


<!-- END JAVASCRIPTS -->

</body>
<div id = 'hide1'>
<form class="layui-form" id= 'form1' onsubmit='return add_crowd1()'> 
  <div class="layui-form-item" >
    <label class="layui-form-label">标题</label>
    <div class="layui-input-block">
      <input type="text" name="title" id= 'title1' placeholder="请输入" autocomplete="off" class="layui-input" value='' >
    </div>
  </div>
  <div class="layui-form-item" >
    <label class="layui-form-label">图片</label>
    <div class="layui-input-inline" style='height:80px;width:80px'>
      <img src="" alt="" id ='img1'>

    </div>
    <div class="layui-input-inline">
        <button type="button" class="layui-btn" id="test2">上传图片</button>
        <input type="hidden" name= '' id='files'>
    </div> 
  </div>
  <div class="layui-form-item" >
    <label class="layui-form-label">总金额</label>
    <div class="layui-input-block">
      <input type="text" name="totalAmount" id= 'totalAmount1' placeholder="请输入" autocomplete="off" class="layui-input" value=0 >
    </div>
  </div>
   <div class="layui-form-item" >
    <label class="layui-form-label">当前金额</label>
    <div class="layui-input-block">
      <input type="text" name="currentAmount" id= 'currentAmount1' placeholder="请输入" autocomplete="off" class="layui-input" value=0 >
    </div>
  </div>
   <div class="layui-form-item" >
    <label class="layui-form-label">众筹人数</label>
    <div class="layui-input-block">
      <input type="text" name="num" id= 'num1' placeholder="请输入" autocomplete="off" class="layui-input" value='0' >
    </div>
  </div>
  <div class="layui-form-item" >
    <label class="layui-form-label">众筹金额比</label>
    <div class="layui-input-block">
      <input type="text" name="proportion" id= 'proportion1' placeholder="请输入" autocomplete="off" class="layui-input" value='' 
      >
    </div>
  </div>
  <div class="layui-form-item" >
    <label class="layui-form-label">限购币数</label>
    <div class="layui-input-block">
      <input type="text" name="limit" id= 'limit1' placeholder="请输入" autocomplete="off" class="layui-input" value=1 
      >
    </div>
  </div>
       <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">开始时间</label>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="time5" placeholder="yyyy-MM-dd">
      </div>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="time6" placeholder="HH:mm:ss">
      </div>
    </div>
</div>
    <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">结束时间</label>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="time7" placeholder="yyyy-MM-dd">
      </div>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="time8" placeholder="HH:mm:ss">
      </div>
    </div>
  </div>
 <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="add"  >立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>

</form>
</div>

<div id = 'hide'>
<form class="layui-form" id= 'form' > <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
  <div class="layui-form-item" >
    <label class="layui-form-label">标题</label>
    <div class="layui-input-block">
      <input type="text" name="title" id= 'title' placeholder="请输入" autocomplete="off" class="layui-input" value='' lay-verify ='required'>
    </div>
  </div>
  <div class="layui-form-item" >
    <label class="layui-form-label">图片</label>
    <div class="layui-input-inline" style='height:80px;width:80px'>
      <img src="" alt="" id ='img'>

    </div>
    <div class="layui-input-inline">
        <button type="button" class="layui-btn" id="test1">修改图片</button>
        <input type="hidden" name= '' id='files'>
    </div> 
  </div>
  <input type="hidden" name= 'cf_id' id = 'cf_id' value=''>
 <div class="layui-form-item" >
    <label class="layui-form-label">总金额</label>
    <div class="layui-input-block">
      <input type="text" name="totalAmount" id= 'totalAmount' placeholder="请输入" autocomplete="off" class="layui-input" value='' lay-verify ='required|number|is_fushu|decimal_place'>
    </div>
  </div>
  <div class="layui-form-item" >
    <label class="layui-form-label">当前金额</label>
    <div class="layui-input-block">
      <input type="text" name="currentAmount" id= 'currentAmount' placeholder="请输入" autocomplete="off" class="layui-input" value=''lay-verify ='required|number|is_fushu|decimal_place'>
    </div>
  </div>
   <div class="layui-form-item" >
    <label class="layui-form-label">众筹人数</label>
    <div class="layui-input-block">
      <input type="text" name="num" id= 'num' placeholder="请输入" autocomplete="off" class="layui-input" value='' lay-verify ='required|number|is_decimal|is_fushu'>
    </div>
  </div>
  <div class="layui-form-item" >
    <label class="layui-form-label">众筹金额比</label>
    <div class="layui-input-block">
      <input type="text" name="proportion" id= 'proportion' placeholder="请输入" autocomplete="off" class="layui-input" value='' 
      lay-verify ='required|number|int|is_fushu'>
    </div>
  </div>
  <div class="layui-form-item" >
    <label class="layui-form-label">限购币数</label>
    <div class="layui-input-block">
      <input type="text" name="limit" id= 'limit' placeholder="请输入" autocomplete="off" class="layui-input" value='' 
      lay-verify ='required|number|is_fushu'>
    </div>
  </div>
     <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">开始时间</label>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="time1" placeholder="yyyy-MM-dd">
      </div>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="time2" placeholder="HH:mm:ss">
      </div>
    </div>
</div>
    <div class="layui-form-item">
    <div class="layui-inline">
      <label class="layui-form-label">结束时间</label>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="time3" placeholder="yyyy-MM-dd">
      </div>
      <div class="layui-input-inline">
        <input type="text" class="layui-input" id="time4" placeholder="HH:mm:ss">
      </div>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit="" lay-filter="update" >立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
  <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
</form>
</div>
<div class="layui-form" id = 'table'>
  <table class="layui-table">

    <thead>
      <tr>
        <th>订单id</th>
        <th>钱包地址</th>
        <th>金额</th>
        <th>众筹id</th>
        <th width='130px'>时间</th>
        <th>币数</th>
        <th>用户id</th>
        <th>操作</th>
      </tr> 
    </thead>
    <tbody id= 'body'>
     
    </tbody>
  </table>
</div>
<!-- END BODY -->
<script type="text/javascript">
      function get_crowd_order(cf_id){
         layer.open({
                  type: 1,
                  title: '众筹订单详情',
                  //maxmin: true,
                  //shadeClose: true, //点击遮罩关闭层
                  area : ['1000px' , '520px'],
                  content: $('#table')
                            
                 });
        
         $.ajax({
        url:"<?php echo url('index/assets/getCrowdOrder'); ?>",
        data:{
            cf_id:cf_id
                    },
        type:"POST",
        dataType:"json",
        success: function (res) {
            html = '';
            if(res.code == 1){
                for (var i = 0; i < res.data.length; i++) {
               html += '<tr>'+
                    '<th>'+res.data[i].fo_id+'</th>'+
                    '<th>'+res.data[i].address+'</th>'+
                    '<th>'+res.data[i].money+'</th>'+
                    '<th>'+res.data[i].cf_id+'</th>'+
                    '<th>'+timestampToTime2(res.data[i].time)+'</th>'+
                    '<th>'+res.data[i].gold+'</th>'+
                    '<th>'+res.data[i].u_id+'</th>'+
                    '<th><a class="btn purple" href="javascript:del_crowd_order('+res.data[i].fo_id+')">'+
                                            '<i class="icon-user"></i>删除</a></th>' +                                         
                                                                            
                                    
                  '</tr>' 
                }
            }else{
                html='暂无数据';
            }
            //alert(html);
           $('#body').html(html);
       },
            
        error:function(error){

        }

});
    }
    function isNumber(value) {         //验证是否为正数
    var patrn = /^\d+(\.\d+)?$/;
    if (patrn.exec(value) == null || value == "") {
        return false;
    } else {
        return true;
    }
}
    function trim(value){
    return parseInt(value.replace(/[\-\:]/g,''));
    }
    function add_crowd1(){
        var text = $('#hide1 input:text');
        for (var i = 0; i < text.length; i++) {
            if(text[i].value == ''){
                $(text[i]).focus();
                layer.msg('必填项');
                return false;
            }
        }

        if($('#img1').attr('src') == ''){
            layer.msg('你还没上传图片');
            $('#test2').focus();
            return false;
        }
        var r = /^\+?[0-9]?[0-9]*$/;　　//判断是否为正整数 
        if(!r.test($('#num1').val())){
            $('#num1').focus();
            layer.msg('只能为正整数');
            return false;
        }
        if(!isNumber($('#totalAmount1').val())){
            $('#totalAmount1').focus();
            layer.msg('只能为正数');
            return false;
        }
        if(!isNumber($('#currentAmount1').val())){
            $('#currentAmount1').focus();
            layer.msg('只能为正数');
            return false;
        }
        if(!isNumber($('#num1').val())){
            $('#num1').focus();
            layer.msg('只能为正数');
            return false;
        }
        if(!isNumber($('#limit1').val())){
            $('#limit1').focus();
            layer.msg('只能为正数');
            return false;
        }
        if(!isNumber($('#proportion1').val())){
            $('#proportion1').focus();
            layer.msg('只能为正数');
            return false;
        }
        if($('#proportion1').val() == 0){
             $('#proportion1').focus();
            layer.msg('不能为0');
            return false;
        }
        if($('#currentAmount1').val() >$('#totalAmount1').val()){
            $('#currentAmount1').focus();
            layer.msg('当前金额不能超过总金额');
            return false;
        }
        //alert(trim($('#time6').val()));
        if(trim($('#time5').val()) == trim($('#time7').val())){
            if(trim($('#time6').val()) > trim($('#time8').val())){
                //$('#time8').focus();
                layer.msg('结束时间不能小于开始时间');
                return false;
            }

        }else if(trim($('#time5').val()) > trim($('#time7').val())){
            //$('#time7').focus();
                layer.msg('结束时间不能小于开始时间');
                return false;
        }


         $.ajax({
        url:"<?php echo url('index/assets/addCrowd'); ?>",
        data:{
            title:$('#title1').val(),
            image:$('#img1').attr('src'),
            amount:$('#totalAmount1').val(),
            current:$('#currentAmount1').val(),
            num:$('#num1').val(),
            proportion:$('#proportion1').val(),
            limit:$('#limit1').val(),
            time1:$('#time5').val(),
            time2:$('#time6').val(),
            time3:$('#time7').val(),
            time4:$('#time8').val(),

                    },
        type:"POST",
        dataType:"json",
        success: function (res) {
            var index = parent.layer.getFrameIndex(window.name);
                               if(res.code == 1){
                                
                    
                    parent.layer.close(index);

                    //layer.closeAll();
                    setInterval('window.parent.location.reload()',2000);

                                layer.msg('添加成功',{time:1000})

                               }else{
                                //parent.layer.close(index);
                                setInterval('window.parent.location.reload()',2000);
                                 layer.msg('添加失败',{time:1000})
                               }
                            },
        error:function(error){

        }

});
         return false;
    }



</script>
</html>