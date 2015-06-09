<?php

/**
 * Etabnonsco form base class.
 *
 * @method Etabnonsco getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEtabnonscoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'quartier_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'add_empty' => false)),
	  'typeetablissement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissementnonsco'), 'add_empty' => false)),
      'nometabnonsco'        => new sfWidgetFormInputText(),
      'adresseetabnonscobat' => new sfWidgetFormInputText(),
      'adresseetabnonscorue' => new sfWidgetFormInputText(),
      'teletabnonsco'        => new sfWidgetFormInputText(),
      'faxetabnonsco'        => new sfWidgetFormInputText(),
      'emailetabnonsco'      => new sfWidgetFormInputText(),
	  'ordre'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'quartier_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'))),
      'typeetablissement_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissementnonsco'))),
      'nometabnonsco'        => new sfValidatorString(array('max_length' => 100)),
      'adresseetabnonscobat' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'adresseetabnonscorue' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'teletabnonsco'        => new sfValidatorRegex(array('max_length' => 10, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'faxetabnonsco'        => new sfValidatorRegex(array('max_length' => 10, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'emailetabnonsco'      => new sfValidatorString(array('max_length' => 150, 'required' => false)),
	  'ordre'                => new sfValidatorInteger(array( 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('etabnonsco[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Etabnonsco';
  }

}
