<?php

class sfEmailMeAFireShotActions extends sfActions{
	
	public function executeIndex(sfWebRequest $request){
		throw new Exception('Getting clipboard content in dev');
		$this->form=$form=new sfEmailMeAFireShotEmailForm();
	}
	
}
?>