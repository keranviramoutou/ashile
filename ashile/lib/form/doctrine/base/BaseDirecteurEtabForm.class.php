<?php

/**
 * DirecteurEtab form base class.
 *
 * @method DirecteurEtab getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDirecteurEtabForm extends PersonneForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('directeur_etab[%s]');
  }

  public function getModelName()
  {
    return 'DirecteurEtab';
  }

}
