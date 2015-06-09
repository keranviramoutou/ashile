<?php

/**
 * SuivitExterne form base class.
 *
 * @method SuivitExterne getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSuivitExterneForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'specialiste_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiste'), 'add_empty' => false)),
      'eleve_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => false)),
      'datedebutpriseencharge' => new sfWidgetFormDate(),
      'datefinpriseencharge'   => new sfWidgetFormDate(),
      'organismesuivit_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrganismeSuivit'), 'add_empty' => true)),
      'naturesuiviext_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Naturesuiviext'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'specialiste_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Specialiste'))),
      'eleve_id'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'))),
      'datedebutpriseencharge' => new sfValidatorDate(array('required' => false)),
      'datefinpriseencharge'   => new sfValidatorDate(array('required' => false)),
      'organismesuivit_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OrganismeSuivit'), 'required' => false)),
      'naturesuiviext_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Naturesuiviext'))),
    ));

    $this->widgetSchema->setNameFormat('suivit_externe[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SuivitExterne';
  }

}
