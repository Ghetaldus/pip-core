<?php

	//====================================================================================
	//
	// SHOP CLASS
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//====================================================================================
	
	class pip_shop {
		
		public $data;
		
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// Constructor
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public function __construct($username="", $id="") {
			if (!pip_empty($username, $id)) {
				$this->data = pip_shop_get($username, $id);
				$this->setup();
			}
		}
		
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		// Setup
		//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - 
		public function setup() {
			
			$this->data['tspan'] 				+= $this->data['upgrade_tspan'] 			* ($this->data['level']-1);
			$this->data['amount_min'] 			+= $this->data['upgrade_amount'] 			* ($this->data['level']-1);
			$this->data['amount_max'] 			+= $this->data['upgrade_amount'] 			* ($this->data['level']-1);
			$this->data['required_level_min'] 	+= $this->data['upgrade_required_level'] 	* ($this->data['level']-1);
			$this->data['required_level_max'] 	+= $this->data['upgrade_required_level'] 	* ($this->data['level']-1);
			$this->data['rarity_min'] 			+= $this->data['upgrade_rarity'] 			* ($this->data['level']-1);
			$this->data['rarity_max'] 			+= $this->data['upgrade_rarity'] 			* ($this->data['level']-1);
					
		}
		
	}
	
	
	
//=====================================================================================EOF

?>