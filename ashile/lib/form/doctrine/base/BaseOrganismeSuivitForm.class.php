<?php

/**
 * OrganismeSuivit form base class.
 *
 * @method OrganismeSuivit getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseOrganismeSuivitForm extends EtabnonscoForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['libellesuivit'] = new sfWidgetFormInputText();
    $this->validatorSchema['libellesuivit'] = new sfValidatorString(array('max_length' => 100, 'required' => false));

    $this->widgetSchema   ['secteur_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'add_empty' => false));
    $this->validatorSchema['secteur_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur')));

    $this->widgetSchema->setNameFormat('organisme_suivit[%s]');
  }

  public function getModelName()
  {
    return 'OrganismeSuivit';
  }

}
