<?php

/**
 * Eleve filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEleveFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'quartier_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'add_empty' => true)),
      'secteur_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Secteur'), 'add_empty' => true)),
	  'pps_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pps'), 'add_empty' => true)),
      'ine'             => new sfWidgetFormFilterInput(),
      'numeromdph'      => new sfWidgetFormFilterInput(),
      'nom'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datenaissance'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'adresseelevebat' => new sfWidgetFormFilterInput(),
      'adresseleverue'  => new sfWidgetFormFilterInput(),
      'notes'           => new sfWidgetFormFilterInput(),
      'sexe'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datesortie'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'motif'           => new sfWidgetFormFilterInput(),
      'etat_acc'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
	  'etat_mat'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'quartier_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Quartier'), 'column' => 'id')),
      'secteur_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Secteur'), 'column' => 'id')),
	  'pps_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Secteur'), 'column' => 'id')),
      'ine'             => new sfValidatorPass(array('required' => false)),
      'numeromdph'      => new sfValidatorPass(array('required' => false)),
      'nom'             => new sfValidatorPass(array('required' => false)),
      'prenom'          => new sfValidatorPass(array('required' => false)),
      'datenaissance'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'adresseelevebat' => new sfValidatorPass(array('required' => false)),
      'adresseleverue'  => new sfValidatorPass(array('required' => false)),
      'notes'           => new sfValidatorPass(array('required' => false)),
      'sexe'            => new sfValidatorPass(array('required' => false)),
      'datesortie'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'motif'           => new sfValidatorPass(array('required' => false)),
      'etat_acc'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'etat_mat'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),   
   ));

    $this->widgetSchema->setNameFormat('eleve_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Eleve';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'quartier_id'     => 'ForeignKey',
      'secteur_id'      => 'ForeignKey',
      'pps_id'          => 'ForeignKey',
      'ine'             => 'Text',
      'numeromdph'      => 'Text',
      'nom'             => 'Text',
      'prenom'          => 'Text',
      'datenaissance'   => 'Date',
      'adresseelevebat' => 'Text',
      'adresseleverue'  => 'Text',
      'notes'           => 'Text',
      'sexe'            => 'Text',
      'datesortie'      => 'Date',
      'motif'           => 'Text',
      'etat_acc'        => 'Date',
	  'etat_mat'        => 'Date',
    );
  }
}
