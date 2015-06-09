<?php

/**
 * Sessadobtenu form base class.
 *
 * @method Sessadobtenu getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSessadobtenuForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'eleve_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => false)),
      'sessad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Sessad'), 'add_empty' => false)),
      'datedebut' => new sfWidgetFormDate(),
      'datefin'   => new sfWidgetFormDate(),
      'demandesessad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DemandeSessad'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'eleve_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'))),
      'sessad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Sessad'))),
      'datedebut' => new sfValidatorDate(array('required' => false)),
      'datefin'   => new sfValidatorDate(array('required' => false)),
      'demandesessad_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DemandeSessad'), 'required' => false)),     
    ));

    $this->widgetSchema->setNameFormat('sessadobtenu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sessadobtenu';
  }

}
