<?php

/**
 * Typematerieldemande filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypematerieldemandeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelletypemateriel' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'libelletypemateriel' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('typematerieldemande_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Typematerieldemande';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'libelletypemateriel' => 'Text',
    );
  }
}
