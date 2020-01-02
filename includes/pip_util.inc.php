<?php

	//========================================================================================
	//
	// UTIL
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//========================================================================================

	//----------------------------------------------------------------------------------------
	// pip_clamp
	//----------------------------------------------------------------------------------------
	function pip_clamp($current, $min, $max) {
    	return max($min, min($max, $current));
	}

	//----------------------------------------------------------------------------------------
	// pip_empty
	//----------------------------------------------------------------------------------------
	function pip_empty() {
		if (func_num_args() > 0) {
			foreach (func_get_args() as $arg) {
				if (empty($arg)) {
					return true;
				}
			}
        }
    	return false;
	}

	//----------------------------------------------------------------------------------------
	// 
	//----------------------------------------------------------------------------------------
	function pip_checktime($start, $duration) {
		if (!pip_empty($start, $duration)) {
			$start = strtotime($start) + $duration;
			$end = time();
			if ($end >= $start) {
				return true;
			}
		}
		return false;
	}

	//----------------------------------------------------------------------------------------
	// 
	//----------------------------------------------------------------------------------------
	function pip_sanitize($var) {
		return strip_tags(trim($var));
	}
	
	//----------------------------------------------------------------------------------------
	// 
	//----------------------------------------------------------------------------------------
	function pip_logincheck($login=1) {
		if ($login == 1) {
			if (!isset($_SESSION['id'])) {
				pip_controller(CONF_PG_FAIL);
			} else {
				if(isset($_SESSION['username']) && CONF_SYS_NOACTIVATE == FALSE) {
					$uname = $_SESSION['username'];
					$sql = "SELECT aktiviert, nutzername FROM <<".CONF_TBL_USER.">> WHERE nutzername = '$uname' ";
					$row = pip_db_reader($sql);
					if ($row['active'] == 0) {
						$aktivierungsseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?action=activate';
						header('Location:' . $aktivierungsseite);
					}		
				}
			}
		}
	}

	//----------------------------------------------------------------------------------------
	// 
	//----------------------------------------------------------------------------------------
	function pip_mail($to, $title, $body, $from='') {
		date_default_timezone_set('UTC');
		
		$from = trim($from);

		if (!$from) {
		$from = '<'.CONF_SYS_EMAIL.'>';
		}

		$rp    = CONF_SYS_EMAIL;
		$org    = CONF_SYS_URL;
		$mailer = 'PHP';

		$head  = '';
		$head  .= "Content-Type: text/plain \r\n";
		$head  .= "Date: ". date('r'). " \r\n";
		$head  .= "Return-Path: $rp \r\n";
		$head  .= "From: $from \r\n";
		$head  .= "Sender: $from \r\n";
		$head  .= "Reply-To: $from \r\n";
		$head  .= "Organization: $org \r\n";
		$head  .= "X-Sender: $from \r\n";
		$head  .= "X-Priority: 3 \r\n";
		$head  .= "X-Mailer: $mailer \r\n";

		$body  = str_replace("\r\n", "\n", $body);
		$body  = str_replace("\n", "\r\n", $body);

		return mail($to, $title, $body, $head);
  
	}

//=====================================================================================EOF

?>