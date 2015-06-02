<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
	<div class="xxl_content">
		<div style="width:500px;margin:0 auto;">
			<div class="xxl_content_1">
				<div class="xxl_content_title">我要纠错</div>
				<div class="xxl_content_info">
					<dl>
						<dt class="fl tr">学校名称</dt>
						<dd class="fl"><input type="text" class="person-input" value="<?php echo $school_name;?>" disabled></dd>
						<input type="hidden" name="info[school_name]" id="school_name" value="<?php echo $school_name;?>" />
					</dl>
					<dl>
						<dt class="fl tr">学校ID</dt>
						<dd class="fl"><input type="text" class="person-input" name="info[school_id]" value="<?php echo $school_id;?>" disabled></dd>
						<input type="hidden" name="info[school_id]" id="school_id" value="<?php echo $school_id;?>" />
					</dl>
					<dl>
						<dt class="fl tr">姓名</dt>
						<dd class="fl"><input type="text" class="person-input" id="name" name="info[name]" value="" ></dd>
					</dl>
					<dl>
						<dt class="fl tr">电话</dt>
						<dd class="fl"><input type="text" class="person-input" id="tel" name="info[tel]" value=""></dd>
					</dl>
					<dl>
						<dt class="fl tr">错误描述</dt>
						<dd class="fl" style="width: 320px;margin-left: 10px;">
							<textarea cols="50" rows="5" style="border-radius: 6px;border: 1px solid #dce4ec;" id="desc" name="info[desc]"></textarea>
						</dd>
					</dl>
					<dl style="margin-bottom: 50px">
						<dt class="fl tr xxl_font" style="font-size: 12px;width: 200px;color:red;text-align: left;">*请您填写错误描述</dt>
						<dd class="fr" style="margin-right: 35px;">
							<input type="submit" class="btn btn_ser fl mr10 dosubmit" style="background: rgb(255, 116, 0);float: right;" name="dosubmit" value="提交"/>
						</dd>
					</dl>
				</div>
			</div>
		</div>
	</div>
	<div class="gov_zhezhao"  style="display: none;"></div>
    <div class="set_sapp" style="display: none;">
    	<dl class="run_person">申请成功!</dl>
        <dl class="run_info">由于近期申请人数较多，网站业务繁忙。工作人员会在收到申请的3个工作日内与您联系！</dl>
        <div class="operation_button clerfix">
        	<a href="javascript:void(0);" class="btn btn_ser fl mr10 go_back">好的</a>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
	$('.dosubmit').on("click",function(){
		var school_name = $('#school_name').val();
		var school_id = $('#school_id').val();
		var name = $('#name').val();
		var tel = $('#tel').val();
		var desc = $('#desc').val();
		$.post('index.php?m=school&c=index&a=error_recovery',{dosubmit:'1',school_name:school_name,school_id:school_id,name:name,tel:tel,desc:desc},function(data){
			$(".gov_zhezhao").show();
			$(".set_sapp").show();
		});
	});
	
	$('.go_back').on("click",function(){
		location.href = 'index.php?m=school&c=index&a=init';
	});
</script>