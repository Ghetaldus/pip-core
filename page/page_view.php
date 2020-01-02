<?php

//========================================================================================
//
// VIEW
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
	
$vars["piptitle"] 	= "View Profile";
$vars["piperrors"] = "";
$vars["pipself"] = $_SERVER['PHP_SELF'];

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_logincheck();

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

if (isset($_GET["userid"])) {

	$nutzerid = pip_sanitize($_GET["userid"]);

	$sql = "SELECT ".CONF_FLD_ID.",".CONF_FLD_USERNAME.",".CONF_FLD_SCORE." FROM <<".CONF_TBL_USER.">> WHERE ".CONF_FLD_ID." = '$nutzerid'";
	$row = pip_db_reader($sql);

	if ($row) {
			
		$vars["pipsection"] = "";
		$vars["pipsection"] .= "<tr><td><b>ID:</b></td><td>".$row[CONF_FLD_ID]."</td></tr>\n";
		$vars["pipsection"] .= "<tr><td><b>Name:</b></td><td>".$row[CONF_FLD_USERNAME]."</td></tr>\n";
		$vars["pipsection"] .= "<tr><td><b>Score:</b></td><td>".$row[CONF_FLD_SCORE]."</td></tr>\n";

		$vars["pipsection"] .= "<tr><td colspan='99'><hr></td></tr>\n";

		$vars["pipsection"] .= "<tr><td><b>Wert 1</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Wert 2</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Wert 3</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Wert 4</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Wert 5</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Wert 6</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Wert 7</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Wert 8</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Wert 9</b></td><td>...</td>\n";
		
		$vars["pipsection"] .= "<tr><td colspan='99'><hr></td></tr>\n";
		
		$vars["pipsection"] .= "<tr><td><b>Interesse 1</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Interesse 2</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Interesse 3</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Interesse 4</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Interesse 5</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Interesse 6</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Interesse 7</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Interesse 8</b></td><td>...</td>\n";
		$vars["pipsection"] .= "<tr><td><b>Interesse 9</b></td><td>...</td>\n";
	
		$vars["pipsection"] .= "<tr><td colspan='99'><hr></td></tr>\n";
		
	}

}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_tpl_render("view", $vars);

//=====================================================================================EOF

?>