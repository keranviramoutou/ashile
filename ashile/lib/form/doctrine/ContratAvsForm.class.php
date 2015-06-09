<?php

/**
 * ContratAvs form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ContratAvsForm extends BaseContratAvsForm
{
  public function configure()
  {

  
    

    $this->widgetSchema['temps_hebdo'] = new sfWidgetFormInputText(array(), array("style"=>'width: 40px;'));
	
  
	// on definit l'avs pour ne pas avoir à l'afficher
	$this->setWidget('avs_id', new sfWidgetFormInputHidden());
	$this->setValidator('avs_id', new sfValidatorString());
	
	/* -------  if edit  ------------
 	$this->setWidget('etabsco_id', new sfWidgetFormInputHidden());
	$this->setValidator('etabsco_id', new sfValidatorString());
    */    
	
	$this->validatorSchema['temps_hebdo']=  new sfValidatorNumber(array('required' => true ),array( 'required' => 'saisie obligatoire'));
		
	//$this->widgetSchema['date_debut_contrat'] = new sfWidgetFormJQueryDate1(array('image' => '/ashile/images/calendar_icon.png','culture' => 'fr','date_widget' => $dateWidget));
	$this->widgetSchema['date_debut_contrat'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	$this->validatorSchema['date_debut_contrat'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));	
	
	//$this->widgetSchema['date_fin_contrat'] = new sfWidgetFormJQueryDate(array('image' => '/ashile/images/calendar.png','culture' => 'fr','date_widget' => $dateWidget));
	$this->widgetSchema['date_fin_contrat'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	$this->validatorSchema['date_fin_contrat'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));
	$this->tabErreurDefaut['date_fin_contrat'] = "eee";
  	$this->tabErreur['date_fin_contrat'] = "";
				 
	$this->widgetSchema['date_fin_projete'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['date_fin_projete'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));			 
		$this->tabErreur['date_fin_projete'] = "";

  
  		//Affichage des type de contrat avec Affichage  à TRUE
		//----------------------------------------------------------------------------------------------------
			$query1 = Doctrine_Query::create()
			->select('*')
						->from('TypeContratAvs t')
						->where('t.affichage = ?', 1)
					    ->orderby ('t.typecontrat ASC');
						
		$this->widgetSchema['typecontratavs_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('TypeContratAvs'),
					'query' => $query1,
                    'add_empty' => '',
                ));

	
	
	    $query = Doctrine::getTable('Etabsco')->getEtabscoBySecteur();

        $this->widgetSchema['etabsco_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Etabsco',
                    'query' => $query,
                    'add_empty' => 'Choisissez...',
                ));
				 
		//if(!$this->isNew()){
		// --------- insertion des positions avs -----------------------------------------
		//---------------------------------------------------------------------------------------
		//	$newPositionAvs = new PositionAvs();
		//	$newPositionAvs->setContratAvs($this->object);
		//	$newPositionAvsForm = new PositionAvsForm($newPositionAvs);
			
		//	$this->embedForm('newPositionAvs', $newPositionAvsForm);
		//}
        //---------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------
       }

}
