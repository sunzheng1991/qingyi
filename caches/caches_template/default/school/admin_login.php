<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
	<div class="xxl_content">
		<div style="width:320px;margin:0 auto;">
			<div class="xxl_content_2">
				<div class="xxl_content_title2">管理员登录</div>
				<div class="xxl_content_info2">
					<dl>
						<dt class="fl tr">用户名</dt>
						<dd class="fl"><input type="text" class="person-input2" name="username" id="username" value=""/></dd>
					</dl>
					<dl>
						<dt class="fl tr">密码</dt>
						<dd class="fl"><input type="password" class="person-input2" name="password" id="password" value=""/></dd>
					</dl>
					<dl>
						<dd style="width:250px;margin:0 auto;">
							<a href="javascript:void(0);" class="btn btn_ser fl mr10 dosubmit" style="width:250px;background:#fb6d42;">登录</a>
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$('.dosubmit').on("click",function(){
		var username = $('#username').val();
		var password = $('#password').val();
		$.post('index.php?m=school&c=index&a=admin_login_submit',{dosubmit:'1',username:username,password:password},function(data){
			if(data == 'ok'){
				location.href = 'index.php?m=school&c=index&a=school_list';
				return;
			}
			else{data == 'no'}
			{
				alert('登陆失败!');
				//location.href = 'index.php?m=school&c=index&a=init';
				return;
			}
		});
	});
</script>