<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:103:"D:\phpStudy\PHPTutorial\WWW\malaxyb\mubei_admin\public/../application/index\view\user\change_lunbo.html";i:1525949358;}*/ ?>

<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>Metronic | Form Stuff - Form Components</title>

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

    <!--<link href="__static__/media/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>-->

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

    <link rel="stylesheet" type="text/css" href="__static__/bianji/styles/simditor.css" />
    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="__static__/bianji/scripts/module.min.js"></script>
    <script type="text/javascript" src="__static__/bianji/scripts/hotkeys.min.js"></script>
    <script type="text/javascript" src="__static__/bianji/scripts/uploader.min.js"></script>
    <script type="text/javascript" src="__static__/bianji/scripts/simditor.min.js"></script>

    <!-- END PAGE LEVEL STYLES -->

    <link rel="shortcut icon" href="__static__/media/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

<!-- BEGIN HEADER -->



<!-- END HEADER -->

<!-- BEGIN CONTAINER -->

<div class="page-container row-fluid">




                <div class="portlet box blue">

                    <div class="portlet-title">
                        <div class="caption"><i class="icon-reorder"></i>修改轮播图</div>
                    </div>

                    <div class="portlet-body form">

                        <!-- BEGIN FORM-->

                        <form action="#" class="form-horizontal">




                            <div class="control-group">

                                <label class="control-label">上传资讯图片</label>

                                <div class="controls">

                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                        <div class="fileupload-new thumbnail" style="width: 300px; height: 150px;">

                                            <img style="width: 100%;height: 100%;"
                                                    src="<?php echo  '/new_vpay_api/public/static/uploads/'.$shop['lb_img']?>" alt="">

                                        </div>

                                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                        <div>

                                            <span class="btn btn-file"><span class="fileupload-new">选择图片</span>

													<span class="fileupload-exists">更换图片</span>

													  <input type="file" class="default" accept="image/*"  id="image" name="image"  /> </span>


                                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">删除图片</a>

                                        </div>

                                    </div>

                                </div>

                            </div>




                            <input type="hidden" value="<?php echo $shop['lb_img']?>" id="img"/>
                            <input type="hidden" value="<?php echo $shop['lb_id']?>" id="lbid"/>



                            <div class="form-actions">
                                <button type="button" class="btn blue" onclick="send()"><i class="icon-ok"></i>修改</button>


                            </div>


                        </form>

                        <!-- END FORM-->

                    </div>

                </div>

                <!-- END PORTLET-->



</div>

<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->



<!-- END FOOTER -->

<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

<!-- BEGIN CORE PLUGINS -->

<script src="__static__/media/js/jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="__static__/media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTAN__static__/T! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

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

<!-- END PAGE__static__/ LEVEL PLUGINS -->

<!-- BEGIN PA__static__/GE LEVEL SCRIPTS -->

<script src="__static__/media/js/app.js"></script>

<script src="__static__/media/js/form-components.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<script type="text/javascript" src="__static__/hui/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__static__/hui/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__static__/hui/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__static__/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
<script src="__static__/layer/mobile/layer.js"></script>
<link rel="stylesheet" href="__static__/layer/mobile/need/layer.css">



<script>

    jQuery(document).ready(function() {

        // initiate layout and plugins

        App.init();

        FormComponents.init();

    });

    function send(){
        var fileInput = document.getElementById("image");
        var file = fileInput.files[0];
        var formData = new FormData();
        formData.append("image",file);
        formData.append("images",$('#img').val());
        formData.append("nid",$('#lbid').val());
        console.log(formData);
        if(!formData){
            alert("请选择图片");
        }else{
            $.ajax({
                url: "<?php echo url('index/menu/change_lunbo'); ?>",
                type: 'POST',
                dataType: 'JSON',
                data: formData,
                cache: false,//上传文件无需缓存
                processData: false,//用于对data参数进行序列化处理 这里必须false
                contentType: false, //必须
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

                }
            });

        }

    }

</script>

<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>