<?php

/**
 * MouvementMateriel form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MouvementMaterielForm extends BaseMouvementMaterielForm
{
  public function configure()
  {
		  
		 $this->widgetSchema['datedebut'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datedebut'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
                     
	     $this->widgetSchema['datefin'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datefin'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false));                      

		//if (sfContext::getInstance()->getActionName() == 'edit' || sfContext::getInstance()->getActionName() == 'update' || sfContext::getInstance()->getActionName() == 'miseAjour' ){
           // on enlève la réf à matériel Id qui est connue
         	$this->setWidget('materiel_id', new sfWidgetFormInputHidden());
			$this->setValidator('materiel_id', new sfValidatorString());  
		 //}	

            
  }
}
