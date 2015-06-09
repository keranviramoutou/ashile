<?php

/**
 * PiecesDossier form base class.
 *
 * @method PiecesDossier getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePiecesDossierForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'mdph_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'), 'add_empty' => false)),
      'libellepiece' => new sfWidgetFormInputText(),
      'restitue'     => new sfWidgetFormInputCheckbox(),
	  'daterecep'       => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'mdph_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'))),
      'libellepiece' => new sfValidatorString(array('max_length' => 100)),
      'restitue'     => new sfValidatorBoolean(array('required' => false)),
	  'daterecep'       => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('pieces_dossier[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PiecesDossier';
  }

}
