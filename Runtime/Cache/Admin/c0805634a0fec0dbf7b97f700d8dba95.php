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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/Item/item_add/itemid/3.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/Item/item_add/itemid/3.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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

<div class="padding border-bottom">
	<div class="step">
	 <div class="step-bar active x4" ><span class="step-point icon-check"></span><span class="step-text">基本资料</span></span></div>
	 <div class="step-bar x4"><span class="step-point">2</span><span class="step-text">股权设置</span></div>
	 <div class="step-bar x4" ><span class="step-point">3</span><span class="step-text">项目详情</span></div>

	</div>
</div>
<div class="clearfix"></div>
<div class="padding  x12">
	<div class="border x12">
	<div class="bg padding "><strong>发起项目</strong></div>	
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2"><span class="text-red">*</span> 行业类别</span>
			<span class="x9">
				<select name="cid[]" class="input input-auto box-shadow-none radius-none"  id="first" onchange="loadRegion('first',2,'second','/index.php?s=/Admin/Item/get_category');">
				<option value="" >选择栏目</option>
				<?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $nowcate[0]['id']): ?>selected<?php endif; ?>  ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				<select name="cid[]" class="input input-auto box-shadow-none radius-none" id="second"  onchange="loadRegion('second',3,'third','/index.php?s=/Admin/Item/get_category');">
					<?php if($nowcate[1]['id']): ?><option value="<?php echo ($nowcate[1]['id']); ?>"><?php echo ($nowcate[1]['name']); ?></option>
					<?php else: ?>
						<option value="0">无</option><?php endif; ?>
				</select>
			</span>
			
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2"><span class="text-red">*</span> 标签</span>
			<span class="x9" >
			  <div class="field">
				<div class="button-group checkbox">
				<?php if(is_array($tags)): $i = 0; $__LIST__ = $tags;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="button radius-none margin-small <?php if(in_array($vo['id'],$tagsid)): ?>active<?php endif; ?>" onclick="choosetags(this)">
					<input name="tags[]" value="<?php echo ($vo["id"]); ?>" <?php if(in_array($vo['id'],$tagsid)): ?>checked="checked"<?php endif; ?> type="checkbox" /><span class="icon icon-check text-red"></span> <?php echo ($vo["name"]); ?>
				  </label><?php endforeach; endif; else: echo "" ;endif; ?> 
				</div>
			  </div>
			</span>
			
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2"><span class="text-red">*</span> 项目名称</span>
			<span class="x9">
				<input type="text" name="name" value="<?php echo ($item["name"]); ?>" class="input box-shadow-none radius-none" />
			</span>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2"><span class="text-red">*</span> 用户UIN</span>
			<span class="x9">
				<input type="text" name="uin" value="<?php echo ($item["uin"]); ?>" class="input input-auto box-shadow-none radius-none" />
				<button class="button bg-sub radius-none" type="button" onclick="getuser()">获取用户列表</button>
				 <div class="input-note">帮用户发布项目请填写用户的UIN，平台方自己发布可以普通用户的方式注册一个账号获得UIN</div>
			</span>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2"><span class="text-red">*</span> 项目简介</span>
			<span class="x9">
				<input type="text" name="desc" value="<?php echo ($item["desc"]); ?>" class="input box-shadow-none radius-none" />
			</span>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2"><span class="text-red">*</span>  筹资金额</span>
			<span class="x9">
				<input type="text" name="raising_money" value="<?php echo ($item["raising_money"]); ?>" placeholder="如：100000" class="text-small input input-auto box-shadow-none radius-none" size="20" /> 元
			</span>
		</div>
		
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x2"><span class="text-red">*</span>  筹资结束时间</span>
			<span class="x9">
				<input type="text" name="end_time" placeholder="请选择" value="<?php if($item['end_time']): echo date('Y-m-d H:i:s',$item['end_time']); endif; ?>"  onclick="laydate({istime: true, min: laydate.now(), format: 'YYYY-MM-DD hh:mm:ss'})" class="text-small input input-auto box-shadow-none radius-none" size="20" /> 
			</span>
		</div>
		
		<div class="x12 padding text-center">
			<a href="javascript:void(0)" class="button button-big bg-red" onclick="add_item(this)">下一步</a>
		</div>
		
	</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>

<script>

function getuser(){

      layer.open({
        type: 2,
        title: '选择用户',
        shadeClose: true,
        shade: 0.8,
        area: ['1000px', '570px'],
        content: '<?php echo U('/Admin/User/index/getuser/ok');?>'
   
    });
}
function choosetags(d){
	var c=$("input[name='tags[]']:checked");
	if(c.length > 3){
		$(d).find('input[name="tags[]"]').attr('checked',false);
		layer.msg('最多可以选择3个标签');
	}
}
function add_item(d){
	var cids=$("select[name='cid[]']");
	var tags=$("input[name='tags[]']:checked");
	var name=$("input[name='name']");
	var raising_money=$("input[name='raising_money']");
	var desc=$("input[name='desc']");
	var uin=$("input[name='uin']");
	var end_time=$("input[name='end_time']");
	var cid=new Array();
	var tag=new Array();
	cids.each(function(){
		cid.push($(this).val());	
		
	})
	if(cids.val()==''){
		layer.tips('选择一个行业类别',cids);
		cids.focus()
		return false
	}
	if(uin.val()==''){
		layer.tips('请先选择一个用户',uin);
		uin.focus()
		return false
	}
	if(desc.val()==''){
		layer.tips('简介还是要一个吧',desc);
		desc.focus();
		return false
	}
	//取CID最后一个不为0的id值
	var last = cid[cid.length - 1];
	if(last=='0'){
		last = cid[cid.length - 2];
		if(last=='0'){
			last = cid[cid.length - 3];
		}
	}
	tags.each(function(){
		tag.push($(this).val());
	})
	if(name.val()==''){
		layer.tips('项目名不能为空',name);
		name.focus()
		return false
	}
	if(raising_money.val()==''){
		layer.tips('筹资金额是一个数字喔',raising_money);
		raising_money.focus()
		return false
	}
	if(end_time.val()==''){
		layer.tips(' 筹资结束时间不能为空',end_time);
		end_time.focus()
		return false
	}
		<?php if($itemid): ?>var type=<?php echo ($itemid); ?>;
		<?php else: ?>
		var type="add";<?php endif; ?>
	
	$.post('/index.php?s=/Admin/Item/item_in',{
		name:name.val(),
		cid:last,
		tag:tag.join(','),
		raising_money:raising_money.val(),
		end_time:end_time.val(),
		uin:uin.val(),
		type:type,
		desc:desc.val(),
	},function(data){
		if(data.status==1){
			window.location.href=data.url	
		}else{
			console.log(data)
			layer.msg(data.info)
		}
	})
}
</script>

<script src="/Public/lib/laydate/laydate.js"></script>
<script src="/Public/lib/region.js"></script>

</body>
</html>