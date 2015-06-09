<?php

/**
 * OrganismeSuivit form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class OrganismeSuivitForm extends BaseOrganismeSuivitForm
{
  public function configure()
  {
	          // on redéfinit  secteur_id     
        $this->setWidget('secteur_id', new sfWidgetFormInputHidden());
        $this->setValidator('secteur_id', new sfValidatorString());
        
		$this->widgetSchema->setLabels(array(
			'libellesuivit'		=>		'Nom du suivi',
		));       

			$this->widgetSchema['nometabnonsco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
			$this->widgetSchema['adresseetabnonscobat'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
			$this->widgetSchema['adresseetabnonscorue'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));		
			
			
		// $this->setWidget('libellesuivit', new sfWidgetFormInputHidden());
        //$this->setValidator('libellesuivit', new sfValidatorString());
			
		 // --- pour palier aux erreurs à l'enregistrement on crée un champ _csrf_token qui ne s'affiche pas -------
			//afficher le champs dans le _form.php
		
			$this->setWidget('_csrf_token', new sfWidgetFormInputHidden());
			$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputText(array(), array("style"=>'width: 0px;'));
			$this->setValidator('_csrf_token' , new sfValidatorString());
			
			// --------------------------------------------------------------------------------------------------------	
  }
}
