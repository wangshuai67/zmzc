<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发布的项目 - 会员中心芝麻乐开源众筹系统</title>
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



<div class="x12 padding border-bottom">
	<h1>我发布的项目</h1>
</div>
<div class="x12 text-center padding-top padding-bottom border-bottom border-top margin-top">
	<a href="<?php echo U('Item/index');?>" class='x1 <?php if(!$_GET['progress']): ?>border-right text-red<?php endif; ?>'>全部</a>
	<?php if(is_array($progresslist)): $i = 0; $__LIST__ = $progresslist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Item/index',array('progress'=>$zml['id']));?>"  class="x1 <?php if($_GET['progress'] == $zml['id']): ?>border-right text-red<?php endif; ?>"><?php echo ($zml["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zml): $mod = ($i % 2 );++$i;?><div class="x12 bg padding">
		<div class="x3 padding  bg-white"><img src="<?php echo ($zml["cover_img"]); ?>" alt="<?php echo ($zml["name"]); ?>" class="x12" height="94"></div>
		<div class="x9 bg padding bg-white border-left height-big" style="height: 114px;">
			<div>
				<span class="x6">
					<span class="text-big"><?php echo ($zml["name"]); ?><a class="text-small text-gray" href="<?php echo U('User/Item/item_add',array('itemid'=>$zml['id']));?>" class="text-gray"> 修改</a></span>
					<div class="x12 text-gray">
						<div class="x6">
							<span class="x12 text-small">融资总额: <span class="text-red">￥<?php echo ($zml["raising_money"]); ?></span></span>
						</div>
						<div class="x6">
							<span class="x12 text-small">投资方占比: <span class="text-red"><?php echo ($zml["investment_rate"]); ?>%</span></span>
						</div>
						<div class="x6">
							<span class="x12 text-small"> 已融资: <span class="text-red"> ￥<?php echo ($zml["count_money"]); ?></span></span>
						</div>
						<div class="x6">
							<span class="x12 text-small">完成率: <span class="text-red"><?php echo ($zml["success_rate"]); ?>%</span></span>
						</div>
					</div>
				</span>
				<span class="x6">
					<div class="x9">
						<button class="button radius-none bg-red button-small"><?php echo ($zml["progress_name"]); ?></button>
						<button onClick="lead(<?php echo ($zml["id"]); ?>,this)" class="button button-small radius-none bg-yellow margin-left">领投规则</button>
						<button onclick="video('<?php echo U('User/Item/item_video',array('itemid'=>$zml['id']));?>')" class="button button-small radius-none bg-sub margin-left">视频管理</button>
						
					</div>
					<div class="x3">
						<span class="x12"><a href="<?php echo U('Item/interview',array('itemid'=>$zml['id']));?>" class="button button-small bg-sub radius-none"><?php echo ($zml["interview"]); ?>位约谈</a></span>
						<span class="x12 margin-top"><a href="<?php echo U('Lead/index',array('itemid'=>$zml['id']));?>" class="button button-small bg-sub radius-none"><?php echo ($zml["countlead"]); ?>位领投</a></span>
					</div>
				</span>
			</div>
		</div>
	</div><?php endforeach; endif; else: echo "" ;endif; ?>
<div class="x12 text-center padding"><ul class="pagination border-red pagination-small"><?php echo ($page); ?></ul></div>
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
		$.get("/index.php?s=/User/Lead/lead_list/itemid/"+itemid, function(d){
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
		$.post("/index.php?s=/User/Lead/sub_lead", {
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
	function video(url){
		layer.open({
        type: 2,
        title: '提示',
        shadeClose: true,
        shade: 0.8,
        area: ['1000px', '570px'],
        content: url
      });
	}
</script>
</body>
</html>