<?php

/**
 * Bilan filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseBilanFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'specialiste_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('specialiste'), 'add_empty' => true)),
      'mdph_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mdph'), 'add_empty' => true)),
      'libelle_bilan'  => new sfWidgetFormFilterInput(),
      'date_bilan'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'notes'          => new sfWidgetFormFilterInput(),
      'specialite_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialite'), 'add_empty' => true)),
      'naturebilan_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NatureBilan'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'specialiste_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('specialiste'), 'column' => 'id')),
      'mdph_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('mdph'), 'column' => 'id')),
      'libelle_bilan'  => new sfValidatorPass(array('required' => false)),
      'date_bilan'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'notes'          => new sfValidatorPass(array('required' => false)),
      'specialite_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Specialite'), 'column' => 'id')),
      'naturebilan_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NatureBilan'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('bilan_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bilan';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'specialiste_id' => 'ForeignKey',
      'mdph_id'        => 'ForeignKey',
      'libelle_bilan'  => 'Text',
      'date_bilan'     => 'Date',
      'notes'          => 'Text',
      'specialite_id'  => 'ForeignKey',
      'naturebilan_id' => 'ForeignKey',
    );
  }
}
