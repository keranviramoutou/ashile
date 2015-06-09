<?php

/**
 * PiecesDossier filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePiecesDossierFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'mdph_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Mdph'), 'add_empty' => true)),
      'libellepiece' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'restitue'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'mdph_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Mdph'), 'column' => 'id')),
      'libellepiece' => new sfValidatorPass(array('required' => false)),
      'restitue'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('pieces_dossier_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PiecesDossier';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'mdph_id'      => 'ForeignKey',
      'libellepiece' => 'Text',
      'restitue'     => 'Boolean',
    );
  }
}
