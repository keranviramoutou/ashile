<?php

/**
 * DemandeOrientation form base class.
 *
 * @method DemandeOrientation getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDemandeOrientationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'mdph_id'                  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'), 'add_empty' => false)),
      'classeext_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classeext'), 'add_empty' => false)),
      'demijournee_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'), 'add_empty' => false)),
      'date_demande_orientation' => new sfWidgetFormDate(),
      'datedebutnotif'           => new sfWidgetFormDate(),
      'datefinnotif'             => new sfWidgetFormDate(),
      'datedecisioncda'          => new sfWidgetFormDate(),
      'decisioncda'              => new sfWidgetFormInputCheckbox(),
      'traite'                   => new sfWidgetFormInputCheckbox(),
      'etat'                     => new sfWidgetFormInputCheckbox(),
      'notes'                    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mdph_id'                  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'))),
      'classeext_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Classeext'))),
      'demijournee_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'))),
      'date_demande_orientation' => new sfValidatorDate(array('required' => false)),
      'datedebutnotif'           => new sfValidatorDate(array('required' => false)),
      'datefinnotif'             => new sfValidatorDate(array('required' => false)),
      'datedecisioncda'          => new sfValidatorDate(array('required' => false)),
      'decisioncda'              => new sfValidatorBoolean(array('required' => false)),
      'traite'                   => new sfValidatorBoolean(array('required' => false)),
      'etat'                     => new sfValidatorBoolean(array('required' => false)),
      'notes'                    => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('demande_orientation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DemandeOrientation';
  }

}
