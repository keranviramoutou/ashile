<?php

/**
 * Classe form base class.
 *
 * @method Classe getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseClasseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'typeetablissement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissement'), 'add_empty' => false)),
      'typeclasse_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeClasse'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typeetablissement_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissement'))),
      'typeclasse_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeClasse'))),
    ));

    $this->widgetSchema->setNameFormat('classe[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Classe';
  }

}
