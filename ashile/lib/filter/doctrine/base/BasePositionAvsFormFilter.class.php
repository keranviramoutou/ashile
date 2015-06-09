<?php

/**
 * PositionAvs filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePositionAvsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contratavs_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ContratAvs'), 'add_empty' => true)),
      'typepositionavs_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypePositionAvs'), 'add_empty' => true)),
      'datedebut'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'contratavs_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ContratAvs'), 'column' => 'id')),
      'typepositionavs_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypePositionAvs'), 'column' => 'id')),
      'datedebut'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('position_avs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PositionAvs';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'contratavs_id'      => 'ForeignKey',
      'typepositionavs_id' => 'ForeignKey',
      'datedebut'          => 'Date',
      'datefin'            => 'Date',
    );
  }
}
