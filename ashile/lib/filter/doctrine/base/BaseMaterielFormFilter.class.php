<?php

/**
 * Materiel filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMaterielFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'marque_id'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Marque'), 'add_empty' => true)),
      'typemateriel_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemateriel'), 'add_empty' => true)),
      'catmateriel_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Catmateriel'), 'add_empty' => true)),
      'libellemateriel'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prixachat'               => new sfWidgetFormFilterInput(),
      'fournisseur_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fournisseur'), 'add_empty' => true)),
      'caracteristiquemateriel' => new sfWidgetFormFilterInput(),
      'numeromateriel'          => new sfWidgetFormFilterInput(),
      'commentaire'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'marque_id'               => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Marque'), 'column' => 'id')),
      'typemateriel_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typemateriel'), 'column' => 'id')),
      'catmateriel_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Catmateriel'), 'column' => 'id')),
      'libellemateriel'         => new sfValidatorPass(array('required' => false)),
      'prixachat'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fournisseur_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fournisseur'), 'column' => 'id')),
      'caracteristiquemateriel' => new sfValidatorPass(array('required' => false)),
      'numeromateriel'          => new sfValidatorPass(array('required' => false)),
      'commentaire'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('materiel_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Materiel';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'marque_id'               => 'ForeignKey',
      'typemateriel_id'         => 'ForeignKey',
      'catmateriel_id'          => 'ForeignKey',
      'libellemateriel'         => 'Text',
      'prixachat'               => 'Number',
      'fournisseur_id'          => 'ForeignKey',
      'caracteristiquemateriel' => 'Text',
      'numeromateriel'          => 'Text',
      'commentaire'             => 'Text',
    );
  }
}
