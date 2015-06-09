<?php

/**
 * Niveauscolairespe filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNiveauscolairespeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
  
      'LibelleNiveauScolaire' => new sfWidgetFormFilterInput(),

    ));

    $this->setValidators(array(

      'LibelleNiveauScolaire' => new sfValidatorPass(array('required' => false)),

    ));

    $this->widgetSchema->setNameFormat('niveauscolairespe_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Niveauscolairespe';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
       'LibelleNiveauScolaire' => 'Text',
    );
  }
}
