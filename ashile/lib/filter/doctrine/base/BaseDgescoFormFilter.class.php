<?php

/**
 * Dgesco filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDgescoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eleve_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'anneescolaire_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Anneescolaire'), 'add_empty' => true)),
      'reponse_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Reponse'), 'add_empty' => true)),
      'question_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Question'), 'add_empty' => true)),
      'libelle_reponse'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'eleve_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Eleve'), 'column' => 'id')),
      'anneescolaire_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Anneescolaire'), 'column' => 'id')),
      'reponse_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Reponse'), 'column' => 'id')),
      'question_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Question'), 'column' => 'id')),
      'libelle_reponse'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('dgesco_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Dgesco';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'eleve_id'         => 'ForeignKey',
      'anneescolaire_id' => 'ForeignKey',
      'reponse_id'       => 'ForeignKey',
      'question_id'      => 'ForeignKey',
      'libelle_reponse'   => 'Text',
    );
  }
}
