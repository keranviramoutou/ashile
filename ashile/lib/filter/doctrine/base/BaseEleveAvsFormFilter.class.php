<?php

/**
 * EleveAvs filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEleveAvsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eleve_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'avs_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avs'), 'add_empty' => true)),
      'commentaire'        => new sfWidgetFormFilterInput(),
      'quotitehorraireavs' => new sfWidgetFormFilterInput(),
      'datedebut'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'eleve_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Eleve'), 'column' => 'id')),
      'avs_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Avs'), 'column' => 'id')),
      'commentaire'        => new sfValidatorPass(array('required' => false)),
      'quotitehorraireavs' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datedebut'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('eleve_avs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EleveAvs';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'eleve_id'           => 'ForeignKey',
      'avs_id'             => 'ForeignKey',
      'commentaire'        => 'Text',
      'quotitehorraireavs' => 'Number',
      'datedebut'          => 'Date',
      'datefin'            => 'Date',
    );
  }
}
