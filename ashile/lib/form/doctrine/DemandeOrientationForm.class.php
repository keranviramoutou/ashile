<?php

/**
 * DemandeOrientation form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DemandeOrientationForm extends BaseDemandeOrientationForm
{
  public function configure()
  {

	    $this->widgetSchema['date_demande_orientation'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['date_demande_orientation'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false));	    	    
        
 	      

			$this->widgetSchema['datedebutnotif'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
			$this->validatorSchema['datedebutnotif'] = new sfValidatorDate(   
					array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
						  "date_input"  => 'dd-MM-y',	
						  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
						 "required" => false));
						 
			$this->widgetSchema['datefinnotif'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
			$this->validatorSchema['datefinnotif'] = new sfValidatorDate(   
					array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
						  "date_input"  => 'dd-MM-y',	
						  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
						 "required" => false));
					  
			$this->widgetSchema['datedecisioncda'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
			$this->validatorSchema['datedecisioncda'] = new sfValidatorDate(   
					array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
						  "date_input"  => 'dd-MM-y',	
						  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
						 "required" => false));

		$this->widgetSchema['classeext_id'] = new sfWidgetFormDoctrineChoice(array(
		   'model' => $this->getRelatedModelName('Classeext'),
			'add_empty'=>'',
			'order_by' => array('libelle_classe_ext', 'asc'),
		)); 

  	  
	    $this->setWidget('mdph_id', new sfWidgetFormInputHidden());
        $this->setValidator('mdph_id', new sfValidatorString());
		
		$this->setWidget('date_demande_orientation', new sfWidgetFormInputHidden());
        $this->setValidator('date_demande_orientation', new sfValidatorString());
  }
}
