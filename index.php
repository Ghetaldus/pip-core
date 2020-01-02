<?php

//========================================================================================
//
// INDEX
//
// 
// @author    Weaver (Fhizban)
// @copyright 2016+ www.critical-hit.biz
// @version   1.0
//
//========================================================================================

require_once('includes/pip_core.inc.php');

if (isset($_GET["action"])) {
	pip_controller($_GET["action"]);
} else {
	pip_controller("");
}

//=====================================================================================EOF

?>