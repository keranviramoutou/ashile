<?php

/**
 * NatureSuivitExterne filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNatureSuivitExterneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libellenaturesuivitext' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'libellenaturesuivitext' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('nature_suivit_externe_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'NatureSuivitExterne';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'libellenaturesuivitext' => 'Text',
    );
  }
}
