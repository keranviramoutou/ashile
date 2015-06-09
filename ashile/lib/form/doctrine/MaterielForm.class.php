<?php

/**
 * Materiel form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class MaterielForm extends BaseMaterielForm
{
  public function configure()
  {
        $this->widgetSchema['numeromateriel'] = new sfWidgetFormInputText(array(), array("style"=>'width: 200px;'));
	    $this->widgetSchema['libellemateriel'] = new sfWidgetFormInputText(array(), array("style"=>'width: 300px;'));
		$this->widgetSchema['prixachat'] = new sfWidgetFormInputText(array(), array("style"=>'width: 55px;'));
		$this->widgetSchema['dateachat'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	    $this->validatorSchema['dateachat'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
	      if (sfContext::getInstance()->getActionName() == 'edit' || sfContext::getInstance()->getActionName() == 'update' || sfContext::getInstance()->getActionName() == 'miseAjour' ){
			
		
			$this->setWidget('marque_id', new sfWidgetFormInputHidden());	
			$this->setWidget('typemateriel_id', new sfWidgetFormInputHidden());
			
			$this->setValidator('marque_id', new sfValidatorString());
			$this->setValidator('typemateriel_id', new sfValidatorString());
			
			//$this->setWidget('materiel_id', new sfWidgetFormInputHidden());
			//$this->setValidator('materiel_id', new sfValidatorString());
		 }	

			 $this->validatorSchema->setOption('allow_extra_fields', true);
     
		 if($this->isNew()){           
			// widget pour le nombre d'enregistrement de materiels
			 $this->widgetSchema['nbmateriel'] = new sfWidgetFormInput(array('default' => 1),array("style"=>'width: 10px;'));
		 }else{
			 $this->widgetSchema['nbmateriel'] = new sfWidgetFormInputHidden(array('default' => 1),array("style"=>'width: 10px;'));
		 }

			 $this->setValidator('nbmateriel', new sfValidatorNumber());

/*
		if(!$this->isNew() && $this->getObject()->getNumeromateriel() !==''){
		// --------- insertion des mouvements materiels -----------------------------------------
		//---------------------------------------------------------------------------------------
			$newMouvementsMateriel = new MouvementMateriel();
			$newMouvementsMateriel->setMateriel($this->getObject());
			$newMouvementsMaterielForm = new MouvementMaterielForm($newMouvementsMateriel);
			$this->embedForm('newMouvementMateriel', $newMouvementsMaterielForm);
		}
        //---------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------
	
  */     



 //$this->embedForm('mouvementmateriel', new MouvementMaterielForm($this->getObject()->getMouvementMateriels()));
    }


	
}
