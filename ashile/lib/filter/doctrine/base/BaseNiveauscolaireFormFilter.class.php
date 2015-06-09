<?php

/**
 * Niveauscolaire filter form base class.
 *
 * @package    ash
 * @subpackage filter
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseNiveauscolaireFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
  
  		//Liste des types établissements
		//----------------------------------------
			$query1 = Doctrine_Query::create()
			->select( trim('nomtypeetablissement'))
			->from('Typeetablissement t') 
			->orderby('nomtypeetablissement')
			->execute();

      
	//$liste = implode(",",$res1Arrays);
		
 	//$liste=array("CLG" => "CLG","CLG PR" => "CLG PR","E.E.A." => "E.E.A.","E.E.I." => "E.E.I.","E.E.PR" => "E.E.PR","E.E.PU" => "E.E.PU","E.M.PU" => "E.M.PU","I.A. " => "I.A. ","IEN" => "IEN","LGT " => "LGT ","LGT PR" => "LGT PR","LP " => "LP ","LPO LYC" => 'LPO LYC','LPO PR' => 'LPO PR','RECTORAT' => 'RECTORAT','SEGPA' => 'SEGPA','ND' => 'ND' );
     $this->setWidgets(array(
      'nomniveauscolaire'     => new sfWidgetFormFilterInput(),
      'nomLongNiveauScolaire' => new sfWidgetFormFilterInput(),
	//  'degreetabsco' => new sfWidgetFormChoice(array('choices' => $query1)),
	   'degreetabsco' => new sfWidgetFormFilterInput(),



    ));




    $this->setValidators(array(
      'nomniveauscolaire'     => new sfValidatorPass(array('required' => false)),
      'nomLongNiveauScolaire' =>new sfValidatorPass(array('required' => false)),
      'degreetabsco' =>new sfValidatorPass(array('required' => false)),
	 
	

    ));

    $this->widgetSchema->setNameFormat('niveauscolaire_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Niveauscolaire';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'nomniveauscolaire'     => 'Text',
      'nomLongNiveauScolaire' => 'Text',
	  'degreetabsco' => 'Text',

	 
    );
  }
}
