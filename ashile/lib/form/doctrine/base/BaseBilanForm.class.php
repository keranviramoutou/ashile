<?php

/**
 * Bilan form base class.
 *
 * @method Bilan getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseBilanForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'specialiste_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('specialiste'), 'add_empty' => false)),
      'mdph_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mdph'), 'add_empty' => true)),
      'libelle_bilan'  => new sfWidgetFormInputText(),
      'date_bilan'     => new sfWidgetFormDate(),
      'notes'          => new sfWidgetFormTextarea(),
      'naturebilan_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebilan'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'specialiste_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('specialiste'))),
      'mdph_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('mdph'), 'required' => false)),
      'libelle_bilan'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'date_bilan'     => new sfValidatorDate(array('required' => false)),
      'notes'          => new sfValidatorString(array('required' => false)),
      'naturebilan_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturebilan'))),
    ));

    $this->widgetSchema->setNameFormat('bilan[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bilan';
  }

}
