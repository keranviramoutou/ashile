<?php

/**
 * Personne filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePersonneFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'quartier_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'add_empty' => true)),
      'nom'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prenom'         => new sfWidgetFormFilterInput(),
      'nom_nais'       => new sfWidgetFormFilterInput(),
      'date_naissance' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'numen'          => new sfWidgetFormFilterInput(),
      'commentaire'    => new sfWidgetFormFilterInput(),
      'adressebat'     => new sfWidgetFormFilterInput(),
      'adresserue'     => new sfWidgetFormFilterInput(),
      'tel1'           => new sfWidgetFormFilterInput(),
      'tel2'           => new sfWidgetFormFilterInput(),
      'email'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'quartier_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Quartier'), 'column' => 'id')),
      'nom'            => new sfValidatorPass(array('required' => false)),
      'prenom'         => new sfValidatorPass(array('required' => false)),
      'nom_nais'       => new sfValidatorPass(array('required' => false)),
      'date_naissance' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'numen'          => new sfValidatorPass(array('required' => false)),
      'commentaire'    => new sfValidatorPass(array('required' => false)),
      'adressebat'     => new sfValidatorPass(array('required' => false)),
      'adresserue'     => new sfValidatorPass(array('required' => false)),
      'tel1'           => new sfValidatorPass(array('required' => false)),
      'tel2'           => new sfValidatorPass(array('required' => false)),
      'email'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('personne_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Personne';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'quartier_id'    => 'ForeignKey',
      'nom'            => 'Text',
      'prenom'         => 'Text',
      'nom_nais'       => 'Text',
      'date_naissance' => 'Date',
      'numen'          => 'Text',
      'commentaire'    => 'Text',
      'adressebat'     => 'Text',
      'adresserue'     => 'Text',
      'tel1'           => 'Text',
      'tel2'           => 'Text',
      'email'          => 'Text',
    );
  }
}
