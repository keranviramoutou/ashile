<?php

/**
 * Catmateriel filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCatmaterielFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libellecatmateriel' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'libellecatmateriel' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('catmateriel_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Catmateriel';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'libellecatmateriel' => 'Text',
    );
  }
}
