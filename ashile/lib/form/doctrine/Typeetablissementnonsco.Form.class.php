<?php

/**
 * Typeetablissementnonsco form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TypeetablissementnonscoForm extends BaseTypeetablissementnonscoForm
{
  public function configure()
  {
  
          $this->widgetSchema->setLabels(array(
            'nomtypeetablissement' => 'Type établissement :',
        
        ));
  }
}
