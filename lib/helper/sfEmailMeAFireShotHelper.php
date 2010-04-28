<?php

function link_sfEmailMeAFireShot($content,$action="edit"){
	return content_tag('span',
		content_tag('a',$content,array('onclick'=>'shotAnd("'.$action.'"); return false;','href'=>'#')),
	array('id'=>'sfEmailMeAFireShot'));
	
}


/**
 * Add js 
 */
function include_sfEmailMeAFireShot_js(){
	$apiKey=get_sfEmailMeAFireShot_apiKey();
	echo javascript_include_tag('/sfEmailMeAFireShotPlugin/js/fsapi.js');
	echo javascript_tag('$(document).ready(function(){ 
		FireShotAPI.Key ="'.$apiKey.'";
		if(!FireShotAPI.isWindows()){ $("#sfEmailMeAFireShot").hide(); }
		if(!FireShotAPI.isFirefox()){ $("#sfEmailMeAFireShot").hide(); }
	 });');	
	echo javascript_tag('
	function shotAnd(action){
		//Test si install
		if (typeof(FireShotAPI) != "undefined" && FireShotAPI.isAvailable()){
			if(action=="email")
				FireShotAPI.emailPage(true);
			if(action=="edit")
				FireShotAPI.editPage(true);			
			
		}else{
			$("#sfEmailMeAFireShot").html( "<b>Not installed</b>, " + 
			"<a href=\'javascript:FireShotAPI.installPlugin()\'>Install plugin now</a>");
		}
	}
	');
}


function get_sfEmailMeAFireShot_apiKey(){
	$request=sfContext::getInstance()->getRequest();
	$keys=sfConfig::get('app_sfEmailMeAFireShot_apiKey',array());
	if(array_key_exists($request->getHost(),$keys)){
		return $keys[$request->getHost()];
	}
	if(array_key_exists($_SERVER["SERVER_ADDR"],$keys)){
		return $keys[$_SERVER["SERVER_ADDR"]];
	}
	return '';	
}

?>