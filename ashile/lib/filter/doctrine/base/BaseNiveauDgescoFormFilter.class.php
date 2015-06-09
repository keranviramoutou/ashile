<?php

/**
 * NiveauDgesco filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNiveauDgescoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nomniveaudegsco'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nomLongNiveauDgesco' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'nomniveaudegsco'     => new sfValidatorPass(array('required' => false)),
      'nomLongNiveauDgesco' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('niveau_dgesco_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NiveauDgesco';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'nomniveaudegsco'     => 'Text',
      'nomLongNiveauDgesco' => 'Text',
    );
  }
}
