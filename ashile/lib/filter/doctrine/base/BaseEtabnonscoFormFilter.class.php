<?php

/**
 * Etabnonsco filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEtabnonscoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'quartier_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'add_empty' => true)),
	  'typeetablissement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissementnonsco'), 'add_empty' => true)),
      'nometabnonsco'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'adresseetabnonscobat' => new sfWidgetFormFilterInput(),
      'adresseetabnonscorue' => new sfWidgetFormFilterInput(),
      'teletabnonsco'        => new sfWidgetFormFilterInput(),
      'faxetabnonsco'        => new sfWidgetFormFilterInput(),
      'emailetabnonsco'      => new sfWidgetFormFilterInput(),
	  'ordre'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'quartier_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Quartier'), 'column' => 'id')),
	   'typeetablissement_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeetablissementnonsco'), 'column' => 'id')),
      'nometabnonsco'        => new sfValidatorPass(array('required' => false)),
      'adresseetabnonscobat' => new sfValidatorPass(array('required' => false)),
      'adresseetabnonscorue' => new sfValidatorPass(array('required' => false)),
      'teletabnonsco'        => new sfValidatorPass(array('required' => false)),
      'faxetabnonsco'        => new sfValidatorPass(array('required' => false)),
      'emailetabnonsco'      => new sfValidatorPass(array('required' => false)),
      'ordre'                => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('etabnonsco_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Etabnonsco';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'quartier_id'          => 'ForeignKey',
      'nometabnonsco'        => 'Text',
      'adresseetabnonscobat' => 'Text',
      'adresseetabnonscorue' => 'Text',
      'teletabnonsco'        => 'Text',
      'faxetabnonsco'        => 'Text',
      'emailetabnonsco'      => 'Text',
    );
  }
}
