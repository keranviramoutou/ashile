<?php

/**
 * Fournisseur filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFournisseurFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nomfournisseur'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'faxfournisseur'        => new sfWidgetFormFilterInput(),
      'telfournisseur'        => new sfWidgetFormFilterInput(),
      'adressefournisseurbat' => new sfWidgetFormFilterInput(),
      'adressefournisseurrue' => new sfWidgetFormFilterInput(),
      'codepostalfournisseur' => new sfWidgetFormFilterInput(),
      'villefournisseur'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nomfournisseur'        => new sfValidatorPass(array('required' => false)),
      'faxfournisseur'        => new sfValidatorPass(array('required' => false)),
      'telfournisseur'        => new sfValidatorPass(array('required' => false)),
      'adressefournisseurbat' => new sfValidatorPass(array('required' => false)),
      'adressefournisseurrue' => new sfValidatorPass(array('required' => false)),
      'codepostalfournisseur' => new sfValidatorPass(array('required' => false)),
      'villefournisseur'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('fournisseur_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fournisseur';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'nomfournisseur'        => 'Text',
      'faxfournisseur'        => 'Text',
      'telfournisseur'        => 'Text',
      'adressefournisseurbat' => 'Text',
      'adressefournisseurrue' => 'Text',
      'codepostalfournisseur' => 'Text',
      'villefournisseur'      => 'Text',
    );
  }
}
