<?php

/**
 * Sessad filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSessadFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'etabnonsco_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabnonsco'), 'add_empty' => true)),
      'typesessad_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typesessad'), 'add_empty' => true)),
	  'ordre'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'etabnonsco_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etabnonsco'), 'column' => 'id')),
      'typesessad_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typesessad'), 'column' => 'id')),
	  'ordre'         => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('sessad_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sessad';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'etabnonsco_id' => 'ForeignKey',
      'typesessad_id' => 'ForeignKey',
    );
  }
}
