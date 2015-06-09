<?php

/**
 * Avs form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AvsForm extends BaseAvsForm
{
  public function configure()
  {
  
  $this->widgetSchema['nom'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
   $this->widgetSchema['nom_nais'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
  $this->widgetSchema['prenom'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
  $this->widgetSchema['adressebat'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
   $this->widgetSchema['adresserue'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
   $this->widgetSchema['commentaire'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;')); 
      $this->widgetSchema['email'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;')); 
     //$this->widgetSchema['date_naissance'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',));
	$this->widgetSchema['date_naissance'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	$this->validatorSchema['date_naissance'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));
		
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

	}
		protected function doSave($con = null) //mettre le nom en majuscule fonction capitalize définie dans eleve.class.php
  {
    $this->values['nom'] = Avs::capitalize($this->values['nom']); 
	$this->values['prenom'] = Avs::capitalize($this->values['prenom']); 
	$this->values['tel1'] = Avs::format_tel($this->values['tel1']); 
	$this->values['tel2'] = Avs::format_tel($this->values['tel2']); 
    parent::doSave($con);
  } 
}
