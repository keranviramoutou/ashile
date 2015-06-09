<?php

/**
 * Situation filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSituationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'situation' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'situation' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('situation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Situation';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'situation' => 'Text',
    );
  }
}
