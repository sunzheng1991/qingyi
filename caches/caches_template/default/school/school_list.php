<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
<!-- main start -->
<div class="w100">
	<div class="main">
    	<div class="m_header">
        	<ul>
	            	<li><a href="index.php?m=school&c=index&a=school_list" class="a_nav">学校管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=apply_list">申请管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=error_list">纠错管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=system">系统设置</a></li>
            </ul>
        </div>
        <div class="m_title">
        	<div class="t_left">学校列表：共有<?php echo $school_count;?>所学校</div>
            <div class="t_right" style="width:320px">
            <form action="index.php?m=school&c=index&a=school_list" method="post" id="form_search">
            	<p style="width: 259px;float:left;">学校名称 <input type="text" name="search_school_name" value="<?php echo $school_name;?>" /></p>
                <input type="submit" class="ss" style="width: 50px; height: 34px;float:left;" value="">&nbsp;</input>
           	</form>
            </div>
        </div>
        <div class="m_table">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                    <td><input name="" type="checkbox" value="" onclick="allSelectType();"/>&nbsp;全选</td>
                    <td>ID</td>
                    <td>名称</td>
                    <td>地址</td>
                    <td>负责人</td>
                    <td>手机</td>
                    <td>固话</td>
                    <td>授课范围</td>
                    <td>课时费用/元小时</td>
                    <td>分类</td>
                    <td>加入时间</td>
                    <td>二维码</td>
                    <td>LOGO</td>
                    <td>操作</td>
                </tr>
                <?php foreach($school_list as $r){?>
                <tr>
                    <td><input name="all_checked" type="checkbox" value="<?php echo $r['id'];?>" /></td>
                    <td><?php echo $r['id'];?></td>
                    <td><?php echo $r['school_name'];?></td>
                    <td><?php echo $r['provice'].$r['city'].$r['county'].$r['address'];?></td>
                    <td><?php echo $r['head'];?></td>
                    <td><?php echo $r['mobile'];?></td>
                    <td><?php echo $r['tel'];?></td>
                    <td><?php echo $r['medium_range'];?></td>
                    <td><?php echo $r['class_fee'];?>/元小时</td>
                    <td><?php echo $r['type'];?></td>
                    <td><?php echo $r['create_time'];?></td>
                    <td><?php if($r['qr_code'] != ''){?><img src="<?php echo $r['qr_code'];?>" width="50px" height="50px"/><?php }else{ echo '二维码';}?></td>
                    <td><?php if($r['school_logo'] != ''){?><img src="<?php echo $r['school_logo'];?>" width="50px" height="50px"/><?php }else{ echo 'LOGO';}?></td>
                    <td><a href="javascript:void(0)" onclick="edit(<?php echo $r['id'];?>)">修改</a></td>
                </tr>
                <?php }?>
            </table>
			<button type="button" class="delete" style="cursor: pointer;">&nbsp;</button>
        </div>
           <div id="page" style="text-align: center;"><?php echo $pages;?></div>
    </div>
	<div class="gov_zhezhao"  style="display: none;"></div>
    <div class="set_sapp" style="width: 940px;height: 560px;margin-top: -280px;margin-left: -470px; background: white; display: none;">
		<div class="xxl_content_info" style="margin-top: 20px; width:940px;">
            <p class="xxl_close" style="font-size: 14px;text-align: right;height: 30px;font-weight: 700;cursor: pointer;width:930px;">X</p>
			<dl style="float: left;">
				<dt class="fl tr">学校名称</dt>
				<dd class="fl"><input type="text" class="person-input" id="school_name" name="info[school_name]" value=""/></dd>
				<input type="hidden" id="school_id" name="school_id" value="" />
			</dl>
			<dl style="float: left;width: 300px;">
				<dt class="fl tr">学校类型</dt>
				<dd class="fl xxl_select">
					<select name="info[type]" id="type">
						<option value="1">书法</option>
						<option value="2">绘画</option>
						<option value="3">其他</option>
					</select>
				</dd>
			</dl>
			<dl style="float: left;width:461px;">
				<dt class="fl tr">学校位置</dt>
				<dd class="fl xxl_select" id="provice_select"></dd>
				<dd class="fl xxl_select" id="city_select" style="display: none;"></dd>
				<dd class="fl xxl_select" id="county_select" style="display: none;"></dd>
			</dl>
			<dl style="float: left;">
				<dt class="fl tr">学校地址</dt>
				<dd class="fl"><input type="text" class="person-input" id="address" name="info[address]"/></dd>
			</dl>
			<dl style="float: left;">
				<dt class="fl tr">负责人</dt>
				<dd class="fl"><input type="text" class="person-input" id="head" name="info[head]"/></dd>
			</dl>
			<dl style="float: left;">
				<dt class="fl tr">负责人电话</dt>
				<dd class="fl"><input type="text" class="person-input" id="mobile" name="info[mobile]"/></dd>
			</dl>
			<dl style="float: left;">
				<dt class="fl tr">联系电话</dt>
				<dd class="fl"><input type="text" class="person-input" id="tel" name="info[tel]"/></dd>
			</dl>
			<dl style="float: left;">
				<dt class="fl tr">授课范围</dt>
				<dd class="fl"><input type="text" class="person-input" id="medium_range" name="info[medium_range]"/></dd>
			</dl>
			<dl style="float: left;">
				<dt class="fl tr">课时费用</dt>
				<dd class="fl"><input type="text" class="person-input" id="class_fee" name="info[class_fee]"/></dd>
			</dl>
			<dl style="float: left;">
				<dt class="fl tr">微站地址</dt>
				<dd class="fl"><input type="text" class="person-input" id="micro_site_url" name="info[micro_site_url]"/></dd>
			</dl>
			<dl style="float: left;width: 460px;">
				<dt class="fl tr">二维码</dt>
				<dd class="fl">
				  <input type="file" name="fileToUpload" id="fileToUpload" class="inp_fileToUpload" style="width:66px;" multiple="multiple"/>
				  <img src="" width="50px" height="50px" class="img_upload" id="img_upload" />
				  <input type="hidden" id="qr_code" value="" />
				</dd>
			</dl>
			<dl style="float: left;width: 460px;">
				<dt class="fl tr">学校LOGO</dt>
				<dd class="fl">
				  <input type="file" name="school_logo_file" id="school_logo_file" class="inp_fileToUpload" style="width:66px;" multiple="multiple"/>
				  <img src="" width="50px" height="50px" class="img_upload" id="school_logo_upload" />
				  <input type="hidden" id="school_logo" value="" />
				</dd>
			</dl>
			<dl>
				<dt class="fl tr xxl_font" style="font-size: 12px;width: 200px;">*所有选项均为必填项，请您完整填写</dt>
				<dd class="fr" style="margin-right: 35px;">
                    <input type="submit" class="btn btn_ser fl mr10 dosubmit" style="background: rgb(255, 116, 0);float: right;" name="dosubmit" value="好的"/>
                </dd>
			</dl>
		</div>
    </div>
</div>
<!-- main end -->
</body>
</html>
<script type="text/javascript" src="<?php echo JS_PATH;?>school/js/ajaxfileupload.js"></script>
<script type="text/javascript">

	$(function() {
		$("#fileToUpload").on("change",function() {   
			ajaxFileUpload();  
		});
		$("#school_logo_file").on("change",function() {  
			ajaxFileUpload_logo();  
		}); 
        
        // 关闭修改框
        $('.xxl_close').on("click",function(){
            $('.gov_zhezhao').css('display','none');
            $('.set_sapp').css('display','none');
        });
        
        // 单选添加class
        $("input[name='all_checked']").on('click',function(){
            if($(this).attr('class') == undefined || $(this).attr('class') == ''){
                $(this).addClass(' xxl_add_delete');
            }else{
                $(this).removeClass(' xxl_add_delete');
            }
        });
        
        // 删除
        $('.delete').on("click",function(){
            var checked = $(".xxl_add_delete");

            var ids = '';
            for(var i=0;i<checked.length;i++){
                if( ids != '')
                    ids += ',';
                ids += checked[i].value;
            }
            if( ids == ''){
                alert('请先选择学校!');
            }
            if( confirm('确认删除!') ){
                $.post('index.php?m=school&c=index&a=delete_school',{ids:ids},function(){
                    location.reload();
                });
            }
            console.log(ids);
        });
	});  
	
    function allSelectType(){
    　　var ids=$("input[name='all_checked']");  
    　　for(var i=0;i<ids.length;i++){   
    　　　　ids[i].checked="checked";
            ids.addClass(' xxl_add_delete');
    　　}
    }

	function ajaxFileUpload() { 
			$.ajaxFileUpload({
				url : 'index.php?m=school&c=index&a=upload_img', //用于文件上传的服务器端请求地址  
				secureuri : false, //是否需要安全协议，一般设置为false  
				fileElementId : "fileToUpload", //文件上传域的ID  
				dataType : 'json', //返回值类型 一般设置为json  
				success : function(data, status)//服务器成功响应处理函数  
				{  
					if(data.msg == 'ok'){
						document.getElementById('img_upload').src = data.path;
						$("#qr_code").val(data.path);
					}
				},  
				error : function(data, status, e)//服务器响应失败处理函数  
				{  
					alert(e);  
				}
			})  
		return false;  
	}
	
	function ajaxFileUpload_logo() { 
			$.ajaxFileUpload({
				url : 'index.php?m=school&c=index&a=upload_logo', //用于文件上传的服务器端请求地址  
				secureuri : false, //是否需要安全协议，一般设置为false  
				fileElementId : "school_logo_file", //文件上传域的ID  
				dataType : 'json', //返回值类型 一般设置为json  
				success : function(data, status)//服务器成功响应处理函数  
				{  
					if(data.msg == 'ok'){
						document.getElementById('school_logo_upload').src = data.path;
						$("#school_logo").val(data.path);
					}
				},  
				error : function(data, status, e)//服务器响应失败处理函数  
				{  
					alert(e);  
				}
			})  
		return false;  
	} 
		
	$('.dosubmit').on("click",function(){
		var school_id = $('#school_id').val()
		var school_name = $('#school_name').val();
		var type = $('#type').val();
		var provice = $('#provice').val();
		var city = $('#city').val();
		var county = $('#county').val();
		var address = $('#address').val();
		var head = $('#head').val();
		var mobile = $('#mobile').val();
		var tel = $('#tel').val();
		var medium_range = $('#medium_range').val();
		var class_fee = $('#class_fee').val();
		var qr_code = $('#qr_code').val();
		var school_logo = $('#school_logo').val();
		var micro_site_url = $('#micro_site_url').val();
		$.post('index.php?m=school&c=index&a=edit_school',{dosubmit:'1',school_id:school_id,school_name:school_name,type:type,provice:provice,city:city,county:county,address:address,head:head,mobile:mobile,tel:tel,medium_range:medium_range,class_fee:class_fee,qr_code:qr_code,school_logo:school_logo,micro_site_url:micro_site_url},function(data){
			$(".gov_zhezhao").hide();
			$(".set_sapp").hide();
			location.reload();
		});
	});
	
	function edit(school_id){
		$.getJSON('index.php?m=school&c=index&a=edit_school',{school_id:school_id},function(jsondata){
			$('#school_id').val(jsondata.id);
			$('#school_name').val(jsondata.school_name);
			$('#type').val(jsondata.type);
			$('#provice_select').html(jsondata.provice_select);
			if( jsondata.city != '0'){
				$('#city_select').show();
				$('#city_select').html(jsondata.city_select);
			}
			if( jsondata.county != '0'){
				$('#county_select').show();
				$('#county_select').html(jsondata.county_select);
			}
			$('#address').val(jsondata.address);
			$('#head').val(jsondata.head);
			$('#mobile').val(jsondata.mobile);
			$('#tel').val(jsondata.tel);
			$('#medium_range').val(jsondata.medium_range);
			$('#class_fee').val(jsondata.class_fee);
			$('#qr_code').val(jsondata.qr_code);
			document.getElementById('img_upload').src = jsondata.qr_code;
			$('#school_logo').val(jsondata.school_logo);
			document.getElementById('school_logo_upload').src = jsondata.school_logo;
			$('#micro_site_url').val(jsondata.micro_site_url);
			
			$('.gov_zhezhao').show();
			$('.set_sapp').show();
		});
	}
	
    function provice(provice_id){
        $.post('index.php?m=school&c=index&a=city',{provice_id:provice_id},function(data){
            if(data != ''){
                $("#city_select").html(data);
                $("#city_select").show();
                $("#county_select").hide();
            }
        });
    }
    
    function city(city_id){
        $.post('index.php?m=school&c=index&a=county',{city_id:city_id},function(data){
            if(data != ''){
                $("#county_select").html(data);
                $("#county_select").show();  
            }
        });
    }
</script>



