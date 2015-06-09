<?php

/**
 * Typeetablissementnonsco filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypeetablissementnonscoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nomtypeetablissement' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nomtypeetablissement' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typeetablissementnonsco_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typeetablissementnonsco';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'nomtypeetablissement' => 'Text',
    );
  }
}
