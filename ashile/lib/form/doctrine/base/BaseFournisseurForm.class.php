<?php

/**
 * Fournisseur form base class.
 *
 * @method Fournisseur getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFournisseurForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'nomfournisseur'        => new sfWidgetFormInputText(),
      'faxfournisseur'        => new sfWidgetFormInputText(),
      'telfournisseur'        => new sfWidgetFormInputText(),
      'adressefournisseurbat' => new sfWidgetFormInputText(),
      'adressefournisseurrue' => new sfWidgetFormInputText(),
      'codepostalfournisseur' => new sfWidgetFormInputText(),
      'villefournisseur'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'nomfournisseur'        => new sfValidatorString(array('max_length' => 100)),
      'faxfournisseur'        => new sfValidatorRegex(array('max_length' => 15, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'telfournisseur'        => new sfValidatorRegex(array('max_length' => 15, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'adressefournisseurbat' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'adressefournisseurrue' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'codepostalfournisseur' => new sfValidatorRegex(array('max_length' => 30, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'villefournisseur'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fournisseur[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fournisseur';
  }

}
