<?php

	//====================================================================================
	//
	// SHOP
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//====================================================================================
	
	//------------------------------------------------------------------------------------
	// pip_shop_adddefault
	// add all default shops to a users account
	//------------------------------------------------------------------------------------
	function pip_shop_adddefault($username="") {
		if (!empty($username)) {
			$sql = "SELECT * FROM <<".CONF_PREFIX_TPL.CONF_TBL_SHOP.">> WHERE `default_level` != '0'";
			$row = pip_db_reader($sql);
			if ($row) {
				foreach ($row as $result) {
					pip_shop_add($username, $result['id'], $result['default_level']);
				}
			}
		}
	}
	
	//------------------------------------------------------------------------------------
	// pip_shop_add
	// add a new shop to a users account or increase/decrease an existing objects amount/level
	//------------------------------------------------------------------------------------
	function pip_shop_add($username="", $id="", $level="") {
		if (!pip_empty($username, $id, $level)) {
			$sql = "SELECT * FROM <<".CONF_PREFIX_LST.CONF_TBL_SHOP.">> WHERE username = '$username' AND myid = '$id' LIMIT 1";
			$row = pip_db_scalar($sql);
			$subrow = pip_shop_get($username, $id);
			if ($row) {
				$sql = "UPDATE <<".CONF_PREFIX_LST.CONF_TBL_SHOP.">> SET level = level + '$level' WHERE ".CONF_FLD_USERNAME." = '$username' AND myid = '$myid' LIMIT 1"; 
				pip_db_query($sql);
			} else {
				$sql = "INSERT INTO <<".CONF_PREFIX_LST.CONF_TBL_SHOP.">> (username, myid, category, level, tstamp) VALUES ('".$username."', '".$id."', '".$subrow['category']."', '".$level."', null);";
				pip_db_query($sql);
			}
		}
	}

	//------------------------------------------------------------------------------------
	// pip_shop_getall
	// return all shops of a specific category on a users account and their template data
	//------------------------------------------------------------------------------------
	function pip_shop_getall($username="") {
		$data = array();
		if (!empty($username)) {
			$sql = "SELECT * FROM <<".CONF_PREFIX_LST.CONF_TBL_SHOPLIST.">> WHERE username = '$username'";
			$row =  pip_db_reader($sql);
			if ($row) {
				foreach ($row as $result) {
					$subrow = pip_object_get(CONF_TBL_SHOP, $result['myid']);
					if ($subrow) {
						$data[] = array_merge($subrow, $result);
					}
				}
			}
		}
		return $data;
	}
	
	//------------------------------------------------------------------------------------
	// pip_shop_get
	// return the template and user settings of a specific shop
	//------------------------------------------------------------------------------------
	function pip_shop_get($username="", $id="") {
		$data = array();
		if (!pip_empty($username, $id)) {
			$data = pip_object_get(CONF_TBL_SHOP, $id);
			$sql = "SELECT * FROM <<".CONF_PREFIX_LST.CONF_TBL_SHOP.">> WHERE username = '".$username."' AND myid = '".$id."' LIMIT 1";
			$subrow = pip_db_scalar($sql);	
			if ($subrow) {
				$data = array_merge($data, $subrow);
			}
		}
		return $data;
	}	

	//------------------------------------------------------------------------------------
	// pip_shop_removeinventory
	// remove one object (or an amount) from a user accounts shop inventory
	//------------------------------------------------------------------------------------
	function pip_shop_removeinventory($username="", $shopid="", $objid="", $amount="") {
		if (!pip_empty($username, $shopid, $objid, $amount)) {
		
			// -- Get Shop Template & Shop Level Attributes
			$row = pip_shop_get($username, $shopid);
		
			if ($row) {
				if ($row['stock']) {
					$sql = "SELECT * FROM <<".CONF_PREFIX_INV.CONF_TBL_SHOP.">> WHERE username = '".$username."' AND myid = '".$objid."' LIMIT 1";
					$item = pip_db_scalar($sql);
					
					if ($amount <= 0 || $amount >= $item['amount']) {
						$sql = "DELETE FROM <<".CONF_PREFIX_INV.CONF_TBL_SHOP.">> WHERE username = '".$username."' AND myid = '".$objid."'";
					} else {
						$sql = "UPDATE <<".CONF_PREFIX_INV.CONF_TBL_SHOP.">> SET amount = amount - '".$amount."' WHERE username = '$username' AND myid = '$objid' LIMIT 1"; 
					}
					pip_db_query($sql);
					
				}
			}
		}
	}	

	//------------------------------------------------------------------------------------
	// pip_shop_getinventory
	// return the inventory of a user shop and refresh the shop if required
	//------------------------------------------------------------------------------------
	function pip_shop_getinventory($username="", $id="") {
		$data = array();
		if (!empty($username) && !empty($id)) {
		
			$refresh = false;
			
			// -- Check if Shop exists
			$sql = "SELECT * FROM <<".CONF_PREFIX_LST.CONF_TBL_SHOP.">> WHERE username = '".$username."' AND myid = '".$id."' LIMIT 1";
			$row = pip_db_scalar($sql);

			if ($row) {
			
				// -- Get Shop Template & Shop Level Attributes
				$shop = new pip_shop($username, $id);
				
				// -- Check Shop empty
				$sql = "SELECT * FROM <<".CONF_PREFIX_INV.CONF_TBL_SHOP.">> WHERE username = '".$username."' AND myid = '".$id."'";
				$count = pip_db_scalar($sql);
				
				if (empty($count)) {
					$refresh = true;
				} else {
					$tstamp 	= $shop->data['tstamp'];
					$tspan 		= $shop->data['tspan'];
					$refresh 	= pip_checktime($tstamp, $tspan);
				}
				
				if ($refresh) {
					pip_shop_refreshinventory($username, $id);
				}
				
				// -- Gather Shop Inventory
				$sql = "SELECT * FROM <<".CONF_PREFIX_INV.CONF_TBL_SHOP.">> WHERE username = '".$username."' AND myid = '".$id."'";
				$subrow = pip_db_reader($sql);

				foreach ($subrow as $item) {
					$subrow2 = pip_object_get($item['category'], $item['objectid']);
					if ($subrow2) {
						$data[] = array_merge($item, $subrow2);
					}
					
				}
			}
		}
		return $data;
	}

	//------------------------------------------------------------------------------------
	// pip_shop_checkunique
	// check if the unique amount limit of a certain shop item is reached
	//------------------------------------------------------------------------------------
	function pip_shop_checklimitation($username="", $category="", $id="", $limit="") {
		$ok = true;
		if (!empty($username) && !empty($category) && !empty($id) && !empty($limit)) {
			if ($limit > 0) {
				$amount = pip_object_getamount($username, $category, $id);
				if ($amount >= $limit) {
					$ok = false;
				}
			}
		}
		return $ok;
	}

	//------------------------------------------------------------------------------------
	// pip_shop_refreshinventory
	// refresh a shop inventory according to category, rarity and object level min/max
	//------------------------------------------------------------------------------------
	function pip_shop_refreshinventory($username="", $id="") {
		if (!pip_empty($username, $id)) {
			
			$data = array();
			
			// -- Delete old Shop Inventory
			$sql = "DELETE FROM <<".CONF_PREFIX_INV.CONF_TBL_SHOP.">> WHERE username = '$username' AND myid = '".$id."'";
			pip_db_query($sql);
			
			// -- Get Shop Template & Shop Level Attributes
			$shop = new pip_shop($username, $id);
			
			if ($shop) {
			
				$sql = "SELECT * FROM <<".CONF_PREFIX_TPL.$shop->data['category'].">> WHERE required_level_min <= '".$shop->data['required_level_min']."' AND required_level_max >= '".$shop->data['required_level_max']."'";
				$data = pip_db_reader($sql);

				if ($data) {
					$amount = rand($shop->data['amount_min'], $shop->data['amount_max']);
					for ($i=1; $i<=$amount; $i++) {
						
						shuffle($data);
						$rarity = rand($shop->data['rarity_min'],$shop->data['rarity_max']);

						foreach ($data as $item) {
							
							// -- Check Amount Limitation
							$ok = pip_shop_checklimitation($username, $shop->data['category'], $item['id'], $item['limit']);
							
							if ($ok && $item['rarity'] <= $rarity) {
								
								$objectamount 	= 0;
								$objectlevel 	= 0;
								
								if (isset($item['acquire_amount_min'])) {
									$objectamount = rand($item['acquire_amount_min'],$item['acquire_amount_max']);
								}
								if (isset($item['acquire_level_min'])) {
									$objectlevel = rand($item['acquire_level_min'],$item['acquire_level_max']);
								}
								
								$sql = "INSERT INTO <<".CONF_PREFIX_INV.CONF_TBL_SHOP.">> (username,myid,category,objectid,amount,level) VALUES ('$username', '$id', '".$shop->data['category']."', '".$item['id']."', '$objectamount', '$objectlevel');";
								pip_db_query($sql);		
							}
						}
					}
				}
				
				$sql = "UPDATE <<".CONF_PREFIX_LST.CONF_TBL_SHOP.">> SET tstamp = NOW() WHERE username = '$username' AND myid = '$id' LIMIT 1"; 
				pip_db_query($sql);		
	
			}
		}
	}
	
	
//=====================================================================================EOF

?>