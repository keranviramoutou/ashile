<?php

/**
 * Classe filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseClasseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typeetablissement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissement'), 'add_empty' => true)),
      'typeclasse_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeClasse'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'typeetablissement_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeetablissement'), 'column' => 'id')),
      'typeclasse_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeClasse'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('classe_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Classe';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'typeetablissement_id' => 'ForeignKey',
      'typeclasse_id'        => 'ForeignKey',
    );
  }
}
