<?php

//========================================================================================
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

pip_logincheck();

$vars	= array();
	
$vars["piptitle"] 	= "List";
$vars["piperrors"] = "";
$vars["pipself"] = $_SERVER['PHP_SELF'];

$data = array();
$link = false;
$sell = true;
$type = "";

//----------------------------------------------------------------------------------------
// Validate Actions
//----------------------------------------------------------------------------------------

// --------------------------------------------------------------------------- Sell
if (isset($_POST['idn_sellid']) && isset($_POST['idn_objid']) && (isset($_POST['idn_sellamount']) || isset($_POST['idn_selllevel']))) {
	
	$amount = 0;
	$level 	= 0;
		
	if (isset($_POST['idn_sellamount'])) {
		$amount = $_POST['idn_sellamount'];
	}
	if (isset($_POST['idn_selllevel'])) {
		$level = $_POST['idn_selllevel'];
	}
	
	$success = pip_object_sell($_SESSION['username'], $_GET['ids_type'], $_POST['idn_objid'], $_POST['idn_sellid'], $amount, $level);
}

// --------------------------------------------------------------------------- Upgrade
if (isset($_POST['idn_upgradeid'])) {
	$success = pip_object_upgrade($_SESSION['username'], $_GET['ids_type'], $_POST['idn_objid'], $_POST['idn_upgradeid']);
}

// --------------------------------------------------------------------------- Collect
if (isset($_POST['idn_collectid'])) {

}

// --------------------------------------------------------------------------- List
if (isset($_GET['ids_type'])) {
	$type = $_GET['ids_type'];
	$data = pip_object_getall($_SESSION['username'], $type);
	if ($type == "shop") {
		$link = true;
		$sell = false;
	}
}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

$vars["pipsection"] = "";
$vars["pipsection"] .= "<tr><td colspan='99'><hr></td></tr>\n";

foreach($data as $item) {
	
	$amount = 0;
	$level 	= 0;
		
	if (isset($item['amount'])) {
		$amount = $item['amount'];
	}
	if (isset($item['level'])) {
		$level = $item['level'];
	}
	
	// --------------------------------------------------------------------------- Icon & Name
	$label = "";
	if ($link) {
		$label = "<a href='index.php?action=".$type."&idn_id=".$item['myid']."'>".$item['name']."</a>";
	} else {
		$label = $item['name'];
	}
	
	if ($amount > 0) {
		$label .= " x".$amount;
	}
	if ($level > 0) {
		$label .= " L".$level;
	}
	
	$vars["pipsection"] .= "<tr><td><b>".$item['icon']."</b></td><td>".$label."</td><td>";
	
	// --------------------------------------------------------------------------- Sell Option
	if ($sell) {
		
		$form = new pip_form("Sell", "list&ids_type=".$type);
			
		$form->pip_addField("idn_objid", "hidden", $item['myid']);
		$form->pip_addField("idn_sellid", "hidden", $item['id']);
		
		if ($amount != 0) {
			$form->pip_addField("idn_sellamount", "number", "1", "min='1' max='".$amount."'");
		}
		if ($level != 0) {
			$form->pip_addField("idn_selllevel", "hidden", $level);
		}
				
		$vars["pipsection"] .= $form->pip_outputForm();
		
	}
			
	// --------------------------------------------------------------------------- Upgrade Option
	
	if ($type == "building" || $type == "item" || $type == "tech") {
		if ($item['level'] != 0 && $item['level'] < $item['max_level']) {
		
			if (pip_object_canupgrade($_SESSION['username'], $type, $item['id'], $item['myid'])) {
		
				$form = new pip_form("Upgrade", "list&ids_type=".$type);
			
				$form->pip_addField("idn_objid", "hidden", $item['myid']);
				$form->pip_addField("idn_upgradeid", "hidden", $item['id']);
		
				$vars["pipsection"] .= $form->pip_outputForm();
			
			}
		}
	}
	
	// --------------------------------------------------------------------------- Collect Option
	if ($type == "building") {
	
	
	}
	
	// ---------------------------------------------------------------------------
	$vars["pipsection"] .= "</td></tr>\n";
	$vars["pipsection"] .= "</tr>\n";

}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------

pip_tpl_render("list", $vars);

//=====================================================================================EOF

?>