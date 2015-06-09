<?php

/**
 * Inclusion form base class.
 *
 * @method Inclusion getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInclusionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'classe_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classe'), 'add_empty' => false)),
      'temspclasseintegration' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'classe_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Classe'))),
      'temspclasseintegration' => new sfValidatorRegex(array('max_length' => 50, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('inclusion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inclusion';
  }

}
