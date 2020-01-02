<?php

	//====================================================================================
	//
	// SINGLETON CLASS
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//====================================================================================

	class singleton {
	
		protected static $_instance = null;

		public static function getInstance()
		{
		   if (null === self::$_instance)
		   {
			   self::$_instance = new self;
		   }
		   return self::$_instance;
		}

		protected function __clone() {}

		protected function __construct() {}
		
	}

	//=====================================================================================EOF

 ?>