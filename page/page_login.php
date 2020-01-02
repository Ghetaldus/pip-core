<?php

//========================================================================================
//
// LOGIN
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

$vars["piptitle"] 	= "Login";
$vars["piperrors"] 	= "";
$vars["pipself"] 	= $_SERVER['PHP_SELF'];
	
//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

if (!isset($_SESSION['id'])) {
	if (isset($_POST['action_submit'])) {

		$nutzername = trim($_POST["ids_username"]);
		$passwort 	= trim($_POST["ids_password"]);

		$pass = false;
		
		if (!empty($nutzername) && !empty($passwort)) {
			$pass = true;
		}
		
		if ($pass) {

			$sql = "SELECT * FROM <<".CONF_TBL_USER.">> WHERE username = '$nutzername' AND password = SHA('$passwort') LIMIT 1";
			$row = pip_db_scalar($sql);

			if ($row) {
				
				$_SESSION = $row;
				setcookie("id", $row['id'], time() + (60 * 60 * 24 * 30));    // Verfaellt in 30 Tagen
				setcookie("username", $row['username'], time() + (60 * 60 * 24 * 30));  // Verfaellt in 30 Tagen
				$hauptseite = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php?action=members';
				header('Location: ' . $hauptseite);
			}
			else {
				$vars["piperrors"] = '<p class="fail">Sie m&uuml;ssen g&uuml;ltige Zugangsdaten eingeben, um sich einzuloggen.</p>';
			}
		}
		else {
			$vars["piperrors"] = '<p class="fail">Sie m&uuml;ssen Ihre Zugangsdaten eingeben, um sich einzuloggen.</p>';
		}
	}
}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
	
pip_tpl_render("login", $vars);

//=====================================================================================EOF

?>