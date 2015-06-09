<?php

/**
 * Reponse filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseReponseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'reponse'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'libelle_reponse' => new sfWidgetFormFilterInput(),
	  'degreetabsco  ' => new sfWidgetFormFilterInput(),
      'question_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Question'), 'add_empty' => true)),
      'algorithm'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'reponse'         => new sfValidatorPass(array('required' => false)),
      'libelle_reponse' => new sfValidatorPass(array('required' => false)),
	  'degreetabsco'    => new sfValidatorPass(array('required' => false)),
      'question_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Question'), 'column' => 'id')),
      'algorithm'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('reponse_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Reponse';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'reponse'         => 'Text',
      'libelle_reponse' => 'Text',
      'question_id'     => 'ForeignKey',
      'algorithm'       => 'Text',
    );
  }
}
