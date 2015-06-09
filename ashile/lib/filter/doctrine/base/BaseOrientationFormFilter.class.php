<?php

/**
 * Orientation filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseOrientationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'niveaudgesco_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('NiveauDgesco'), 'add_empty' => true)),
      'niveauscolaire_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Niveauscolaire'), 'add_empty' => true)),
      'libelleclasse'     => new sfWidgetFormFilterInput(),
      'demijournee_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Demijournee'), 'add_empty' => true)),
      'eleve_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'classe_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Classe'), 'add_empty' => true)),
      'inclusion_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Inclusion'), 'add_empty' => true)),
      'enseignant_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Enseignant'), 'add_empty' => true)),
	  'rased_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rased'), 'add_empty' => true)),
	  'rased2_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Rased'), 'add_empty' => true)),
      'etabsco_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Etabsco'), 'add_empty' => true)),
      'datedebut'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'datefin'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'niveaudgesco_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('NiveauDgesco'), 'column' => 'id')),
      'niveauscolaire_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Niveauscolaire'), 'column' => 'id')),
      'libelleclasse'     => new sfValidatorPass(array('required' => false)),
      'demijournee_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Demijournee'), 'column' => 'id')),
      'eleve_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Eleve'), 'column' => 'id')),
      'classe_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Classe'), 'column' => 'id')),
      'inclusion_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Inclusion'), 'column' => 'id')),
      'enseignant_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Enseignant'), 'column' => 'id')),
	  'rased_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rased'), 'column' => 'id')),
	  'rased2_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Rased'), 'column' => 'id')),
      'etabsco_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Etabsco'), 'column' => 'id')),
      'datedebut'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'datefin'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('orientation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Orientation';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'niveaudgesco_id'   => 'ForeignKey',
      'niveauscolaire_id' => 'ForeignKey',
      'libelleclasse'     => 'Text',
      'demijournee_id'    => 'ForeignKey',
      'eleve_id'          => 'ForeignKey',
      'classe_id'         => 'ForeignKey',
      'inclusion_id'      => 'ForeignKey',
      'enseignant_id'     => 'ForeignKey',
      'etabsco_id'        => 'ForeignKey',
      'datedebut'         => 'Date',
      'datefin'           => 'Date',
    );
  }
}
