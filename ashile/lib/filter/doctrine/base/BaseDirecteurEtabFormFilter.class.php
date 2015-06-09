<?php

/**
 * DirecteurEtab filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDirecteurEtabFormFilter extends PersonneFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('directeur_etab_filters[%s]');
  }

  public function getModelName()
  {
    return 'DirecteurEtab';
  }
}
