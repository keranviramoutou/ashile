<?php

/**
 * DemandeTransport filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandeTransportFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'transport_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Transport'), 'add_empty' => true)),
      'mdph_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'), 'add_empty' => true)),
      'date_demande_transport' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datedebutnotif'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinnotif'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datedecisioncda'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'decisioncda'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'traite'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'etat'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'transport_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Transport'), 'column' => 'id')),
      'mdph_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mdph'), 'column' => 'id')),
      'date_demande_transport' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datedebutnotif'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinnotif'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datedecisioncda'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'decisioncda'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'traite'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'etat'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('demande_transport_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DemandeTransport';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'transport_id'           => 'ForeignKey',
      'mdph_id'                => 'ForeignKey',
      'date_demande_transport' => 'Date',
      'datedebutnotif'         => 'Date',
      'datefinnotif'           => 'Date',
      'datedecisioncda'        => 'Date',
      'decisioncda'            => 'Boolean',
      'traite'                 => 'Boolean',
      'etat'                   => 'Boolean',
    );
  }
}
