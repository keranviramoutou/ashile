<?php

/**
 * Reponse form base class.
 *
 * @method Reponse getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseReponseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'reponse'         => new sfWidgetFormInputText(),
      'libelle_reponse' => new sfWidgetFormInputText(),
	  'degreetabsco'    => new sfWidgetFormInputText(),
	  'num_reponse'    => new sfWidgetFormInputText(),
      'question_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Question'), 'add_empty' => false)),
      'algorithm'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'reponse'         => new sfValidatorString(array('max_length' => 100)),
	  'degreetabsco'    => new sfValidatorString(array('max_length' => 25)),
	  'num_reponse'     => new sfValidatorString(array('max_length' => 25)),
      'libelle_reponse' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'question_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Question'))),
      'algorithm'       => new sfValidatorString(array('max_length' => 128, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reponse[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reponse';
  }

}
