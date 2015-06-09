<?php

/**
 * Mdph form base class.
 *
 * @method Mdph getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMdphForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'eleve_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => false)),
      'datecreationpps'   => new sfWidgetFormDate(),
      'nbheuresavs'       => new sfWidgetFormInputText(),
      'dateenvoiedossier' => new sfWidgetFormDate(),
      'etat'              => new sfWidgetFormInputCheckbox(),
      'dateess'           => new sfWidgetFormDate(),
      'datepjdom'         => new sfWidgetFormDate(),
      'datepjident'       => new sfWidgetFormDate(),
      'datebilanmedical'  => new sfWidgetFormDate(),
	  'depotparent'              => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'eleve_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'))),
      'datecreationpps'   => new sfValidatorDate(array('required' => false)),
      'nbheuresavs'       => new sfValidatorInteger(array('required' => false)),
      'dateenvoiedossier' => new sfValidatorDate(array('required' => false)),
      'etat'              => new sfValidatorBoolean(array('required' => false)),
      'dateess'           => new sfValidatorDate(array('required' => false)),
      'datepjdom'         => new sfValidatorDate(array('required' => false)),
      'datepjident'       => new sfValidatorDate(array('required' => false)),
      'datebilanmedical'  => new sfValidatorDate(array('required' => false)),
	  'depotparent'       => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mdph[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mdph';
  }

}
