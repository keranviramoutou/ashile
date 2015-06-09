<?php

/**
 * SecteurEtabsco form base class.
 *
 * @method SecteurEtabsco getObject() Returns the current form's model object
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSecteurEtabscoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'etabsco_id' => new sfWidgetFormInputHidden(),
      'secteur_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'etabsco_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('etabsco_id')), 'empty_value' => $this->getObject()->get('etabsco_id'), 'required' => false)),
      'secteur_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('secteur_id')), 'empty_value' => $this->getObject()->get('secteur_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('secteur_etabsco[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SecteurEtabsco';
  }

}
