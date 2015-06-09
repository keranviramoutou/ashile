<?php

/**
 * Quartier filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseQuartierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'commune_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commune'), 'add_empty' => true)),
      'code_postal'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nom_quartier' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'commune_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commune'), 'column' => 'id')),
      'code_postal'  => new sfValidatorPass(array('required' => false)),
      'nom_quartier' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('quartier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Quartier';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'commune_id'   => 'ForeignKey',
      'code_postal'  => 'Text',
      'nom_quartier' => 'Text',
    );
  }
}
