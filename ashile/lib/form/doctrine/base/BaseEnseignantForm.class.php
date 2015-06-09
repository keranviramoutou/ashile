<?php

/**
 * Enseignant form base class.
 *
 * @method Enseignant getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEnseignantForm extends PersonneForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('enseignant[%s]');
  }

  public function getModelName()
  {
    return 'Enseignant';
  }

}
