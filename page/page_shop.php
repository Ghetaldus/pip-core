<?php

//========================================================================================
//
// SHOP
// 
// @author    Weaver (Fhizban)
// @copyright 2016+ www.critical-hit.biz
// @version   1.0
//
//========================================================================================

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_logincheck();

$vars	= array();
	
$vars["piptitle"] 	= "Item Shop";
$vars["piperrors"] = "";
$vars["pipself"] = $_SERVER['PHP_SELF'];

$data = array();
$type = 0;

//----------------------------------------------------------------------------------------
// Validate Options
//----------------------------------------------------------------------------------------

$shop = pip_shop_get($_SESSION['username'], $_GET['idn_id']);	

// --------------------------------------------------------------------------- Buy
if (isset($_POST['idn_buyid']) && (isset($_POST['idn_buyamount']) || isset($_POST['idn_buylevel'])) ) {
	
	$amount = 0;
	$level = 0;
	
	if (isset($_POST['idn_buyamount'])) {
		$amount = $_POST['idn_buyamount'];
	}
	if (isset($_POST['idn_buylevel'])) {
		$level = $_POST['idn_buylevel'];
	}
	
	$success = pip_object_buy($_SESSION['username'], $shop['category'], $_POST['idn_buyid'], $amount, $level);
	if ($success) {
		pip_shop_removeinventory($_SESSION['username'], $_GET['idn_id'], $_POST['idn_buyid'], $amount);
	}
	
}

// --------------------------------------------------------------------------- List
if (isset($_GET['idn_id'])) {
	$type = $_GET['idn_id'];
	$data = pip_shop_getinventory($_SESSION['username'], $type);	
}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

	$vars["pipsection"] = "";
	$vars["pipsection"] .= "<table align='center' width='100%'>\n";
	$vars["pipsection"] .= "<thead>\n";
	$vars["pipsection"] .= "<tr><td colspan='99'>Verfügbare Items</tr></td>\n";
	$vars["pipsection"] .= "</thead>\n";
		
	$vars["pipsection"] .= "<tr><td colspan='99'><hr></td></tr>\n";
		
	foreach ($data as $item) {
		
	
		$amount = 0;
		$level 	= 0;
		
		if (isset($item['level'])) {
			$level = $item['level'];
		}
		
		if (isset($item['amount'])) {
			$amount = pip_object_getmaxbuyamount($_SESSION['username'], $shop['category'], $item['id']);
		}
		
		// --------------------------------------------------------------------------- Icon & Name
		
		$label = "";
		$label = $item['name'];
		
		if ($amount > 0) {
			$label .= " x".$amount;
		}
		if ($level > 0) {
			$label .= " L".$level;
		}
		$vars["pipsection"] .= "<tr><td><b>".$label."</b></td><td>".$item['res1_id']."/".$item['res1_amount']."</td><td>";
		
		// --------------------------------------------------------------------------- Buy Option
		
		if (pip_object_canbuy($_SESSION['username'], $item['category'], $item['id'], $amount)) {
		
			$form = new pip_form("Buy", "shop&idn_id=".$type);
			
			$form->pip_addField("idn_buyid", "hidden", $item['id']);
			
			if ($amount != 0) {
				$form->pip_addField("idn_buyamount", "hidden", "1", "min='1' max='".$amount."'");
			}
			if ($level != 0) {
				$form->pip_addField("idn_buylevel", "hidden", $level);
			}
			
			$vars["pipsection"] .= $form->pip_outputForm();
			
		}
		
		// ---------------------------------------------------------------------------
		
		$vars["pipsection"] .= "</td></tr>\n";
		
	}
	
	$vars["pipsection"] .= "</table>\n";
	
//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_tpl_render("shop", $vars);

//=====================================================================================EOF

?>