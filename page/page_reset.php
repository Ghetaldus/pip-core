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

$vars["piptitle"] 	= "Reset Password";
$vars["piperrors"] = "";
$vars["pipself"] = $_SERVER['PHP_SELF'];

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

if (isset($_POST['submit'])) {

	$nutzername 		= trim($_POST["ids_username"]);
	$sicherheitscode 	= trim($_POST["idn_scode"]);
	$passwort 			= trim($_POST["ids_password"]);
	$passwortwdh 		= trim($_POST["ids_passwordrpt"]);

	if (!empty($nutzername) && !empty($sicherheitscode) && !empty($passwort) && !empty($passwortwdh)) {

		$sql = "SELECT username, scode FROM <<".CONF_TBL_USER.">> username = '$nutzername' AND scode = '$sicherheitscode'";
		$row = pip_db_reader($sql);

		if ($passwort == $passwortwdh) {	
			if ($row) {
  
				$code = rand(100000, 999999); 

				$sql = "UPDATE <<".CONF_TBL_USER.">> SET password = SHA('$passwort') WHERE username = '$nutzername'";
				pip_db_query($sql)
 
				$sql = "UPDATE <<".CONF_TBL_USER.">> SET scode = '$code' WHERE username = '$nutzername'";
				pip_db_query($sql)

				$vars["piperrors"] = '<p class="pass">Passwort wurde erfolgreich ge&auml;ndert. Sie k&ouml;nnen sich nun mit dem neuen Kennwort <a href="index.php?action=login">hier</a> einloggen.</p>';
			}
			else {
				$vars["piperrors"] = '<p class="fail">In der Abfrage ist ein Problem aufgetaucht.</p>';
			}
		}
		else {
			$vars["piperrors"] = '<p class="fail">Benutzername/Sicherheitscode falsch.</p>';
		}
	}
	else {
		$vars["piperrors"] = '<p class="fail">Sie m&uuml;ssen Daten eingeben.</p>';
	}
}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_tpl_render("reset", $vars);

//=====================================================================================EOF

?>