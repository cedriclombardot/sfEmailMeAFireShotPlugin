<?php

class sfEmailMeAFireShotEmailForm extends sfForm {

	public function configure(){
		$this->setWidgets(array(
			'subject'=>new sfWidgetFormInput(array(),array('size'=>53)),
			'content'=>new sfWidgetFormTextarea(array(),array('rows'=>10,'cols'=>40)),
			'capture'=>new sfWidgetFormInputHidden(),
		));
		
		$this->setValidators(array(
			'subject'=>new sfValidatorString(array('required'=>true),array('required'=>'You must set a subject')),
			'content'=>new sfValidatorString(array('required'=>true),array('required'=>'You must set a content')),
			'capture'=>new sfValidatorString(array('required'=>true)),
		));
		
		$this->widgetSchema->setNameFormat('email_me_fireshot[%s]');
		$this->widgetSchema->getFormFormatter()->setTranslationCatalogue('email_me_fireshot');
		
	}
	
	
}
?>