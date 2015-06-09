<?php

/**
 * Etabsco form base class.
 *
 * @method Etabsco getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEtabscoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'circonscription_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Circonscription'), 'add_empty' => false)),
      'rne'                  => new sfWidgetFormInputText(),
	  'typeetablissement_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissement'), 'add_empty' => false)),
      'nometabsco'           => new sfWidgetFormInputText(),
      'degreetabsco'         => new sfWidgetFormInputText(),
      'adresseetabscobat'    => new sfWidgetFormInputText(),
      'adresseetabscorue'    => new sfWidgetFormInputText(),
	  'quartier_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'), 'add_empty' => false)),
      'telephoneetabsco'     => new sfWidgetFormInputText(),
      'faxetabsco'           => new sfWidgetFormInputText(),
      'emailetabsco'         => new sfWidgetFormInputText(),
      'etabref'              => new sfWidgetFormInputCheckbox(),
      'directeuretab_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DirecteurEtab'), 'add_empty' => true)),
      'inclusionetab_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EtabscoInclusion'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'quartier_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Quartier'))),
      'typeetablissement_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Typeetablissement'))),
      'circonscription_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Circonscription'))),
      'rne'                  => new sfValidatorString(array('max_length' => 8)),
      'nometabsco'           => new sfValidatorString(array('max_length' => 100)),
      'degreetabsco'         => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'adresseetabscobat'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'adresseetabscorue'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'telephoneetabsco'     => new sfValidatorRegex(array('max_length' => 10, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'faxetabsco'           => new sfValidatorRegex(array('max_length' => 10, 'pattern' => '/^([\s]*[0-9]+[\s]*)+$/', 'required' => false)),
      'emailetabsco'         => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'etabref'              => new sfValidatorBoolean(array('required' => false)),
      'directeuretab_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DirecteurEtab'), 'required' => false)),
      'inclusionetab_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EtabscoInclusion'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('etabsco[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Etabsco';
  }

}
