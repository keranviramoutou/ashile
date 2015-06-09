<?php

/**
 * Modnonsco form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ModnonscoForm extends BaseModnonscoForm
{
  public function configure()
  {
  
    $this->widgetSchema['quothorreff'] = new sfWidgetFormInputText(array(), array("style"=>'width: 60px;'));
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
			 
			 
    //    $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
    //                new sfValidatorSchemaCompare('datedebut', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'datefin',
    //                        array('throw_global_error' => true),
    //                        array('invalid' => 'La date de debut ("%left_field%") doit être inférieure à la date fin ("%right_field%")')
    //                ),
    //                new sfValidatorNbDemiJournee(),
    //            )));
      
        // on commence par declarer les champs du formulaire
        $this->widgetSchema->setLabels(array(
            'demijournee_id' => 'Type d\'orientation :',
            'quothorreff'  => 'Quotitée horaire effective :',
            'etabnonsco_id'=> 'Choisissez l\'etablissement',
            'datedebut' => 'Date de début d\'orientation :',
            'datefin' => 'Date de fin d\'orientation :',
        ));
        
        // on veut que le nom de l'etablissement spécialisé soit dans une list déroulante
       // $this->setWidget('etabnonsco_id', new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabnonsco'), 'add_empty' => true)));
        
					$query = Doctrine_Query::create()
					 ->select ('*')
					->from('Etabnonsco e')
				    ->where ('e.id not in (select etabnonsco_id from sessad )')
					->orderby('e.ordre asc'); 
					
		
		$this->widgetSchema['etabnonsco_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('Etabnonsco'),
					'query' => $query,
                    'add_empty' => 'Selectionner l\'établissement:',
                ));
				
				
		$this->widgetSchema['classespe_id'] = new sfWidgetFormDoctrineChoice(array(
		   'model' => $this->getRelatedModelName('Classespe'),
			'add_empty'=>'',
			'order_by' => array('libelle_classe_spe', 'asc'),
		)); 
		
		$this->widgetSchema['demijounee_id_id'] = new sfWidgetFormDoctrineChoice(array(
		   'model' => $this->getRelatedModelName('Demijournee'),
			'add_empty'=>'',
			'order_by' => array('libelledemijournee', 'asc'),
		)); 
        // et son validateur
		
		
        $this->setValidator('etabnonsco_id', new sfValidatorString());        
        
        // on redéfinit  eleve_id     
        $this->setWidget('eleve_id', new sfWidgetFormInputHidden());
        $this->setValidator('eleve_id', new sfValidatorString());

	// on empéche la saisie de plus de 8 demi-journées pour les scolarisations
		//$this->validatorSchema->setPostValidator(new sfValidatorNbDemiJournee());
		
				//--- pour palier aux erreurs à l'enregistrement on crée un champ _csrf_token qui ne s'affiche pas -------
			$this->setWidget('_csrf_token', new sfWidgetFormInputHidden());
			$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputText(array(), array("style"=>'width: 0px;'));
			$this->setValidator('_csrf_token' , new sfValidatorString());
			//--------------------------------------------------------------------------------------------------------

  }
}
