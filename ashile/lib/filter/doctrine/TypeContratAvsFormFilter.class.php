<?php

/**
 * TypeContratAvs filter form.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class TypeContratAvsFormFilter extends BaseTypeContratAvsFormFilter
{
  public function configure()
  {
  unset($this['id']);
  }
}
