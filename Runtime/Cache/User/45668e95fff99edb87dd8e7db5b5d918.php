<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员中心 --芝麻乐开源众筹系统</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/Public/css/pintuer.css">
<script src="/Public/js/jquery-1.8.3.min.js"></script>
<script src="/Public/js/respond.js"></script>
<script src="/Public/lib/layer/layer.js"></script>
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
	<div class="step">
	 <div class="step-bar complete" style="width:25%;"><span class="step-point icon-check"></span><span class="step-text">基本资料</span></span></div>
	 <div class="step-bar active" style="width:25%;"><span class="step-point">2</span><span class="step-text">股权设置</span></div>
	 <div class="step-bar" style="width:25%;"><span class="step-point">3</span><span class="step-text">项目详情</span></div>
	 <div class="step-bar" style="width:25%;"><span class="step-point">4</span><span class="step-text">发起人信息</span></div>
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
			<a href="/index.php?s=/User/Item/item_add/itemid/<?php echo ($itemid); ?>" class="button button-big bg-red" >上一步</a>
			<a href="javascript:void(0)" class="button button-big bg-red" onclick="save(this)">下一步</a>
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
	$.post('/index.php?s=/User/Item/item_in_two',{
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