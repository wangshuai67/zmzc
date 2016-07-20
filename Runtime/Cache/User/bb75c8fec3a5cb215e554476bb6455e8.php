<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员中心 --芝麻乐开源众筹系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/Public/css/pintuer.css">
<script src="/Public/js/jquery-1.8.3.min.js"></script>
<script src="/Public/js/pintuer.js"></script>
<script src="/Public/js/respond.js"></script>
<script src="/Public/lib//layer/layer.js"></script>
</head>
<body style="background:#e7e8eb">
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
<div class="container">
<div class="x12 margin-large-top border bg-white margin-large-bottom">
	<div class="x2" style="min-height:800px">
		<div class="x12 border-bottom padding-top padding-bottom text-center ">
			<a href="/index.php?s=/User/Info"><img src="<?php if($user['header']): echo cut_image($user['header'],'90','90'); else: ?>/Template/User/default/Public/img/user-logo.jpg<?php endif; ?>" width="90" height="90" class="header radius-circle" /></a>
			<h5 class="padding"><?php echo ($phone); ?></h5>
			<?php if($user['rstatus'] == '1'): ?><div class="txt-border txt-small radius-circle border sta" data-msg="<span class='text-black'>你已通过实名认证，<a href='<?php echo U('User/Attest/index');?>' class='text-blue'>查看认证</a></span>" ><div class="txt bg-red radius-circle icon-male"></div></div>
			
			<?php else: ?>
			<div class="txt-border txt-small radius-circle border sta" data-msg="<span class='text-black'>你未通过实名认证，<a href='<?php echo U('User/Attest/index');?>' class='text-blue'>去认证</a></span>" ><div class="txt radius-circle icon-male"></div></div><?php endif; ?>
			<div class="txt-border txt-small radius-circle border sta" data-msg="<span class='text-black'>您已绑定手机，<a href='' class='text-blue'>更改</a></span>"><div class="txt radius-circle bg-red icon-tablet"></div></div>
			<a href="<?php echo U('User/Prepaid/index');?>" class="txt-border txt-small radius-circle border " ><div class="txt radius-circle bg-red ">充</div></a>
		</div>
		<div class="x12 border-bottom padding-bottom leftnav">	
			<a href="/index.php?s=/User/index" class="button x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Index and ACTION_NAME == index): ?>bg-red<?php endif; ?>"><span class="padding-left">会员中心首页<span><span class="float-right icon-angle-right"></span></a>

			<span class="button x12 bg-gray radius-none">我是项目方</span>
			<a href="<?php echo U('Item/item_add');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Item and ACTION_NAME == item_add): ?>bg-red<?php endif; ?>"><span class="padding-large-left">发布项目<span><span class="float-right icon-angle-right"></span></a>

			<a href="<?php echo U('Item/index');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Item and ACTION_NAME == index): ?>bg-red<?php endif; ?>"><span class="padding-large-left">已发布的项目<span><span class="float-right icon-angle-right"></span></a>
	
			<a href="<?php echo U('Lead/index');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Lead): ?>bg-red<?php endif; ?>"><span class="padding-large-left">领投管理<span><span class="float-right icon-angle-right"></span></a>

			<a href="<?php echo U('Item/interview');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Item and ACTION_NAME == interview): ?>bg-red<?php endif; ?>"><span class="padding-large-left">约谈管理<span><span class="float-right icon-angle-right"></span></a>
			
			<span class="button x12 bg-gray radius-none">我是投资方</span>

			<a href="<?php echo U('Investor/collect_item');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Investor and ACTION_NAME == collect_item): ?>bg-red<?php endif; ?>"><span class="padding-large-left">我收藏的项目<span><span class="float-right icon-angle-right"></span></a>
			<a href="<?php echo U('Investor/with_item');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Investor and ACTION_NAME == with_item): ?>bg-red<?php endif; ?>"><span class="padding-large-left">我投资的项目<span><span class="float-right icon-angle-right"></span></a>
			<a href="<?php echo U('Investor/interview_item');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Investor and ACTION_NAME == interview_item): ?>bg-red<?php endif; ?>"><span class="padding-large-left">我约谈的项目<span><span class="float-right icon-angle-right"></span></a>
			<a href="<?php echo U('Investor/lead');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Investor and ACTION_NAME == lead): ?>bg-red<?php endif; ?>"><span class="padding-large-left">我领投的项目<span><span class="float-right icon-angle-right"></span></a>

			<span class="button x12 bg-gray radius-none">资金管理</span>

			<a href="<?php echo U('User/Funds/money_details');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Funds and ACTION_NAME == money_details): ?>bg-red<?php endif; ?>"><span class="padding-large-left">资金明细<span><span class="float-right icon-angle-right"></span></a>
			<a href="<?php echo U('User/Funds/payment_details');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Funds and ACTION_NAME == payment_details): ?>bg-red<?php endif; ?>"><span class="padding-large-left">充值记录<span><span class="float-right icon-angle-right"></span></a>
			<a href="<?php echo U('User/Prepaid/index');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Prepaid and ACTION_NAME == index): ?>bg-red<?php endif; ?>"><span class="padding-large-left">我要充值<span><span class="float-right icon-angle-right"></span></a>

			<span class="button x12 bg-gray radius-none">个人中心</span>

			<a href="<?php echo U('Attest/index');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Attest): ?>bg-red<?php endif; ?>"><span class="padding-large-left">我的认证<span><span class="float-right icon-angle-right"></span></a>
			<a href="<?php echo U('Info/index');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Info and ACTION_NAME == index): ?>bg-red<?php endif; ?>"><span class="padding-large-left">账号设置<span><span class="float-right icon-angle-right"></span></a>
			<a href="<?php echo U('Dolog/index');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Dolog): ?>bg-red<?php endif; ?>"><span class="padding-large-left">消息中心<span><span class="badge bg-dot float-right"><?php echo doLog();?>条未读</span></a>
			<a href="<?php echo U('Bank/index');?>" class="button button-small x12 border-none radius-none padding <?php if(CONTROLLER_NAME == Bank): ?>bg-red<?php endif; ?>"><span class="padding-large-left">银行卡管理<span></a>
		</div>	
	</div>
	<script type="text/javascript">
		$(".sta").each(function(e){
			var msg=$(this).attr('data-msg');
			$(this).on("mouseover mouseout",function(event){
 			if(event.type == "mouseover"){
 				 var ii=layer.tips(msg, $(this), {
    				tips: [2,'#fff']
				});	
 			}else if(event.type == "mouseout"){
  				layer.close(ii)
			 }
			})			
						
		})
	</script>
<div class="x10  border-left" style="min-height:800px;">


<div class="x12 padding border-bottom height-big">
	<h5>基本信息</h5>	
</div>
<div class="clearfix"></div>
<div class="padding  x12">
	<div class="border x12">
	<div class="bg padding ">用户基本信息</div>	
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2">昵称</span>
			<span class="x9">
			<span  onclick="edit('name','<?php echo ($user["name"]); ?>',this)">
			<?php if($user['name']): echo ($user["name"]); ?>
			<?php else: ?>
				未知<?php endif; ?>
			<i class="text-gray">(点击修改)</i>
			</span>
			</span>
			
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2">手机号</span>
			<span class="x9" id="domain"><?php echo ($user["phone"]); ?></span>
			<a href="/index.php?s=/User/Info/edit_phone" class="text-blue" >修改</a>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2">头像</span>
			<span class="x9"><img src="<?php if($user['header']): echo cut_image($user['header'],'90','90'); else: ?>/Template/User/default/Public/img/user-logo.jpg<?php endif; ?>" class="header" height="90" /></span>
			<a class="input-file text-blue" href="javascript:void(0);">	
				上传
				<input size="100" type="file" id='fileupload' name='upfile' />
			</a>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2">年龄</span>
			<span class="x9" id="title">
			<span  onclick="edit('age','<?php echo ($user["age"]); ?>',this)">
			<?php if($user['age']): echo ($user["age"]); ?>
			<?php else: ?>
				未知<?php endif; ?>
			<i class="text-gray">(点击修改)</i>
			</span>
			</span>
		
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2">性别</span>
			<span class="x9" >
				<label> <input type="radio" onclick="savesex('0',this)" name="sex" value="0" <?php if($user['sex'] == '0'): ?>checked<?php endif; ?> /> 未知 </label>
				<label> <input type="radio" onclick="savesex('1',this)" name="sex" value="0" <?php if($user['sex'] == '1'): ?>checked<?php endif; ?> /> 男 </label>
				<label> <input type="radio" onclick="savesex('2',this)" name="sex" value="0" <?php if($user['sex'] == '2'): ?>checked<?php endif; ?> /> 女 </label>
			</span>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2">住所</span>
			<span class="x9" id="desc">
				<select name="province" class="input input-auto"  id="province" onchange="loadRegion('province',2,'city','/index.php?s=/User/Region/index');">
				<option value="" >省份/直辖市</option>
				<?php if(is_array($prove)): $i = 0; $__LIST__ = $prove;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($user['province'] == $vo['id']): ?>selected<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<select name="city" class="input input-auto " id="city" data-validate="required:请选择城市"  onchange="loadRegion('city',3,'area','/index.php?s=/User/Region/index');">
			
					<option value="<?php echo ($user["city"]); ?>"><?php echo ($user["cityname"]); ?></option>
				</select>
				<select name="area" class="input input-auto" data-validate="required:请选择镇区" id="area">			
						<option value="<?php echo ($user["area"]); ?>"><?php echo ($user["areaname"]); ?></option>
				</select>		
				<input type="text" class="input input-auto" value="<?php echo ($user["address"]); ?>" id="address" name="address" />		
			</span>
			<a href="###" class="text-blue"  onclick="saveaddress(this)">保存修改</a>
		</div>
		<div class="height-large padding   x12">
			<span class="text-gray x2">注册时间</span>
			<span class="x9" ><span class="text-gray"><?php echo date('Y-m-d',$user['create_time']);?> </span></span>
		</div>
		
	</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
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

<script src="/Public/js/form.js"></script>
<script src="/Public/lib/region.js"></script>
<script>
function saveaddress(d){
	var prov=$("#province").val();
	var city=$("#city").val();
	var area=$("#area").val();
	var address=$("#address").val();
	$.post('/index.php?s=/User/Info/edit',{province:prov,city:city,area:area,address:address},function(e){
		$("#address").val(address);
		layer.msg('更新成功', {shift: 2});
	})
}
function edit(name,id,d){
	var html='<input type="text" name="'+name+'" class="input input-auto" size="20" value='+id+' /> <button class="button" type="button" onclick="save(\''+name+'\',this)">保存</button>';
	$(d).parent().html(html);
}
function save(name,d,value){
	var v=$(d).siblings('input[name="'+name+'"]').val();
	if(name=='name'){
		$.post('/index.php?s=/User/Info/edit',{name:v},function(e){
			if(e.status=1){
				$(d).parent().text(v);
				layer.msg('更新成功', {shift: 2});
			}else{
				$(d).parent().text(v);
				layer.msg('更新失败', {shift: 2});
			}
		})
	}else if(name=='age'){
		$.post('/index.php?s=/User/Info/edit',{age:v},function(e){
			if(e.status=1){
				$(d).parent().text(v);
				layer.msg('更新成功', {shift: 2});
			}else{
				$(d).parent().text(v);
				layer.msg('更新失败', {shift: 2});
			}
		})
	}else if(name=='header'){
		$.post('/index.php?s=/User/Info/edit',{header:value},function(e){
			if(e.status=1){
				layer.msg('更新成功', {shift: 2});
			}else{
				layer.msg('更新失败', {shift: 2});
			}
		})
	}
}
function savesex(v,d){
	$.post('/index.php?s=/User/Info/edit',{sex:v},function(e){
			if(e.status=1){
				layer.msg('更新成功', {shift: 2});
			}else{
				layer.msg('更新失败', {shift: 2});
			}
	})
}

$(function () {
	var bar = $('.bar');
	var percent = $('.jindu');
	var showimg = $('.content');
	var progress = $(".jindu");
	var files = $(".files");
	var btn = $(".btn span");
	$("#fileupload").wrap("<form id='myupload' action='/Admin/Upload' method='post' enctype='multipart/form-data'></form>");
    $("#fileupload").change(function(){
		$("#myupload").ajaxSubmit({
			dataType:  'json',
			beforeSend: function() {
        		var index = layer.load(1, {
					shade: [0.1,'#fff'] //0.1透明度的白色背景
				});
    		},
			success: function(data) {
				if(data.status==0){
					layer.open({
						content:data.info,
						btn:['好的'],
						yes:function(){
							layer.closeAll()
						}
					})
				}else{
					var img = data.url;
					$(".header").attr('src',img);
					save('header','header',''+img+'');
					layer.closeAll()
					
				}
			}
		});
	});
	
});	

</script>
</body>
</html>