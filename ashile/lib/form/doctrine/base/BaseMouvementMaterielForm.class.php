<?php

/**
 * MouvementMateriel form base class.
 *
 * @method MouvementMateriel getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMouvementMaterielForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'materiel_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('materiel'), 'add_empty' => true)),
      'mouvement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('mouvement'), 'add_empty' => true)),
      'datedebut'    => new sfWidgetFormDate(),
      'datefin'      => new sfWidgetFormDate(),
      'notes'           => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'materiel_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('materiel'), 'required' => false)),
      'mouvement_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('mouvement'), 'required' => false)),
      'datedebut'    => new sfValidatorDate(array('required' => false)),
      'datefin'      => new sfValidatorDate(array('required' => false)),
	  'notes'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mouvement_materiel[%s]');

   // $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MouvementMateriel';
  }

}
