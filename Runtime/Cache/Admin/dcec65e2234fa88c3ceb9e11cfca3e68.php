<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
  <title>芝麻乐众筹管理后台</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/Public/css/pintuer.css">
  <script src="/Public/js/jquery-1.8.3.min.js"></script>
  <script src="/Public/js/pintuer.js"></script>
  <script src="/Public/js/respond.js"></script>
  <script src="/Public/lib/layer/layer.js"></script>
</head>
<body style="background:#fafafa;">
	<!-- 导航 -->

<div class="container-layout  bg-white border-bottom margin-bottom">
  <div class="container padding-big-top padding-big-bottom">
    <div class="x12">
      <div class="x2 ">
        <a href="javascript:void(0)">
          <span class=" text-red" style="font-size: 32px;">芝麻乐</span><span class="text-gray padding-left">众筹管理后台</span>
        </a>
      </div>
		<div class="x8  text-right float-right">			<div class="navbar-text navbar-right hidden-s">
			 <span class="padding-right"> 欢迎登录 <?php echo session('admin_username');?> ( <?php echo ($group_name); ?>  ) </span>	
			 <a href="javascript:void(0)" onclick="my_edit()" class="button button-small icon-cog bg-blue"> 设置</a>
			  <a href="/" target="_blank"  class="button button-small icon-link bg-blue"> 访问网站</a>
			 <button type="button" onclick="delcahe()" class="button button-small icon-power-off bg-blue"> 删除缓存</button>			 <button type="button" id="loginout" class="button button-small icon-power-off bg-blue"> 退出系统</button></div>
		</div>
      </div>
    </div>
  </div>
<script>	function delcahe(){		$.get("/index.php?s=/Admin/Delcahe/index",function(ret){			layer.msg(ret.info,{shift:2})		})	}
	function my_edit(id){	
		layer.open({
			type: 2,
			area: ['700px', '360px'],
			fix: true, //不固定
			maxmin: true,
			title:'用户设置',
			content: '/index.php?s=/Admin/Auth/my_edit'
		});
	}
</script>
 <div class="container">
	<div class="border x12">
    <div class="x2 bg-white border-right">	
	<div class="x12" style="min-height:800px">
	<div class="x12 border-bottom padding-bottom">
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/Item/item_add/itemid/3/set/3.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/Item/item_add/itemid/3/set/3.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
	</div>
	<div class="clearfix"></div>
		<div class="padding text-center text-small text-gray">
			<a href="http://www.zhimale.com" class=" text-gray padding-right">帮助中心</a>|
			<a href="http://www.zhimale.com" class="text-gray padding-left">联系我们</a>
			<span class="text-gray padding-top x12">ZHIMALE 版权所有</span>			<span class="text-gray padding-top x12">版本号 <?php echo ZHIMALE_V ?></span>
		</div> 
	</div>
            
    </div>
    <div class="x10 bg-white" style="min-height:680px;">
<script>

  $(function(){
    $('#loginout').click(function(){
      layer.confirm('确定要退出吗？', {icon: 3},function(){
        parent.layer.msg('退出成功!', {
          shift: 2,
          time: 1000,
          shade: [0.1,'#000'],
          end: function(){
            window.location.href = '<?php echo U('/Admin/Public/logout');?>';
          }
        });
      });
     });
  });

  //全局配置
layer.config({
    extend: [
        'extend/layer.ext.js' 
    ]
});
</script>
	<script src="/Public/lib/laydate/laydate.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/lang/zh-cn/zh-cn.js"></script>

	<div class="padding border-bottom">
		<div class="step ">
				<div class="step-bar  complete x4" ><span class="step-point icon-check"></span><span class="step-text">基本资料</span></span></div>
			<div class="step-bar complete x4" ><span class="step-point ">2</span><span class="step-text">股权设置</span></div>
			<div class="step-bar active  x4"><span class="step-point">3</span><span class="step-text">项目详情</span></div>
	
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
				<a href="/index.php?s=/Admin/Item/item_add/itemid/<?php echo ($itemid); ?>/set/2.html" class="button button-big bg-red" >上一步</a>
				<a href="javascript:void(0)" class="button button-big bg-red" onclick="save(this)">确认发布</a>
			</div>
		</div>
		<div class="x12" id="the_box"></div>
	</div>
</div>
</div>
</div>


<!-- 自己写的上传js类 百度编辑器不好用 -->
<script src="/Public/js/form.js"></script>
<script>
layer.tips("填完上面的，试试这个！","#mobanbianji")
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

	$.post('/index.php?s=/Admin/Item/item_in_third',{
		cover_img:cover_img.val(),
		prove:provearray.join(","),
		plan_file:plan_file.val(),
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