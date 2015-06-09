<?php

/**
 * Commande form base class.
 *
 * @method Commande getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCommandeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'fournisseur_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('fournisseur'), 'add_empty' => false)),
      'date_commande'  => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'fournisseur_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('fournisseur'))),
      'date_commande'  => new sfValidatorDate(),
    ));

    $this->widgetSchema->setNameFormat('commande[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Commande';
  }

}
