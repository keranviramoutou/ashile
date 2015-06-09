<?php

/**
 * EleveAvs form base class.
 *
 * @method EleveAvs getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEleveAvsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'eleve_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'avs_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avs'), 'add_empty' => true)),
      'commentaire'        => new sfWidgetFormTextarea(),
      'quotitehorraireavs' => new sfWidgetFormInputText(),
      'datedebut'          => new sfWidgetFormDate(),
      'datefin'            => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'eleve_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'required' => false)),
      'avs_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avs'), 'required' => false)),
      'commentaire'        => new sfValidatorString(array('required' => false)),
      'quotitehorraireavs' => new sfValidatorInteger(array('required' => false)),
      'datedebut'          => new sfValidatorDate(array('required' => false)),
      'datefin'            => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eleve_avs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EleveAvs';
  }

}
