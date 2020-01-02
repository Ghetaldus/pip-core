<?php

	//====================================================================================
	//
	// FORM CLASS
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//====================================================================================
	
	class pip_form {
		
		private $data;
		private $submitLabel;
		private $fieldCount;
		
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// Constructor
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public function __construct($label, $action) {
			$this->pip_setupForm($label, $action);
		}
		
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// pip_setupForm
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public function pip_setupForm($label="", $action="") {
			
			$this->fieldCount 	= 0;
			$this->submitLabel = $label;
			
			$this->data = "\n";
			$this->data .= "<form action='index.php?action=".$action."' method='post'>\n";
					
		}
		
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// pip_addField
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public function pip_addField($name="", $type="", $value="", $other="") {
			if (!pip_empty($name, $type, $value)) {
				
				$this->data .= "<input type='".$type."' name='".$name."' value='".$value."' ".$other.">\n";
				
				$this->fieldCount++;
			}
		}
		
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// pip_outputForm
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public function pip_outputForm() {
			if ($this->fieldCount > 0) {
			
				$key = pip_security::pip_outputKey();
				
				$this->pip_addField("ids_formKey", "hidden", $key);
			
				$this->data .= "<input type='submit' value='".$this->submitLabel."'>\n</form>\n";
			
				return $this->data;
				
			}
			return "";
		}
		
	}
	
//=====================================================================================EOF

?>