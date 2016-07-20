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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/Item/recycle.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/Item/recycle.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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

<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><div class="x12 bg padding">
		<div class="x3 padding  bg-white"><img src="<?php echo ($zml["cover_img"]); ?>" alt="<?php echo ($zml["name"]); ?>" class="x12" height="94"></div>
		<div class="x9 bg padding bg-white border-left height-big">
			<div><span class="x6 text-big"><a href="<?php echo U('Home/Item/info',array('id'=>$zml['id']));?>"><?php echo ($zml["name"]); ?></a></span>
			<span class="x6 text-right"><button class="button radius-none bg-red" target="_blank"><?php echo ($zml["progress_name"]); ?></button>
			<button onClick="lead(<?php echo ($zml["id"]); ?>,this)" class="button radius-none bg-yellow margin-left">设置领投规则</button>
			</div>
			<div class="x12">
				<a href="<?php echo U('Admin/Item/item_add',array('itemid'=>$zml['id']));?>" class="button button-small bg-sub radius-none">修改</a>
				<a href="javascript:void(0)" onclick="delitem('<?php echo U('Admin/Item/item_del',array('id'=>$zml['id'],'isdel'=>0));?>')" class="radius-none button button-small bg-sub">还原</a>
				<a href="javascript:void(0)" onclick="iframe('<?php echo U('Admin/Item/item_editstatus',array('itemid'=>$zml['id']));?>')" class="button button-small radius-none bg-green "> 修改项目状态</a>
				<a href="javascript:void(0)" onclick="iframe('/index.php?s=/Admin/Item/interview/itemid/<?php echo ($zml["id"]); ?>')" class="button button-small bg-sub radius-none"><?php echo ($zml["interview"]); ?> 位约谈</a>
				<a href="javascript:void(0)"   onclick="iframe('<?php echo U('Admin/Lead/index',array('itemid'=>$zml['id']));?>')" class="button button-small bg-sub radius-none"><?php echo ($zml["countlead"]); ?> 位领投</a>
			
			</div>
			<div class="x12 text-gray">
				<div class="x6">
					<span class="x12">融资总额: <span class="text-red">￥<?php echo ($zml["raising_money"]); ?></span>
					已筹款：<span class="text-red">￥<?php echo ($zml["countmoney"]); ?></span>
					</span>
				</div>
				<div class="x6">
					<span class="x6">投资方占比: <span class="text-red"><?php echo ($zml["investment_rate"]); ?>%</span></span>
					<span class="x6">项目发布者: <span class="text-red"><a href="/index.php?s=/Admin/Item/index/uin/<?php echo ($zml["uin"]); ?>" class="text-sub"><?php echo ($zml["user_name"]); ?></a></span></span>
				</div>
			</div>
		</div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="x12 text-center padding"><ul class="pagination border-red pagination-small"><?php echo ($page); ?></ul></div>
</div>
</div>
</div>
<div class="clearfix"></div>
<script>
	function delitem(url){
		layer.confirm('你确定要还原该项目吗？', {
		btn: ['确定','取消'] //按钮
	}, function(){
		$.get(url,function(ret){
			layer.msg(ret.info, {shift: 2});
			if(ret.status==1){
				window.location.reload();
			}
		})
	}, function(){
		layer.msg('你选择了取消', {shift: 6});
	});
	}
	function iframe(url){
		 layer.open({
        type: 2,
        title: '提示',
        shadeClose: true,
        shade: 0.8,
        area: ['1000px', '570px'],
        content: url
      });
	}
	function open_l(itemid,info){
		layer.open({
		    type: 1,
		    title:'设置领投规则',
		    skin: 'layui-layer-rim', //加上边框
		    area: ['600px', '450px'], //宽高
		    content: '<form class="form padding-big">'+
		    '<input type="hidden" name="itemid" value="'+itemid+'"/>'+
			'<div class="form-group">'+
				'<div class="label"><label for="manage_money">领投人管理服务费</label></div>'+
				'<div class="field field-icon-right">'+
					'<input type="text" class="input" id="manage_money" name="manage_money" value="'+info.manage_money+'" size="30" placeholder="纯数字" />'+
				'</div>'+
			'</div>'+
			'<div class="form-group">'+
				'<div class="label"><label for="num">领投人数量</label></div>'+
				'<div class="field field-icon-right">'+
					'<input type="text" class="input" id="num" name="num" size="30" value="'+info.num+'" placeholder="纯数字" />'+
				'</div>'+
			'</div>'+
			'<div class="form-group">'+
				'<div class="label"><label for="do_what">领投人义务</label></div>'+
				'<div class="field field-icon-right">'+
					'<textarea type="text" rows="5" class="input" id="do_what" name="do_what"  placeholder="领头人需要做什么">'+info.do_what+'</textarea>'+
				'</div>'+
			'</div>'+
			'<div class="form-button"><button class="button radius-none bg-red" type="button" onClick="sub(this)">提交</button></div>'+
			'</form>'
		});
	}
	
	//弹出设置层
	function lead(itemid,b){
		$.get("/index.php?s=/Admin/Lead/lead_list/itemid/"+itemid, function(d){
			if (d.status==1) {
				open_l(itemid,d.info);
			}else{
				layer.open({
				    content: d.info
				});  
			}
		});
	}
	function sub(a){
		var itemid = $('input[name="itemid"]');
		var manage_money = $('input[name="manage_money"]');
		var num = $('input[name="num"]');
		var do_what = $('textarea[name="do_what"]');
		if(manage_money.val()=='' || isNaN(manage_money.val())){
			layer.tips("纯数字填写","#manage_money",{
			    tips: 1
			})
			manage_money.focus();
			return false
		}
		if(num.val()=='' || isNaN(num.val())){
			layer.tips("纯数字填写","#num",{
			    tips: 1
			})
			num.focus();
			return false
		}
		if(do_what.val()==''){
			layer.tips("不能为空","#do_what",{
			    tips: 1
			})
			do_what.focus();
			return false
		}
		$.post("/index.php?s=/Admin/Lead/sub_lead", {
		 	itemid: itemid.val(),
		 	manage_money: manage_money.val(),
		 	num: num.val(),
		 	do_what: do_what.val(),
		},function(d){
			if (d.status == 1) {
				layer.open({
				    content: d.info,
				    yes: function(index){
				    	layer.close(index); //一般设定yes回调，必须进行手工关闭
				    	window.location.reload();
				    }
				}); 
			}else{
				alert(d.info);
			}
	   	});
	}
</script>
</body>
</html>