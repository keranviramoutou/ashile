<?php

/**
 * Secteur filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSecteurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'sfguarduser_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfguarduser'), 'add_empty' => true)),
      'libellesecteur' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'sfguarduser_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfguarduser'), 'column' => 'id')),
      'libellesecteur' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('secteur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Secteur';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'sfguarduser_id' => 'ForeignKey',
      'libellesecteur' => 'Text',
    );
  }
}
