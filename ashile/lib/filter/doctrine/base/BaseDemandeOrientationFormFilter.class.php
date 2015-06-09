<?php

/**
 * DemandeOrientation filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandeOrientationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mdph_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'), 'add_empty' => true)),
      'classeext_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classespe'), 'add_empty' => true)),
      'demijournee_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'), 'add_empty' => true)),
      'date_demande_orientation' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datedebutnotif'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinnotif'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datedecisioncda'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'decisioncda'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'traite'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'etat'                     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'notes'                    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'mdph_id'                  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mdph'), 'column' => 'id')),
      'classeext_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Classespe'), 'column' => 'id')),
      'demijournee_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demijournee'), 'column' => 'id')),
      'date_demande_orientation' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datedebutnotif'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinnotif'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datedecisioncda'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'decisioncda'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'traite'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'etat'                     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'notes'                    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('demande_orientation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DemandeOrientation';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'mdph_id'                  => 'ForeignKey',
      'classeext_id'             => 'ForeignKey',
      'demijournee_id'           => 'ForeignKey',
      'date_demande_orientation' => 'Date',
      'datedebutnotif'           => 'Date',
      'datefinnotif'             => 'Date',
      'datedecisioncda'          => 'Date',
      'decisioncda'              => 'Boolean',
      'traite'                   => 'Boolean',
      'etat'                     => 'Boolean',
      'notes'                    => 'Text',
    );
  }
}
