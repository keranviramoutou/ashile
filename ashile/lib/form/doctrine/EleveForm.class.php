<?php

/**
 * Eleve form.
 *
 * @package ash974
 * @subpackage form
 * @author Your name here
 * @version SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EleveForm extends BaseEleveForm
{
   
    protected $numbersToDelete = array();
    public function configure()
    {
			$this->widgetSchema['numeromdph'] = new sfWidgetFormInputText(array(), array("style"=>'width: 90px;'));
			$this->widgetSchema['ine'] = new sfWidgetFormInputText(array(), array("style"=>'width: 90px;'));
			$this->widgetSchema['nom'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
			$this->widgetSchema['prenom'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
			$this->widgetSchema['adresseelevebat'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
			$this->widgetSchema['adresseleverue'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
			$this->widgetSchema['motif'] = new sfWidgetFormInputText(array(), array("style"=>'width: 450px;'));
	
		$this->widgetSchema['datenaissance'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));										  
		        $this->validatorSchema['datenaissance'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => true));	
    if ("datesortie")
    {	  
        $this->widgetSchema['datesortie'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	        $this->validatorSchema['datesortie'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false));
     }           
			
			
        $this->widgetSchema['etat_acc'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		        $this->validatorSchema['etat_acc'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false));	
					 
        $this->widgetSchema['etat_mat'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['etat_mat'] = new sfValidatorDate(   
        array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false));	  


					 
	//Dernière demande matériel en cours à la date du jour pour l'élève selectionné à l'état A ATTRIBUER
		//----------------------------------------------------------------------------------------------------
			$query1 = Doctrine_Query::create()
			->select('*')
						->from('Secteur s')
					    ->orderby ('s.libellesecteur ASC');
				

	
					 
					 
            $this->widgetSchema['secteur_id'] = new sfWidgetFormDoctrineChoice(array(
                   'model' => $this->getRelatedModelName('Secteur'),
                   'query' => $query1,
                    'add_empty' => '',
                )); 


				
          if(sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend') {           
        // au format français
        // on cache le champ secteur
        $this->widgetSchema['secteur_id'] = new sfWidgetFormInputHidden();
		}
		
		$this->widgetSchema['pps_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pps'), 'add_empty' => false,'default' => 2));
		
		
        // on change le champ sexe en radiobouton  de choix entre garçon ou fille
        $this->widgetSchema['sexe'] = new sfWidgetFormSelectRadio(array('choices' => array('G' => 'Garçon', 'F' => 'Fille'), 'formatter' => array($this, 'formatterRadio')));
        // ici on donne un aspect plus ergonomique aux labels du formulaire
        $this->widgetSchema->setLabels(array(
            'ine' => 'N° élève (*):',
            'nom' => 'Nom (*):',
            'prenom' => 'Prénom (*):',
            'sexe' => 'Sexe (*):',
            'numeromdph' => 'Référence Mdph',
            'datenaissance' => 'Date de naissance (*):',
            'adresseelevebat' => 'Batiment et appartement :',
            'adresseleverue' => 'N° rue et chemin :',
            'sessad_id' => 'Sessad :',
            'commune_id' => 'Commune :',
            'notes' => '',
            'datesortie' => 'Fin de prise en charge ',
            'motif'	=> 'Motif de Fin de prise en charge',
			'pps_id'	=> ' <b><FONT color="#298A08">Projet personnalisé de scolarisation(*):</b> </FONT>',
        ));
		
		
		
	  $this->setValidator(
'nom' , new sfValidatorAnd(array(
    new sfValidatorString(
        array('required' => true, 'min_length' => 3, 'max_length' => 30), 
        array( 'min_length' => 'Le nom doit faire minimum 3 characteres.', 'max_length' => 'Le nom de peut exceder 30 characteres.')
        ),
    new sfValidatorRegex(
          array('pattern' => '/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄ ]+[\s]*)+$/'),
        array('invalid' => 'Vous ne pouvez utiliser que des lettres de l\' alphabet (A-Z) .')
        ),
), array(), array('required' => 'Entrer un Nom')));
  
   $this->setValidator(
'prenom' , new sfValidatorAnd(array(
    new sfValidatorString(
        array('required' => true, 'min_length' => 3, 'max_length' => 20), 
        array( 'min_length' => 'Le prénom doit faire minimum 3 characteres.', 'max_length' => 'Le prénom de peut exceder 20 characteres.')
        ),
    new sfValidatorRegex(
          array('pattern' => '/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄ ]+[\s]*)+$/'),
        array('invalid' => 'Vous ne pouvez utiliser que des lettres de l\' alphabet (A-Z).')
        ),
), array(), array('required' => 'Entrer un prénom.'))); 
        
        // si on est dans l'application acad on desactive des champs du formulaire

        if(sfContext::getInstance()->getConfiguration()->getApplication() == 'academie' && sfContext::getInstance()->getActionName () !== 'new')
        {
			 unset($this['ine'], $this['numeromdph'],  $this['sessad_id']);
	    }

		
		if(sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend' )
        {
        // on redéfinit  ine     
        $this->setWidget('ine', new sfWidgetFormInputHidden());
        $this->setValidator('ine', new sfValidatorString());
        
        // on redéfinit  numeromdph     
       // $this->setWidget('numeromdph', new sfWidgetFormInputHidden());
       // $this->setValidator('numeromdph', new sfValidatorString());
		}
    }

    public function formatterRadio($widget, $inputs)
    {
        $rows = array();
        foreach ($inputs as $input) {
            $rows[] = '<span class="radio">' . $input['input'] . $input['label'] . '</span>';
        }
        return "" . implode("", $rows) . "";
    }
	
	protected function doSave($con = null) //mettre le nom en majuscule fonction capitalize définie dans eleve.class.php
  {
    $this->values['nom'] = Eleve::capitalize($this->values['nom']); 
	$this->values['prenom'] = Eleve::capitalize($this->values['prenom']); 
    parent::doSave($con);
  } 


}

