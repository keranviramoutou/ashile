<?php

/**
 * Specialiste form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SpecialisteForm extends BaseSpecialisteForm
{
  /**
   * @see PersonneForm
   */
  public function configure()
  {
    parent::configure();
    		$this->widgetSchema['nom'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
			$this->widgetSchema['prenom'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
			$this->widgetSchema['adressebat'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
			$this->widgetSchema['adresserue'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
	   $this->widgetSchema['commentaire'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;')); 
	     $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
            // on redéfinit  eleve_id     
	$this->setWidget('secteur_id', new sfWidgetFormInputHidden());
	$this->setValidator('secteur_id', new sfValidatorString());
	
	
   			//--- pour palier aux erreurs à l'enregistrement on crée un champ _csrf_token qui ne s'affiche pas -------
			$this->setWidget('_csrf_token', new sfWidgetFormInputHidden());
			$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputText(array(), array("style"=>'width: 0px;'));
			$this->setValidator('_csrf_token' , new sfValidatorString());
			//--------------------------------------------------------------------------------------------------------
			
			 $queryOrganismeValid = Doctrine::getTable('OrganismeSuivit')-> getOrganismeValid(sfContext::getInstance()->getUser()->getAttribute('secteur')); 
			        $this->widgetSchema['organismesuivit_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'OrganismeSuivit',
                    'add_empty' => 'Choisissez...',
                    'query' => $queryOrganismeValid ,
                    'add_empty' => true
                ));
				
				}
 
protected function doSave($con = null) //mettre le nom en majuscule fonction capitalize définie dans specialiste.class.php
  {
    $this->values['nom'] = Specialiste::capitalize($this->values['nom']); 
	$this->values['prenom'] = Specialiste::capitalize($this->values['prenom']); 
     parent::doSave($con);

 }





}
