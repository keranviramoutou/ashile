<?php

/**
 * DetailCommande form base class.
 *
 * @method DetailCommande getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseDetailCommandeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'typemateriel_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typemateriel'), 'add_empty' => false)),
      'commande_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'), 'add_empty' => false)),
      'specification'   => new sfWidgetFormTextarea(),
      'quantite'        => new sfWidgetFormInputText(),
      'datelivraison'   => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'typemateriel_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typemateriel'))),
      'commande_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Commande'))),
      'specification'   => new sfValidatorString(array('required' => false)),
      'quantite'        => new sfValidatorInteger(),
      'datelivraison'   => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detail_commande[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetailCommande';
  }

}
