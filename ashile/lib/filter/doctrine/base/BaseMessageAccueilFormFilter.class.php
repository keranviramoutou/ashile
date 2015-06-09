<?php

/**
 * MessageAccueil filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMessageAccueilFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contenu' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contenu' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('message_accueil_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MessageAccueil';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'contenu' => 'Text',
    );
  }
}
