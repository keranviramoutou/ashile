<?php

/**
 * Etabsco filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEtabscoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'quartier_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'add_empty' => true)),
      'typeetablissement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissement'), 'add_empty' => true)),
      'circonscription_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Circonscription'), 'add_empty' => true)),
      'rne'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nometabsco'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'degreetabsco'         => new sfWidgetFormFilterInput(),
      'adresseetabscobat'    => new sfWidgetFormFilterInput(),
      'adresseetabscorue'    => new sfWidgetFormFilterInput(),
      'telephoneetabsco'     => new sfWidgetFormFilterInput(),
      'faxetabsco'           => new sfWidgetFormFilterInput(),
      'emailetabsco'         => new sfWidgetFormFilterInput(),
      'etabref'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'directeuretab_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DirecteurEtab'), 'add_empty' => true)),
      'inclusionetab_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EtabscoInclusion'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'quartier_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Quartier'), 'column' => 'id')),
      'typeetablissement_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typeetablissement'), 'column' => 'id')),
      'circonscription_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Circonscription'), 'column' => 'id')),
      'rne'                  => new sfValidatorPass(array('required' => false)),
      'nometabsco'           => new sfValidatorPass(array('required' => false)),
      'degreetabsco'         => new sfValidatorPass(array('required' => false)),
      'adresseetabscobat'    => new sfValidatorPass(array('required' => false)),
      'adresseetabscorue'    => new sfValidatorPass(array('required' => false)),
      'telephoneetabsco'     => new sfValidatorPass(array('required' => false)),
      'faxetabsco'           => new sfValidatorPass(array('required' => false)),
      'emailetabsco'         => new sfValidatorPass(array('required' => false)),
      'etabref'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'directeuretab_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DirecteurEtab'), 'column' => 'id')),
      'inclusionetab_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EtabscoInclusion'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('etabsco_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Etabsco';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'quartier_id'          => 'ForeignKey',
      'typeetablissement_id' => 'ForeignKey',
      'circonscription_id'   => 'ForeignKey',
      'rne'                  => 'Text',
      'nometabsco'           => 'Text',
      'degreetabsco'         => 'Text',
      'adresseetabscobat'    => 'Text',
      'adresseetabscorue'    => 'Text',
      'telephoneetabsco'     => 'Text',
      'faxetabsco'           => 'Text',
      'emailetabsco'         => 'Text',
      'etabref'              => 'Boolean',
      'directeuretab_id'     => 'ForeignKey',
      'inclusionetab_id'     => 'ForeignKey',
    );
  }
}
