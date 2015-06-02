<?php
/**
 * 学校管理
 * sunzheng
 */

defined('IN_PHPCMS') or exit('No permission resources.');

session_start();

class index{
	
    function __construct(){
        $this->school_model = pc_base::load_model('school_model');
        $this->linkage_model = pc_base::load_model('linkage_model');
        $this->error_model = pc_base::load_model('error_model');
        $this->admin_model = pc_base::load_model('admin_model');
        $this->system_model = pc_base::load_model('system_model');
    }
    
    
    //热词
    public function hot_words(){
        $system = $this->system_model->get_one('id=1');
        $hot_words_array = explode(";",$system['hot_words']);
        return $hot_words_array;
    }
    
    //学校黄页---首页
    public function init() {
        $hot_words_array = $this->hot_words();
        
    	$page = isset( $_REQUEST['page'] )? intval( $_REQUEST['page'] ): 1 ;
    	$type = isset( $_REQUEST['type'] )? intval( $_REQUEST['type'] ): 0 ;
    	$micro_site_type = isset( $_REQUEST['micro_site_type'] )? intval( $_REQUEST['micro_site_type'] ): 0 ;
    	$search = isset( $_REQUEST['search'] )? trim( $_REQUEST['search'] ): '' ;
    	
    	$provice_name = isset( $_REQUEST['provice_name'] )? trim( $_REQUEST['provice_name'] ): '' ;
    	if( $provice_name != ''){
    		$area = $this->linkage_model->get_one("name='{$provice_name}'");
    		$provice = $area['linkageid'];
    	}else{
    		$provice = isset( $_REQUEST['provice'] )? intval( $_REQUEST['provice'] ): 2 ;
    	}
    	
    	$city_id = isset($_REQUEST['city_id']) ? intval($_REQUEST['city_id']) : '';
        
        //城市名称
        $provice_name = $this->linkage_model->get_one("linkageid = {$provice}");
        //下一级城市
        $city_list = $this->linkage_model->select("parentid = {$provice} and keyid = 1");
		
		$_SESSION['provice'] = $provice;
		$_SESSION['provice_name'] = $provice_name;
		
        $where = ' 1 = 1 and status = 1 and apply_type = 0 ';
        if($provice){
        	$where .= ' and provice = \''.$provice.'\'';
        }
        if($city_id != ''){
        	$where .= ' and city = \''.$city_id.'\'';
        }
        if($type != 0){
        	$where .= ' and type = \''.$type.'\'';
        }
        if($micro_site_type != 0){
        	$where .= ' and qr_code != "" ';
        }
        if($search != ''){
        	$where .= ' and school_name like \'%'.$search.'%\'';
        }
        $school_list = $this->school_model->listinfo($where,'create_time desc',$page,8,'',10,'',array("provice"=>$provice,"type"=>$type,"city"=>$city_id,"micro_site_type"=>$micro_site_type,"search"=>$search));
        $school_count = count($school_list);
        $pages = $this->school_model->pages;
        if( count($school_list) > 0 ){
        	foreach($school_list as $key=>$r){
        		$provice_name = $this->linkage_model->get_one("linkageid={$r['provice']}","name");
                $school_list[$key]['provice'] = $provice_name['name'];
                $city_name = $this->linkage_model->get_one("linkageid={$r['city']}","name");
                $school_list[$key]['city'] = $city_name['name'];
                $county_name = $this->linkage_model->get_one("linkageid={$r['county']}","name");
                $school_list[$key]['county'] = $county_name['name'];
        	}
        }
        //system
        $system = $this->system_model->get_one('id=1');
        $recommend_school_array = explode(";",$system['recommend_school']);
        if( count($recommend_school_array) > 0 ){
        	foreach($recommend_school_array as $r){
        		$school = $this->school_model->get_one(array('id'=>$r));
        		if($school != false){
        			$recommend_school[] = $school;
        		}
        	}
            foreach( $recommend_school as $key=>$r){
                $provice_name = $this->linkage_model->get_one("linkageid={$r['provice']}","name");
                if( strstr($provice_name['name'],'省') != false ){
                    $provice_name = $this->linkage_model->get_one("linkageid={$r['city']}","name");
                }
                $recommend_school[$key]['provice'] = $provice_name['name'];
            }
        }
        $new_school_array = explode(";",$system['new_school']);
        if( count($new_school_array) > 0){
            foreach($new_school_array as $r){
                $school = $this->school_model->get_one(array('id'=>$r));
        		if($school != false){
        			$new_school[] = $school;
        		}
            }
            foreach( $new_school as $key=>$r){
                $provice_name = $this->linkage_model->get_one("linkageid={$r['provice']}","name");
                if( strstr($provice_name['name'],'省') != false ){
                    $provice_name = $this->linkage_model->get_one("linkageid={$r['city']}","name");
                }
                $new_school[$key]['provice'] = $provice_name['name'];
            }
        }
        
        include template('school','index');
    }
    
    //添加学校
    public function add_school(){
        if($_REQUEST['dosubmit']){
            //$infos = $_REQUEST['info'];
            $infos['school_name'] = isset( $_REQUEST['school_name'] )? trim( $_REQUEST['school_name'] ): '' ;
            $infos['provice'] = isset( $_REQUEST['provice'] )? intval( $_REQUEST['provice'] ): '' ;
            $infos['city'] = isset( $_REQUEST['city'] )? intval( $_REQUEST['city'] ): '' ;
            $infos['county'] = isset( $_REQUEST['county'] )? intval( $_REQUEST['county'] ): '' ;
            $infos['address'] = isset( $_REQUEST['address'] )? trim( $_REQUEST['address'] ): '' ;
            $infos['mobile'] = isset( $_REQUEST['mobile'] )? trim( $_REQUEST['mobile'] ): '' ;
            $infos['tel'] = isset( $_REQUEST['tel'] )? trim( $_REQUEST['tel'] ): '' ;
            $infos['medium_range'] = isset( $_REQUEST['medium_range'] )? trim( $_REQUEST['medium_range'] ): '' ;
            $infos['apply_type'] = isset( $_REQUEST['apply_type'] )? intval( $_REQUEST['apply_type'] ): 0 ;
            $infos['create_time'] = time();
            $ret = $this->school_model->insert($infos,1);
            if( $ret ){
                echo 'ok';
                exit;
            }else{
                echo 'no';
                exit;
            }
        }
        else{
        	$hot_words_array = $this->hot_words();
            $provice = $this->linkage_model->select('parentid = 0 and keyid = 1');
            include template('school','add_school');
        }
    }
        
    //admin_login
    public function login(){
		include template('school','admin_login');	
    }
    
    public function loginout(){
    	session_destroy();
    }
    
    public function admin_login_submit(){
    		$username = isset( $_REQUEST['username'] ) ? trim( $_REQUEST['username'] ) : '' ;
    		$password = isset( $_REQUEST['password'] ) ? trim( $_REQUEST['password'] ) : '' ;
   		 	$adminuser = $this->admin_model->get_one("username = '{$username}'");
   		 	if($adminuser == false){
   		 		echo 'no';
   		 		exit;
   		 	}
	 		if( $adminuser['password'] == md5(md5(trim($password)).$adminuser['encrypt']) ){
	 			$_SESSION['username'] = $adminuser['username'];
	 			$_SESSION['userid'] = $adminuser['userid'];
	 			echo 'ok';
	 			exit;
	 		}else{
	 			echo 'no';
	 			exit;
	 		}
    }
    
    //微站申请
    public function micro_site_apply(){
        $hot_words_array = $this->hot_words();
    	$provice = $this->linkage_model->select('parentid = 0 and keyid = 1');
    	include template('school','micro_site_apply');
    }
    
    //error
    public function error_recovery(){
    	if($_REQUEST['dosubmit']){
    		//$infos = $_REQUEST['info'];
    		$infos['school_name'] = isset( $_REQUEST['school_name'] )? trim( $_REQUEST['school_name'] ): '' ;
            $infos['school_id'] = isset( $_REQUEST['school_id'] )? intval( $_REQUEST['school_id'] ): '' ;
            $infos['name'] = isset( $_REQUEST['name'] )? trim( $_REQUEST['name'] ): '' ;
            $infos['tel'] = isset( $_REQUEST['tel'] )? trim( $_REQUEST['tel'] ): '' ;
            $infos['desc'] = isset( $_REQUEST['desc'] )? trim( $_REQUEST['desc'] ): '' ;
    		$ret = $this->error_model->insert($infos,1);
            if( $ret ){
                echo 'ok';
                exit;
            }else{
                echo 'no';
                exit;
            }
    	}
    	else
		{
            $hot_words_array = $this->hot_words();
	    	$school_id = isset( $_REQUEST['school_id'] )? intval( $_REQUEST['school_id'] ): '' ;
			$school_name = isset( $_REQUEST['school_name'] )? trim( $_REQUEST['school_name'] ): '' ;
	    	include template('school','error_recovery');	
    	}
    }
    
    //学校城市
    public function school_city(){
        $hot_words_array = $this->hot_words();
  		//学校
  		$provice_id = isset( $_REQUEST['provice_id'] )? intval( $_REQUEST['provice_id'] ): 2 ;
  		
  		$school_list = $this->school_model->select("status = 1 and apply_type = 0");
  		foreach($school_list as $key=>$r){
  			$provice_data = $this->linkage_model->get_one("linkageid = {$r['provice']}");
  			$provice[$provice_data['linkageid']]['linkageid'] = $provice_data['linkageid'];
  			$provice[$provice_data['linkageid']]['name'] = $provice_data['name'];
  		}
  		
    	$provice_list = $provice;
    	foreach($provice_list as $k=>$r){
    		if( strstr($r['name'],'省') != false ){
    			$city_list = $this->school_model->select("provice = {$r['linkageid']} and status = 1 and apply_type = 0");
    			foreach($city_list as $l){
    				$city_data = $this->linkage_model->get_one("linkageid = {$l['city']}");
					$city[$city_data['linkageid']]['linkageid'] = $city_data['linkageid'];
					$city[$city_data['linkageid']]['name'] = $city_data['name'];
					unset($provice_list[$k]);
    			}
    		}
    	}
        if( count($city) > 0 )
            $array = $provice_list + $city;
        else
            $array = $provice_list;

    	foreach($array as $r){
			$pinyin = $this->getFirstCharter($r['name']);
			$city_pinyin[$pinyin]['city'][] = $r['name'];	
    	}
		
        //热门城市
        $system =$this->system_model->get_one("id=1");
        $hot_city_array = explode(";",$system['hot_city']);
        $hot_city = array();
        foreach( $hot_city_array as $r){
            $link = $this->linkage_model->get_one("name='{$r}'");
            if( count( $link) > 0)
                $hot_city[] = array('linkageid'=>$link['linkageid'],'name'=>$link['name']);
        }
		include template('school','school_city');
    }
    
    //学校管理列表
    public function school_list(){
    	$username = $_SESSION['username'];
    	if( $username == '' ){
    		echo '<script>alert(\'请先登录!\');location.href = \'index.php?m=school&c=index&a=login\';</script>';
			exit;	
    	}
    	$hot_words_array = $this->hot_words();
    	$page = isset( $_REQUEST['page'] )? intval( $_REQUEST['page'] ): 1 ;
    	
    	$school_name = isset( $_REQUEST['search_school_name'] )? trim( $_REQUEST['search_school_name'] ): '' ;
        
    	$where = ' 1 = 1 and status = 1 and apply_type = 0 ';
    	if( $school_name != ''){
    		$where .= ' and school_name like \'%'.$school_name.'%\'';
    	}
    	
    	$school_list = $this->school_model->listinfo($where,'create_time desc',$page,5,'',10,'',array('search_school_name'=>$school_name));
        $school_count = count($school_list);
        $pages = $this->school_model->pages;
        
    	include template('school','school_list');
    }
    
    public function edit_school(){
    	$school_id = isset( $_REQUEST['school_id'] )? intval( $_REQUEST['school_id'] ): '' ;
    	if($_REQUEST['dosubmit']){
			$infos['school_name'] = isset( $_REQUEST['school_name'] )? trim( $_REQUEST['school_name'] ): '' ;
			$infos['type'] = isset( $_REQUEST['type'] )? intval( $_REQUEST['type'] ): 3 ;
			$infos['provice'] = isset( $_REQUEST['provice'] )? intval( $_REQUEST['provice'] ): '' ;
			$infos['city'] = isset( $_REQUEST['city'] )? intval( $_REQUEST['city'] ): '' ;
			$infos['county'] = isset( $_REQUEST['county'] )? intval( $_REQUEST['county'] ): '' ;
			$infos['address'] = isset( $_REQUEST['address'] )? trim( $_REQUEST['address'] ): '' ;
			$infos['head'] = isset( $_REQUEST['head'] )? trim( $_REQUEST['head'] ): '' ;
			$infos['mobile'] = isset( $_REQUEST['mobile'] )? trim( $_REQUEST['mobile'] ): '' ;
			$infos['tel'] = isset( $_REQUEST['tel'] )? trim( $_REQUEST['tel'] ): '' ;
			$infos['medium_range'] = isset( $_REQUEST['medium_range'] )? trim( $_REQUEST['medium_range'] ): '' ;
			$infos['class_fee'] = isset( $_REQUEST['class_fee'] )? intval( $_REQUEST['class_fee'] ): 0 ;
			$infos['qr_code'] = isset( $_REQUEST['qr_code'] )? trim( $_REQUEST['qr_code'] ): '' ;
			$infos['school_logo'] = isset( $_REQUEST['school_logo'] )? trim( $_REQUEST['school_logo'] ): '' ;
            $infos['status'] = isset( $_REQUEST['status'] )? intval( $_REQUEST['status'] ): 1 ;
            $infos['micro_site_url'] = isset( $_REQUEST['micro_site_url'] )? trim( $_REQUEST['micro_site_url'] ): '' ;
            
			$ret = $this->school_model->update($infos,array('id'=>$school_id));
   			if( $ret ){
                echo 'ok';
                exit;
            }else{
                echo 'no';
                exit;
            }
    	}else{
    	    $school = $this->school_model->get_one("id={$school_id}");
	    	if($school['provice'] != 0){
	     		$provice_list = $this->linkage_model->select("parentid = 0 and keyid = 1");
		    	$select = "<select name='info[provice]' id='provice' onchange='provice(this.value)'>";
		    	foreach($provice_list as $r){
		    		$selected = '';
		    		if($r['linkageid'] == $school['provice']){
		    			$selected = 'selected';
		    		}
		    		$select .= "<option value='{$r['linkageid']}' $selected>{$r['name']}</option>";
		    	}
		    	$select .= "</select>";
		    	$school['provice_select'] = $select;
	    	}
	    	
	    	if($school['city'] != 0){
	     		$city_list = $this->linkage_model->select("parentid = {$school[provice]} and keyid = 1");
		    	$select = "<select name='info[city]' id='city' onchange='city(this.value)'>";
		    	foreach($city_list as $r){
		    		$selected = '';
		    		if($r['linkageid'] == $school['city']){
		    			$selected = 'selected';
		    		}
		    		$select .= "<option value='{$r['linkageid']}' $selected>{$r['name']}</option>";
		    	}
		    	$select .= "</select>";
		    	$school['city_select'] = $select;
	    	}
	    	
	    	if($school['county'] != 0){
	     		$county_list = $this->linkage_model->select("parentid = {$school[city]} and keyid = 1");
		    	$select = "<select name='info[county]' id='county'>";
		    	foreach($county_list as $r){
		    		$selected = '';
		    		if($r['linkageid'] == $school['county']){
		    			$selected = 'selected';
		    		}
		    		$select .= "<option value='{$r['linkageid']}' $selected>{$r['name']}</option>";
		    	}
		    	$select .= "</select>";
		    	$school['county_select'] = $select;
	    	}
	    	
	    	echo json_encode($school);	
    	}
    }
    
    public function delete_school(){
        $ids = isset( $_REQUEST['ids'] )? trim( $_REQUEST['ids'] ): '' ;
        $id_array = explode(",",$ids);
        foreach( $id_array as $id){
            $this->school_model->delete("id={$id}");
        }
    }
    
    public function delete_error(){
        $ids = isset( $_REQUEST['ids'] )? trim( $_REQUEST['ids'] ): '' ;
        $id_array = explode(",",$ids);
        foreach( $id_array as $id){
            $this->error_model->delete("id={$id}");
        }
    }
    
    public function delete_images(){
        $id = isset( $_REQUEST['id'] )? intval( $_REQUEST['id'] ): '' ;
        $this->system_model->update("images{$id}=''",array('id'=>1));
    }
    
    //学校展示
    public function school_show(){
        $hot_words_array = $this->hot_words();
        $id = isset( $_REQUEST['id'] )? intval( $_REQUEST['id'] ): '' ;
        $hot_words_array = $this->hot_words();
        
        $school_one = $this->school_model->get_one("id={$id}");
        //system
        $system = $this->system_model->get_one('id=1');
        $recommend_school_array = explode(";",$system['recommend_school']);
        if( count($recommend_school_array) > 0 ){
        	foreach($recommend_school_array as $r){
        		$school = $this->school_model->get_one(array('id'=>$r));
        		if($school != false){
        			$recommend_school[] = $school;
        		}
        	}
            foreach( $recommend_school as $key=>$r){
                $provice_name = $this->linkage_model->get_one("linkageid={$r['provice']}","name");
                if( strstr($provice_name['name'],'省') != false ){
                    $provice_name = $this->linkage_model->get_one("linkageid={$r['city']}","name");
                }
                $recommend_school[$key]['provice'] = $provice_name['name'];
            }
        }
        $new_school_array = explode(";",$system['new_school']);
        if( count($new_school_array) > 0){
            foreach($new_school_array as $r){
                $school = $this->school_model->get_one(array('id'=>$r));
        		if($school != false){
        			$new_school[] = $school;
        		}
            }
        }
    	include template('school','school_show');
    }
    
    //申请列表
    public function apply_list(){
    	$username = $_SESSION['username'];
    	if( $username == '' ){
    		echo '<script>alert(\'请先登录!\');location.href = \'index.php?m=school&c=index&a=login\';</script>';
			exit;	
    	}
        $hot_words_array = $this->hot_words();
        
   	    $page = isset( $_REQUEST['page'] )? intval( $_REQUEST['page'] ): 1 ;
        $apply_type = isset( $_REQUEST['apply_type'] ) ? intval( $_REQUEST['apply_type'] ) : 0 ;
        
    	$where = " 1 = 1 and status = 0 and apply_type = {$apply_type}";
    	
    	$school_list = $this->school_model->listinfo($where,'create_time desc',$page,5,'',10,'',array('apply_type'=>$apply_type));
        $pages = $this->school_model->pages;
        
    	include template('school','apply_list');
    }
    
    //纠错列表
    public function error_list(){
    	$username = $_SESSION['username'];
    	if( $username == '' ){
    		echo '<script>alert(\'请先登录!\');location.href = \'index.php?m=school&c=index&a=login\';</script>';
			exit;	
    	}
        $hot_words_array = $this->hot_words();
        $page = isset( $_REQUEST['page'] )? intval( $_REQUEST['page'] ): 1 ;
        
        $status = isset( $_REQUEST['status'] ) ? intval( $_REQUEST['status'] ) : 0 ;
        $where = " 1 = 1 and status = {$status}";
        
        $error_list = $this->error_model->listinfo($where,'id desc',$page,5,'',10,'',array('status'=>$status));
        $pages = $this->error_model->pages;
        
    	include template('school','error_list');	
    }
    
    //编辑纠错
    public function edit_error(){
        $id = isset( $_REQUEST['id'] )? intval( $_REQUEST['id'] ): '' ;
        $infos['manage'] = isset( $_REQUEST['manage'] )? trim( $_REQUEST['manage'] ): '' ;
        $infos['status'] = isset( $_REQUEST['status'] )? intval( $_REQUEST['status'] ): 0 ;
        
		$ret = $this->error_model->update($infos,array('id'=>$id));
		if( $ret ){
            echo 'ok';
            exit;
        }else{
            echo 'no';
            exit;
        }
    }
    
    //系统设置
    public function system(){
    	$username = $_SESSION['username'];
    	if( $username == '' ){
    		echo '<script>alert(\'请先登录!\');location.href = \'index.php?m=school&c=index&a=login\';</script>';
			exit;	
    	}
        $hot_words_array = $this->hot_words();
        
    	$system_data = $this->system_model->get_one('id=1');
    	include template('school','system');
    }
    
    public function edit_system(){
    	$infos['hot_words'] = isset( $_REQUEST['hot_words'] )? trim( $_REQUEST['hot_words'] ): '' ;
    	$infos['recommend_school'] = isset( $_REQUEST['recommend_school'] )? trim( $_REQUEST['recommend_school'] ): '' ;
    	$infos['new_school'] = isset( $_REQUEST['new_school'] )? trim( $_REQUEST['new_school'] ): '' ;
    	$infos['hot_city'] = isset( $_REQUEST['hot_city'] )? trim( $_REQUEST['hot_city'] ): '' ;
    	$infos['images1'] = isset( $_REQUEST['images1'] )? trim( $_REQUEST['images1'] ): '' ;
    	$infos['images2'] = isset( $_REQUEST['images2'] )? trim( $_REQUEST['images2'] ): '' ;
    	$infos['images3'] = isset( $_REQUEST['images3'] )? trim( $_REQUEST['images3'] ): '' ;
    	$infos['images4'] = isset( $_REQUEST['images4'] )? trim( $_REQUEST['images4'] ): '' ;
    	$infos['images5'] = isset( $_REQUEST['images5'] )? trim( $_REQUEST['images5'] ): '' ;
    	$infos['images_url1'] = isset( $_REQUEST['images_url1'] )? trim( $_REQUEST['images_url1'] ): '' ;
    	$infos['images_url2'] = isset( $_REQUEST['images_url2'] )? trim( $_REQUEST['images_url2'] ): '' ;
    	$infos['images_url3'] = isset( $_REQUEST['images_url3'] )? trim( $_REQUEST['images_url3'] ): '' ;
    	$infos['images_url4'] = isset( $_REQUEST['images_url4'] )? trim( $_REQUEST['images_url4'] ): '' ;
    	$infos['images_url5'] = isset( $_REQUEST['images_url5'] )? trim( $_REQUEST['images_url5'] ): '' ;
    	$ret = $this->system_model->update($infos,array('id'=>1));
		if( $ret ){
            echo 'ok';
            exit;
        }else{
            echo 'no';
            exit;
		}
    }
    
    //获取学校的城市
    public function get_school_city(){
    	$provice_id = isset( $_REQUEST['provice_id'] )? intval( $_REQUEST['provice_id'] ): '' ;
    	$city_list = $this->school_model->select("provice = {$provice_id} and status = 1 and apply_type = 0");
		foreach($city_list as $l){
			$city_data = $this->linkage_model->get_one("linkageid = {$l['city']}");
			$city[$city_data['linkageid']]['linkageid'] = $city_data['linkageid'];
			$city[$city_data['linkageid']]['name'] = $city_data['name'];
		}
		$select = "<select name='city' id='city' onchange='city();'>";
    	foreach($city as $r){
    		$select .= "<option value='{$r['linkageid']}'>{$r['name']}</option>";
    	}
    	$select .= "</select>";
    	echo $select;
    }
    
    
    public function city(){
        $provice_id = isset($_REQUEST['provice_id'])?$_REQUEST['provice_id']:'';
        $city_list = $this->linkage_model->select("parentid = {$provice_id} and keyid = 1");
    	$select = "<select name='info[city]' id='city' onchange='city(this.value);'>";
    	foreach($city_list as $r){
    		$select .= "<option value='{$r['linkageid']}'>{$r['name']}</option>";
    	}
    	$select .= "</select>";
    	echo $select;
    }
    
    public function county(){
        $city_id = isset($_REQUEST['city_id'])?$_REQUEST['city_id']:'';
        $county_list = $this->linkage_model->select("parentid = {$city_id} and keyid = 1");
        if( count($county_list) < 1 ){
            echo '';
            exit;
        } 
    	$select = "<select name='info[county]' id='county'>";
    	foreach($county_list as $r){
    		$select .= "<option value='{$r['linkageid']}'>{$r['name']}</option>";
    	}
    	$select .= "</select>";
    	echo $select;
    }
    
    function getFirstCharter($str){
    	if( empty($str) ) {
    		return '';
		}
		$fchar=ord($str{0});
		if($fchar>=ord('A')&&$fchar<=ord('z')) 
			return strtoupper($str{0});
		$s1=iconv('UTF-8','gb2312',$str);
		$s2=iconv('gb2312','UTF-8',$s1);
		$s=$s2==$str?$s1:$str;
		$asc=ord($s{0})*256+ord($s{1})-65536;
		if($asc>=-20319&&$asc<=-20284) return 'A';
		if($asc>=-20283&&$asc<=-19776) return 'B';
		if($asc>=-19775&&$asc<=-19219) return 'C';
		if($asc>=-19218&&$asc<=-18711) return 'D';
		if($asc>=-18710&&$asc<=-18527) return 'E';
		if($asc>=-18526&&$asc<=-18240) return 'F';
		if($asc>=-18239&&$asc<=-17923) return 'G';
		if($asc>=-17922&&$asc<=-17418) return 'H';
		if($asc>=-17417&&$asc<=-16475) return 'J';
		if($asc>=-16474&&$asc<=-16213) return 'K';
		if($asc>=-16212&&$asc<=-15641) return 'L';
		if($asc>=-15640&&$asc<=-15166) return 'M';
		if($asc>=-15165&&$asc<=-14923) return 'N';
		if($asc>=-14922&&$asc<=-14915) return 'O';
		if($asc>=-14914&&$asc<=-14631) return 'P';
		if($asc>=-14630&&$asc<=-14150) return 'Q';
		if($asc>=-14149&&$asc<=-14091) return 'R';
		if($asc>=-14090&&$asc<=-13319) return 'S';
		if($asc>=-13318&&$asc<=-12839) return 'T';
		if($asc>=-12838&&$asc<=-12557) return 'W';
		if($asc>=-12556&&$asc<=-11848) return 'X';
		if($asc>=-11847&&$asc<=-11056) return 'Y';
		if($asc>=-11055&&$asc<=-10247) return 'Z';
		return null;
	}
	
	public function upload_img(){
		$new_file_path = 'uploadfile/school/'.time().rand(100,999).".jpg";
		$ret['path'] = $new_file_path;
		if( move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$new_file_path) ){
			$ret['msg'] = 'ok';
		}else{
			$ret['msg'] = 'no';
		}
		echo json_encode($ret);
	}
	
	public function upload_logo(){
		$new_file_path = 'uploadfile/school/'.time().rand(100,999).".jpg";
		$ret['path'] = $new_file_path;
		if( move_uploaded_file($_FILES['school_logo_file']['tmp_name'],$new_file_path) ){
			$ret['msg'] = 'ok';
		}else{
			$ret['msg'] = 'no';
		}
		echo json_encode($ret);
	} 
	
	public function upload_images1(){
		$new_file_path = 'uploadfile/school/'.time().rand(100,999).".jpg";
		$ret['path'] = $new_file_path;
		if( move_uploaded_file($_FILES['images1_upload']['tmp_name'],$new_file_path) ){
			$ret['msg'] = 'ok';
		}else{
			$ret['msg'] = 'no';
		}
		echo json_encode($ret);
	} 
	public function upload_images2(){
		$new_file_path = 'uploadfile/school/'.time().rand(100,999).".jpg";
		$ret['path'] = $new_file_path;
		if( move_uploaded_file($_FILES['images2_upload']['tmp_name'],$new_file_path) ){
			$ret['msg'] = 'ok';
		}else{
			$ret['msg'] = 'no';
		}
		echo json_encode($ret);
	} 
	public function upload_images3(){
		$new_file_path = 'uploadfile/school/'.time().rand(100,999).".jpg";
		$ret['path'] = $new_file_path;
		if( move_uploaded_file($_FILES['images3_upload']['tmp_name'],$new_file_path) ){
			$ret['msg'] = 'ok';
		}else{
			$ret['msg'] = 'no';
		}
		echo json_encode($ret);
	} 
	public function upload_images4(){
		$new_file_path = 'uploadfile/school/'.time().rand(100,999).".jpg";
		$ret['path'] = $new_file_path;
		if( move_uploaded_file($_FILES['images4_upload']['tmp_name'],$new_file_path) ){
			$ret['msg'] = 'ok';
		}else{
			$ret['msg'] = 'no';
		}
		echo json_encode($ret);
	} 
	public function upload_images5(){
		$new_file_path = 'uploadfile/school/'.time().rand(100,999).".jpg";
		$ret['path'] = $new_file_path;
		if( move_uploaded_file($_FILES['images5_upload']['tmp_name'],$new_file_path) ){
			$ret['msg'] = 'ok';
		}else{
			$ret['msg'] = 'no';
		}
		echo json_encode($ret);
	} 

}
?>