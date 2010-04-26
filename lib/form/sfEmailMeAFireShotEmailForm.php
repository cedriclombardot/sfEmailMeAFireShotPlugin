<?php

class sfEmailMeAFireShotEmailForm extends sfForm {

	public function configure(){
		$this->setWidgets(array(
			'subject'=>new sfWidgetFormInput(),
			'content'=>new sfWidgetFormTextarea(),
			'capture'=>new sfWidgetFormTextarea(),
		));
		
		$this->setValidators(array(
			'subject'=>new sfValidatorString(array('required'=>true)),
			'content'=>new sfValidatorString(array('required'=>true)),
			'capture'=>new sfValidatorString(array('required'=>true)),
		));
		
		$this->widgetSchema->setNameFormat('email_me_fireshot[%s]');
	}
	
	
}
?>