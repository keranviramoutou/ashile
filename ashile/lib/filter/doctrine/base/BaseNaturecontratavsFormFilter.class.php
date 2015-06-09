<?php

/**
 * Naturecontratavs filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNaturecontratavsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'naturecontrat'        => new sfWidgetFormFilterInput(),
      'nouvnomnaturecontrat' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'naturecontrat'        => new sfValidatorPass(array('required' => false)),
      'nouvnomnaturecontrat' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('naturecontratavs_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Naturecontratavs';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'naturecontrat'        => 'Text',
      'nouvnomnaturecontrat' => 'Text',
    );
  }
}
