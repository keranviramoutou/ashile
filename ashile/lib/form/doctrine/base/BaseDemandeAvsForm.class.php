<?php

/**
 * DemandeAvs form base class.
 *
 * @method DemandeAvs getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDemandeAvsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'mdph_id'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'), 'add_empty' => false)),
      'conditionsuspensive_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Conditionsuspensive'), 'add_empty' => true)),
      'naturecontratavs_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturecontratavs'), 'add_empty' => true)),
      'date_demande_avs'       => new sfWidgetFormDate(),
      'quotitehorrairenotifie' => new sfWidgetFormInputText(),
      'datedebutnotif'         => new sfWidgetFormDate(),
      'datefinnotif'           => new sfWidgetFormDate(),
      'datedecisioncda'        => new sfWidgetFormDate(),
      'decisioncda'            => new sfWidgetFormInputCheckbox(),
      'traite'                 => new sfWidgetFormInputCheckbox(),
      'etat'                   => new sfWidgetFormInputCheckbox(),
      'notes'                  => new sfWidgetFormTextarea(),
      'dateRecepDemandERF'     => new sfWidgetFormDate(),
      'dateDemandDSM'          => new sfWidgetFormDate(),
      'dateDeciDSM'            => new sfWidgetFormDate(),
      'datetransDeciERF'       => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mdph_id'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'))),
      'conditionsuspensive_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Conditionsuspensive'), 'required' => false)),
      'naturecontratavs_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturecontratavs'), 'required' => false)),
      'date_demande_avs'       => new sfValidatorDate(array('required' => false)),
      'quotitehorrairenotifie' => new sfValidatorInteger(array('required' => false)),
      'datedebutnotif'         => new sfValidatorDate(array('required' => false)),
      'datefinnotif'           => new sfValidatorDate(array('required' => false)),
      'datedecisioncda'        => new sfValidatorDate(array('required' => false)),
      'decisioncda'            => new sfValidatorBoolean(array('required' => false)),
      'traite'                 => new sfValidatorBoolean(array('required' => false)),
      'etat'                   => new sfValidatorBoolean(array('required' => false)),
      'notes'                  => new sfValidatorString(array('required' => false)),
      'dateRecepDemandERF'     => new sfValidatorDate(array('required' => false)),
      'dateDemandDSM'          => new sfValidatorDate(array('required' => false)),
      'dateDeciDSM'            => new sfValidatorDate(array('required' => false)),
      'datetransDeciERF'       => new sfValidatorDate(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'DemandeAvs', 'column' => array('mdph_id')))
    );

    $this->widgetSchema->setNameFormat('demande_avs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DemandeAvs';
  }

}
