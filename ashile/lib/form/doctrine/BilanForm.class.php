<?php

/**
 * Bilan form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class BilanForm extends BaseBilanForm
{
  public function configure()
  {
     // ici on définit le format des champs de type date => on utilise un calendrier 'JQuery'
	$this->widgetSchema['date_bilan'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	$this->validatorSchema['date_bilan'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));   ;	



    // on redéfinit  mdph_id     
    $this->setWidget('mdph_id', new sfWidgetFormInputHidden());
    $this->setValidator('mdph_id', new sfValidatorString());
    
    // les specialiste du secteur uniquement
    
      $querySpecialisteValid = Doctrine::getTable('Specialiste')->getSpecialisteValid(sfContext::getInstance()->getUser()->getAttribute('secteur'));    
                  
        $this->widgetSchema['specialiste_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Specialiste',
                    'add_empty' => 'Choisissez...',
                    'query' => $querySpecialisteValid,
                ));

        $this->setValidator('specialiste_id', new sfValidatorDoctrineChoice(array(
                    'model' => 'Specialiste',
                )));
  
  }
}
