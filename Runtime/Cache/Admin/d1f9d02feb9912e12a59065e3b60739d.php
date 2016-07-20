<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" href="/Public/css/pintuer.css">
<script src="/Public/js/jquery-1.8.3.min.js"></script>
<script src="/Public/lib/layer/layer.js"></script>
      <div class="x12 padding-large">
       <form method="post" class="form-x">
		  <div class="form-group x6">
			<div class="label padding-right">登录账号 : </div>
			<div class="field">
			  <input type="text" class="input input-auto box-shadow-none radius-none" value="<?php echo ($admin_user["username"]); ?>" name="username" size="30" placeholder="" />
			</div>
		  </div>
		  <div class="form-group x6">
			<div class="label padding-right">登录密码 : (*留空则不修改)</div>
			<div class="field">
			  <input type="password" class="input input-auto box-shadow-none radius-none"   name="password" size="30"  />
			</div>
		  </div>
		  <div class="form-group x6">
			<div class="label padding-right">昵称 : </div>
			<div class="field">
			  <input type="text" class="input input-auto box-shadow-none radius-none" value="<?php echo ($admin_user["nickname"]); ?>"  name="nickname" size="30"  />
			</div>
		  </div>
		  <div class="form-group x6">
			<div class="label padding-right">邮箱 : </div>
			<div class="field">
			  <input type="text" class="input input-auto box-shadow-none radius-none"  value="<?php echo ($admin_user["email"]); ?>" name="email" size="30"  />
			</div>
		  </div>
		  <div class="form-group x6">
			<div class="label padding-right">用户组 : </div>
			<div class="field">
			  <select name="group_id" class="input input-auto box-shadow-none radius-none">
				<?php if(is_array($groups)): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>"<?php if($admin_user['group_id'] == $key): ?>selected<?php endif; ?> ><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			  </select>
			</div>
		  </div>
		   <div class="form-group x6">
			<div class="label padding-right">用户状态 : </div>
			<div class="field">
				<label><input type="radio" name="status" value="1" <?php if($admin_user['status'] == '1'): ?>checked<?php endif; ?> /> 正常 </label>
				<label><input type="radio" name="status" value="0" <?php if($admin_user['status'] == '0'): ?>checked<?php endif; ?>  /> 锁定 </label>
			</div>
		  </div>
		  <div class="form-button x12 text-center padding-top"><button class="button bg-blue icon-plus" onclick="user_add(this)" type="button"> 保存修改</button></div>
		</form>
      </div>
	  
	<script>
		
		//创建用户
		function user_add(d){
			var username=$("input[name='username']");
			var password=$("input[name='password']");
			var nickname=$("input[name='nickname']");
			var email=$("input[name='email']");
			var group_id=$("select[name='group_id']").val();			
			var status=$("input[name='status']:checked").val();			
			if(username.val()==''){
				layer.tips('登录账号不能为空', username);
				username.focus();
				return false
			}
		
			if(nickname.val()==''){
				layer.tips('昵称还是要一个方便以后识别', nickname);
				nickname.focus();
				return false
			}
			if(email.val()==''){
				layer.tips('邮箱是用来找回密码的', email);
				email.focus();
				return false
			}
			$.post("/index.php?s=/Admin/Auth/user_edit",{
				username:username.val(),
				password:password.val(),
				nickname:nickname.val(),
				email:email.val(),
				group_id:group_id,
				status:status,
				id:<?php echo ($uid); ?>,
			},function(ret){
				if(ret.status==1){
					 parent.layer.msg(ret.info, {
						offset: 200,
						shift: 2
					});
					 parent.window.location.reload()
				}else{
					parent.layer.msg(ret.info, {
						offset: 200,
						shift: 2
					});
				}
			})			
		}
</script>
  </div>
</body>
</html>