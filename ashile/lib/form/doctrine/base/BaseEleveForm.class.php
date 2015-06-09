<?php

/**
 * Eleve form base class.
 *
 * @method Eleve getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEleveForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'quartier_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'add_empty' => true)),
      'secteur_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'add_empty' => true)),
	  'pps_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pps'), 'add_empty' => true)),
      'ine'             => new sfWidgetFormInputText(),
      'numeromdph'      => new sfWidgetFormInputText(),
      'nom'             => new sfWidgetFormInputText(),
      'prenom'          => new sfWidgetFormInputText(),
      'datenaissance'   => new sfWidgetFormDate(),
      'adresseelevebat' => new sfWidgetFormInputText(),
      'adresseleverue'  => new sfWidgetFormInputText(),
      'notes'           => new sfWidgetFormTextarea(),
      'sexe'            => new sfWidgetFormInputText(),
      'datesortie'      => new sfWidgetFormDate(),
      'motif'           => new sfWidgetFormInputText(),
      'etat_acc'        => new sfWidgetFormDate(),
	  'etat_mat'        => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'quartier_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'required' => false)),
      'secteur_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'required' => false)),
	  'pps_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'required' => false)),
      'ine'             => new sfValidatorString(array('max_length' => 11, 'required' => false)),
      'numeromdph'      => new sfValidatorString(array('max_length' => 11, 'required' => false)),
      'nom'             => new sfValidatorRegex(array('max_length' => 100, 'pattern' => "/^([\s]*[-A-Za-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+[\s]*)+$/")),
      'prenom'          => new sfValidatorRegex(array('max_length' => 100, 'pattern' => "/^([\s]*[-A-Za-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+[\s]*)+$/")),
      'datenaissance'   => new sfValidatorDate(),
      'adresseelevebat' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'adresseleverue'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'notes'           => new sfValidatorString(array('required' => false)),
      'sexe'            => new sfValidatorString(array('max_length' => 1)),
      'datesortie'      => new sfValidatorDate(array('required' => false)),
      'motif'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'etat_acc'        => new sfValidatorDate(array('required' => false)),
	  'etat_mat'        => new sfValidatorDate(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Eleve', 'column' => array('ine'))),
        //new sfValidatorDoctrineUnique(array('model' => 'Eleve', 'column' => array('numeromdph'))),
      ))
    );

    $this->widgetSchema->setNameFormat('eleve[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Eleve';
  }

}
