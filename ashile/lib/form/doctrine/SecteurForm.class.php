<?php

/**
 * Secteur form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SecteurForm extends sfFormExtraPlugin
{
  public function configure()
  {
	  
	    // modification du widget pour utilisation filtres Admin
     $this->widgetSchema['id']->setOption('renderer_class', 'sfWidgetFormSelectDoubleList');
	  
  }
}
