<?php

//========================================================================================
//
// TEMPLATE
// 
// @author    Weaver (Fhizban)
// @copyright 2016+ www.critical-hit.biz
// @version   1.0
//
//========================================================================================

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
function pip_tpl_get($templatename) { 
	$output = "";
	if ($templatename != NULL && $templatename != "") {
    	$filename = "./templates/" . CONF_SUFFIX_TP . $templatename . ".tpl";
    	if (file_exists($filename)) {
			$output = file_get_contents($filename);
		}
	}
	return $output;
}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
function pip_tpl_parse($template, $vars) {
	if ($template != NULL && $vars != NULL) {
    	foreach($vars as $a => $b) {
       		$template = str_replace("{{{$a}}}", $b, $template);
    	}
    }
    return $template;
}

//----------------------------------------------------------------------------------------
// 
//----------------------------------------------------------------------------------------
function pip_tpl_render($template, $vars) {
	
	global $lang, $css, $js;
	
	$vars = array_merge($vars, $lang);													// -- parse lang vars
	
	$tmp_vars = "";
	foreach ($css as $plugin) {															// -- parse css plugins
		$tmp_vars .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"./plugins/".$plugin."\" />\n";
	}
	$vars["css"] = $tmp_vars;
	
	$tmp_vars = "";
	foreach ($js as $plugin) {															// -- parse js plugins
		$tmp_vars .= "<script type=\"text/javascript\" src=\"./plugins/".$plugin."\" />\n";
	}
	$vars["js"] = $tmp_vars;
		
	$vars["piphead"] = pip_tpl_parse(pip_tpl_get("head"), $vars);

	if (isset($_SESSION['username'])) {
		$vars["pipmenu"] = pip_tpl_parse(pip_tpl_get("menu_login"), $vars);
	} else {
		$vars["pipmenu"] = pip_tpl_parse(pip_tpl_get("menu_logout"), $vars);
	}

	if (isset($_SESSION['username'])) {
		$vars["pipfooter"] = pip_tpl_parse(pip_tpl_get("footer_login"), $vars);
	} else {
		$vars["pipfooter"] = pip_tpl_parse(pip_tpl_get("footer_logout"), $vars);
	}

	$vars["pipcontent"] = pip_tpl_parse(pip_tpl_get($template), $vars);

	echo pip_tpl_parse(pip_tpl_get("page"), $vars);

}

//=====================================================================================EOF

?>