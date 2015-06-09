<?php

/**
 * Modnonsco form base class.
 *
 * @method Modnonsco getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseModnonscoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'eleve_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => false)),
      'etabnonsco_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabnonsco'), 'add_empty' => false)),
	  'niveauscolairespe_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveauscolairespe'), 'add_empty' => true)),
      'demijournee_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'), 'add_empty' => true)),
      'classespe_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classespe'), 'add_empty' => true)),
      'quothorreff'    => new sfWidgetFormInputText(),
      'datedebut'      => new sfWidgetFormDate(),
      'datefin'        => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'eleve_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'))),
      'etabnonsco_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etabnonsco'))),
	  'niveauscolairespe_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Niveauscolairespe'),'required' => false)),
      'demijournee_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'), 'required' => false)),
      'classespe_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Classespe'), 'required' => false)),
      'quothorreff'    => new sfValidatorInteger(array('required' => false)),
      'datedebut'      => new sfValidatorDate(array('required' => false)),
      'datefin'        => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('modnonsco[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Modnonsco';
  }

}
