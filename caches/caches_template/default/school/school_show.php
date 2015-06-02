<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("school","header"); ?>
		<div id="content">
			<div id="zhanshi_phone">
				<img src="<?php echo IMG_PATH;?>school/images/index_03.png"/>
				<div style="z-index: 1; background-color: white; width: 250px; height: 443px; position: relative; left: 41px; top: -587px;">
					<iframe src="<?php echo $school_one['micro_site_url']?>" width="100%" height="443px"></iframe>
				</div>
			</div>
			<div id="zhanshi_weixin">
				<div class="zxerweima fl">
					<img src="<?php echo $school_one['qr_code'];?>" />
					<p class="wxinfo">微信扫描了解详情</p>
				</div>
			</div>
			<div id="zhanshi_leisi">
				<span>
					<h4>最新加入学校:</h4>
                    <?php foreach( $recommend_school as $r){?>
                    <li><?php echo $r['school_name'];?></li>
                    <?php }?>
				</span>
				<span>
					<h4>推荐学校:</h4>
					<?php foreach( $new_school as $r){?>
                    <li><?php echo $r['school_name'];?></li>
                    <?php }?>
				</span>
			</div>
		</div>
	</body>
</html>