<?php

/**
 * Conditionsuspensive filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseConditionsuspensiveFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'conditionsuspensive' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'conditionsuspensive' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('conditionsuspensive_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Conditionsuspensive';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'conditionsuspensive' => 'Text',
    );
  }
}
