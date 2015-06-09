<?php

/**
 * Quartier form base class.
 *
 * @method Quartier getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseQuartierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'commune_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commune'), 'add_empty' => false)),
      'code_postal'  => new sfWidgetFormInputText(),
      'nom_quartier' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'commune_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Commune'))),
      'code_postal'  => new sfValidatorString(array('max_length' => 5)),
      'nom_quartier' => new sfValidatorString(array('max_length' => 70)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Quartier', 'column' => array('code_postal')))
    );

    $this->widgetSchema->setNameFormat('quartier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Quartier';
  }

}
