<?php

/**
 * Reunion filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReunionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eleve_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'typereunion_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeReunion'), 'add_empty' => true)),
      'libellereunion' => new sfWidgetFormFilterInput(),
      'datereunion'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'observation'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'eleve_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Eleve'), 'column' => 'id')),
      'typereunion_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeReunion'), 'column' => 'id')),
      'libellereunion' => new sfValidatorPass(array('required' => false)),
      'datereunion'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'observation'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reunion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reunion';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'eleve_id'       => 'ForeignKey',
      'typereunion_id' => 'ForeignKey',
      'libellereunion' => 'Text',
      'datereunion'    => 'Date',
      'observation'    => 'Text',
    );
  }
}
