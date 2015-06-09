<?php

/**
 * Niveauscolaire form base class.
 *
 * @method Niveauscolaire getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNiveauscolaireForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'nomniveauscolaire'     => new sfWidgetFormInputText(),
      'nomLongNiveauScolaire' => new sfWidgetFormInputText(),
	  'degreetabsco'         => new sfWidgetFormInputText(),
	   'ordre'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nomniveauscolaire'     => new sfValidatorString(array('max_length' => 50)),
      'nomLongNiveauScolaire' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
	  'degreetabsco'         => new sfValidatorString(array('max_length' => 25, 'required' => false)),
	  'ordre'                => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('niveauscolaire[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Niveauscolaire';
  }

}
