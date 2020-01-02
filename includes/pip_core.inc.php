<?php

//========================================================================================
//
// CORE
//
// @author    Weaver (Fhizban)
// @copyright 2016+ www.critical-hit.biz
// @version   1.0
//
//========================================================================================



	global $lang, $css, $js;

	require_once('./includes/pip_config.inc.php');

	date_default_timezone_set(CONF_SYS_TIMEZONE);

	require_once('./includes/pip_plugins.inc.php');
	require_once('./includes/pip_lang.inc.php');
	
	require_once('./includes/pip_template.inc.php');
	require_once('./includes/pip_util.inc.php');
	require_once('./includes/pip_heartbeat.inc.php');
	require_once('./includes/pip_user.inc.php');
	require_once('./includes/pip_object.inc.php');
	require_once('./includes/pip_shop.inc.php');
	require_once('./includes/pip_reward.inc.php');
	require_once('./includes/pip_control.inc.php');
	
	require_once('./classes/pip_singleton.class.php');
	
	require_once('./classes/pip_database.class.php');
	require_once('./classes/pip_session.class.php');
	require_once('./classes/pip_form.class.php');
	require_once('./classes/pip_security.class.php');
	require_once('./classes/pip_shop.class.php');
	
	db::getInstance();
	
	$session 	= new pip_session();
	$security 	= new pip_security();



//=====================================================================================EOF

?>