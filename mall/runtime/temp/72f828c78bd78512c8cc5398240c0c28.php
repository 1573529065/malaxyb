<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpStudy\WWW\maibao_admin\public/../application/index\view\user\money_order.html";i:1523628279;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>会员管理</title>

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

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

<div class="portlet box blue">

    <div class="portlet-title">

        <div class="caption"><i class="icon-cogs"></i>余额记录</div>


    </div>

    <div class="portlet-body no-more-tables">

        <table class="table-bordered table-striped table-condensed cf">

            <thead class="cf">

            <tr>

                <th>业务类型</th>

                <!--<th>Company</th>-->

                <th class="numeric">数额</th>

                <th class="numeric">时间</th>


            </tr>

            </thead>

            <tbody>

            <?php if(is_array($order) || $order instanceof \think\Collection || $order instanceof \think\Paginator): $i = 0; $__LIST__ = $order;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <tr style="text-align: center">
                <td data-title="业务类型">
                    <?php if($v['type'] == 1){ ?>
                    <?php echo '签到';}else if($v['type'] == 2){ echo '兑换流通资产';}
                    else if($v['type'] == 3){ echo '买入';}else if($v['type'] == 4){ echo '卖出';}else if($v['type'] == 5){ echo '加速释放';}
                    else if($v['type'] == 6){ echo '转出';}else if($v['type'] == 7){ echo '转入';}
                     if($v['target_uid'] != 0) { ?>
                    (<?php echo $v['target_uid']; ?>)
                    <?php } ?>
                </td>
                <td data-title="数额" class="numeric"><?php echo $v['bo_money']?></td>
                <td data-title="时间" class="numeric"><?php echo date('Y-m-d H:i:s', $v['bo_time']) ?></td>
            </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>

        </table>

    </div>

</div>







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
</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>