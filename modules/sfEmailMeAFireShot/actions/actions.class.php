<?php

class sfEmailMeAFireShotActions extends sfActions{
	public function executeIndex(sfWebRequest $request){
		$this->form=new sfEmailMeAFireShotEmailForm();
		$this->form->setDefault('capture',$this->getUser()->getAttribute('sfEmailMeAFireShot_base64'));
		$this->setLayout(false);
		sfConfig::set('sf_web_debug', false);
		if ($request->isMethod('post'))
	    {
	      $this->form->bind($request->getParameter($this->form->getName()));
	     
			if($this->form->isValid()){
				$mailer=$this->getMailer();
				$attach=new Swift_Attachment(base64_decode($this->form->getValue('capture')),'sfEmailMeAFireShot '.date('Y-m-d h:i:s').'.png','image/png');
				if(method_exists($this->getUser(),'getMail')){
					$from=$this->getUser()->getMail();
					if($from=='')
						$from=sfConfig::get('app_sfEmailMeAFireShot_email_from',sfConfig::get('app_sfEmailMeAFireShot_email_to'));
				}else{
					$from=sfConfig::get('app_sfEmailMeAFireShot_email_from',sfConfig::get('app_sfEmailMeAFireShot_email_to'));
				}
				$msg=$mailer->compose(
						$from,
						sfConfig::get('app_sfEmailMeAFireShot_email_to'),
						$this->form->getValue('subject'),
						$this->form->getValue('content'))
					->attach($attach);
				$isSend=$mailer->sendNextImmediately()->send($msg);
				$this->getUser()->setAttribute('sfEmailMeAFireShot_base64',null);
				$this->setTemplate('emailOk');
				
			}
	    }
	}
	
	public function executeGetBase64(sfWebRequest $request){
		$this->getUser()->setAttribute('sfEmailMeAFireShot_base64',$request->getParameter('base64'));
		$this->setLayout(false);
		return sfView::NONE;
	}
}
?>