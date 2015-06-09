<?php

/**
 * TypeReunion filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypeReunionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelletypereunion' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'libelletypereunion' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('type_reunion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TypeReunion';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'libelletypereunion' => 'Text',
    );
  }
}
