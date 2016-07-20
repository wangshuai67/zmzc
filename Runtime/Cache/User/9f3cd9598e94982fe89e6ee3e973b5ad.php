<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html lang="zh-cn">

<head>

<title>用户登录-芝麻乐开源众筹系统</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="/Public/css/pintuer.css">

<script src="/Public/js/jquery-1.8.3.min.js"></script>

<script src="/Public/js/pintuer.js"></script>

<script src="/Public/js/respond.js"></script>

<script src="/Public/lib//layer/layer.js"></script>

</head>

<body  onkeydown="BindEnter(event)"> 



<script type="text/javascript">

function BindEnter(obj)

{

   

    if(obj.keyCode == 13)

        {

            login()

          

        }

}

</script>

	<style>

.mynav li{width: 80px;height: 36px;line-height: 36px;float: left;text-align: center;margin-right: 5px;border-radius: 3px;position: relative;display: block;}

.mynav .active{background-color: #ea544a;}

.mynav .active a{color: #fff;}

</style>

<script type="text/javascript"> 

var Sys = {};

        var ua = navigator.userAgent.toLowerCase();

        if (window.ActiveXObject){

            Sys.ie = ua.match(/msie ([\d.]+)/)[1]

            if (Sys.ie<=7){

            alert('你目前的IE版本为'+Sys.ie+'版本太低，请升级！');location.href="http://windows.microsoft.com/zh-CN/internet-explorer/downloads/ie";

            }

        }

</script> 

<div class="x12 margin-big-bottom text-little padding-small bg-black text-pale" id="top">

    <div class="container">

        <span class="x2">欢迎来到芝麻乐开源众筹系统！</span>

        <span class="x10 text-right text-pale"><?php if(session('user.uin')): ?><a href="<?php echo U('User/Index/index');?>" class="text-pale"><?php echo session('user.phone');?> 进入用户中心</a> | <a href="<?php echo U('/User/Login/logout');?>" class="text-pale">退出</a><?php else: ?></a><a href="<?php echo U('User/Login/index');?>" class="text-pale">登录</a> | <a href="<?php echo U('User/Login/reg');?>" class="text-pale">注册</a><?php endif; ?></span>

    </div>

</div>

<div class="container-layout  bg-white">

    <div class="container padding-big-top padding-big-bottom">

        <div class="x12">

            <div class="x2">

                <a href="/"><img src="/uploads/1/20151017/zmlcms_1445061661767.png" alt="芝麻乐开源众筹系统"  class="img-responsive"></a>

            </div>

            <div class="x10 padding-top">

                <div class="x8">

                    <ul class="mynav text-big float-right padding-big-right">

                        <li <?php if(CONTROLLER_NAME== 'Index'): ?>class="active"<?php endif; ?>><a href="/">首页</a></li>

                        <li <?php if(CONTROLLER_NAME== 'Item'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Home/Item/index');?>">项目</a></li>

                        <!--             <li><a href="#">动态</a></li> -->

                        <li <?php if(CONTROLLER_NAME== 'News'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Home/News/index');?>">新闻</a></li>

                    </ul>

                </div>

                <div class="x4">

                    <form id="form" action="<?php echo U('Home/Item/index');?>" method="get">

                        <div class="input-group padding-little-top">
                            <div class="field">

                                <input type="text" class="input border-red" name="search" size="30" placeholder="项目名称"/>
                            </div>

                            <span class="addbtn"><button type="submit" class="button bg-red">搜!</button></span>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function select (){

    var content = $('input[name="search"]');

    if(content.val()==''){

        layer.tips("请填写搜索内容！","#content",{

            tips: 1

        })

        content.focus();

        return false

    } 
    window.location.href="/index.php/Home/Item/index/search/"+content.val()
}

</script>

    <div class="x12 padding-large-top" style="background:url(/Template/User/default/Public/img/register_bj.jpg) center;height:500px;"  >

		<div class="container">

			<div class="x4 float-right bg-white padding-large">

				<h2 class="padding-bottom">用户登录</h2>

				<div class="form-group">

					<div class="field field-icon">	

						<span class="padding-small-top icon icon-user"></span>					

						<input type="text"  placeholder="手机号" name="phone" class="input box-shadow-none text-small input-big radius-none" />					

					</div>

				</div>

				<div class="form-group">

					<div class="field field-icon">	

						<span class="padding-small-top icon icon-key"></span>						

						<input type="password" name="pwd" placeholder="密码" class="input box-shadow-none text-small input-big radius-none" />

					</div>

				</div>

				<div class="form-group">

							

					  <div class="field field-icon">	

						<span class="padding-small-top icon icon-check-square-o"></span>

						  <input type="text " size="10" class="input radius-none input-big box-shadow-none text-small input-auto" name="verify"   placeholder="验证码" />

						  <span class="addbtn padding-left"><img src="<?php echo U('Home/Verify/index');?>" id="code" height="45"/></span>

							<a href="javascript:void(0)"  onclick="verifys('code')" class="text-blue">换一张</a>

					  </div>

					

				</div>

				<a href="javascript:void(0)"  class="x12 bg-red   text-center padding text-white text-large" onclick="login(this)">登 录</a>

				<div class="x12 margin-top">

					<span>还没有账号 ? 【<a href="/index.php?s=/User/Login/reg" class="text-blue">注册账号</a>】</span>

					<span><a href="/index.php?s=/User/Login/forgotpwd" class="text-blue">忘记密码 ? </a></span>

				</div>

			</div> 

		</div>

	</div>

	<script>

		function verifys(id){

			document.getElementById(id).src="<?php echo U('Home/Verify/index');?>&"+Math.random(); 

		}

		function login(d){

			var phone=$("input[name='phone']")

			var pwd=$("input[name='pwd']")

			var verify=$("input[name='verify']")

			if(phone.val()==''){

				layer.tips('手机号不能为空', phone);

				phone.focus();

				return false

			}

			if(pwd.val()==''){

				layer.tips('密码不能为空', pwd);

				pwd.focus();

				return false			

			}

			if(verify.val()==''){

				layer.tips('验证码不能为空', verify,{

					tips:4,

				});

				verify.focus();

				return false			

			}

			$(d).text('登录中...');

			$.post(

				"/index.php?s=/User/Login/index",

				{

					phone:phone.val(),

					pwd:pwd.val(),				

					verify:verify.val(),

				},function (data){

					if (data.status == 1) {

						window.location.href=data.url

					}else{

						layer.msg(data.info);

						$(d).text('登 录');

					}

				}

			)

		}

	</script>

	<div class="container-layout text-gray  bg-black bg-inverse padding-big-top padding-big-bottom margin-big-top" >
    <div class="container text-small">
        <div class="x10 height-big margin-bottom">
			<?php $info = D("Admin/Nav")->loadList("status =1 AND type =2 AND pid =0","");foreach ($info as $i=>$zml):$nav2=D("Admin/Nav")->loadList(array("pid"=>$zml["id"]));?><a href="<?php echo ($zml["url"]); ?>" class="padding-big-right text-gray"><?php echo ($zml["name"]); ?></a><?php endforeach ?>
        </div>
       
        <div class="x12 text-left text-little">版权所有 © 芝麻乐开源众筹系统 All Rights Reserved，赣ICP备：380959609 <a href="http://www.zhimale.com">芝麻乐</a>版权所有</div>
    </div>
</div>
<div class="fixed-bottom-right margin-right" style="width:40px;right:10px;z-index: 99999;">
<!--     <div class="x12 txt radius-small bg-red margin-small-bottom icon-qrcode text-large"></div>
    <div class="x12 txt radius-small bg-red margin-small-bottom icon-pencil-square-o text-large"></div>
    <div class="x12 txt radius-small bg-red margin-small-bottom icon-question text-large"></div> -->
    <a href="javascript:;"  onclick="slideFunction('top');"><div class="txt radius-small bg-red margin-small-bottom icon-arrow-up text-large"></div></a>
</div>


</body>

</html>