<?php

	//========================================================================================
	// 
	//========================================================================================
	
	/* -- Database Definitions -- */
	define('CONF_DB_HOST', 			'localhost'); 					// Database Host
	define('CONF_DB_USER', 			'youruser');				// Database User
	define('CONF_DB_PASS', 			'yourpassword'); 					// Database Password
	define('CONF_DB_NAME', 			'yourdatabase'); 				// Database Name
	define('CONF_DB_SOCKET', 		'');							// Database Socket /tmp/mysql5.sock
	define('CONF_DB_PORT',			3306);							// Database Port
	
	/* -- Database Table Definitions -- */
	define('CONF_DB_PREFIX', 		'pip');							// Database Table Prefix
	
	define('CONF_PREFIX_LST',		'list_');						// Database List Table
	define('CONF_PREFIX_TPL',		'template_');					// Database Template Table
	define('CONF_PREFIX_INV',		'inventory_');					// Database Inventory Table
	
	/* -- Table Name Definitions -- */
	define('CONF_TBL_USER',				'user');						//
	define('CONF_TBL_SHOP',				'shop');						// 
	define('CONF_TBL_RESOURCE',			'resource');					//
	define('CONF_TBL_ITEM',				'item');						//
	define('CONF_TBL_TASK',				'task');						//
	define('CONF_TBL_CHAR',				'char');						//
	define('CONF_TBL_BUILDING',			'building');					//
	define('CONF_TBL_REWARD',			'reward');						//
	define('CONF_TBL_GLOBALBUFF',		'globalbuff');					//
	
	/* -- Contact Definitions -- */
	define('CONF_SYS_EMAIL',			'test@yourdomain.com');			//
	define('CONF_SYS_URL',				'yourdomain.com');			//
	define('CONF_SYS_NOACTIVATE',		true);							//
	define('CONF_SYS_TIMEZONE',			"Europe/Berlin");				//
	define('CONF_SYS_SESSION_LIFETIME', 21600);
	define('CONF_SUFFIX_PG', 			'page_');						// page suffix
	define('CONF_SUFFIX_TP', 			'tpl_');						// template suffix
	
	/* -- Page Name Definitions -- */
	define('CONF_PG_INDEX', 		'index');						//
	define('CONF_PG_MEMBERS', 		'members');						//
	define('CONF_PG_ACTIVATE', 		'activate');					//
	define('CONF_PG_LOGIN', 		'login');						//
	define('CONF_PG_LOGOUT', 		'logout');						//
	define('CONF_PG_EDIT', 			'edit');						//
	define('CONF_PG_REGISTER', 		'register');					//
	define('CONF_PG_FORGOT', 		'forgot');						//
	define('CONF_PG_RESET', 		'reset');						//
	define('CONF_PG_FAIL', 			'fail');						//
	define('CONF_PG_RANKING', 		'ranking');						//
	define('CONF_PG_PROFILE', 		'profile');						//
	define('CONF_PG_VIEW',	 		'view');						//
	
	define('CONF_PG_SHOP',			'shop');						//
	define('CONF_PG_LIST',			'list');						//
	
	
	
	
	
	
	
	
	
	//=================================================================================EOF
	
?>