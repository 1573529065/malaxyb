<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:63:"/home/wwwroot/default/hpay_admin/thinkphp/tpl/dispatch_jump.tpl";i:1510659424;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="http://apps.bdimg.com/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
    <title>跳转提示</title>
    <style type="text/css">
        *{ padding: 0; margin: 0; }
        body{ background: #fff; font-family: "Microsoft Yahei","Helvetica Neue",Helvetica,Arial,sans-serif; color: #333; font-size: 16px; }
        .system-message{ padding: 24px 48px; }
        .system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
        .system-message .jump{ padding-top: 10px; }
        .system-message .jump a{ color: #333; }
        .system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px; }
        .system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display: none; }
        #overlay {  background: #000;  display: none;  filter: alpha(opacity=50); /* IE的透明度 */  opacity: 0.5;  /* 透明度 */  position: absolute;  top: 0;  left: 0;  width: 100%;  height: 100%;  z-index: 100; /* 此处的图层要大于页面 */  }
        .alert{  width:310px; z-index:101;position:absolute;  top:-40%;  left:50%;  margin: -101px 0 0 -151px; border: 1px solid #e5e5e5;border-radius: 4px; }
        .alert h2{  height:40px;  padding-left:8px; font-size:14px;  background:#ffffff;  text-align:left;  line-height:40px;  border-bottom: 1px solid #e5e5e5;position: relative}
        .alert .top{  position: absolute;right: 5px;top:0;text-decoration:none;font-size: 26px;color: #cccccc;}
        .alert .alert_con{  background:#fff;  height:160px;  }
        .alert .alert_con p{  color:#000;  line-height:90px;  }
        .alert .alert_con #ds{  text-align: center }
        .alert .alert_con #ts{   padding-left:8px; border-bottom: 1px solid #e5e5e5;}
        .alert .alert_con .btn{  padding:3px 10px;  color:#fff;  cursor:pointer;  background:#72D1FF;  border:1px solid #72D1FF;  border-radius:4px;  }
        .alert .alert_con .btn:hover{  background:#4FB2EF;  border:1px solid #4FB2EF;  border-radius:4px;  }
    </style>
</head>
<body>
    <div class="system-message">
        <div id="overlay"></div>
        <div class="alert" id="alert" style="display:none">
            <h2>消息</h2>
            <a href="javascript:;" class="top">&#215;</a>
            <div class="alert_con">
                <p id="ts"><?php echo(strip_tags($msg))?></p>
                <p id="ds" style="line-height:70px"><a class="btn">确定</a></p>
            </div>
        </div>



        <?php switch ($code) { case 1:?>

        <script type="text/javascript">
            function is_to(){
                setTimeout(function (){window.location.href="<?php echo($url); ?>"}, 310);
            }
            $(".btn").click(function(){is_hide();hideOverlay();is_to()});
            $(".top").click(function(){is_hide();hideOverlay();is_to()});
            function is_hide(){ $(".alert").animate({"top":"-40%"}, 300) }
            function is_show(){ $(".alert").show().animate({"top":"45%"}, 300) }
            function showOverlay() {
                $("#overlay").height(pageHeight());
                $("#overlay").width(pageWidth());

                // fadeTo第一个参数为速度，第二个为透明度
                // 多重方式控制透明度，保证兼容性，但也带来修改麻烦的问题
                $("#overlay").fadeTo(200, 0.5);
            }
            /* 隐藏覆盖层 */
            function hideOverlay() {
                $("#overlay").fadeOut(200);
            }
            /* 当前页面高度 */
            function pageHeight() {
                return document.body.scrollHeight;
            }
            /* 当前页面宽度 */
            function pageWidth() {
                return document.body.scrollWidth;
            }


            showOverlay();
            is_show();
            $(document).bind('click', function(e) {
                var e = e || window.event;
                var elem = e.target || e.srcElement;
                while (elem) {
                    if (elem.id && elem.id == 'alert') {
                        return;
                    }
                    elem = elem.parentNode;
                }
                is_hide();hideOverlay();is_to();
            });
        </script>

            <?php break;case 0:?>

        <script type="text/javascript">
            function is_to(){
                setTimeout(function (){history.go(-1);}, 310);
            }
            $(".btn").click(function(){is_hide();hideOverlay();is_to()});
            $(".top").click(function(){is_hide();hideOverlay();is_to()});
            function is_hide(){ $(".alert").animate({"top":"-40%"}, 300) }
            function is_show(){ $(".alert").show().animate({"top":"45%"}, 300) }

            function showOverlay() {
                $("#overlay").height(pageHeight());
                $("#overlay").width(pageWidth());

                // fadeTo第一个参数为速度，第二个为透明度
                // 多重方式控制透明度，保证兼容性，但也带来修改麻烦的问题
                $("#overlay").fadeTo(200, 0.5);
            }
            /* 隐藏覆盖层 */
            function hideOverlay() {
                $("#overlay").fadeOut(200);
            }
            /* 当前页面高度 */
            function pageHeight() {
                return document.body.scrollHeight;
            }
            /* 当前页面宽度 */
            function pageWidth() {
                return document.body.scrollWidth;
            }
            showOverlay();
            is_show();
            $(document).bind('click', function(e) {
                var e = e || window.event;
                var elem = e.target || e.srcElement;
                while (elem) {
                    if (elem.id && elem.id == 'alert') {
                        return;
                    }
                    elem = elem.parentNode;
                }
                is_hide();is_to();hideOverlay();
            });
        </script>

            <?php break;} ?>







        <p class="detail"></p>
        <p class="jump">
            <a id="href" href="javascript:;"></a>
        </p>
    </div>
    <script type="text/javascript">
        (function(){
            var wait = document.getElementById('wait'),
                href = document.getElementById('href').href;
            var interval = setInterval(function(){
                var time = --wait;
                if(time <= 0) {
                    location.href = href;
                    clearInterval(interval);
                };
            }, 1000);
        })();


    </script>
</body>
</html>
