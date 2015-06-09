<?php

/**
 * Typeetablissement filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypeetablissementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nomtypeetablissement' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nomtypeetablissement' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typeetablissement_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typeetablissement';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'nomtypeetablissement' => 'Text',
    );
  }
}
