<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页</title>
<link rel="stylesheet" href="<?php echo CSS_PATH;?>school/css/base.css" />
<link rel="stylesheet" href="<?php echo CSS_PATH;?>school/css/style.css" />
<script type="text/javascript" src="<?php echo JS_PATH;?>school/js/jquery.min.js"></script>

</head>
	<body>
		<!-- header start -->
		<div class="header w100">
			<div class="h_main">
		    	<div class="h_logo"><img src="<?php echo IMG_PATH;?>school/images/logo.png" /></div>
		        <div class="h_addres">
		        	<p class="ching"><?php echo $provice_name['name'];?></p>
		            <p class="c888"><a href="index.php?m=school&c=index&a=school_city&provice_id=<?php echo $provice;?>">[切换城市]</a></p>
		        </div>
		        <div class="h_ser"> <input type="text" /><button type="button" class="ser">&nbsp;</button></div>
		        <div class="h_right">
		        	<a href="index.php?m=school&c=index&a=micro_site_apply"><img src="<?php echo IMG_PATH;?>school/images/btn1.png"/></a>
		            <a href="index.php?m=school&c=index&a=error_recovery&school_id=<?php ?>"><img src="<?php echo IMG_PATH;?>school/images/btn2.png"/></a>
		        </div> 
		    </div>
		</div>
		<!-- header end -->