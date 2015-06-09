<?php

/**
 * ResponsableEleve form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ResponsableEleveForm extends BaseResponsableEleveForm
{
  /**
   * @see PersonneForm
   */
  public function configure()
  {
  
  		$this->widgetSchema['nom'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
		$this->widgetSchema['nom_nais'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;', "required" =>  false));
		$this->widgetSchema['prenom'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
		$this->widgetSchema['adressebat'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
		$this->widgetSchema['adresserue'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
	   $this->widgetSchema['commentaire'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;')); 
	   $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;')); 


	  $this->setValidator(
'nom' , new sfValidatorAnd(array(
    new sfValidatorString(
        array('required' => true, 'min_length' => 3, 'max_length' => 30), 
        array( 'min_length' => 'Le nom doit faire minimum 3 characteres.', 'max_length' => 'Le nom de peut exceder 30 characteres.')
        ),
    new sfValidatorRegex(
        array('pattern' => '/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊËÄ ]+[\s]*)+$/'),
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
        array('pattern' => '/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊËÄ ]+[\s]*)+$/'),
        array('invalid' => 'Vous ne pouvez utiliser que des lettres de l\' alphabet (A-Z).')
        ),
), array(), array('required' => 'Entrer un prénom.'))); 

	// on desactive le champ NUMEN hérité de PERSONNE
	unset($this['numen'],$this['date_naissance']);
	  
    parent::configure();
  }
}
