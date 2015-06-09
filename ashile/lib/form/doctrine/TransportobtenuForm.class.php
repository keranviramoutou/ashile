<?php

/**
 * Transportobtenu form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TransportobtenuForm extends BaseTransportobtenuForm
{
  public function configure()
  {
	  	// on présente un calendrier JQuery pour la saisie des dates	
	  //$this->widgetSchema['datedebut'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
	  //$this->widgetSchema['datefin'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
	  
        $this->widgetSchema['datedebut'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['datedebut'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
                     
        $this->widgetSchema['datefin'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['datefin'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
	  
	//controle sur les dates
	$this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
				new sfValidatorSchemaCompare('datedebut', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'datefin',
						array('throw_global_error' => true),
						array('invalid' => 'La date de debut ("%left_field%") doit etre inferieur à la date fin ("%right_field%")')
				)
			)));
			
	$this->setWidget('eleve_id', new sfWidgetFormInputHidden());
	$this->setValidator('eleve_id', new sfValidatorString());
	
	$this->setWidget('demandetransport_id', new sfWidgetFormInputHidden());
	$this->setValidator('demandetransport_id', new sfValidatorString());
	
				//--- pour palier aux erreurs à l'enregistrement on crée un champ _csrf_token qui ne s'affiche pas -------
			$this->setWidget('_csrf_token', new sfWidgetFormInputHidden());
			$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputText(array(), array("style"=>'width: 0px;'));
			$this->setValidator('_csrf_token' , new sfValidatorString());
			//--------------------------------------------------------------------------------------------------------
  }
}
