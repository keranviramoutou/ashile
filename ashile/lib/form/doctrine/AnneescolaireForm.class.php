<?php

/**
 * Anneescolaire form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AnneescolaireForm extends BaseAnneescolaireForm
{
  public function configure()
  {
     // ici on définit le format des champs de type date => on utilise un calendrier 'JQuery'
    //$this->widgetSchema['datedebutanneescolaire'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true)); 
        $this->widgetSchema['datedebutanneescolaire'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',));
        $this->validatorSchema['datedebutanneescolaire'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
    
    //$this->widgetSchema['datefinanneescolaire'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true)); 
        $this->widgetSchema['datefinanneescolaire'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',));
        $this->validatorSchema['datefinanneescolaire'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));

      $this->widgetSchema->setLabels(array(
   //choix du type de contrat
          'datedebutanneescolaire'  =>'Date de debut de l\'année scolaire :' ,
          'datefinanneescolaire'  =>'Date de fin de l\'année scolaire :' ,
          ));
  }
}
