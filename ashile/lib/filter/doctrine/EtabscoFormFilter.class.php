<?php

/**
 * Etabsco filter form.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EtabscoFormFilter extends BaseEtabscoFormFilter
{
  public function configure()
  {
      $this->widgetSchema->setLabels(array("typeetablissement_id" => "Type",));		
  }
}
