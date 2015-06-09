<?php

/**
 * Personne form.
 *
 * @package ash974
 * @subpackage form
 * @author Your name here
 * @version SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PersonneForm extends BasePersonneForm {

    public function configure() {
		
		$this->widgetSchema['date_naissance'] =new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));									  
		$this->validatorSchema['date_naissance'] = new sfValidatorDate(   
		array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
			  "date_input"  => 'dd-MM-y',	
			  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
			 "required" => false));		
		
		
		
        $this->widgetSchema->setLabels(array(
            'nom' => 'Nom : (*)',
            'prenom' => 'Prénom : (*) ',
            'adressebat' => 'Immeuble ou batiment :',
            'adresserue' => 'N° rue ou chemin :',
            'quartier_id' => 'CP :',
            'tel1' => 'Téléphone 1 :',
            'tel2' => 'Téléphone 2 :',
            'email' => 'E-mail :',
        ));
		
			
   			//--- pour palier aux erreurs à l'enregistrement on crée un champ _csrf_token qui ne s'affiche pas -------
			$this->setWidget('_csrf_token', new sfWidgetFormInputHidden());
			$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputText(array(), array("style"=>'width: 0px;'));
			$this->setValidator('_csrf_token' , new sfValidatorString());
			//--------------------------------------------------------------------------------------------------------
			
			unset($this['numen'],$this['date_naissance']);
    }
protected function doSave($con = null) //mettre le nom en majuscule fonction capitalize définie dans eleve.class.php
  {
    $this->values['nom'] = Personne::capitalize($this->values['nom']); 
	$this->values['prenom'] = Personne::capitalize($this->values['prenom']); 
	$this->values['tel1'] = Personne::format_tel($this->values['tel1']); 
	$this->values['tel2'] = Personne::format_tel($this->values['tel2']); 
    parent::doSave($con);
  } 

}
