<?php

/**
 * DemandeAvs filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDemandeAvsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mdph_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'), 'add_empty' => true)),
      'conditionsuspensive_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Conditionsuspensive'), 'add_empty' => true)),
      'naturecontratavs_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturecontratavs'), 'add_empty' => true)),
      'date_demande_avs'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'quotitehorrairenotifie' => new sfWidgetFormFilterInput(),
      'datedebutnotif'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefinnotif'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datedecisioncda'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'decisioncda'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'traite'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'etat'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'notes'                  => new sfWidgetFormFilterInput(),
      'dateRecepDemandERF'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'dateDemandDSM'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'dateDeciDSM'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datetransDeciERF'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'mdph_id'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mdph'), 'column' => 'id')),
      'conditionsuspensive_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Conditionsuspensive'), 'column' => 'id')),
      'naturecontratavs_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Naturecontratavs'), 'column' => 'id')),
      'date_demande_avs'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'quotitehorrairenotifie' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datedebutnotif'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefinnotif'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datedecisioncda'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'decisioncda'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'traite'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'etat'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'notes'                  => new sfValidatorPass(array('required' => false)),
      'dateRecepDemandERF'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dateDemandDSM'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'dateDeciDSM'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datetransDeciERF'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('demande_avs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DemandeAvs';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'mdph_id'                => 'ForeignKey',
      'conditionsuspensive_id' => 'ForeignKey',
      'naturecontratavs_id'    => 'ForeignKey',
      'date_demande_avs'       => 'Date',
      'quotitehorrairenotifie' => 'Number',
      'datedebutnotif'         => 'Date',
      'datefinnotif'           => 'Date',
      'datedecisioncda'        => 'Date',
      'decisioncda'            => 'Boolean',
      'traite'                 => 'Boolean',
      'etat'                   => 'Boolean',
      'notes'                  => 'Text',
      'dateRecepDemandERF'     => 'Date',
      'dateDemandDSM'          => 'Date',
      'dateDeciDSM'            => 'Date',
      'datetransDeciERF'       => 'Date',
    );
  }
}
