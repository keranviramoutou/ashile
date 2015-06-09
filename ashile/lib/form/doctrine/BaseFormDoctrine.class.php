<?php

/**
 * Project form base class.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends ahBaseFormDoctrine  /*sfFormDoctrine*/
{
	public function setup()
  {
	sfValidatorBase::setDefaultMessage('required', 'Ce champs ne peut être vide.');
    	sfValidatorBase::setDefaultMessage('invalid', 'Ce champs n\'est pas valide.');
  }

}
