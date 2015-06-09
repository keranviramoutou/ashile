<?php

/**
 * ResponsableEleve filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseResponsableEleveFormFilter extends PersonneFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('responsable_eleve_filters[%s]');
  }

  public function getModelName()
  {
    return 'ResponsableEleve';
  }
}
