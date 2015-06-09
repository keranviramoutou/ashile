<?php

/**
 * ContratAvs form base class.
 *
 * @method ContratAvs getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseContratAvsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'etabsco_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabsco'), 'add_empty' => false)),
      'avs_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Avs'), 'add_empty' => false)),
      'typecontratavs_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeContratAvs'), 'add_empty' => false)),
      'temps_hebdo'        => new sfWidgetFormInputText(),
      'date_debut_contrat' => new sfWidgetFormDate(),
      'date_fin_contrat'   => new sfWidgetFormDate(),
      'date_fin_projete'   => new sfWidgetFormDate(),
	  'commentaire'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'etabsco_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Etabsco'))),
      'avs_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Avs'))),
      'typecontratavs_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TypeContratAvs'))),
      'temps_hebdo'        => new sfValidatorInteger(array('required' => false)),
      'date_debut_contrat' => new sfValidatorDate(array('required' => false)),
      'date_fin_contrat'   => new sfValidatorDate(array('required' => false)),
      'date_fin_projete'   => new sfValidatorDate(array('required' => false)),
	  'commentaire'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contrat_avs[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContratAvs';
  }

}
