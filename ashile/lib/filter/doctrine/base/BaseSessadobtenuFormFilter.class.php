<?php

/**
 * Sessadobtenu filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSessadobtenuFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eleve_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'sessad_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sessad'), 'add_empty' => true)),
      'datedebut'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'demandesessad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DemandeSessad'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'eleve_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Eleve'), 'column' => 'id')),
      'sessad_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Sessad'), 'column' => 'id')),
      'datedebut'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'demandesessad_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DemandeSessad'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('sessadobtenu_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sessadobtenu';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'eleve_id'         => 'ForeignKey',
      'sessad_id'        => 'ForeignKey',
      'datedebut'        => 'Date',
      'datefin'          => 'Date',
      'demandesessad_id' => 'ForeignKey',
    );
  }
}
