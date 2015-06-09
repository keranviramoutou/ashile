<?php

/**
 * Specialiste form base class.
 *
 * @method Specialiste getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSpecialisteForm extends PersonneForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['specialite_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialite'), 'add_empty' => false));
    $this->validatorSchema['specialite_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Specialite')));

    $this->widgetSchema   ['secteur_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'add_empty' => false));
    $this->validatorSchema['secteur_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur')));

    $this->widgetSchema   ['organismesuivit_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrganismeSuivit'), 'add_empty' => true));
    $this->validatorSchema['organismesuivit_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('OrganismeSuivit'), 'required' => false));

    $this->widgetSchema->setNameFormat('specialiste[%s]');
  }

  public function getModelName()
  {
    return 'Specialiste';
  }

}
