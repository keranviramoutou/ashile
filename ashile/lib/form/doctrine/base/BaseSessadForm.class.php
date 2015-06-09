<?php

/**
 * Sessad form base class.
 *
 * @method Sessad getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSessadForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'etabnonsco_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabnonsco'), 'add_empty' => false)),
      'typesessad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typesessad'), 'add_empty' => false)),
	  'ordre'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'etabnonsco_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etabnonsco'))),
      'typesessad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typesessad'))),
	  'ordre'         => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('sessad[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sessad';
  }

}
