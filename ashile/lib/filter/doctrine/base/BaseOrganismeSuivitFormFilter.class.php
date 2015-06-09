<?php

/**
 * OrganismeSuivit filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrganismeSuivitFormFilter extends EtabnonscoFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['libellesuivit'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    $this->validatorSchema['libellesuivit'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['secteur_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'add_empty' => true));
    $this->validatorSchema['secteur_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Secteur'), 'column' => 'id'));

    $this->widgetSchema->setNameFormat('organisme_suivit_filters[%s]');
  }

  public function getModelName()
  {
    return 'OrganismeSuivit';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'libellesuivit' => 'Text',
      'secteur_id' => 'ForeignKey',
    ));
  }
}
