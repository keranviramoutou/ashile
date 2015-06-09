<?php

/**
 * Personne form base class.
 *
 * @method Personne getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePersonneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    
      'nom'            => new sfWidgetFormInputText(),
      'prenom'         => new sfWidgetFormInputText(),
      'id'             => new sfWidgetFormInputHidden(),
      'nom_nais'       => new sfWidgetFormInputText(),
      'date_naissance' => new sfWidgetFormDate(),
      'numen'          => new sfWidgetFormInputText(),
      'adressebat'     => new sfWidgetFormInputText(),
      'adresserue'     => new sfWidgetFormInputText(),
      'quartier_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'add_empty' => true)),
      'tel1'           => new sfWidgetFormInputText(),
      'tel2'           => new sfWidgetFormInputText(),
      'email'          => new sfWidgetFormInputText(),
      'commentaire'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'quartier_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'required' => false)),
      'nom'             => new sfValidatorRegex(array('max_length' => 100, 'pattern' => "/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄÀ ]+[\s]*)+$/")),
      'prenom'          => new sfValidatorRegex(array('max_length' => 100, 'pattern' => "/^([\s]*[-A-Z\'\`a-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿÊÈÉËÄÀ ]+[\s]*)+$/")),
      'nom_nais'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'date_naissance' => new sfValidatorDate(array('required' => false)),
      'numen'          => new sfValidatorString(array('max_length' => 13, 'required' => false)),
      'commentaire'    => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'adressebat'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'adresserue'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'tel1'           => new sfValidatorRegex(array('max_length' => 13, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'tel2'           => new sfValidatorRegex(array('max_length' => 13, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'email'          => new sfValidatorEmail(array('max_length' => 150, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personne[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Personne';
  }

}
