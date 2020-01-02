<?php

	//====================================================================================
	//
	// USER
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//====================================================================================

	//------------------------------------------------------------------------------------
	// pip_user_adduser
	//------------------------------------------------------------------------------------
	function pip_user_adduser($username="", $email="", $password="", $code="") {
		if (!empty($username) && !empty($email) && !empty($password) && !empty($code) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$code1 = rand(100000, 999999); 
			$sql = "INSERT INTO <<".CONF_TBL_USER.">> (username,email,password,regdate,acode,active,scode) VALUES ('$username', '$email', SHA('$password'), NOW(), $code, 0, $code1)";
			
			pip_db_query($sql);
			
			pip_user_addscore($username);
			
			pip_object_adddefault($username, 'resource');
			pip_object_adddefault($username, 'item');
			pip_object_adddefault($username, 'char');
			pip_object_adddefault($username, 'task');
			pip_object_adddefault($username, 'building');
			pip_object_adddefault($username, 'tech');
			
			pip_shop_adddefault($username, 'shop');
			
		}
	}
		
	//------------------------------------------------------------------------------------
	// pip_user_addscore
	//------------------------------------------------------------------------------------
	function pip_user_addscore($username="", $score="") {
	
		if (!empty($username)) {
		
			$sql = 	"INSERT INTO <<".CONF_PREFIX_LST.CONF_TBL_USER.">> SET username = '$username' 
					,score = '$score'
					,tstamp= CURRENT_TIMESTAMP ON DUPLICATE KEY UPDATE
					tstamp = if('$score'> score,CURRENT_TIMESTAMP,tstamp)
					,score = if ('$score'>score, '$score', score);";
		
			pip_db_query($sql);
			
		}
	}

//=====================================================================================EOF

?>