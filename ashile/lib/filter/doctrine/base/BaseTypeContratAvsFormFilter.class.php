<?php

/**
 * TypeContratAvs filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypeContratAvsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
	 'affichage'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'typecontrat' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'affichage'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'typecontrat' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('type_contrat_avs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TypeContratAvs';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'typecontrat' => 'Text',
	   'affichage'  => 'Boolean',
    );
  }
}
