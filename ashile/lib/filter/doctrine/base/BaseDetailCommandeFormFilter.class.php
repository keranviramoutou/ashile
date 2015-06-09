<?php

/**
 * DetailCommande filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseDetailCommandeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'typemateriel_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemateriel'), 'add_empty' => true)),
      'commande_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'), 'add_empty' => true)),
      'specification'   => new sfWidgetFormFilterInput(),
      'quantite'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'datelivraison'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'typemateriel_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Typemateriel'), 'column' => 'id')),
      'commande_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Commande'), 'column' => 'id')),
      'specification'   => new sfValidatorPass(array('required' => false)),
      'quantite'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datelivraison'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('detail_commande_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetailCommande';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'typemateriel_id' => 'ForeignKey',
      'commande_id'     => 'ForeignKey',
      'specification'   => 'Text',
      'quantite'        => 'Number',
      'datelivraison'   => 'Date',
    );
  }
}
