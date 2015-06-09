<?php

/**
 * TypeResponsableEleve filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTypeResponsableEleveFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'denomination' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'denomination' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('type_responsable_eleve_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TypeResponsableEleve';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'denomination' => 'Text',
    );
  }
}
