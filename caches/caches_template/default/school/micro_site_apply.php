<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
	<div class="xxl_content" style="margin-top:70px;">
		<p class="xxl_aninfo">案例展示</p>
		<div class="xxl_content_1" style="float:left;">
			<input type="hidden" name="info[apply_type]" id="apply_type" value="1" />
			<div class="xxl_content_title">微信开通申请</div>
			<div class="xxl_content_info">
				<dl>
					<dt class="fl tr">学校名称</dt>
					<dd class="fl"><input type="text" class="person-input" id="school_name" name="info[school_name]" value=""/></dd>
				</dl>
				<dl>
					<dt class="fl tr">学校位置</dt>
					<dd class="fl xxl_select">
						<select name="info[provice]" id="provice" onchange="provice(this.value)">
                            <?php foreach($provice as $r){?>
							<option value="<?php echo $r['linkageid'];?>"><?php echo $r['name'];?></option>
                            <?php }?>
						</select>
					</dd>
					<dd class="fl xxl_select" id="city_selete" style="display: none;"></dd>
    				<dd class="fl xxl_select" id="county_select" style="display: none;"></dd>
				</dl>
				<dl>
					<dt class="fl tr">学校地址</dt>
					<dd class="fl"><input type="text" class="person-input" id="address"  name="info[address]"/></dd>
				</dl>
				<dl>
					<dt class="fl tr">负责人姓名</dt>
					<dd class="fl"><input type="text" class="person-input" id="mobile"  name="info[mobile]"/></dd>
				</dl>
				<dl>
					<dt class="fl tr">联系电话</dt>
					<dd class="fl"><input type="text" class="person-input" id="tel"  name="info[tel]"/></dd>
				</dl>
				<dl>
					<dt class="fl tr">授课范围</dt>
					<dd class="fl"><input type="text" class="person-input" id="medium_range"  name="info[medium_range]"/></dd>
				</dl>
				<dl>
					<dt class="fl tr xxl_font" style="font-size: 12px;width: 200px;color:red;">*所有选项均为必填项，请您完整填写</dt>
					<dd class="fr" style="margin-right: 35px;">
						<input type="submit" class="btn btn_ser fl mr10 dosubmit" style="background: rgb(255, 116, 0);float: right;" name="dosubmit" value="提交申请"/>
					</dd>
				</dl>
			</div>
		</div>
		<div class="xxl_anlizs">
			<img src="<?php echo IMG_PATH;?>school/images/weixin_add.png" alt="案例展示" />
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
		var provice = $('#provice').val();
		var city = $('#city').val();
		var county = $('#county').val();
		var address = $('#address').val();
		var mobile = $('#mobile').val();
		var tel = $('#tel').val();
		var medium_range = $('#medium_range').val();
		var apply_type = $('#apply_type').val();
		$.post('index.php?m=school&c=index&a=add_school',{dosubmit:'1',school_name:school_name,provice:provice,city:city,county:county,address:address,mobile:mobile,tel:tel,medium_range:medium_range,apply_type:apply_type},function(data){
			$(".gov_zhezhao").show();
			$(".set_sapp").show();
		});
	});
	
	$('.go_back').on("click",function(){
		location.href = 'index.php?m=school&c=index&a=init';
	});

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