<?php

/**
 * Orientation form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrientationForm extends BaseOrientationForm
{

    public function configure()
    {
        
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
        
        
        $this->widgetSchema->setLabels(array(
            'niveauscolaire_id' => 'Niveau scolaire :',
            'dgesco_id' => 'Niveau Dgesco :',
            'libelleclasse' => 'Nom de la classe',
            'demijournee_id' => 'Nombre de demi-journées :',
            'etabsco_id' => 'Etablissement scolaire :',
            'classe_id' => 'Classe d\'accueil :',
            'datedebut' => 'Début de scolarisation :',
            'datefin' => 'Fin de scolarisation :',
        ));

        $query = Doctrine::getTable('Etabsco')->getEtabscoBySecteur();


		if(sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend')
		{	
			$this->widgetSchema['etabsco_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Etabsco',
                    'query' => $query,
                    'add_empty' => 'Choisissez',
                ));
		}else{
			// champ etabsco qui est en autocomplete			
			sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
			$this->widgetSchema['etabsco_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
			$this->widgetSchema['etabsco_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
			  array(
				'model' => 'Etabsco',
				'url'   => url_for('@ajax_section')
			  ), array('size' =>60)
    );	
	
	
	// au démarrage il n'y pas de changement d'etabsco donc on ne peut pas declencher les fonctions liées 
	
		if(sfContext::getInstance()->getActionName() == 'new'){
		// champ classe qui réagit en fonction du choix du type etabsco	
		$this->setWidget( 'classe_id', new sfWidgetFormDoctrineChoiceWithParams(
				array(
					'model' => 'classe',
					'table_method' => array('method' => 'getExecclasse', 'parameters' => array($this->getOption('etabsco_id')))
				) ) );
		//}
	
	/*	
		// champ niveauscolaire qui réagit en fonction du choix du type etabsco
		$this->setWidget( 'niveauscolaire_id', new sfWidgetFormDoctrineChoiceWithParams(
		array(
			'model' => 'niveauscolaire',
			'table_method' => array('method' => 'getExecniveau', 'parameters' => array($this->getOption('etabsco_id')))
		) ) );
		}
	*/
		}
	}
	
        $this->setWidget('eleve_id', new sfWidgetFormInputHidden());
        $this->setValidator('eleve_id', new sfValidatorString());
        $this->setWidget('enseignant_id', new sfWidgetFormInputHidden());
        //$this->setValidator('enseignant_id', new sfValidatorString());
        $this->setWidget('inclusion_id', new sfWidgetFormInputHidden());
        //$this->setValidator('inclusion_id', new sfValidatorString());
        
        $this->validatorSchema->setOption('allow_extra_fields', true);

                
    }

}
