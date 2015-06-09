<?php

/**
 * Rased filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRasedFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type_rased'     => new sfWidgetFormFilterInput(array('with_empty' => false)),

    ));

    $this->setValidators(array(
      'type_rased'     => new sfValidatorPass(array('required' => false)),

    ));

    $this->widgetSchema->setNameFormat('Rased_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rased';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'type_rased       '     => 'Text',

    );
  }
}
