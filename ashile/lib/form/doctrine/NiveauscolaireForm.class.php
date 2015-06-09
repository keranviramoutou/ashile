<?php

/**
 * Niveauscolaire form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class NiveauscolaireForm extends BaseNiveauscolaireForm
{
  public function configure()
  {
  
    $this->widgetSchema['nomLongNiveauScolaire'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
	$this->widgetSchema['ordre'] = new sfWidgetFormInputText(array(), array("style"=>'width: 80px;'));
	


        // Recuperation des lignes dans les tables
       // $res1s = Doctrine_core::getTable('Typeetablissement')->findAll();
       
        // Mettre le type dans un tableau $id => $libelle
        //instanciation des variables tableau
        //$res1Arrays = array();
		 //   $i = 0;
         //foreach ($res1s as $res1) {
            $res1Arrays[++$i] = '"'.$res1->getNomtypeetablissement().'" => "'.$res1->getNomtypeetablissement().'"';
             
        //}

		  //Liste des types établissements
		//----------------------------------------
			$liste = Doctrine_Query::create()
			->select('nomtypeetablissement')
			->from('Typeetablissement t') 
			->orderby('nomtypeetablissement')
			->execute();
  
    
//	$liste = implode(",",$res1Arrays);
		
//	$liste=array("CLG" => "CLG","CLG PR" => "CLG PR","E.E.A." => "E.E.A.","E.E.I." => "E.E.I.","E.E.PR" => "E.E.PR","E.E.PU" => "E.E.PU","E.M.PU" => "E.M.PU","I.A. " => "I.A. ","IEN" => "IEN","LGT " => "LGT ","LGT PR" => "LGT PR","LP " => "LP ","LPO LYC" => 'LPO LYC','LPO PR' => 'LPO PR','RECTORAT' => 'RECTORAT','SEGPA' => 'SEGPA','ND' => 'ND' );

    $this->widgetSchema['degreetabsco'] =  new sfWidgetFormChoice(array('choices' => $liste));   

	$this->widgetSchema->setLabels(array(

    "ordre"		=>	"Ordre de tri",
	"nomniveauscolaire"		=>	"Libellé",
	"nomLongNiveauScolaire" 	=>	"Libellé Long",
					));	
					
					
  }
}
