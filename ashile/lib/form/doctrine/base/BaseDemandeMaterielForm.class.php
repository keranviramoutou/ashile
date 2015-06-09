<?php

/**
 * DemandeMateriel form base class.
 *
 * @method DemandeMateriel getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDemandeMaterielForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'mdph_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'), 'add_empty' => false)),
      'typemateriel_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemateriel'), 'add_empty' => false)),
      'traitement_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Traitement'), 'add_empty' => true)),
      'date_demande_materiel' => new sfWidgetFormDate(),
      'datedebutnotif'        => new sfWidgetFormDate(),
      'datefinnotif'          => new sfWidgetFormDate(),
      'datedecisioncda'       => new sfWidgetFormDate(),
      'decisioncda'           => new sfWidgetFormInputCheckbox(),
      'traite'                => new sfWidgetFormInputCheckbox(),
      'etat'                  => new sfWidgetFormInputCheckbox(),
      'notes'                 => new sfWidgetFormTextarea(),
      'materiel_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Materiel'), 'add_empty' => true)),
      'catmateriel_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catmateriel'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mdph_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'))),
      'typemateriel_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typemateriel'))),
      'traitement_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Traitement'), 'required' => false)),
      'date_demande_materiel' => new sfValidatorDate(array('required' => false)),
      'datedebutnotif'        => new sfValidatorDate(array('required' => false)),
      'datefinnotif'          => new sfValidatorDate(array('required' => false)),
      'datedecisioncda'       => new sfValidatorDate(array('required' => false)),
      'decisioncda'           => new sfValidatorBoolean(array('required' => false)),
      'traite'                => new sfValidatorBoolean(array('required' => false)),
      'etat'                  => new sfValidatorBoolean(array('required' => false)),
      'notes'                 => new sfValidatorString(array('required' => false)),
      'materiel_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Materiel'), 'required' => false)),
      'catmateriel_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Catmateriel'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('demande_materiel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DemandeMateriel';
  }

}
