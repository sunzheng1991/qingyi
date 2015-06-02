<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
<!-- main start -->
<div class="w100">
	<div class="main">
    	<div class="m_header">
        	<ul>
	            	<li><a href="index.php?m=school&c=index&a=school_list">学校管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=apply_list">申请管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=error_list" class="a_nav">纠错管理</a></li>
	                <li><a href="index.php?m=school&c=index&a=system">系统设置</a></li>
            </ul>
        </div>
        <div class="m_table">
            <div style="width: 980px;margin-top: 20px;margin-bottom: 15px;">
                <p style="width: 130px;font-size: 16px;float: left;">纠错数据列表:</p>
                <p style="width: 300px;float: left;font-size: 16px;">
                    <input type="radio" name="status" value="0" style="width: 25px;height: 15px;" <?php if($status == '0'){echo 'checked';}?> onclick="change(0);"/>显示未处理
                    <input type="radio" name="status" value="1" style="width: 25px;height: 15px;margin-left: 20px;" <?php if($status == '1'){echo 'checked';}?> onclick="change(1);"/>显示已处理
                </p>
            </div>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                    <td><input name="" type="checkbox" value="" onclick="allSelectType();"/>&nbsp;全选</td>
                    <td>学校ID</td>
                    <td>学校名称</td>
                    <td>提交人姓名</td>
                    <td>提交人联系方式</td>
                    <td>错误描述</td>
                    <td>处理方式</td>
                    <?php if($status == '0'){?><td>操作</td><?php }?>
                </tr>
                <?php foreach($error_list as $r){?>
                <tr>
                    <td><input name="all_checked" type="checkbox" value="<?php echo $r['school_id'];?>" /></td>
                    <td><?php echo $r['school_id'];?></td>
                    <td><?php echo $r['school_name'];?></td>
                    <td><?php echo $r['name'];?></td>
                    <td><?php echo $r['tel'];?></td>
                    <td><?php echo $r['desc'];?></td>
                    <td><?php echo $r['manage'];?></td>
                    <?php if($status == '0'){?><td><a onclick="edit(<?php echo $r['id'];?>)">修改</a></td><?php }?>
                </tr>
                <?php }?>
            </table>
			<button type="button" class="delete">&nbsp;</button>
        </div>
           <div id="page" style="text-align: center;"><?php echo $pages;?></div>
    </div>
     	<div class="gov_zhezhao"  style="display: none;"></div>
    <div class="set_sapp" style="width: 480px; height:270px; margin-top: -240px; background: white; display: none;">
		<div class="xxl_content_info" style="margin-top: 20px;">
        <p class="xxl_close" style="font-size: 14px;text-align: right;height: 30px;font-weight: 700;cursor: pointer;width: 475px;">X</p>
			<dl>
				<dt class="fl tr">处理方式</dt>
				<dd class="fl">
                <textarea name="manage" id="manage" style="margin-left: 10px;border-radius: 6px;" cols="50" rows="5"></textarea>
                </dd>
				<input type="hidden" id="id" name="id" value="" />
			</dl>
            <dl>
				<dt class="fl tr">处理状态</dt>
				<dd class="fl">
                    <input type="radio" id="status" name="status" value="0" style="margin-left: 15px;width: 25px;height: 17px;"/>未处理
                    <input type="radio" id="status" name="status" value="1" style="margin-left: 15px;width: 25px;height: 17px;"/>已处理
                </dd>
			</dl>
			<dl>
				<dt class="fl tr xxl_font" style="font-size: 12px;width: 200px;">*所有选项均为必填项，请您完整填写</dt>
				<dd class="fr" style="margin-right: 35px;">
                    <input type="submit" class="btn btn_ser fl mr10 dosubmit" style="background: rgb(255, 116, 0);float: right;" name="dosubmit" value="确定"/>
                </dd>
			</dl>
		</div>
    </div>
</div>
<!-- main end -->
</body>
</html>

<script type="text/javascript">
	
	$('.dosubmit').on("click",function(){
		var id = $('#id').val()
		var manage = $('#manage').val();
        var status = $('input[name="status"]:checked').val();
		$.post('index.php?m=school&c=index&a=edit_error',{dosubmit:'1',id:id,manage:manage,status:status},function(data){
			$(".gov_zhezhao").hide();
			$(".set_sapp").hide();
			location.reload();
		});
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
            alert('请先选择!');
        }
        if( confirm('确认删除!') ){
            $.post('index.php?m=school&c=index&a=delete_error',{ids:ids},function(){
                location.reload();
            });
        }
        
        console.log(ids);
    });
    
    function allSelectType(){
    　　var ids=$("input[name='all_checked']");  
    　　for(var i=0;i<ids.length;i++){   
    　　　　ids[i].checked="checked";
            ids.addClass(' xxl_add_delete');
    　　}
    }
	
	function edit(id){
		$("#id").val(id);
		$('.gov_zhezhao').show();
		$('.set_sapp').show();
	}
    
    function change(status){
        location.href = 'index.php?m=school&c=index&a=error_list&status='+status;
    }
</script>
