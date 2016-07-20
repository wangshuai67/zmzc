<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/Item/item_add/itemid/3/set/2.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/Item/item_add/itemid/3/set/2.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
		<div class="step-bar  complete x4" ><span class="step-point icon-check"></span><span class="step-text">基本资料</span></span></div>
			<div class="step-bar active x4" ><span class="step-point ">2</span><span class="step-text">股权设置</span></div>
			<div class="step-bar  x4"><span class="step-point">3</span><span class="step-text">项目详情</span></div>
	
	</div>
</div>
<div class="clearfix"></div>
<div class="padding  x12">
	<div class="border x12">
	<div class="bg padding "><strong>股权设置</strong></div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x3 text-right padding-right"><span class="text-red">*</span> 融资总额 :</span>
			<span class="x9">
				<input type="text" name="raising_money" value="<?php echo ($item["raising_money"]); ?>" oninput="count(this)" class="input input-auto box-shadow-none radius-none" /> 元 
				(<span class="text-red">* 含项目方出资 </span>)
			</span>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x3 text-right padding-right"><span class="text-red">*</span>  项目方出资 :</span>
			<span class="x9">
				<input type="text" name="has_investment" oninput="count(this)" value="<?php echo ($item["has_investment"]); ?>" placeholder="如：100000" class="text-small input input-auto box-shadow-none radius-none" size="20" /> 元
				(<span class="text-red">* 项目方出资金额 如：已投入金额或即将投入 </span>)
			</span>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x3 text-right padding-right"><span class="text-red">*</span>  认购份数 :</span>
			<span class="x9">
				<input type="text" name="amount" oninput="count(this)" value="<?php echo ($item["amount"]); ?>" placeholder="如：199" class="text-small input input-auto box-shadow-none radius-none" size="20" /> 份
				(<span class="text-red">*认购份数=投资人出资总额/最低投资金额 </span>)
			</span>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x3 text-right padding-right"><span class="text-red">*</span>  单笔投入最低投资金额 :</span>
			<span class="x9">
				<input type="text" name="lowest_money" placeholder="" value="<?php echo ($item["lowest_money"]); ?>"  class="text-small  input input-auto box-shadow-none radius-none" readonly size="20" /> 元
				(<span class="text-red">* 投资人出资总额 /认购份数 </span>)
			</span>
		</div>
		<div class="height-large padding border-bottom x12">
			<span class="text-gray x3 text-right padding-right"><span class="text-red">*</span>  项目方收益比例 :</span>
			<span class="x2">
				<input type="text" name="project_rate"  value="<?php echo ($item["project_rate"]); ?>" placeholder="如：51" class="text-small input input-auto box-shadow-none radius-none" size="15" /> %
				
			</span>
			<span class="text-gray x2 text-right padding-right"><span class="text-red">*</span>  投资方收益比例 :</span>
			<span class="x2">
				<input type="text" name="investment_rate" value="<?php echo ($item["investment_rate"]); ?>"  placeholder="" class="text-small input input-auto box-shadow-none radius-none" readonly size="15" /> %
				
			</span>
		</div>
		<div class="x9 padding text-center">
			<a href="/index.php?s=/Admin/Item/item_add/itemid/<?php echo ($itemid); ?>" class="button button-big bg-red" >上一步</a>
			<a href="javascript:void(0)" class="button button-big bg-red" onclick="save(this)">下一步</a>
		</div>
		
	</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>

<script>
	
		$("input[name='project_rate']").bind('input propertychange', function() {
			var rates=$(this).val();
			if(rates > 0 && rates < 100){
				var investment_rate=(100 - rates).toFixed(2);			
				$("input[name='investment_rate']").val(investment_rate);
			 }else{
				$(this).val('')
				$("input[name='investment_rate']").val('');
			 }
		})
	
	function count(d){
		var rai=$('input[name="raising_money"]');
		var has=$('input[name="has_investment"]');
		var amo=$('input[name="amount"]');
		var raising=$(rai).val();
		var has_money=$(has).val();
		var qty=$(amo).val();
		$(rai).bind('input propertychange', function() {
			 raising=$(this).val();			
		})
		$(has).bind('input propertychange', function() {
			 has_money=$(this).val();			
		})
		$(amo).bind('input propertychange', function() {
			qty=$(this).val();			
		})
		
		
		
		if( raising > 0 && has_money > 0 && qty > 0){
			var lowest_money=(raising - has_money) / qty;		
			$("input[name='lowest_money']").val(lowest_money.toFixed(2));
		}
		
	}
 function save(d){
	var raising_money=$('input[name="raising_money"]');
	var has_investment=$('input[name="has_investment"]');
	var amount=$('input[name="amount"]');
	var lowest_money=$('input[name="lowest_money"]');
	var project_rate=$('input[name="project_rate"]');
	var investment_rate=$('input[name="investment_rate"]');
	if(raising_money.val()==''){
		layer.tips('融资总额不能为空',raising_money);
		raising_money.focus();
		return false
	}
	if(has_investment.val()==''){
		layer.tips('项目方出资不能为空',has_investment);
		has_investment.focus();
		return false
	}
	if(amount.val()==''){
		layer.tips('认购份数不能为空',amount);
		amount.focus();
		return false
	}
	if(lowest_money.val()==''){
		layer.tips('单笔投入最低投资金额不能为空',lowest_money);
		lowest_money.focus();
		return false
	}
	if(project_rate.val()==''){
		layer.tips('项目方收益比例不能为空',project_rate);
		project_rate.focus();
		return false
	}
	if(investment_rate.val()==''){
		layer.tips('投资方收益比例不能为空',investment_rate);
		investment_rate.focus();
		return false
	}
	$.post('/index.php?s=/Admin/Item/item_in_two',{
		raising_money:raising_money.val(),
		has_investment:has_investment.val(),
		amount:amount.val(),
		lowest_money:lowest_money.val(),
		project_rate:project_rate.val(),
		investment_rate:investment_rate.val(),
		id:<?php echo ($itemid); ?>,
		
	},function(data){
		if(data.status==1){
			window.location.href=data.url	
		}else{
			layer.msg(data.info);
		}
	
	})
	
	
 }

</script>


</body>
</html>