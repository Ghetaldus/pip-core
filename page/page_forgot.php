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
$vars["piptitle"] 	= "Forgot Password";
$vars["pipself"] = $_SERVER['PHP_SELF'];

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
	
if (isset($_POST['submit'])) {
	
	$nutzername = trim($_POST['ids_username']);
	$email 		= trim($_POST['ids_email']);

	if (!empty($nutzername) && !empty($email)) {
		
		$sql = "SELECT email, nutzername FROM <<".CONF_TBL_USER.">> WHERE nutzername = '$nutzername' AND email = '$email'";
		$row = pip_db_reader($sql);
		
		if ($row) {
		
			$vergessencode = rand(100000, 999999);

			$sql = "UPDATE <<".CONF_TBL_USER.">> SET vergessen = '$vergessencode' WHERE nutzername = '$nutzername'";
 			pip_db_query($sql);
			
			$betreff = "Beispiel - Passwort vergessen?";
			$msg = "Hallo $nutzername,\n" .
			"wenn Sie ihr Passwort vergessen haben besuchen Sie bitte http://localhost/zuruecksetzen.php und &auml;ndern Sie ihr vergessenes Passwort in ein neues gewünschtes Passwort um.\n" .
			"Dazu benötigen Sie nur Ihren Benutzernamen ( $nutzername ) und einen generierten Sicherheitsschlüssel ( $vergessencode ). \n" .
			"Falls Sie Ihr Passwort nicht vergessen haben ignorieren Sie diese E-Mail bitte einfach. \n" . 
			"Mit freundlichen Grüßen\n" .
			"Beispielseite";

			pip_mail($email, $betreff, $msg);
			
			$vars["piperrors"] = '<p class="pass">Sie haben einen entsprechenden Sicherheitscode an Ihre E-Mail Adresse erhalten. Sie k&ouml;nnen <a href="index.php?action=reset">hier</a> Ihr Passwort zur&uuml;cksetzen.</p>';
			
			mysqli_close($db);
		}
		else {
			$vars["piperrors"] = '<p class="fail">E-Mail und Nutzername stimmen nicht &uuml;berein.</p>';
		}
	}
	else {
		$vars["piperrors"] = '<p class="fail">Sie haben vergessen Daten einzugeben.</p>';
	}
}
		
//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_tpl_render("forgot", $vars);

//=====================================================================================EOF
	
?>