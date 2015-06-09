<?php

/**
 * Specialiste filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSpecialisteFormFilter extends PersonneFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['specialite_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Specialite'), 'add_empty' => true));
    $this->validatorSchema['specialite_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Specialite'), 'column' => 'id'));

    $this->widgetSchema   ['secteur_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'add_empty' => true));
    $this->validatorSchema['secteur_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Secteur'), 'column' => 'id'));

    $this->widgetSchema   ['organismesuivit_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('OrganismeSuivit'), 'add_empty' => true));
    $this->validatorSchema['organismesuivit_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('OrganismeSuivit'), 'column' => 'id'));

    $this->widgetSchema->setNameFormat('specialiste_filters[%s]');
  }

  public function getModelName()
  {
    return 'Specialiste';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'specialite_id' => 'ForeignKey',
      'secteur_id' => 'ForeignKey',
      'organismesuivit_id' => 'ForeignKey',
    ));
  }
}
