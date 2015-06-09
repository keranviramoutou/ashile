<?php

/**
 * DemandeSessad form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DemandeSessadForm extends BaseDemandeSessadForm
{
  public function configure()
  {
	    $this->widgetSchema['datedebutnotif'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datedebutnotif'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false)); 
	          
        $this->widgetSchema['datefinnotif'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datefinnotif'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false)); 

        $this->widgetSchema['date_demande_sessad'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['date_demande_sessad'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
					  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));        
        
        $this->widgetSchema['datedecisioncda'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
              $this->validatorSchema['datedecisioncda'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false)); 

        // on change les labels du formulaire
        $this->widgetSchema->setLabels(array(
            'date_demande_sessad' => 'Date de la demande sessad :',
	    'datedecisioncda' => 'Date de la d&eacute;cision CDA',
            'typesessad_id' => 'type du sessad demandé :'
        ));

        // modification du champ type de matriel demandé pour avoir un menu choix deroulant
        $this->widgetSchema['typesessad_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('Typesessad'), 'add_empty' => 'Faites votre choix :'
                ));
        // et son validateur
        $this->validatorSchema['typesessad_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => true,
                    'model' => $this->getRelatedModelName('Typesessad'),
                    'column' => 'id',
                ));

        $this->setWidget('mdph_id', new sfWidgetFormInputHidden());
        $this->setValidator('mdph_id', new sfValidatorString());

		
	    $this->setWidget('date_demande_sessad', new sfWidgetFormInputHidden());
        $this->setValidator('date_demande_sessad', new sfValidatorString());

        
        
        /*
        if((sfContext::getInstance()->getActionName() == 'edit' || sfContext::getInstance()->getActionName() == 'update') && sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend')
        {
			$this->setWidget('typesessad_id', new sfWidgetFormInputHidden());
			$this->setValidator('typesessad_id', new sfValidatorString());	
			//$this->setWidget('date_demande_sessad', new sfWidgetFormInputHidden());
			//$this->setValidator('date_demande_sessad', new sfValidatorString());			
		}
		*/



         
//       $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
//                new sfValidatorSchemaCompare ('date_demande_sessad', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'datedecisioncda',
//                array('throw_global_error' => true),
//                array('invalid' => 'La date de debut d\'attribution ("%left_field%") doit etre inferieure  à la date fin d\'attribution ("%right_field%)')
//                ),
//                new sfValidatorSchemaCompare('datedebutnotif', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'datefinnotif',
//                array('throw_global_error' => true),
//                array('invalid' => 'La date de fin d\'attribution  ("%left_field%") doit etre inferieure à la date de convention ("%right_field%")')
//                ),
//                )));

    }
}
