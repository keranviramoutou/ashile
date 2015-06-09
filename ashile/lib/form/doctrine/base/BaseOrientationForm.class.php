<?php

/**
 * Orientation form base class.
 *
 * @method Orientation getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrientationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'niveaudgesco_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NiveauDgesco'), 'add_empty' => true)),
      'niveauscolaire_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveauscolaire'), 'add_empty' => true)),
      'libelleclasse'     => new sfWidgetFormInputText(),
      'demijournee_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'), 'add_empty' => true)),
      'eleve_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => false)),
      'classe_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classe'), 'add_empty' => true)),
      'inclusion_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inclusion'), 'add_empty' => true)),
      'enseignant_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Enseignant'), 'add_empty' => true)),
	  'rased_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rased'), 'add_empty' => true)),
	  'rased2_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rased'), 'add_empty' => true)),
      'etabsco_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabsco'), 'add_empty' => false)),
      'datedebut'         => new sfWidgetFormDate(),
      'datefin'           => new sfWidgetFormDate(),
	  'notes'           => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'niveaudgesco_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('NiveauDgesco'), 'required' => false)),
      'niveauscolaire_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Niveauscolaire'), 'required' => false)),
      'libelleclasse'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'demijournee_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'), 'required' => false)),
      'eleve_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'))),
      'classe_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Classe'), 'required' => false)),
      'inclusion_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Inclusion'), 'required' => false)),
      'enseignant_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Enseignant'), 'required' => false)),
	  'rased_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rased'), 'required' => false)),
	  'rased2_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Rased'), 'required' => false)),
      'etabsco_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etabsco'))),
      'datedebut'         => new sfValidatorDate(array('required' => false)),
      'datefin'           => new sfValidatorDate(array('required' => false)),
	  'notes'           => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('orientation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orientation';
  }

}
