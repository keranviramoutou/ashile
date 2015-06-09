<?php

/**
 * DemandeMateriel form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DemandeMaterielForm extends BaseDemandeMaterielForm
{

    public function configure()
    {
		$this->widgetSchema['datedebutnotif'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
		$this->widgetSchema['datedebutnotif'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['datedebutnotif'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false)); 
		
		
        $this->widgetSchema['datefinnotif'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
		$this->widgetSchema['datefinnotif'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['datefinnotif'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false)); 
				         
        $this->widgetSchema['datedecisioncda'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
		$this->widgetSchema['datedecisioncda'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['datedecisioncda'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false)); 
				         
        $this->widgetSchema['date_demande_materiel'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
		$this->widgetSchema['date_demande_materiel'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['date_demande_materiel'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false)); 
				 
		$this->widgetSchema['typemateriel_id'] = new sfWidgetFormDoctrineChoice(array(
		   'model' => $this->getRelatedModelName('Typemateriel'),
		  // 'query' => $query1,
			'add_empty'=>'',
			'order_by' => array('libelletypemateriel', 'asc'),
		)); 
		$this->widgetSchema['catmateriel_id'] = new sfWidgetFormDoctrineChoice(array(
		   'model' => $this->getRelatedModelName('Catmateriel'),
		  // 'query' => $query1,
			'add_empty'=>'',
			'order_by' => array('libellecatmateriel', 'asc'),
		)); 
				         
        $this->setWidget('mdph_id', new sfWidgetFormInputHidden());
        $this->setValidator('mdph_id', new sfValidatorString());
		
			// --- pour palier aux erreurs à l'enregistrement on crée un champ _csrf_token qui ne s'affiche pas -------
			//afficher le champs dans le _form.php
		
			$this->setWidget('_csrf_token', new sfWidgetFormInputHidden());
			$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputText(array(), array("style"=>'width: 0px;'));
			$this->setValidator('_csrf_token' , new sfValidatorString());
			
			// --------------------------------------------------------------------------------------------------------	
	/*	        $this->validatorSchema['materiel_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => false,
                    'model' => $this->getRelatedModelName('Materiel'),
                    'column' => 'id',
					
                ));	*/
		 if(sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend')
        {
		// on enlève la réf à matériel Id qui est connue
		//----------------------------------------------
			 $this->setWidget('materiel_id', new sfWidgetFormInputHidden());
	    }
		 if(sfContext::getInstance()->getConfiguration()->getApplication() == 'academie')
        {
			$this->widgetSchema['materiel_id'] = new sfWidgetFormInputText(array(), array("style"=>'width: 70px;'));		
		}

    }

}

