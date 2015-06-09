<?php

/**
 * Circonscription filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCirconscriptionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'num_circonscription'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'libelle_circonscription' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'num_circonscription'     => new sfValidatorPass(array('required' => false)),
      'libelle_circonscription' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('circonscription_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Circonscription';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'num_circonscription'     => 'Text',
      'libelle_circonscription' => 'Text',
    );
  }
}
