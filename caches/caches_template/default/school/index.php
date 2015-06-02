<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
<?php if($system){?>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-3672694-9']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "//hm.baidu.com/hm.js?fa98b91e638fc607d0335693fb173e7f";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
		</script>
		<script type="<?php echo JS_PATH;?>school/js/gun.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>school/css/org.css" />
		<script type="text/javascript" src="<?php echo JS_PATH;?>school/js/jquery-1.8.0.min.js"></script>
		<div class="main" style="margin-top:20px;">
			<div class="pro-switch">
				<div class="slider">
					<div class="flexslider">
						<ul class="slides">
                            <?php if($system['images1'] != ''){?>
							<li>
								<div class="img"><a href="<?php echo $system['images_url1']?>" target="_blank"><img src="<?php echo $system['images1']?>" height="424" width="960" alt="" /></a></div>
							</li>
                            <?php }?>
                            <?php if($system['images2'] != ''){?>
							<li>
								<div class="img"><a href="<?php echo $system['images_url2']?>" target="_blank"><img src="<?php echo $system['images2']?>" height="424" width="960" alt="" /></a></div>
							</li>
                            <?php }?>
                            <?php if($system['images3'] != ''){?>
							<li>
								<div class="img"><a href="<?php echo $system['images_url3']?>" target="_blank"><img src="<?php echo $system['images3']?>" height="424" width="960" alt="" /></a></div>
							</li>
                            <?php }?>
                            <?php if($system['images4'] != ''){?>
							<li>
								<div class="img"><a href="<?php echo $system['images_url4']?>" target="_blank"><img src="<?php echo $system['images4']?>" height="424" width="960" alt="" /></a></div>
							</li>
                            <?php }?>
                            <?php if($system['images5'] != ''){?>
							<li>
								<div class="img"><a href="<?php echo $system['images_url5']?>" target="_blank"><img src="<?php echo $system['images5']?>" height="424" width="960" alt="" /></a></div>
							</li>
                            <?php }?>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<script defer src="<?php echo JS_PATH;?>school/js/org.js"></script> 
		<script type="text/javascript">
		    $(function(){
		      $('.flexslider').flexslider({
		        animation: "slide",
		        start: function(slider){
		          $('body').removeClass('loading');
		        }
		      });
		    });
		  </script>
          <?php }?>
		<!-- content -->
		<div id="content">
			<?php if($recommend_school){?>
			<div id="recommend">
				<div class="recommend_title">
					<span class="span_check1" id="span1"><a onclick="check(1);">推荐学校</a></span>&nbsp;&nbsp;
					<span class="span_check2" id="span2"><a onclick="check(2);">最新加入</a></span>
					<!--<img src="<?php echo IMG_PATH;?>school/images/index_78.png"/>-->
				</div>
				<?php foreach($recommend_school as $r){?>
				<div class="recommend_content" id="recommend_school" style="display: block;">
					<div class="recommend_newest">
						<div class="recommend_newest_left">
							<img src="<?php echo $r['school_logo']?>">
						</div>
						<div class="recommend_newest_right">
							<h5 style="font-weight: 700;"><?php echo $r['school_name'];?></h5>
							<span><b><?php if($r['type'] == '1'){echo '书法';}elseif($r['type'] == '2'){echo '绘画';}elseif($r['type']=='3'){echo '其他';}?></b></span>
							<li style="line-height: 20px;font-weight: 100;"><img src="<?php echo IMG_PATH;?>school/images/index_14.gif"/> 三年教龄</li>
							<li style="line-height: 20px;font-weight: 100;"><img src="<?php echo IMG_PATH;?>school/images/index_17.gif"> <?php echo $r['provice'];?></li>
						</div>
					</div>
				</div>
				<?php }?>
				<?php foreach($new_school as $r){?>
				<div class="recommend_content" id="new_school" style="display: none;">
					<div class="recommend_newest">
						<div class="recommend_newest_left">
							<img src="<?php echo $r['school_logo']?>">
						</div>
						<div class="recommend_newest_right">
							<h5 style="font-weight: 700;"><?php echo $r['school_name'];?></h5>
							<span><b><?php if($r['type'] == '1'){echo '书法';}elseif($r['type'] == '2'){echo '绘画';}elseif($r['type']=='3'){echo '其他';}?></b></span>
							<li style="line-height: 20px;font-weight: 100;"><img src="<?php echo IMG_PATH;?>school/images/index_14.gif"/> 三年教龄</li>
							<li style="line-height: 20px;font-weight: 100;"><img src="<?php echo IMG_PATH;?>school/images/index_17.gif"> <?php echo $r['provice'];?></li>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
			<?php }?>
			<div id="type">
				<div class="type_title">
					<span class="type_title_left">所有分类〉</span>
					<span class="type_title_right">共<?php echo $school_count;?>所学校</span>
				</div>
				<div class="type_conter">
					<div class="type_scope">
						<li>教学范围：</li>
						<li><input type="radio" name="type" value="0" <?php if($type == '0'){echo 'checked';}?> /> 全部</li>
						<li><input type="radio" name="type" value="1" <?php if($type == '1'){echo 'checked';}?>/> 书法</li>
						<li><input type="radio" name="type" value="2" <?php if($type == '2'){echo 'checked';}?>/> 绘画 </li>
						<li><input type="radio" name="type" value="3" <?php if($type == '3'){echo 'checked';}?>/> 其他</li>
					</div>					
					<div class="type_place">
						<li>学校位置：</li>
						<li id="provice_all" <?php if($city_id == ''){echo 'class="pitch"';}?> onclick="school_address('all');">全部</li>
                        <?php foreach($city_list as $r){?>
						<li id="provice_<?php echo $r['linkageid'];?>" onclick="school_address(<?php echo $r['linkageid'];?>);" <?php if($city_id != '' && $r['linkageid'] == $city_id){echo "class='pitch'";}?>><?php echo $r['name'];?></li>
                        <?php }?>
					</div>					
					<div class="type_details">
						<li>学校路线：</li>
						<li><input type="radio" name="micro_site_type" value="0" <?php if($micro_site_type == '0'){echo 'checked';}?>/> 全部</li>
						<li><input type="radio" name="micro_site_type" value="1" <?php if($micro_site_type == '1'){echo 'checked';}?>/> 青艺网已登记学校详情（已开通微站的学校）</li>
					</div>
                    <input type="hidden" id="type_submit" name="type_submit" value="<?php echo $type;?>" />
                    <input type="hidden" id="provice_submit" name="provice_submit" value="<?php echo $city_id;?>" />
                    <input type="hidden" id="micro_site_type_submit" name="micro_site_type_submit" value="<?php echo $micro_site_type;?>" />
                    <input type="hidden" id="search_submit" name="search_submit" value="<?php echo $search;?>" />
				</div>
			</div>
			<div id="synthesize" >
				<div id="synthesize_left">
					<div id="synthesize_title">
						<span class="synthesize_title_left">
							综合排序
						</span>
						<!--<span class="synthesize_title_right">
							<a href="">〈</a> 1/50 <a href="">〉</a>
						</span>-->
					</div>
                    <?php foreach($school_list as $r){?>
					<div id="synthesize_conter">
						<div class="synthesize_list">
							<div class="synthesize_list_pic">
								<?php if($r['qr_code'] != ''){?>
                                    <a href="index.php?m=school&c=index&a=school_show&id=<?php echo $r['id'];?>"><img src="<?php echo $r['school_logo'];?>"/></a>
                                <?php }else{?>
                                    <img src="<?php echo $r['school_logo'];?>"/>
                                <?php }?>
							</div>
							<div class="synthesize_list_details">
								<span><?php echo $r['school_name'];?></span>
								<li><img src="<?php echo IMG_PATH;?>school/images/images_11.png"/> 联系人：<?php echo $r['head'];?></li>
								<li><img src="<?php echo IMG_PATH;?>school/images/images_14.png"/> 联系电话：<?php echo $r['tel']?></li>
								<li><img src="<?php echo IMG_PATH;?>school/images/images_16.png"/> <?php echo mb_substr($r['provice'].$r['city'].$r['county'].$r['address'],0,58);?></li>
							</div>
							<div class="synthesize_list_weixin" style="margin-right:0px;width: 140px;">
                                <div style="width:92px;height: 122px;float: left;background-image:url('<?php echo IMG_PATH;?>school/images/images_06.png');">
                                    <?php if($r['qr_code'] != ''){ ?>
                                    <img src="<?php echo $r['qr_code'];?>" width="70" height="70" style="margin: 10px;margin-bottom: 5px;"/>
                                    <p style="width: 70px;color:#ccc;margin-left: 10px;font-size: 12px;line-height: 14px;letter-spacing: 5px;">微信扫描<br />了解详请</p>
                                    <?php }else{ ?>
                                    <p style="width: 95px;color: #ccc;margin-top: 50px;font-size: 12px;height: 122px;text-align: center;line-height: 19px;letter-spacing: 8px;">暂无详<br />细信息</p>
                                    <?php } ?>
                                </div>
								<a href="index.php?m=school&c=index&a=error_recovery&school_id=<?php echo $r['id'];?>&school_name=<?php echo $r['school_name'];?>" style="margin-left: 8px;"><img src="<?php echo IMG_PATH;?>school/images/images_08.png"/></a>
							</div>
						</div>
					</div>
                    <?php }?>
				</div>
				<div id="synthesize_right">
					<div id="ad">
						<a href="index.php?m=school&c=index&a=add_school"><img src="<?php echo IMG_PATH;?>school/images/images_03.png"/></a>
						<a href="index.php?m=school&c=index&a=micro_site_apply"><img src="<?php echo IMG_PATH;?>school/images/images_18.png"/></a>
					</div>
					<div class="friendship">
						<span>新开通微站学校</span>
                        <?php foreach( $new_school as $r){?>
                        <li><a href="index.php?m=school&c=index&a=school_show&id=<?php echo $r['id'];?>"><?php echo $r['school_name']?></a></li>
                        <?php }?>
					</div>
				</div>
			</div>
			<div id="page" style="text-align: center;"><?php echo $pages;?></div>
		</div>
	</body>
</html>

<script type="text/javascript">
    $('input[name="type"]').click(function(){
        var type = $('input[name="type"]:checked').val();
        $("#type_submit").val(type);
        go_index();
    });
    
    $('input[name="micro_site_type"]').click(function(){
        var micro_site_type = $('input[name="micro_site_type"]:checked').val();
        $("#micro_site_type_submit").val(micro_site_type);
        go_index();
    });
	
	function check(id){
		if(id == 1){
			$('#span1').attr('class','span_check1');
			$('#span2').attr('class','span_check2');
			$('#recommend_school').show();
			$('#new_school').hide();
		}else
		{
			$('#span2').attr('class','span_check1');
			$('#span1').attr('class','span_check2');
			$('#recommend_school').hide();
			$('#new_school').show();
		}
	}
	
    function school_address(provice_id){
    	if(provice_id == 'all'){
   	 		$('#provice_submit').val('');	
    	}else{
    		$('#provice_submit').val(provice_id);		
    	}
    	
    	go_index();
    }
    
    function go_index(){
   		var type = $('#type_submit').val();
    	var micro_site_type = $('#micro_site_type_submit').val();
    	var provice_id = $('#provice_submit').val();
    	var search = $('#search_submit').val();
        location.href = "index.php?m=school&c=index&a=init&provice_name=<?php echo $_SESSION['provice_name']['name'];?>&city_id="+provice_id+"&type="+type+"&micro_site_type="+micro_site_type+"&search="+search;
    }
    
</script>