<?php

/**
 * ResponsableEleve form base class.
 *
 * @method ResponsableEleve getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseResponsableEleveForm extends PersonneForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('responsable_eleve[%s]');
  }

  public function getModelName()
  {
    return 'ResponsableEleve';
  }

}
