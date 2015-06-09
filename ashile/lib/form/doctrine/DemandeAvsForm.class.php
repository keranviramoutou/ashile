<?php

/**
 * DemandeAvs form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DemandeAvsForm extends BaseDemandeAvsForm
{

    public function configure()
    {   
	     $this->widgetSchema['quotitehorrairenotifie'] = new sfWidgetFormInputText(array(), array("style"=>'width: 50px;'));
		 $this->widgetSchema['date_demande_avs'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		 $this->validatorSchema['date_demande_avs'] = new sfValidatorDate(   
				array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
					  "date_input"  => 'dd/MM/y',	
					  "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
					 "required" => false)); 
	 
                      
         $this->widgetSchema['datedebutnotif'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datedebutnotif'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
                     
	     $this->widgetSchema['datefinnotif'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datefinnotif'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
                     
         $this->widgetSchema['datedecisioncda'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datedecisioncda'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
                     
	     $this->widgetSchema['dateRecepDemandERF'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['dateRecepDemandERF'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
                     
         $this->widgetSchema['dateDemandDSM'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['dateDemandDSM'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
                     
	     $this->widgetSchema['dateDeciDSM'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['dateDeciDSM'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
                     
         $this->widgetSchema['datetransDeciERF'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datetransDeciERF'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
	
		$this->widgetSchema['naturecontratavs_id'] = new sfWidgetFormDoctrineChoice(array(
		   'model' => $this->getRelatedModelName('Naturecontratavs'),
		  // 'query' => $query1,
			'add_empty'=>'',
			'order_by' => array('nouvnomnaturecontrat', 'asc'),
		)); 
		
		
		$this->widgetSchema['conditionsuspensive_id'] = new sfWidgetFormDoctrineChoice(array(
		   'model' => $this->getRelatedModelName('Conditionsuspensive'),
		  // 'query' => $query1,
			'add_empty'=>'',
			'order_by' => array('conditionsuspensive', 'asc'),
		)); 
         //controle sur les dates de début et fin de notification
		//--------------------------------------------------------
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
                    new sfValidatorSchemaCompare('datedebutnotif', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'datefinnotif',
                            array('throw_global_error' => true),
                            array('invalid' => 'La date de debut de notification ("%left_field%") doit etre inferieure à la date fin de notification ("%right_field%")')
                    )
                )));
  
		// initialisation du numero de dossier mdph
       $this->setWidget('mdph_id', new sfWidgetFormInputHidden());
       $this->setValidator('mdph_id', new sfValidatorString());
	   if( sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend'){
	   $this->setWidget('date_demande_avs', new sfWidgetFormInputHidden());
       $this->setValidator('date_demande_avs', new sfValidatorString());
	   }

    }

}
