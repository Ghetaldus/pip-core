<?php

//========================================================================================
//
// 
// @author    Weaver (Fhizban)
// @copyright 2016+ www.critical-hit.biz
// @version   1.0
//
//========================================================================================

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

#error_reporting(E_ALL);

$vars	= array();

$vars["piperrors"] = "";
$vars["piptitle"] 	= "Edit";
$vars["pipself"] = $_SERVER['PHP_SELF'];

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_logincheck();

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

if (isset($_POST['submit'])) {

	$passwort 	= trim($_POST['ids_password']);
	$newpw 		= trim($_POST['ids_newpw']);
	$wdhnewpw 	= trim($_POST['ids_wdhnewpw']);
	$nutzername = $_SESSION['username'];

	if(!empty($passwort) && !empty($newpw) && !empty($wdhnewpw)) { 

		$sql = "SELECT username, passwod FROM <<".CONF_TBL_USER.">> WHERE username = '$nutzername' AND password = SHA('$passwort')";
		$row = pip_db_reader($sql);

		if ($row) {
			if ($newpw == $wdhnewpw) {
			
				$sql = "UPDATE <<".CONF_TBL_USER.">> SET password = SHA('$newpw') WHERE username = '$nutzername'";
				pip_db_query($sql);
					
				$vars["piperrors"] = '<p class="pass">Ihr Passwort wurde erfolgreich ge&auml;ndert.</p>';
 
			}
			else {
				$vars["piperrors"] = '<p class="fail">Die beiden neuen Passw&ouml;rter stimmen nicht &uuml;berein.</p>';
			}
		}
		else {
			$vars["piperrors"] = '<p class="fail">Ihr aktuelles Passwort simmt nicht.</p>';
		}
	}
	else {
		$vars["piperrors"] = '<p class="fail">Sie haben die ben&ouml;tigten Felder nicht ausgef&uuml;llt.</p>';
	}  
}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_tpl_render("edit", $vars);

//=====================================================================================EOF

?>