<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>会员中心芝麻乐开源众筹系统</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/Public/css/pintuer.css">
	<script src="/Public/js/jquery-1.8.3.min.js"></script>
	<script src="/Public/js/pintuer.js"></script>
	<script src="/Public/js/respond.js"></script>
	<script src="/Public/lib/layer/layer.js"></script>
	<script src="/Public/lib/laydate/laydate.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/lang/zh-cn/zh-cn.js"></script>

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



	<div class="padding border-bottom">
		<div class="step ">
			<div class="step-bar  complete" style="width:25%;"><span class="step-point icon-check"></span><span class="step-text">基本资料</span></span></div>
			<div class="step-bar complete" style="width:25%;"><span class="step-point ">2</span><span class="step-text">股权设置</span></div>
			<div class="step-bar active" style="width:25%;"><span class="step-point">3</span><span class="step-text">项目详情</span></div>
			<div class="step-bar" style="width:25%;"><span class="step-point">4</span><span class="step-text">审核</span></div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="padding  x12">
		<div class="border x12">
			<div class="padding border-bottom border-dashed x12">
				<span class="text-gray x2 text-right padding-right" ><span class="text-red">*</span> 项目封面图 :</span>
				<span class="x10">
					<a class="button bg-blue button-small radius-none x2 text-center" href="javascript:void(0);" onclick="upImage2()" id="fengmiantu">+ 上传项目封面图</a>
					<span class="text-small  text-gray padding-big-left">允许上传：jpg,png,bmp,gif 大小在2MB以内，建议尺寸1190 x 450 像素</span>
					<div class="x12 padding border pic">
						<?php if($item['cover_img']): ?><div class="text-center" style="background:url('<?php echo ($item["cover_img"]); ?>') center; width:100px; height:90px; margin:3px;float:left;"> <input type="hidden" name="cover_img" value='<?php echo ($item["cover_img"]); ?>' /></div><?php endif; ?>
					</div>
					<textarea class="hidden" id="upload_ue2"></textarea>
				</span>
			</div>		
			<div class=" padding border-bottom  border-dashed x12">
				<span class="text-gray x2 text-right padding-right"><span class="text-red">*</span> 证件提交 :</span>
				<span class="x10">	
					<span>
						<a class="button bg-blue x2 text-center  button-small radius-none" id="zhengjian" href="javascript:void(0);" onclick="upImage('zhengjian')">+ 上传证件</a>
						<span class="text-small x10 padding-big-left text-gray">你可以批量上传 法定代表人身份证、法定代表个人信用报告、营业执照、营业执照副本、税务登记证、税务登记证副本、组织机构代码证、组织机构代码证副本、公司照片、场地租凭合同、财务报表 </span>
					</span>
					<div class="x12 padding border zhengjian">
						<?php if(is_array($item["prove"])): $i = 0; $__LIST__ = $item["prove"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><div class="text-center" style="background:url(<?php echo ($zml["url"]); ?>) center; width:100px; height:90px; margin:3px;float:left;">
								<a href="javascript:void(0)" class="text-center bg-red text-white text-small  x12" style="margin-top:75px;background-color:rgba(0,0,0,0.3);" onclick="delpic(this,'zhengjian')">删除</a>
							 	<input type="hidden" name="prove[]" value='<?php echo ($zml["url"]); ?>' />
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<textarea class="hidden" id="upload_ue"></textarea>
				</span>
			</div>
			<div class=" padding border-bottom  border-dashed x12">
				<span class="text-gray x2 text-right padding-right"><span class="text-red">*</span> 项目计划书 :</span>
				<span class="x10">	
					<span>
						<a class="button bg-blue button-small radius-none x2 text-center input-file" href="javascript:void(0);" id="jihuashu">+ 上传项目计划书<input size="100" name="plan_files" id="fileupload" type="file" /></a>
						<span class="text-small  text-gray padding-big-left">允许上传：doc , zip , xls ，PDF ，ppt 等格式 文件</span>
					</span>
					<div class="x12 padding border jihuanshu">
						<?php if($item['plan_file']): ?><a href="<?php echo ($item["plan_file"]); ?>" class="button bg-green icon-cloud-download">下载附件</a><input type="hidden" name="plan_file" value="<?php echo ($item["plan_file"]); ?>"/><?php endif; ?>
					</div>

				</span>
			</div>
			<div class=" padding border-bottom  border-dashed x12">
				<span class="text-gray x2 text-right padding-right">
					<span class="text-red">*</span> 项目详情 :<br />
					<!--<a href="javascript:void(0)" id="mobanbianji" class="bg-red button x12 margin-top text-center" onclick="tpl(this)">模板编辑</a>-->
				</span>
				<span class="x10" onclick="asc()">				
					<textarea  name="content" id="financing_plan" style="width:100%;height:300px;" ><?php echo ($item["content"]); ?></textarea>
				</span>
			</div>

			<div class="x10 padding text-center">
				<a href="/index.php?s=/User/Item/item_add/itemid/<?php echo ($itemid); ?>/set/2.html" class="button button-big bg-red" >上一步</a>
				<a href="javascript:void(0)" class="button button-big bg-red" onclick="save(this)">提交审核</a>
			</div>
		</div>
		<div class="x12" id="the_box"></div>
	</div>
</div>
</div>
</div>

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

<!-- 自己写的上传js类 百度编辑器不好用 -->
<script src="/Public/js/form.js"></script>
<script>
//layer.tips("填完上面的，试试这个！","#mobanbianji")
var c=UE.getEditor('financing_plan',{
	serverUrl:'<?php echo U("Admin/Upload/index");?>',
	toolbars:[[
	'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain','forecolor', 'backcolor', 
	'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', 'touppercase', 'tolowercase', 
	'link', 'unlink','imagenone', 'imageleft', 'imageright', 'imagecenter',
	'simpleupload', 'insertimage', 'map','fullscreen'
	]]
});
var imgid = '';
var html='';
    //上传证件
    var _editor = UE.getEditor('upload_ue',{
    	serverUrl:'<?php echo U("Admin/Upload/index");?>',
    	toolbars:[[
    	'insertimage', 
    	]]
    });
    // 上传证件成功
    _editor.ready(function () {
    	html= $(".zhengjian").html() //获取证件初始数据防止修改替换数据库中的证件资料
        _editor.hide();
        _editor.addListener('beforeInsertImage', function (t, arg) {     //侦听图片上传		
        	for(var i in arg){
        		html=html+'<div class="text-center" style="background:url('+arg[i].src+') center; width:100px; height:90px; margin:3px;float:left;"><a href="javascript:void(0)" class="text-center bg-red text-white text-small  x12" style="margin-top:75px;background-color:rgba(0,0,0,0.3);" onclick="delpic(this,\'zhengjian\')">删除</a> <input type="hidden" name="prove[]" value='+arg[i].src+' /></div>';
        	}
        	$("."+imgid).html(html);
        	$("."+imgid).removeClass('hidden');
        })
        _editor.addListener('afterUpfile', function (t, arg) {
        	console.log(arg)
        	var filehtml='<a href="'+arg[0].src+'" class="button bg-blue">下载文件</a>'
        	$(".jihuanshu").html(filehtml)
        	$(".jihuanshu").removeClass('hidden');
        })
    });
	//上传封面图片
	var _editor2 = UE.getEditor('upload_ue2',{
		serverUrl:'<?php echo U("Admin/Upload/index");?>',
		toolbars:[[
		'insertimage', 
		]]
	});
	// 上传封面图片成功
	_editor2.ready(function () {
		_editor2.hide();
        _editor2.addListener('beforeInsertImage', function (t, arg) {     //侦听图片上传		
        	html2='<div class="text-center" style="background:url('+arg[0].src+') center; width:100px; height:90px; margin:3px;float:left;"> <input type="hidden" name="cover_img" value='+arg[0].src+' /></div>';
        	$(".pic").html(html2);
        	$(".pic").removeClass('hidden');
        })
    });
	function upImage2() {
		var myImagew = _editor2.getDialog("insertimage");
		myImagew.open();
	}
	function upImage(as) {
      	//console.log(as);
      	imgid = as;
      	var myImage = _editor.getDialog("insertimage");
      	myImage.open();
  	}
  	function delpic(d,b){
  		$(d).parent().remove();
  		html='';
  		html=$("."+b).html();
  	}
  	//上传附件 计划书
    $(function () {
      	$("#fileupload").wrap("<form id='myupload' action='/Admin/Upload/index' method='post' enctype='multipart/form-data'></form>");
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
      					var filename = data.original;
      					var filehtml='<a href="'+img+'" class="button bg-green icon-cloud-download"> '+filename+'</a><input type="hidden" name="plan_file" value="'+img+'"/>'
      					$(".jihuanshu").html(filehtml)
      					$(".jihuanshu").removeClass('hidden');
      					layer.closeAll()
      				}
      			}
      		});
      	});
    });
$(".itembox").on("click",function(a){
	c.execCommand("insertHtml",$(this).html())
})
var asb = '';
//点击弹出编辑框
function tpl(a){
	asb = c.getContent();
	layer.open({
		type: 2,
		area: ['90%', '530px'],
	    fix: false, //不固定
	    maxmin: true,
	    content: '/User/Item/item_add_diy' //iframe的url
	});
}
function save(d){
	var cover_img=$('input[name="cover_img"]'); //封面图片
	var prove=$('input[name="prove[]"]');//证件图片 array
	var plan_file=$('input[name="plan_file"]');//项目计划书
	var video=$('input[name="video"]'); //预热视频
	var content = c.getContent(); //预热视频
	if(cover_img.length == 0){
		layer.tips("请上传封面图","#fengmiantu")
		slideFunction('fengmiantu')
		return false
	}
	if(prove.length == 0){
		layer.tips("请上传证件图","#zhengjian")
		slideFunction('zhengjian')
		return false
	}
	if(plan_file.val()==''){
		layer.tips("请上传项目计划书","#jihuashu")
		slideFunction('jihuashu')
		return false
	}
	if(content==''){
		layer.msg('项目详情不能为空',{shift: 6});
		content.focus();
		return false
	}
	//遍历所有证件url
	var provearray = new Array();
	$(prove).each(function(i,v){
		provearray.push($(v).val());
	})

	$.post('/index.php?s=/User/Item/item_in_third',{
		cover_img:cover_img.val(),
		prove:provearray.join(","),
		plan_file:plan_file.val(),
		video:video.val(),
		content:content,
		id:<?php echo ($itemid); ?>,
	},function(data){
		if(data.status==1){
			window.location.href=data.url	
		}else{
			layer.msg(data.info);
		}
	})	
}
//如果有默认值 赋值

</script>
</body>
</html>