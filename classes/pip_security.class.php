<?php

	//====================================================================================
	//
	// SECURITY CLASS
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//====================================================================================
	
	class pip_security {

		private $formKey;
		private $old_formKey;
		private $formValid;
		
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// Constructor
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public function __construct() {
			$this->pip_validate_form();
			$this->pip_sanitize_vars();
		}

		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// 
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		private function pip_validate_form() {

			if (isset($_SESSION['form_key'])) {
				$this->old_formKey = $_SESSION['form_key'];
			}

			if ($_SERVER['REQUEST_METHOD'] == 'post') {
				if (!isset($_POST['form_key']) || !$formKey->pip_validate()) {
					$this->formValid = false;
					$_POST = array();
					$_GET = array();
				} else {
					$this->formValid = true;
				}
			}

		}

		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// pip_generateKey
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public static function pip_generateKey() {
			
			$remoteIp = $_SERVER['REMOTE_ADDR'];
		 
			//We use mt_rand() instead of rand() because it is better for generating random numbers.
			//We use 'true' to get a longer string.
			//See http://www.php.net/mt_rand for a precise description of the function and more examples.
			$uniqid = uniqid(mt_rand(), true);
		 
			//Return the hash
			return md5($remoteIp . $uniqid);
		}
 
	 
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// pip_outputKey
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public static function pip_outputKey() {
			
			
			$_SESSION['form_key'] = pip_security::pip_generateKey();
		 
			//Output the form key
			//echo "<input type='hidden' name='form_key' id='form_key' value='".$this->formKey."' />";
		
			return $_SESSION['form_key'];
		}
 
	 
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// pip_validate
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public function pip_validate() {
			if($_POST['form_key'] == $this->old_formKey) {
				return true;
			} else {
				return false;
			}
		}
		
	
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// Sanitize all available POST and GET Variables
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		private function pip_sanitize_vars() {
			
			$min = 0;
			$max = 999999;
			
			// -- Validate POST variables
			foreach($_POST as $key => $value) {
    			if (strpos($key, 'action') === 0 || strpos($key, 'ids_') === 0) {
    			
    				$_POST[$key] = filter_var($_POST[$key], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    			
    			} else if (strpos($key, 'idn_') === 0) {
        	
        			if (filter_var($_POST[$key], FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false) {
        				$_POST[$key] = NULL;
        			}
        	
    			} else {
    				$_POST[$key] = NULL;
    			}
			}
			
			// -- Validate GET Variables
			foreach($_GET as $key => $value) {
    			if (strpos($key, 'action') === 0 || strpos($key, 'ids_') === 0 ) {
    			
    				$_GET[$key] = filter_var($_GET[$key], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    			
    			} else if (strpos($key, 'idn_') === 0) {
        	
        			if (filter_var($_GET[$key], FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false) {
        				$_GET[$key] = NULL;
        			}
        	
    			} else {
    				$_GET[$key] = NULL;
    			}
			}
					
		}
		
	}
	
	
	
//=====================================================================================EOF

?>