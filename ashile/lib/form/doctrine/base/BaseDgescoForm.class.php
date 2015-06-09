<?php

/**
 * Dgesco form base class.
 *
 * @method Dgesco getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDgescoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'eleve_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => false)),
      'anneescolaire_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Anneescolaire'), 'add_empty' => false)),
      'reponse_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Reponse'), 'add_empty' => false)),
      'question_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Question'), 'add_empty' => false)),
      'libelle_reponse'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'eleve_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'))),
      'anneescolaire_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Anneescolaire'))),
      'reponse_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Reponse'),'required' => false)),
      'question_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Question'))),
      'libelle_reponse'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dgesco[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dgesco';
  }

}
