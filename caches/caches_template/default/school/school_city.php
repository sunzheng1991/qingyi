<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
		<div id="content">
			<div id="inquire">
				<span>
					按省份选择	
					<select name="info[provice]" id="provice_id" onchange="provice()">
                        <?php foreach($provice as $r){?>
						<option value="<?php echo $r['linkageid'];?>" <?php if($provice_id == $r['linkageid']){ echo 'selected';}?> ><?php echo $r['name'];?></option>
                        <?php }?>
					</select>
					<span id="city_select"></span>
				</span>
				<span style="margin-left: 36px;">
					直接输入城市
					<input type="text" name="city_name" value=""/>
				</span>
			</div>
			<div id="hots">
				<li>热门城市：</li>
                <?php foreach($hot_city as $r){?>
				<li><a onclick="go_index('<?php echo $r['name']?>');"><?php echo $r['name']?></a></li>
                <?php }?>
			</div>
			<div id="city">
				<!--<div class="spell">
					<li>按拼音首字母选择：</li>
					<?php foreach($city_pinyin as $k=>$r){?>
					<li>A</li>
					<?php }?>
					<li>B</li>
					<li>C</li>
					<li>D</li>
					<li>E</li>
					<li>E</li>
					<li>E</li>
					<li>E</li>
					<li>E</li>
					<li>E</li>
					<li>E</li>
					<li>E</li>
					<li>E</li>
					<li>E</li>
				</div>-->
				<div class="spell_city">
				<?php foreach($city_pinyin as $k=>$r){?>
					<div class="first_spell">
						<span><?php echo $k;?></span>
					</div>
					
					<span class="first_city">
					<?php foreach($r['city'] as $v){?>
						<li><a onclick="go_index('<?php echo $v?>');"><?php echo $v;?></a></li>
					<?php }?>
					</span>
				<?php }?>
				</div>
			</div>
		</div>
	</body>
</html>

<script type="text/javascript">
    function provice(){
    	var provice = $("#provice_id option:selected").text();
    	var provice_id = $("#provice_id option:selected").val();
    	if( provice.indexOf('省') != '-1'){
	        $.post('index.php?m=school&c=index&a=get_school_city',{type:'get_city',provice_id:provice_id},function(data){
				$('#city_select').html(data);			
	        });
    	}
    	else{
    		go_index(provice);
    	}
    }
    
    function city(){
    	var city = $("#city option:selected").text();
    	go_index(city);
    }
    
    function go_index(city_name){
    	location.href = 'index.php?m=school&c=index&a=init&provice_name='+city_name;
    }
    
</script>