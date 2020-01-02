<?php

	//====================================================================================
	//
	// OBJECT
	//
	// 
	// @author    Weaver (Fhizban)
	// @copyright 2016+ www.critical-hit.biz
	// @version   1.0
	//
	//====================================================================================

	//------------------------------------------------------------------------------------
	// pip_object_adddefault
	// add all default objects to a users account
	//------------------------------------------------------------------------------------
	function pip_object_adddefault($username="", $category="") {
		if (!pip_empty($username, $category)) {
		
			if ($category == "resource") {
				$sql = "SELECT * FROM <<".CONF_PREFIX_TPL.$category.">> WHERE default_amount != '0'";
			} else if ($category == "item") {
				$sql = "SELECT * FROM <<".CONF_PREFIX_TPL.$category.">> WHERE default_amount != '0' OR default_level != 0";
			} else {
				$sql = "SELECT * FROM <<".CONF_PREFIX_TPL.$category.">> WHERE default_level != '0'";
			}
			
			$row = pip_db_reader($sql);
			if ($row) {
				foreach ($row as $result) {
					
					$amount = 0;
					$level = 0;

					if (isset($result['default_amount'])) {
						$amount = $result['default_amount'];
					}
					if (isset($result['default_level'])) {
						$level = $result['default_level'];
					}
				
					pip_object_add($username, $category, $result['id'], $amount, $level);
				}
			}
		}
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_add
	// add a new object to a users account or increase/decrease an existing objects amount/level
	//------------------------------------------------------------------------------------
	function pip_object_add($username="", $category="", $id="", $amount=0, $level=0) {
		if (!pip_empty($username, $category, $id) && ($amount != 0 || $level != 0)) {	
			$sql = "SELECT * FROM <<".CONF_PREFIX_LST.$category.">> WHERE username = '$username' AND myid = '$id' LIMIT 1";
			$row = pip_db_scalar($sql);
			if ($row) {
				if ($amount != 0 && $level != 0) {
					$sql = "UPDATE <<".CONF_PREFIX_LST.$category.">> SET amount = amount + '$amount', level = level + '$level' WHERE username = '$username' AND myid = '$id' LIMIT 1";
				} else if ($amount != 0) {
					$sql = "UPDATE <<".CONF_PREFIX_LST.$category.">> SET amount = amount + '$amount' WHERE username = '$username' AND myid = '$id' LIMIT 1";
				} else if ($level != 0) {
					$sql = "UPDATE <<".CONF_PREFIX_LST.$category.">> SET level = level + '$level' WHERE username = '$username' AND myid = '$id' LIMIT 1";
				}
				pip_db_query($sql);
			} else {
				if ($amount != 0 && $level != 0) {
					$sql = "INSERT INTO <<".CONF_PREFIX_LST.$category.">> (username,myid,amount,level) VALUES ('$username', '$id', '$amount', '$level');";
				} else if ($amount != 0) {
					$sql = "INSERT INTO <<".CONF_PREFIX_LST.$category.">> (username,myid,amount) VALUES ('$username', '$id', '$amount');";
				} else if ($level != 0) {
					$sql = "INSERT INTO <<".CONF_PREFIX_LST.$category.">> (username,myid,level) VALUES ('$username', '$id', '$level');";
				}
				pip_db_query($sql);
			}
			
			pip_object_updatebuff($username, $category, $id);
			
		}
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_getall
	// return all objects of a specific category on a users account and their template data
	//------------------------------------------------------------------------------------
	function pip_object_getall($username="", $category="") {
		$data = array();
		if (!pip_empty($username, $category)) {
			$sql = "SELECT * FROM <<".CONF_PREFIX_LST.$category.">> WHERE username = '$username'";
			$row =  pip_db_reader($sql);
			if ($row) {
				foreach ($row as $result) {
					$subrow = pip_object_get($category, $result['myid']);
					if ($subrow) {
						$data[] = array_merge($subrow, $result);
					}
				}
			}
		}
		return $data;
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_get
	// return the template of a specific object (not related to a user account)
	//------------------------------------------------------------------------------------
	function pip_object_get($category= "", $id="") {
		$data = array();
		if (!pip_empty($category, $id)) {
			$sql = "SELECT * FROM <<".CONF_PREFIX_TPL.$category.">> WHERE id = '".$id."' LIMIT 1";
			$data =  pip_db_scalar($sql);
		}
		return $data;
	}	
	
	//------------------------------------------------------------------------------------
	// pip_object_getinstance
	// return both the template and the instance of a specific object related to a user account
	//------------------------------------------------------------------------------------
	function pip_object_getinstance($username="", $category= "", $id="", $myid="") {
		$data = array();
		if (!pip_empty($username, $category, $id, $myid)) {
			$data = pip_object_get($category, $myid);
			if ($data) {
				$sql = "SELECT * FROM <<".CONF_PREFIX_LST.$category.">> WHERE username = '$username' AND id = '".$id."' LIMIT 1";
				$row =  pip_db_scalar($sql);
				if ($row) {
					$data = array_merge($data, $row);
				}
			}
		}
		return $data;
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_getamount
	// return the the total amount of a specific object on a users account
	//------------------------------------------------------------------------------------
	function pip_object_getamount($username="", $category="", $id="") {
		$amount = 0;
		if (!pip_empty($username, $category, $id)) {
			$sql = "SELECT * FROM <<".CONF_PREFIX_LST.$category.">> WHERE username = '$username' AND myid = '".$id."'";
			$row = pip_db_reader($sql);
			if ($category == "resource" || $category == "item") {
				foreach ($row as $item) {
					$amount += $row['amount'];
				}
			} else {
				$amount += count($row);
			}
		}
		return $amount;
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_checkrequirements
	// 
	//------------------------------------------------------------------------------------
	function pip_object_checkrequirements($username="", $category="", $myid="") {
		$success = false;
		if (!pip_empty($username, $category, $myid)) {
			$success = true;
			$sql = "SELECT * FROM <<".CONF_PREFIX_TPL."requirement>> WHERE category = '".$category."' AND myid = '".$myid."'";
			$requirements = pip_db_reader($sql);
			foreach ($requirements as $requirement) {
				$sql = "SELECT * FROM <<".CONF_PREFIX_LST.$requirement['req_category'].">> WHERE username = '".$username."' AND myid = '".$requirement['req_id']."' AND level >= '".$requirement['req_level']."'";
				$count = pip_db_scalar($sql);
				if (!empty($count)) {
					$success = true;
				} else {
					$success = false;
					break;
				}
			}
		}
		return $success;
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_canbuy
	// checks if a user can buy a object by validating resource prices and amount limit
	//------------------------------------------------------------------------------------
	function pip_object_canbuy($username="", $category="", $id="", $amount="") {
		$success = false;
		if (!pip_empty($username, $category, $id)) {
		
			$success = true;
			$object = pip_object_get($category, $id);
			$data 	= pip_object_getall($username, 'resource');
			$amount = max($amount, 1);
			
			// -- check limit (if any)
			if ($object['limit'] > 0) {
				if (pip_object_getamount($username, $category, $id) >= $object['limit']) {
					$success = false;
				}
			}
		
			// -- check resource cost
			if ($success) {
				foreach ($data as $result) {
					for ($i=1; $i<10; $i++) {
						if ($object['res'.$i.'_amount']*$amount > $result['amount']) {
							$success = false;
							break;
						}
					}	
				}
			}
			
			// -- check requirements
			if ($success) {
				$success = pip_object_checkrequirements($username, $category, $id);
			}

		}
		return $success;
	}	

	//------------------------------------------------------------------------------------
	// pip_object_canupgrade
	// 
	//------------------------------------------------------------------------------------
	function pip_object_canupgrade($username="", $category="", $id="", $myid="") {
		$success = false;
		if (!pip_empty($username, $category, $id, $myid)) {
		
			$success = true;
			$object = pip_object_getinstance($username, $category, $id, $myid);
			$data 	= pip_object_getall($username, 'resource');
			$level = $object['level']+1;
			
			// -- check max level
			if ($object['level'] >= $object['max_level']) {
					$success = false;
			}
		
			// -- check resource cost
			if ($success) {
				foreach ($data as $result) {
					for ($i=1; $i<10; $i++) {
						$res_amount = $object['res'.$i.'_amount'] * $level * $object['upgrade_factor'];
						if ($res_amount > $result['amount']) {
							$success = false;
							break;
						}
					}	
				}
			}
			
			// -- check requirements
			if ($success) {
				$success = pip_object_checkrequirements($username, $category, $myid);
			}
			
		}
		
		return $success;
	}	

	//------------------------------------------------------------------------------------
	// pip_object_getmaxbuyamount
	// 
	//------------------------------------------------------------------------------------
	function pip_object_getmaxbuyamount($username="", $category="", $id="") {
		$tmp_amount = 0;
		if (!pip_empty($username, $category, $id)) {
	
			$object = pip_object_get($category, $id);

			if (isset($object['acquire_amount_min'])) {
			
				$tmp_amount = 1;
				$finished	= false;
				$success = pip_object_canbuy($username, $category, $id, $tmp_amount);
				
				if (!$success) {
					return 0;
				} else {
	
					while (!$finished) {		
						if ($tmp_amount < 10) {
							$tmp_amount++;
						} else {
							$tmp_amount += 5;
						}
						$success = pip_object_canbuy($username, $category, $id, $tmp_amount);
						if (!$success) {
							return $tmp_amount;
						}
						if ($tmp_amount >= 200) {
							$finished = true;
						}
					}
				
				}
			
			}
		}
		return $tmp_amount;
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_buy
	// validate an object then pay its resource cost and add it to a user account
	//------------------------------------------------------------------------------------
	function pip_object_buy($username="", $category="", $id="", $amount="", $level="") {
		$success = false;
		if (!pip_empty($username, $category, $id) && (!empty($amount) || !empty($level))) {	
			if (pip_object_canbuy($username, $category, $id, $amount)) {
				$object = pip_object_get($category, $id);
				$data 	= pip_object_getall($username, 'resource');
				$tmp_amount = max(1, $amount);
				
				// -- deduct resource(s)
				for ($i=1; $i<10; $i++) {
					$res_amount = ($object['res'.$i.'_amount']*$tmp_amount)*-1;		
					if ($res_amount != 0) {
						pip_object_add($username, 'resource', $object['res'.$i.'_id'], $res_amount);
					}		
				}				
				
				// -- add object
				pip_object_add($username, $category, $id, $amount, $level);
				$success = true;
			}
		}
		return $success;
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_upgrade
	// validate an object then pay its resource cost to increase its level
	//------------------------------------------------------------------------------------
	function pip_object_upgrade($username="", $category="", $myid="", $id="") {
		$success = false;
		
		if (!pip_empty($username, $category, $id, $myid)) {	
		
			$object = pip_object_getinstance($username, $category, $id, $myid);
			$data 	= pip_object_getall($username, 'resource');
			$level = $object['level']+1;

			if (pip_object_canupgrade($username, $category, $id, $myid)) {

				// -- deduct resource(s)
				for ($i=1; $i<10; $i++) {
					$res_amount = ($object['res'.$i.'_amount']*$level*$object['upgrade_factor'])*-1;
					if ($res_amount != 0) {
						pip_object_add($username, 'resource', $object['res'.$i.'_id'], $res_amount);
					}		
				}				
				
				// -- add object
				pip_object_add($username, $category, $myid, 0, 1);
				$success = true;
			
			}
		}
		return $success;
	}
	
	//------------------------------------------------------------------------------------
	// pip_object_sell
	// validate an object and remove it from a user account to refund a fraction of its cost
	//------------------------------------------------------------------------------------
	function pip_object_sell($username="", $category="", $myid="", $id="", $amount="", $level="") {
		$success = false;
		if (!pip_empty($username, $category, $myid, $id) && (!empty($amount) || !empty($level))) {	
			
			$object 	= pip_object_get($category, $myid);
			
			$refund = 0;
			
			// -- refund factor either by amount or by level
			if ($level > 0) {
				$tmp_amount	= $level;
			} else {
				$tmp_amount	= max($amount, 1);
			}
			
			// -- get resource(s)			
			if ($object['sell_factor'] > 0) {
		
				// -- refund a fraction of the total cost as all resources
				if ($object['sell_resid'] == 0) {
					for ($i=1; $i<10; $i++) {
						$refund = floor(($object['res'.$i.'_amount']*$tmp_amount)*$object['sell_factor']);
						pip_object_add($username, 'resource', $object['res'.$i.'_id'], $refund);
					}					
				// -- refund a fraction of the total cost as one resource
				} else {				
					for ($i=1; $i<10; $i++) {
						$refund += floor(($object['res'.$i.'_amount']*$tmp_amount)*$object['sell_factor']);;		
					}
					pip_object_add($username, 'resource', $object['sell_resid'], $refund);
				}
			
				
			
			}
			
			// -- remove object
			pip_object_remove($username, $category, $id, $amount, $level);
			$success = true;
			
		}
		return $success;
	}

	//------------------------------------------------------------------------------------
	// pip_object_remove
	// removes one object from a user account by its id and/or level - or decreases its amount
	//------------------------------------------------------------------------------------
	function pip_object_remove($username="", $category="", $id="", $amount=0, $level=0) {
		if (!pip_empty($username, $category, $id) && ($amount != 0 || $level != 0)) {	
			$sql = "SELECT * FROM <<".CONF_PREFIX_LST.$category.">> WHERE username = '$username' AND id = '$id' LIMIT 1";
			$item = pip_db_scalar($sql);
			if ($item) {
				if ($amount != 0) {
					if ($amount >= $item['amount']) {
						$sql = "DELETE FROM <<".CONF_PREFIX_LST.$category.">> WHERE username = '".$username."' AND id = '".$id."'";
					} else {
						$sql = "UPDATE <<".CONF_PREFIX_LST.$category.">> SET amount = amount - '".$amount."' WHERE username = '".$username."' AND id = '".$id."' LIMIT 1"; 
					}
				} else if ($level != 0) {
					$sql = "DELETE FROM <<".CONF_PREFIX_LST.$category.">> WHERE username = '".$username."' AND id = '".$id."' AND level = '".$level."'";
				}
				pip_db_query($sql);
				pip_object_updatebuff($username, $category, $id);
			}
		}
	}

	//------------------------------------------------------------------------------------
	// pip_object_updatebuff
	// 
	//------------------------------------------------------------------------------------
	function pip_object_updatebuff($username="", $category="", $id="") {
		if ( !pip_empty($username, $category, $id) && ($category == "building" || $category == "tech") ) {	
	
	
	
			// shop
			// shop unlock building
			
			// resource
			// resource building
			
			// buff
			// buff building
	
	
	
		}
	}

	
	
	//=================================================================================EOF

?>