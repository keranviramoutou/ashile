<?php

/**
 * PositionAvs form base class.
 *
 * @method PositionAvs getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePositionAvsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'contratavs_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContratAvs'), 'add_empty' => false)),
      'typepositionavs_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypePositionAvs'), 'add_empty' => false)),
      'datedebut'          => new sfWidgetFormDate(),
      'datefin'            => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'contratavs_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ContratAvs'))),
      'typepositionavs_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypePositionAvs'))),
      'datedebut'          => new sfValidatorDate(array('required' => false)),
      'datefin'            => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('position_avs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PositionAvs';
  }

}
