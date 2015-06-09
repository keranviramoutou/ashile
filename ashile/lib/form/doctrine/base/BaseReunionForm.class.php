<?php

/**
 * Reunion form base class.
 *
 * @method Reunion getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReunionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'eleve_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => false)),
      'typereunion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeReunion'), 'add_empty' => false)),
      'libellereunion' => new sfWidgetFormInputText(),
      'datereunion'    => new sfWidgetFormDate(),
      'observation'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'eleve_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'))),
      'typereunion_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeReunion'))),
      'libellereunion' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'datereunion'    => new sfValidatorDate(),
      'observation'    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reunion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reunion';
  }

}
