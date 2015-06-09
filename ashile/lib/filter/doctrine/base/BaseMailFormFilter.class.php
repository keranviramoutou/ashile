<?php

/**
 * Mail filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'eleve_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Eleve'), 'add_empty' => true)),
      'sfGuardUser_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'sujet'          => new sfWidgetFormFilterInput(),
      'texte'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'eleve_id'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Eleve'), 'column' => 'id')),
      'sfGuardUser_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'sujet'          => new sfValidatorPass(array('required' => false)),
      'texte'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('mail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Mail';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'eleve_id'       => 'ForeignKey',
      'sfGuardUser_id' => 'Number',
      'date'           => 'Date',
      'sujet'          => 'Text',
      'texte'          => 'Text',
    );
  }
}
