<?php

/**
 * Modnonsco filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseModnonscoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eleve_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'etabnonsco_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabnonsco'), 'add_empty' => true)),
      'demijournee_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'), 'add_empty' => true)),
      'classespe_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classespe'), 'add_empty' => true)),
      'quothorreff'    => new sfWidgetFormFilterInput(),
      'datedebut'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'datefin'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'eleve_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Eleve'), 'column' => 'id')),
      'etabnonsco_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etabnonsco'), 'column' => 'id')),
      'demijournee_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demijournee'), 'column' => 'id')),
      'classespe_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Classespe'), 'column' => 'id')),
      'quothorreff'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datedebut'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('modnonsco_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Modnonsco';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'eleve_id'       => 'ForeignKey',
      'etabnonsco_id'  => 'ForeignKey',
      'demijournee_id' => 'ForeignKey',
      'classespe_id'   => 'ForeignKey',
      'quothorreff'    => 'Number',
      'datedebut'      => 'Date',
      'datefin'        => 'Date',
    );
  }
}
