<?php

/**
 * EleveMateriel form base class.
 *
 * @method EleveMateriel getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEleveMaterielForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'eleve_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'materiel_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materiel'), 'add_empty' => true)),
      'dateconvention' => new sfWidgetFormDate(),
      'datedebut'      => new sfWidgetFormDate(),
      'datefin'        => new sfWidgetFormDate(),
	  'dateremiseerf'      => new sfWidgetFormDate(),
      'dateremiseparent'   => new sfWidgetFormDate(),
	  'autorisationparent'   => new sfWidgetFormDate(),
	  'numero_convention'  => new sfWidgetFormInputText(),
	  'chemin_conv'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'eleve_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'required' => false)),
      'materiel_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Materiel'), 'required' => false)),
      'dateconvention' => new sfValidatorDate(array('required' => false)),
      'datedebut'      => new sfValidatorDate(array('required' => false)),
      'datefin'        => new sfValidatorDate(array('required' => false)),
	  'dateremiseerf'      => new sfValidatorDate(array('required' => false)),
      'dateremiseparent'  => new sfValidatorDate(array('required' => false)),
	  'autorisationparent'  => new sfValidatorDate(array('required' => false)),
	  'numero_convention' => new sfValidatorString(array('max_length' => 11, 'required' => false)),
	  'chemin_conv' => new sfValidatorString(array('max_length' => 150, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('eleve_materiel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EleveMateriel';
  }

}
