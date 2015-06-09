<?php

/**
 * Rased form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RasedForm extends BaseRasedForm
{
  public function configure()
  {
  
    $this->widgetSchema['type_rased'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));

					
					
  }
}
