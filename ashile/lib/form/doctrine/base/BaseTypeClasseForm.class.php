<?php

/**
 * TypeClasse form base class.
 *
 * @method TypeClasse getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTypeClasseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'nomtypeclasse'     => new sfWidgetFormInputText(),
      'nomLongTypeClasse' => new sfWidgetFormInputText(),
      'ordre'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nomtypeclasse'     => new sfValidatorString(array('max_length' => 50)),
      'nomLongTypeClasse' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'ordre'             => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('type_classe[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TypeClasse';
  }

}
