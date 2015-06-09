<?php

/**
 * Transportobtenu form base class.
 *
 * @method Transportobtenu getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTransportobtenuForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'transport_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Transport'), 'add_empty' => false)),
      'eleve_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => false)),
      'demandetransport_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DemandeTransport'), 'add_empty' => false)),
      'datedebut'           => new sfWidgetFormDate(),
      'datefin'             => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'transport_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Transport'))),
      'eleve_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'))),
      'demandetransport_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DemandeTransport'))),
      'datedebut'           => new sfValidatorDate(array('required' => false)),
      'datefin'             => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transportobtenu[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transportobtenu';
  }

}
