<?php

/**
 * Classespe filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClasseextFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'libelle_classe_ext' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'libelle_classe_ext' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('classespe_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Classeext';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'libelle_classe_ext' => 'Text',
    );
  }
}
