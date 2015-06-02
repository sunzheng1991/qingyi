<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>青艺网</title>
<link rel="stylesheet" href="<?php echo CSS_PATH;?>school/css/base.css" />
<link rel="stylesheet" href="<?php echo CSS_PATH;?>school/css/style.css" />
<script type="text/javascript" src="<?php echo JS_PATH;?>school/js/jquery.min.js"></script>


</head>
	<body>
		<!-- header start -->
		<div class="header w100">
			<div class="h_main">
		    	<div class="h_logo"><a href="index.php?m=school&c=index&a=init&provice_name=<?php echo $_SESSION['provice_name']['name']?>"><img src="<?php echo IMG_PATH;?>school/images/logo.png" /></a></div>
		        <div class="h_addres">
		        	<p class="ching"><?php echo $_SESSION['provice_name']['name'];?></p>
		            <p class="c888"><a href="index.php?m=school&c=index&a=school_city&provice_id=<?php echo $_SESSION['provice'];?>">[切换城市]</a></p>
		        </div>
		        <div class="h_ser">
                    <input type="text" name="search" id="search" value="<?php echo $search;?>"/><button type="button" class="ser">&nbsp;</button>
                    <span><?php foreach($hot_words_array as $r){?><a href="index.php?m=school&c=index&a=init&search=<?php echo $r;?>"><?php echo $r;?></a>&nbsp;&nbsp;&nbsp;<?php }?></span>
                </div>
		        <div class="h_right">
		            <?php if( $_SESSION['userid']){?>
		            <p><a href="index.php?m=school&c=index&a=school_list" style="float: left;font-size: 14px;">学校列表</a>
                    <span style="color: #3475B6;font-weight: 700;display:block;margin-left:10px;float:left;font-size: 14px;"><?php echo $_SESSION['username'];?></span>
                    <a href="javascript:void(0)" onclick="login_out();" style="font-size: 14px;">退出</a></p>
		            <?php }else{?>
                    <a href="index.php?m=school&c=index&a=micro_site_apply"><img src="<?php echo IMG_PATH;?>school/images/btn1.png"/></a>
					<a href="index.php?m=school&c=index&a=login"><img src="<?php echo IMG_PATH;?>school/images/btn2.png"/></a>
					<?php }?>
		        </div> 
		    </div>
		</div>
		<!-- header end -->
        <script type="text/javascript">
          $('.ser').on("click",function(){
            	var search = $('#search').val();
            	location.href = "index.php?m=school&c=index&a=init&search="+search;
            });
            
        	function login_out(){
        		if( confirm('确认退出?')){
        			$.post('index.php?m=school&c=index&a=loginout',{},function(){
        				location.href = 'index.php?m=school&c=index&a=init';
        			});	
        		}
        	}
        </script>
