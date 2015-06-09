<?php

/**
 * Tuteur form base class.
 *
 * @method Tuteur getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTuteurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eleve_id'                => new sfWidgetFormInputHidden(),
      'responsableeleve_id'     => new sfWidgetFormInputHidden(),
      'tuteurlegal'             => new sfWidgetFormInputCheckbox(),
      'typeresponsableeleve_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeResponsableEleve'), 'add_empty' => false)),
	  'autretyperesponsable'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'eleve_id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('eleve_id')), 'empty_value' => $this->getObject()->get('eleve_id'), 'required' => false)),
      'responsableeleve_id'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('responsableeleve_id')), 'empty_value' => $this->getObject()->get('responsableeleve_id'), 'required' => false)),
      'tuteurlegal'             => new sfValidatorBoolean(array('required' => false)),
      'typeresponsableeleve_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeResponsableEleve'))),
	  'autretyperesponsable'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tuteur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tuteur';
  }

}
