<?php

/**
 * Tuteur filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTuteurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tuteurlegal'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'typeresponsableeleve_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TypeResponsableEleve'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'tuteurlegal'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'typeresponsableeleve_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TypeResponsableEleve'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tuteur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tuteur';
  }

  public function getFields()
  {
    return array(
      'eleve_id'                => 'Number',
      'responsableeleve_id'     => 'Number',
      'tuteurlegal'             => 'Boolean',
      'typeresponsableeleve_id' => 'ForeignKey',
    );
  }
}
