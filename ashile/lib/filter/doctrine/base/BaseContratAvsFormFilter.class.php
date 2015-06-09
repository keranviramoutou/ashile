<?php

/**
 * ContratAvs filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseContratAvsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'etabsco_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabsco'), 'add_empty' => true)),
      'avs_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avs'), 'add_empty' => true)),
      'typecontratavs_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeContratAvs'), 'add_empty' => true)),
      'temps_hebdo'        => new sfWidgetFormFilterInput(),
      'date_debut_contrat' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_fin_contrat'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_fin_projete'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'etabsco_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etabsco'), 'column' => 'id')),
      'avs_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avs'), 'column' => 'id')),
      'typecontratavs_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeContratAvs'), 'column' => 'id')),
      'temps_hebdo'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_debut_contrat' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_fin_contrat'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'date_fin_projete'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('contrat_avs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContratAvs';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'etabsco_id'         => 'ForeignKey',
      'avs_id'             => 'ForeignKey',
      'typecontratavs_id'  => 'ForeignKey',
      'temps_hebdo'        => 'Number',
      'date_debut_contrat' => 'Date',
      'date_fin_contrat'   => 'Date',
      'date_fin_projete'   => 'Date',
    );
  }
}
