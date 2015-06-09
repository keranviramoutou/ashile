<?php

/**
 * SuivitExterne form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SuivitExterneForm extends BaseSuivitExterneForm
{
  public function configure()
  {
  
        //$this->widgetSchema['datedebutpriseencharge'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
        //$this->widgetSchema['datefinpriseencharge'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));	 
        
        $this->widgetSchema['datedebutpriseencharge'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['datedebutpriseencharge'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));   ;
				 
				 
		$this->widgetSchema['datefinpriseencharge'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['datefinpriseencharge'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));   ;
        
        $this->validatorSchema->setOption('allow_extra_fields', true);
        
         $this->validatorSchema->setPostValidator(new sfValidatorOr(array(
                new sfValidatorSchemaCompare ('datedebutpriseencharge', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'datefinpriseencharge',
                array('throw_global_error' => true),
                array('invalid' => 'La date de debut d\'attribution ("%left_field%") doit etre inferieure  à la date fin d\'attribution("%right_field%")')
                ),
                new sfValidatorSchemaCompare('datefinpriseencharge', '==', ''),
                )));      
  
        $querySpecialisteValid = Doctrine::getTable('Specialiste')->getSpecialisteValid(sfContext::getInstance()->getUser()->getAttribute('secteur')); 
                 
        $this->widgetSchema['specialiste_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Specialiste',
                    'add_empty' => 'Choisissez...',
                    'query' => $querySpecialisteValid,
                    'add_empty' => true
                ));
				
		    $queryOrganismeValid = Doctrine::getTable('OrganismeSuivit')-> getOrganismeValid(sfContext::getInstance()->getUser()->getAttribute('secteur')); 
                 
        $this->widgetSchema['organismesuivit_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'OrganismeSuivit',
                    'add_empty' => 'Choisissez...',
                    'query' => $queryOrganismeValid ,
                    'add_empty' => true
                ));

        $this->setValidator('specialiste_id', new sfValidatorDoctrineChoice(array(
                    'model' => 'Specialiste',
                    "required" =>  false
                    
                )));
                
        // on redéfinit  eleve_id     
        $this->setWidget('eleve_id', new sfWidgetFormInputHidden());
        $this->setValidator('eleve_id', new sfValidatorString());                
        
		$this->widgetSchema->setLabels(array(
			'datedebutpriseencharge'	=>	'Début de prise en charge',
			'datefinpriseencharge'		=>	'Fin de prise en charge',
			'organismesuivit_id'			=>	'Organisme de suivi',
		));

  }
}
