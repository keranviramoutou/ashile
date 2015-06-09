<?php

/**
 * Anneescolaire form base class.
 *
 * @method Anneescolaire getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAnneescolaireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'datedebutanneescolaire' => new sfWidgetFormDate(),
      'datefinanneescolaire'   => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'datedebutanneescolaire' => new sfValidatorDate(array('required' => false)),
      'datefinanneescolaire'   => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('anneescolaire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Anneescolaire';
  }

}
