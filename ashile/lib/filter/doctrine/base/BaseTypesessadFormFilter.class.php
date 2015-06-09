<?php

/**
 * Typesessad filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypesessadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelletypesessad' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'libelletypesessad' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typesessad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typesessad';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'libelletypesessad' => 'Text',
    );
  }
}
