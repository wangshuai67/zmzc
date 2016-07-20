<?php if (!defined('THINK_PATH')) exit();?>
    <!-- 导航 -->
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
		<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['name']);?>" class="button  padding-top padding-big-left border-none radius-none padding-bottom x12 <?php if('/index.php?s=/Admin/News/news_add.html' == '/'.$vo['name'].'.html'): ?>bg-sub<?php endif; ?>"> <?php echo ($vo["title"]); ?> <span class="float-right icon-angle-right"></span></a>
		<?php if(is_array($vo["sub_menu"])): $i = 0; $__LIST__ = $vo["sub_menu"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U($v['name']);?>" class="padding-large-left button x12  border-none radius-none <?php if('/index.php?s=/Admin/News/news_add.html' == '/'.$v['name'].'.html'): ?>bg-sub<?php endif; ?>"><span class="padding-left"><?php echo ($v["title"]); ?><span class="float-right icon-angle-right"></span></span></a><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
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
<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/Public/lib/ueditor/lang/zh-cn/zh-cn.js"></script>
 
      <div class="x12 border-bottom padding">
        <ul class="bread">
          <li><a href="/index.php?s=/Admin/" class="icon-home"> 系统首页</a></li>
          <li><a href="/index.php?s=/Admin/News">新闻管理</a></li>
          <li>创建新闻</li>
        </ul>
      </div>
      <div class="x12 padding" >
        <form class="form-x form-block" action="#" method="post" >

          <div class="form-group x12">
            <div class="label"><label for="title">新闻标题*</label></div>
            <div class="field x5">
              <input type="text" class="input box-shadow-none radius-none" name="title" size="50"  placeholder="新闻标题" />
            </div>
          </div>

          <div class="form-group x12">
            <div class="label"><label for="author">新闻作者</label></div>
            <div class="field x5">
              <input type="text" class="input box-shadow-none radius-none" value="<?php echo session('admin_nickname');?>" name="author" size="50"  placeholder="新闻作者" />
            </div>
          </div>
          <div class="form-group x12">
            <div class="label"><label for="username">新闻分类</label></div>
            <div class="field x2">
              <select class="input box-shadow-none radius-none" name="cid" >
                <?php if(is_array($lists)): $i = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($info["cid"] == $vo["id"] ): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option>
                  <?php if(is_array($vo["lower"])): $k = 0; $__LIST__ = $vo["lower"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rs): $mod = ($k % 2 );++$k;?><option value="<?php echo ($rs["id"]); ?>" <?php if($info["cid"] == $rs["id"] ): ?>selected<?php endif; ?>>├──　　<?php echo ($rs["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
              </select>
            </div>
          </div>

          <div class="form-group x12">
            <div class="label"><label for="title">新闻简介</label></div>
            <div class="field x5">
              <textarea class="input box-shadow-none radius-none" name="desc" rows="5" cols="50" placeholder="新闻简介"></textarea>
            </div>
          </div>

          <div class="form-group x12">
            <div class="label"><label for="content">新闻封面</label></div>
            <div class="field x12">

              <div class="input-group padding-little-top x8">
                <input type="text" class="input border-sub box-shadow-none radius-none" id="picture" name="img"  placeholder="" >
                <span class="addbtn">
                  <a href="javascript:void(0);" class="button input-file bg-sub" onclick="upImage();">+ 上传图片</a>
                </span>
              </div>

              <div class="x4 padding-little">
                <img id="preview" src="" width="34" height="34" class="radius-big" style="cursor:pointer" />
              </div>
              <script type="text/plain" id="upload_ue"></script>

            </div>
          </div>

          <div class="form-group x12">
            <div class="label"><label for="content">新闻内容</label></div>
            <div class="field x12">          
              <script type="text/plain" id="editor" style="width:100%;height:300px;"></script>

            </div>
          </div>

          <div class="form-group x12">
            <div class="label"><label for="username">排序</label></div>
            <div class="field x1">
              <input type="number" min="0" class="input box-shadow-none radius-none" name="sort" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):'0'); ?>" datatype="*" />
            </div>
          </div>
			<div class="clearfix"></div>
          <div class="margin-big-top text-center bg padding">
             <button class="btn button bg-sub" type="button" onclick="add_news()"> 确 定 发 布</button> 
        </div>
      </form>

   
      </div>
    </div>
    <!-- 底部 -->
    
  </div>



<script type="text/javascript">
    //实例化编辑器
    var ue = UE.getEditor('editor',{
	serverUrl:'<?php echo U("Admin/Upload/index");?>',
	toolbars:[[
	'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain','forecolor', 'backcolor', 
	'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', 'touppercase', 'tolowercase', 
	'link', 'unlink','imagenone', 'imageleft', 'imageright', 'imagecenter',
	'simpleupload', 'insertimage', 'map','fullscreen'
	]]
});

    //上传独立使用
        var _editor = UE.getEditor('upload_ue',{
    	serverUrl:'<?php echo U("Admin/Upload/index");?>',
    	toolbars:[[
    	'insertimage', 
    	]]
    });
        _editor.ready(function () {
			
            
            _editor.hide();

            _editor.addListener('beforeInsertImage', function (t, arg) {     //侦听图片上传
                $("#picture").attr("value", arg[0].src);                      //将地址赋值给相应的input
                $("#preview").attr("src", arg[0].src);
            })
        });
        function upImage() {
            var myImage = _editor.getDialog("insertimage");
            myImage.open();
        }
        function upFiles() {
            var myFiles = _editor.getDialog("attachment");
            myFiles.open();
        }


function add_news(){


	var title=$("input[name='title']");
	var cid=$("select[name='cid']").val();
	var desc=$("textarea[name='desc']").val();
	var img=$("input[name='img']").val();

	var author=$("input[name='author']").val();
	 content=ue.getContent();
	var sort=$("input[name='sort']").val();
	
	if(title.val().length < 1){
		layer.tips('新闻标题不能为空', title);
		title.focus()
		return false
	}
	if(content.length < 1){
		layer.msg('内容不能为空', {
				offset: 200,
				shift: 2
			});
		return false
	}
	if(cid.length < 1){
		layer.tips('分类不能为空',"select[name='cid']");
		cid.focus()
		return false
	}
	
	 $.post("/index.php?s=/Admin/News/news_add",{
		title:title.val(),
		cid:cid,
		desc:desc,
		img:img,
		author:author,
		content:content,
		sort:sort,
	},function(ret){
		if(ret.status==1){
			layer.msg(ret.info, {
						offset: 200,
						shift: 2
			});
			window.location.href=ret.url
		}else{
			layer.msg(ret.info, {
						offset: 200,
						shift: 2
			});
		}

	})
	
}

</script>





</body>
</html>