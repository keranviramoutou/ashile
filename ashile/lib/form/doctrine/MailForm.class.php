<?php

/**
 * Mail form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MailForm extends BaseMailForm
{
  public function configure()
  {
 
		$this->widgetSchema['sfGuardUser_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfguarduser'), 'add_empty' => false));

		$this->widgetSchema['date'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['date'] = new sfValidatorDate(   
				array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
					  "date_input"  => 'd-m-Y',	
					  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
					 "required" =>  false));
        
		$this->widgetSchema['sujet'] = new sfWidgetFormInputText(array(), array("style"=>'width: 300px;'));
		
		$this->widgetSchema['date']->setDefault(date('Y-m-d'));
        // on cache ses champs qui sont connus             
        //$this->setWidget('eleve_id', new sfWidgetFormInputHidden());
        //$this->setValidator('eleve_id', new sfValidatorString());
        
        //$this->setWidget('sfGuardUser_id', new sfWidgetFormInputHidden());
        //$this->setValidator('sfGuardUser_id', new sfValidatorString());
        // -----------------------------------

       
  }
}
