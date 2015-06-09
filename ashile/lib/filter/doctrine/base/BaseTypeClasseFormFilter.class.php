<?php

/**
 * TypeClasse filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypeClasseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nomtypeclasse'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nomLongTypeClasse' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nomtypeclasse'     => new sfValidatorPass(array('required' => false)),
      'nomLongTypeClasse' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('type_classe_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TypeClasse';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'nomtypeclasse'     => 'Text',
      'nomLongTypeClasse' => 'Text',
    );
  }
}
