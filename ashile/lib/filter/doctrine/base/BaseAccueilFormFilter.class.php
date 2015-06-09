<?php

/**
 * Accueil filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAccueilFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'type' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('accueil_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Accueil';
  }

  public function getFields()
  {
    return array(
      'id'   => 'Number',
      'type' => 'Text',
    );
  }
}
