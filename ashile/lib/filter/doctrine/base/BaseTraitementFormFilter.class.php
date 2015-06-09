<?php
/**
 * Typematerield filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTraitementFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelletraitement' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'libelletraitement' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('traitement[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'traitement';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'libelletraitement' => 'Text',
    );
  }
}