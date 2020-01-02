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
$vars["piptitle"] 	= "Activate";
$vars["pipself"] = $_SERVER['PHP_SELF'];

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

if (isset($_POST['submit'])) {

	$nutzername = trim($_POST['ids_username']);
	$code 		= trim($_POST['idn_aktivierung']);

	if(!empty($nutzername) && !empty($code)) {

		$sql = "SELECT * FROM <<".CONF_TBL_USER.">> WHERE nutzername = '$nutzername' AND aktivierungscode = '$code'";
		$row = pip_db_reader($sql);

		if ($row || CONF_SYS_NOACTIVATE) {
		
			pip_db_query("UPDATE <<".CONF_TBL_USER.">> SET aktiviert = '1' WHERE nutzername = '$nutzername'");
			
			$vars["piperrors"] = '<p class="pass">Ihr Account wurde erfolgreich aktiviert. <a href="index.php?action=members">Memberarea</a></p>';

		}
		else {
			$vars["piperrors"] = '<p class="fail">Die angegebenen Daten sind leider falsch.</p>';
		}

	}  
	else {
		$vars["piperrors"] = '<p class="fail">Sie haben vergessen Daten einzugeben.</p>';
	} 
}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_tpl_render("activate", $vars);

//=====================================================================================EOF

?>