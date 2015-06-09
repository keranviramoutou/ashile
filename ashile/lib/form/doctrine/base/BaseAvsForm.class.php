<?php

/**
 * Avs form base class.
 *
 * @method Avs getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAvsForm extends PersonneForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('avs[%s]');
  }

  public function getModelName()
  {
    return 'Avs';
  }

}
