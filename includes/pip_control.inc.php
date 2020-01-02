<?php

//========================================================================================
//
// CONTROL
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
function pip_controller($action) {
	
	$page = "";
	
	switch ($action) {
	
		case CONF_PG_MEMBERS:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_MEMBERS.".php";
			break;
		case CONF_PG_ACTIVATE:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_ACTIVATE.".php";
			break;
		case CONF_PG_LOGIN:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_LOGIN.".php";
			break;
		case CONF_PG_LOGOUT:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_LOGOUT.".php";
			break;
		case CONF_PG_EDIT:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_EDIT.".php";
			break;
		case CONF_PG_REGISTER:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_REGISTER.".php";
			break;
		case CONF_PG_FORGOT:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_FORGOT.".php";
			break;
		case CONF_PG_RESET:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_RESET.".php";
			break;
		case CONF_PG_FAIL:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_FAIL.".php";
			break;
		case CONF_PG_RANKING:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_RANKING.".php";
			break;
		case CONF_PG_PROFILE:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_PROFILE.".php";
			break;
		case CONF_PG_VIEW:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_VIEW.".php";
			break;
		case CONF_PG_LIST:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_LIST.".php";
			break;	
		case CONF_PG_SHOP:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_SHOP.".php";
			break;
		
		
		
			
		default:
			$page = "./page/".CONF_SUFFIX_PG.CONF_PG_INDEX.".php";
			break;
	}
	
	$action = "";
	
	include_once($page);
	
}

//=====================================================================================EOF

?>