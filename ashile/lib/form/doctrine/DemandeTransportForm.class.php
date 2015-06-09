<?php

/**
 * DemandeTransport form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DemandeTransportForm extends BaseDemandeTransportForm
{
  public function configure()
  {
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
                     	    
		
		$this->widgetSchema['date_demande_transport'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));										  
		        $this->validatorSchema['date_demande_transport'] = new sfValidatorDate(   
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
				 
				 
	  // if((sfContext::getInstance()->getActionName() == 'edit' || sfContext::getInstance()->getActionName() == 'update') && sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend')
      // {	 
	  //  $this->setWidget('transport_id', new sfWidgetFormInputHidden());
      //  $this->setValidator('transport_id', new sfValidatorString());
	  // }
		$this->setWidget('mdph_id', new sfWidgetFormInputHidden());
        $this->setValidator('mdph_id', new sfValidatorString());
        
        $this->setWidget('date_demande_transport', new sfWidgetFormInputHidden());
        $this->setValidator('date_demande_transport', new sfValidatorString());
  }
}
