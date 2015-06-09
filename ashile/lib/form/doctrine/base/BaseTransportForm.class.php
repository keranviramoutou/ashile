<?php

/**
 * Transport form base class.
 *
 * @method Transport getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTransportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'libelletransport' => new sfWidgetFormInputText(),
      'datedebut'        => new sfWidgetFormDate(),
      'datefin'          => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'libelletransport' => new sfValidatorString(array('max_length' => 100)),
      'datedebut'        => new sfValidatorDate(array('required' => false)),
      'datefin'          => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transport[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transport';
  }

}
