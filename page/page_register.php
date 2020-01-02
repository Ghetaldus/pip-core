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

$vars["piptitle"] 	= "Register";
$vars["piperrors"] = "";
$vars["pipself"] = $_SERVER['PHP_SELF'];

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

if (isset($_POST['action_submit'])) {

	$nutzername 	= trim($_POST["ids_username"]);
	$email 			= trim($_POST["ids_email"]);
	$passwort 		= trim($_POST["ids_password"]);
	$passwortwdh 	= trim($_POST["ids_passwordrpt"]);

	$pass = false;
	
	if (!empty($nutzername) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($passwortwdh) && !empty($passwortwdh) && ($passwort == $passwortwdh)) {
		$pass = true;
	}

	if ($pass) {

		$sql = "SELECT * FROM <<".CONF_TBL_USER.">> WHERE username = '$nutzername'";
		$result = pip_db_query($sql);

		if (mysqli_num_rows($result) == 0) {
			
			$code = rand(100000, 999999); 
			
			pip_user_adduser($nutzername, $email, $passwort, $code);
			
			$betreff = "Beispiel - Aktivieren Sie Ihr Konto";
			$msg = "Hallo $nutzername,\n" .
			"Nur noch ein Schritt bis zu Ihrer Aktivierung ist nötig.\n" .
			"Besuchen sie http://beispiel.de/index.php?action=activate und geben Sie Ihren Nutzernamen ( $nutzername ) und den Aktivierungscode ( $code ) ein.\n" .
			"Mit freundlichen Grüßen\n" .
			"Beispielseite";

			pip_mail($email, $betreff, $msg);
		
			$vars["piperrors"] =  '<p class="pass">Ihr Konto wurde erstellt. Sie k&ouml;nnen sich jetzt <a href="index.php?action=login">einloggen.</a></p>';
			
		}      
		else {
			$vars["piperrors"] = '<p class="fail">Dieser Benutzername ist bereitsbelegt.</p>';
			$nutzername = "";
		}
	}
	else {
		$vars["piperrors"] = '<p class="fail">Sie haben vergessen Daten einzugeben oder diese sind fehlerhaft.</p>';
	}
}
		
//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_tpl_render("register", $vars);

//=====================================================================================EOF

?>