<?php

/**
 * SuivitExterne filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSuivitExterneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'specialiste_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiste'), 'add_empty' => true)),
      'eleve_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'datedebutpriseencharge' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinpriseencharge'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'organismesuivit_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrganismeSuivit'), 'add_empty' => true)),
      'naturesuivitext_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NatureSuivitExterne'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'specialiste_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Specialiste'), 'column' => 'id')),
      'eleve_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Eleve'), 'column' => 'id')),
      'datedebutpriseencharge' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinpriseencharge'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'organismesuivit_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OrganismeSuivit'), 'column' => 'id')),
      'naturesuivitext_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NatureSuivitExterne'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('suivit_externe_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SuivitExterne';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'specialiste_id'         => 'ForeignKey',
      'eleve_id'               => 'ForeignKey',
      'datedebutpriseencharge' => 'Date',
      'datefinpriseencharge'   => 'Date',
      'organismesuivit_id'     => 'ForeignKey',
      'naturesuivitext_id'     => 'ForeignKey',
    );
  }
}
