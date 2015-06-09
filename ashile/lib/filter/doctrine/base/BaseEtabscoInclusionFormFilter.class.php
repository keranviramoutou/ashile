<?php

/**
 * EtabscoInclusion filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEtabscoInclusionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typeinclusion' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'typeinclusion' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('etabsco_inclusion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EtabscoInclusion';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'typeinclusion' => 'Text',
    );
  }
}
