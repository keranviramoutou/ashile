<?php

/**
 * Accueil form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AccueilForm extends BaseAccueilForm
{
  public function configure()
  {
	  $this->widgetSchema->setLabels(array(
	  'texteAccueil' => 'Text d\'Accueil',
	  ));
  }
}
