<?php

/**
 * Inclusion filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInclusionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'classe_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classe'), 'add_empty' => true)),
      'temspclasseintegration' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'classe_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Classe'), 'column' => 'id')),
      'temspclasseintegration' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('inclusion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inclusion';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'classe_id'              => 'ForeignKey',
      'temspclasseintegration' => 'Text',
    );
  }
}
