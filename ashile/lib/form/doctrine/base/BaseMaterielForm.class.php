<?php

/**
 * Materiel form base class.
 *
 * @method Materiel getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMaterielForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'marque_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marque'), 'add_empty' => false)),
      'typemateriel_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemateriel'), 'add_empty' => false)),
      'catmateriel_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catmateriel'), 'add_empty' => true)),
      'libellemateriel'         => new sfWidgetFormInputText(),
      'prixachat'               => new sfWidgetFormInputText(),
      'fournisseur_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'caracteristiquemateriel' => new sfWidgetFormTextarea(),
      'numeromateriel'          => new sfWidgetFormInputText(),
      'commentaire'             => new sfWidgetFormTextarea(),
	  'dateachat'               => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'marque_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Marque'))),
      'typemateriel_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typemateriel'))),
      'catmateriel_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catmateriel'), 'required' => false)),
      'libellemateriel'         => new sfValidatorString(array('max_length' => 100)),
      'prixachat'               => new sfValidatorString(array('required' => false)),
      'fournisseur_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'required' => false)),
      'caracteristiquemateriel' => new sfValidatorString(array('required' => false)),
      'numeromateriel'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'commentaire'             => new sfValidatorString(array('required' => false)),
	  'dateachat'               => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('materiel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Materiel';
  }

}
