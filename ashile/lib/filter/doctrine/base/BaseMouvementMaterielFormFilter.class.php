<?php

/**
 * MouvementMateriel filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMouvementMaterielFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'materiel_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('materiel'), 'add_empty' => true)),
      'mouvement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mouvement'), 'add_empty' => true)),
      'datedebut'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
	   'notes'           => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'materiel_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('materiel'), 'column' => 'id')),
      'mouvement_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('mouvement'), 'column' => 'id')),
      'datedebut'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
	   'notes'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mouvement_materiel_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MouvementMateriel';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'materiel_id'  => 'ForeignKey',
      'mouvement_id' => 'ForeignKey',
      'datedebut'    => 'Date',
      'datefin'      => 'Date',
    );
  }
}
