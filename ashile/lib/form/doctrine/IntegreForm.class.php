<?php

/**
 * Integre form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class IntegreForm extends BaseIntegreForm
{
  public function configure()
  {
	$this->embedRelations(array(
		'Specialiste' => array(
		'considerNewFormEmptyFields' => array(),
		'newFormLabel' => false,
		'formClassArgs' => array(array('ah_add_delete_checkbox' => false)),
		)));
  }
}
