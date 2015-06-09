<?php

/**
 * Commande filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCommandeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fournisseur_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('fournisseur'), 'add_empty' => true)),
      'date_commande'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'fournisseur_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('fournisseur'), 'column' => 'id')),
      'date_commande'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('commande_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commande';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'fournisseur_id' => 'ForeignKey',
      'date_commande'  => 'Date',
    );
  }
}
