<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"/www/wwwroot/www.malaxyb.com/mubei_admin/public/../application/index/view/login/login.html";i:1525949356;}*/ ?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->

<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

	<meta charset="utf-8" />

	<title>Login Options</title>

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

	<link href="__static__/media/css/login-soft.css" rel="stylesheet" type="text/css"/>

	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="__static__/media/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="login">

	<!-- BEGIN LOGO -->

	<div class="logo">

		<img src="__static__/media/image/logo-big.png" alt="" />

	</div>

	<!-- END LOGO -->

	<!-- BEGIN LOGIN -->

	<div class="content">

		<!-- BEGIN LOGIN FORM -->

		<form class="form-vertical login-form" action="#">

			<h3 class="form-title">登陆</h3>

			<div class="alert alert-error hide">

				<button class="close" data-dismiss="alert"></button>

				<span>Enter any username and password.</span>

			</div>

			<div class="control-group">

				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

				<label class="control-label visible-ie8 visible-ie9">Username</label>

				<div class="controls">

					<div class="input-icon left">

						<i class="icon-user"></i>

						<input class="m-wrap placeholder-no-fix" type="text" id="user" placeholder="请输入用户名" name="username"/>

					</div>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label visible-ie8 visible-ie9">Password</label>

				<div class="controls">

					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" id="pass" placeholder="请输入密码" name="password"/>

					</div>

				</div>

			</div>

			<div class="form-actions">


				<button type="button" class="btn blue pull-right" onclick="login()">

				Login <i class="m-icon-swapright m-icon-white"></i>

				</button>            

			</div>


		</form>

		<!-- END LOGIN FORM -->        

		<!-- BEGIN FORGOT PASSWORD FORM -->


		<!-- END REGISTRATION FORM -->

	</div>

	<!-- END LOGIN -->

	<!-- BEGIN COPYRIGHT -->





	<script src="__static__/media/js/jquery-1.10.1.min.js" type="text/javascript"></script>

	<script src="__static__/media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>


	<script src="__static__/media/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

	<script src="__static__/media/js/bootstrap.min.js" type="text/javascript"></script>



	<script src="__static__/media/js/jquery.slimscroll.min.js" type="text/javascript"></script>

	<script src="__static__/media/js/jquery.blockui.min.js" type="text/javascript"></script>

	<script src="__static__/media/js/jquery.cookie.min.js" type="text/javascript"></script>

	<script src="__static__/media/js/jquery.uniform.min.js" type="text/javascript" ></script>


	<script src="__static__/media/js/jquery.validate.min.js" type="text/javascript"></script>

	<script src="__static__/media/js/jquery.backstretch.min.js" type="text/javascript"></script>



	<script src="__static__/media/js/app.js" type="text/javascript"></script>



    <script type="text/javascript" src="__static__/hui/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="__static__/hui/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="__static__/hui/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="__static__/hui/static/h-ui.admin/js/H-ui.admin.js"></script>
    <script src="__static__/layer/mobile/layer.js"></script>
    <link rel="stylesheet" href="__static__/layer/mobile/need/layer.css">

	<script>

		jQuery(document).ready(function() {     

		  App.init();

		  Login.init();

		});


        function login(){
            if(!$('#user').val() || !$('#pass').val()){
                layer.open({
                    content: '请输入用户名和密码'
                    , skin: 'msg'
                    , time: 1
                });
            }else if($('#user').val().length > 16 && $('#pass').val().length > 22 ) {
                layer.open({
                    content: '请填写正确的用户名和密码'
                    , skin: 'msg'
                    , time: 1
                });
            }else{
                $.ajax({
                    url: "<?php echo url('index/login/check_login'); ?>",
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        account: $('#user').val(),
                        pass: $('#pass').val()
                    },
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
                            setTimeout(function(){window.location.href = "<?php echo url('index/index/welcome'); ?>";},500);
                        }
                    }, fail: function (res) {

                    }
                });
            }
        }

        var Login = function () {

            return {
                //main function to initiate the module
                init: function () {

                    $('.login-form').validate({
                        errorElement: 'label', //default input error message container
                        errorClass: 'help-inline', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        rules: {
                            username: {
                                required: true
                            },
                            password: {
                                required: true
                            },
                            remember: {
                                required: false
                            }
                        },

                        messages: {
                            username: {
                                required: "Username is required."
                            },
                            password: {
                                required: "Password is required."
                            }
                        },

                        invalidHandler: function (event, validator) { //display error alert on form submit
                            $('.alert-error', $('.login-form')).show();
                        },

                        highlight: function (element) { // hightlight error inputs
                            $(element)
                                    .closest('.control-group').addClass('error'); // set error class to the control group
                        },

                        success: function (label) {
                            label.closest('.control-group').removeClass('error');
                            label.remove();
                        },

                        errorPlacement: function (error, element) {
                            error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
                        },

                        submitHandler: function (form) {
                            window.location.href = "index.html";
                        }
                    });

                    $('.login-form input').keypress(function (e) {
                        if (e.which == 13) {
                            if ($('.login-form').validate().form()) {
                                window.location.href = "index.html";
                            }
                            return false;
                        }
                    });

                    $('.forget-form').validate({
                        errorElement: 'label', //default input error message container
                        errorClass: 'help-inline', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "",
                        rules: {
                            email: {
                                required: true,
                                email: true
                            }
                        },

                        messages: {
                            email: {
                                required: "Email is required."
                            }
                        },

                        invalidHandler: function (event, validator) { //display error alert on form submit

                        },

                        highlight: function (element) { // hightlight error inputs
                            $(element)
                                    .closest('.control-group').addClass('error'); // set error class to the control group
                        },

                        success: function (label) {
                            label.closest('.control-group').removeClass('error');
                            label.remove();
                        },

                        errorPlacement: function (error, element) {
                            error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
                        },

                        submitHandler: function (form) {
                            window.location.href = "index.html";
                        }
                    });

                    $('.forget-form input').keypress(function (e) {
                        if (e.which == 13) {
                            if ($('.forget-form').validate().form()) {
                                window.location.href = "index.html";
                            }
                            return false;
                        }
                    });

                    jQuery('#forget-password').click(function () {
                        jQuery('.login-form').hide();
                        jQuery('.forget-form').show();
                    });

                    jQuery('#back-btn').click(function () {
                        jQuery('.login-form').show();
                        jQuery('.forget-form').hide();
                    });

                    $('.register-form').validate({
                        errorElement: 'label', //default input error message container
                        errorClass: 'help-inline', // default input error message class
                        focusInvalid: false, // do not focus the last invalid input
                        ignore: "",
                        rules: {
                            username: {
                                required: true
                            },
                            password: {
                                required: true
                            },
                            rpassword: {
                                equalTo: "#register_password"
                            },
                            email: {
                                required: true,
                                email: true
                            },
                            tnc: {
                                required: true
                            }
                        },

                        messages: { // custom messages for radio buttons and checkboxes
                            tnc: {
                                required: "Please accept TNC first."
                            }
                        },

                        invalidHandler: function (event, validator) { //display error alert on form submit

                        },

                        highlight: function (element) { // hightlight error inputs
                            $(element)
                                    .closest('.control-group').addClass('error'); // set error class to the control group
                        },

                        success: function (label) {
                            label.closest('.control-group').removeClass('error');
                            label.remove();
                        },

                        errorPlacement: function (error, element) {
                            if (element.attr("name") == "tnc") { // insert checkbox errors after the container
                                error.addClass('help-small no-left-padding').insertAfter($('#register_tnc_error'));
                            } else {
                                error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
                            }
                        },

                        submitHandler: function (form) {
                            window.location.href = "index.html";
                        }
                    });

                    jQuery('#register-btn').click(function () {
                        jQuery('.login-form').hide();
                        jQuery('.register-form').show();
                    });

                    jQuery('#register-back-btn').click(function () {
                        jQuery('.login-form').show();
                        jQuery('.register-form').hide();
                    });

                    $.backstretch([
                        "__static__/media/image/bg/1.jpg",
                        "__static__/media/image/bg/2.jpg",
                        "__static__/media/image/bg/3.jpg",
                        "__static__/media/image/bg/4.jpg"
                    ], {
                        fade: 1000,
                        duration: 8000
                    });
                }

            };

        }();

	</script>

	<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->

</html>