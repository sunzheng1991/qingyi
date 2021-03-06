<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
	<div class="w100" style="margin-bottom: 50px;">
		<div class="main">
			<div class="m_header">
	        	<ul>
	            	<li><a href="index.php?m=school&c=index&a=school_list">学校管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=apply_list">申请管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=error_list">纠错管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=system" class="a_nav">系统设置</a></li>
	            </ul>
	        </div>
			<div class="system_content">
				<dl><span style="font-weight: 700;">首页设置：</span>(<span style="color:red">*多个设置请用分号“;”间隔</span>)</dl>
				<dl class="fl sys_run_person">
					<dt class="fl tl">热词：</dt>
					<dd class="fl" style="font-size:14px;">
						<input type="text" class="person-input" style="width: 410px;" name="hot_words" id="hot_words" value="<?php echo $system_data['hot_words']?>" />
						<span class="sys_span">最多设置5个</span>
					</dd>
				</dl>
				<dl class="fl sys_run_person">
					<dt class="fl tl">主页焦点图：</dt>
					<div class="fl ml10" style="width:460px">
						<dd class="fl sys_dd">
							<div class="fl sys_div1">
								<img src="<?php echo $system_data['images1']?>" width="217" height="89" alt="" class="img_upload" id="img_upload" />
							</div>
							<div class="fl sys_div2 ml20">
								<p>跳转地址<input type="text" id="images_url1" name="images_url1" value="<?php echo $system_data['images_url1']?>" /></p>
								<input type="file" name="images1_upload" id="images1_upload" class="inp_fileToUpload" style="width:66px;" multiple="multiple"/>
								<input type="hidden" id="images1" value="<?php echo $system_data['images1']?>" />
								<a href="javascript:void(0);" class="btn btn_ser fl mr10" style="width:60px;background:#ccc;" onclick="delete_images(1);">删除</a>
							</div>
						</dd>
						<dd class="fl sys_dd">
							<div class="fl sys_div1">
								<img src="<?php echo $system_data['images2']?>" width="217" height="89" alt="" class="img_upload" id="img_upload2" />
							</div>
							<div class="fl sys_div2 ml20">
								<p>跳转地址<input type="text" id="images_url2" name="images_url2" value="<?php echo $system_data['images_url2']?>" /></p>
								<input type="file" name="images2_upload" id="images2_upload" class="inp_fileToUpload" style="width:66px;" multiple="multiple"/>
								<input type="hidden" id="images2" value="<?php echo $system_data['images2']?>" />
								<a href="javascript:void(0);" class="btn btn_ser fl mr10" style="width:60px;background:#ccc;" onclick="delete_images(2);">删除</a>
							</div>
						</dd>
						<dd class="fl sys_dd">
							<div class="fl sys_div1">
								<img src="<?php echo $system_data['images3']?>" width="217" height="89" alt="" class="img_upload" id="img_upload3" />
							</div>
							<div class="fl sys_div2 ml20">
								<p>跳转地址<input type="text" id="images_url3" name="images_url3" value="<?php echo $system_data['images_url3']?>" /></p>
								<input type="file" name="images3_upload" id="images3_upload" class="inp_fileToUpload" style="width:66px;" multiple="multiple"/>
								<input type="hidden" id="images3" value="<?php echo $system_data['images3']?>" />
								<a href="javascript:void(0);" class="btn btn_ser fl mr10" style="width:60px;background:#ccc;" onclick="delete_images(3);">删除</a>
							</div>
						</dd>
						<dd class="fl sys_dd">
							<div class="fl sys_div1">
								<img src="<?php echo $system_data['images4']?>" width="217" height="89" alt="" class="img_upload" id="img_upload4" />
							</div>
							<div class="fl sys_div2 ml20">
								<p>跳转地址<input type="text" id="images_url4" name="images_url4" value="<?php echo $system_data['images_url4']?>" /></p>
								<input type="file" name="images4_upload" id="images4_upload" class="inp_fileToUpload" style="width:66px;" multiple="multiple"/>
								<input type="hidden" id="images4" value="<?php echo $system_data['images4']?>" />
								<a href="javascript:void(0);" class="btn btn_ser fl mr10" style="width:60px;background:#ccc;" onclick="delete_images(4);">删除</a>
							</div>
						</dd>
						<dd class="fl sys_dd">
							<div class="fl sys_div1">
								<img src="<?php echo $system_data['images5']?>" width="217" height="89" alt="" class="img_upload" id="img_upload5" />
							</div>
							<div class="fl sys_div2 ml20">
								<p>跳转地址<input type="text" id="images_url5" name="images_url5" value="<?php echo $system_data['images_url5']?>" /></p>
								<input type="file" name="images5_upload" id="images5_upload" class="inp_fileToUpload" style="width:66px;" multiple="multiple"/>
								<input type="hidden" id="images5" value="<?php echo $system_data['images5']?>" />
								<a href="javascript:void(0);" class="btn btn_ser fl mr10" style="width:60px;background:#ccc;" onclick="delete_images(5);">删除</a>
							</div>
						</dd>
					</div>
				</dl>
				<dl class="fl sys_run_person">
					<dt class="fl tl">推荐学校：</dt>
					<dd class="fl" style="font-size:14px;">
						<input type="text" class="person-input sys-input" style="width: 410px;" name="recommend_school" id="recommend_school" value="<?php echo $system_data['recommend_school']?>" />
						<span class="sys_span">最多设置10个</span>
					</dd>
				</dl>
				<dl class="fl sys_run_person">
					<dt class="fl tl">最新学校：</dt>
					<dd class="fl" style="font-size:14px;">
						<input type="text" class="person-input sys-input" style="width: 410px;" name="new_school" id="new_school" value="<?php echo $system_data['new_school']?>" />
						<span class="sys_span">最多设置10个</span>
					</dd>
				</dl>
				<dl class="fl sys_run_person">
					<dt class="fl tl">热门城市：</dt>
					<dd class="fl" style="font-size:14px;">
						<input type="text" class="person-input sys-input" style="width: 410px;" name="hot_city" id="hot_city" value="<?php echo $system_data['hot_city']?>" />
						<span class="sys_span">最多设置10个</span>
					</dd>
				</dl>
				<dl style="width: 680px;float: left;">
					<dt class="fl tr" style="font-size: 12px;width: 235px; color:red">*所有选项均为必填项，请您完整填写</dt>
					<dd class="fr" style="margin-right: 35px;">
	                    <input type="submit" class="btn btn_ser fl mr10 dosubmit" style="background: rgb(255, 116, 0);float: right;" name="dosubmit" value="确定"/>
	                </dd>
				</dl>
			</div>
		</div>	
	</div>
	<div class="gov_zhezhao"  style="display: none;"></div>
    <div class="set_sapp" style="display: none;">
    	<dl class="run_person">编辑成功!</dl>
    </div>
</body>
</html>
<script type="text/javascript" src="<?php echo JS_PATH;?>school/js/ajaxfileupload.js"></script>
<script type="text/javascript">

$(function() {
	$("#images1_upload").on("change",function() {   
		ajaxFileUpload();  
	});
	$("#images2_upload").on("change",function() {  
		ajaxFileUpload_images2();  
	});
	$("#images3_upload").on("change",function() {  
		ajaxFileUpload_images3();  
	});
	$("#images4_upload").on("change",function() {  
		ajaxFileUpload_images4();  
	});
	$("#images5_upload").on("change",function() {  
		ajaxFileUpload_images5();  
	});
});

function ajaxFileUpload() { 
		$.ajaxFileUpload({
			url : 'index.php?m=school&c=index&a=upload_images1', //用于文件上传的服务器端请求地址  
			secureuri : false, //是否需要安全协议，一般设置为false  
			fileElementId : "images1_upload", //文件上传域的ID  
			dataType : 'json', //返回值类型 一般设置为json  
			success : function(data, status)//服务器成功响应处理函数  
			{  
				console.log(data);
				if(data.msg == 'ok'){
					document.getElementById('img_upload').src = data.path;
					$("#images1").val(data.path);
				}
			},  
			error : function(data, status, e)//服务器响应失败处理函数  
			{  
				alert(e);  
			}
		})  
	return false;  
}

function ajaxFileUpload_images2() { 
		$.ajaxFileUpload({
			url : 'index.php?m=school&c=index&a=upload_images2', //用于文件上传的服务器端请求地址  
			secureuri : false, //是否需要安全协议，一般设置为false  
			fileElementId : "images2_upload", //文件上传域的ID  
			dataType : 'json', //返回值类型 一般设置为json  
			success : function(data, status)//服务器成功响应处理函数  
			{  
				if(data.msg == 'ok'){
					document.getElementById('img_upload2').src = data.path;
					$("#images2").val(data.path);
				}
			},  
			error : function(data, status, e)//服务器响应失败处理函数  
			{  
				alert(e);  
			}
		})  
	return false;  
}
function ajaxFileUpload_images3() { 
		$.ajaxFileUpload({
			url : 'index.php?m=school&c=index&a=upload_images3', //用于文件上传的服务器端请求地址  
			secureuri : false, //是否需要安全协议，一般设置为false  
			fileElementId : "images3_upload", //文件上传域的ID  
			dataType : 'json', //返回值类型 一般设置为json  
			success : function(data, status)//服务器成功响应处理函数  
			{  
				if(data.msg == 'ok'){
					document.getElementById('img_upload3').src = data.path;
					$("#images3").val(data.path);
				}
			},  
			error : function(data, status, e)//服务器响应失败处理函数  
			{  
				alert(e);  
			}
		})  
	return false;  
}

function ajaxFileUpload_images4() { 
		$.ajaxFileUpload({
			url : 'index.php?m=school&c=index&a=upload_images4', //用于文件上传的服务器端请求地址  
			secureuri : false, //是否需要安全协议，一般设置为false  
			fileElementId : "images4_upload", //文件上传域的ID  
			dataType : 'json', //返回值类型 一般设置为json  
			success : function(data, status)//服务器成功响应处理函数  
			{  
				if(data.msg == 'ok'){
					document.getElementById('img_upload4').src = data.path;
					$("#images4").val(data.path);
				}
			},  
			error : function(data, status, e)//服务器响应失败处理函数  
			{  
				alert(e);  
			}
		})  
	return false;  
}

function ajaxFileUpload_images5() { 
		$.ajaxFileUpload({
			url : 'index.php?m=school&c=index&a=upload_images5', //用于文件上传的服务器端请求地址  
			secureuri : false, //是否需要安全协议，一般设置为false  
			fileElementId : "images5_upload", //文件上传域的ID  
			dataType : 'json', //返回值类型 一般设置为json  
			success : function(data, status)//服务器成功响应处理函数  
			{  
				if(data.msg == 'ok'){
					document.getElementById('img_upload5').src = data.path;
					$("#images5").val(data.path);
				}
			},  
			error : function(data, status, e)//服务器响应失败处理函数  
			{  
				alert(e);  
			}
		})  
	return false;  
} 

function delete_images(id){
    if( confirm("确认删除!")){
            $.post('index.php?m=school&c=index&a=delete_images',{id:id},function(){
                document.getElementById('img_upload'+id).src = '';
                $("#images"+id).val('');
                $("#images_url"+id).html('');
            });
    }
}

$(".dosubmit").on("click",function(){
	var hot_words = $("#hot_words").val();
	var recommend_school = $("#recommend_school").val();
	var new_school = $("#new_school").val();
	var hot_city = $("#hot_city").val();
	var images1 = $("#images1").val();
	var images2 = $("#images2").val();
	var images3 = $("#images3").val();
	var images4 = $("#images4").val();
	var images5 = $("#images5").val();
	var images_url1 = $("#images_url1").val();
	var images_url2 = $("#images_url2").val();
	var images_url3 = $("#images_url3").val();
	var images_url4 = $("#images_url4").val();
	var images_url5 = $("#images_url5").val();
	$.post('index.php?m=school&c=index&a=edit_system',{dosubmit:"1",hot_words:hot_words,recommend_school:recommend_school,new_school:new_school,hot_city:hot_city,images1:images1,images2:images2,images3:images3,images4:images4,images5:images5,images_url1:images_url1,images_url2:images_url2,images_url3:images_url3,images_url4:images_url4,images_url5:images_url5},function(data){
		location.reload();
	});
});

</script>