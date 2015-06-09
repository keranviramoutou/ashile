<?php

/**
 * EleveMateriel form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EleveMaterielForm extends BaseEleveMaterielForm
{

    public function configure()
    {
  
		
		
        $this->widgetSchema['dateconvention'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['dateconvention'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));	

        $this->widgetSchema['datedebut'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['datedebut'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));           

        $this->widgetSchema['datefin'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['datefin'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));

    
        $this->widgetSchema['dateremiseerf'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['dateremiseerf'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));           

        $this->widgetSchema['dateremiseparent'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['dateremiseparent'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
        $this->widgetSchema['autorisationparent'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
        $this->validatorSchema['autorisationparent'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
					 
		$this->widgetSchema['numero_convention'] = new sfWidgetFormInputText(array(), array("style"=>'width: 55px;'));
	
    // liste des materiels disponibles (dernier enregistrement -> EN STOCK)
   // --- une première selection des mouvement_materiel MAX avec date de fin > date du jour ------
   //---------------------------------------------------------------------------------------------
     
	

	// Recuperation de type materiel depuis le controleur à partir du matériel selectionné, new
		//-----------------------------------------------------------------------------------------
		 if ($this->getObject()->getMaterielId()) {     	
	

		//Dernière demande matériel en cours à la date du jour pour l'élève selectionné à l'état A ATTRIBUER
		//----------------------------------------------------------------------------------------------------
			$query1 = Doctrine_Query::create()
			->select('*')
						->from('Eleve e')
                        ->leftJoin('e.Mdphs m ON e.id = m.eleve_id')
						->leftJoin('m.DemandeMateriels d  ')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->leftJoin('d.Traitement ty ON ty.id = d.traitement_id')
						->where('ty.libelletraitement LIKE "%ATTRIBUER%"')
						->andwhere('d.datedecisioncda IS NOT NULL')
						->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))						
					//	->groupby ('d.id');
					    ->orderby ('e.nom,e.prenom ASC');
				$count_dem_mat = count($dem_mat);

		}
               
	// --------------------------------------------------------------------------------------------------

	// --------------------------------------------------------------------------------------------------

	
       	 // Recuperation de type materiel depuis le controleur à partir de la demande dematériel de l'élève selectionné, new
		//-------------------------------------------------------------------------------------------------------------------
		
		 if ($this->getObject()->getEleveId()) {     	
			$demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->getDemandeMatSelectionner($this->getvalue('typemateriel_id'));
			$existdemande_materiel = count($demande_materiel);
            $query = $this->getOption('query');
				
			// selection du matériel immatriculée en STOCK  aujourd'hui
		   //-----------------------------------------------------------	
			/*$query = Doctrine_Query::create()
					 ->select ('m.id as id, q.libellemarque as marque,s.datefin as datefin, f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as nom, m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel, m.caracteristiquemateriel as caracteristiqueMateriel,
					 m.numeromateriel as numeroMateriel, m.commentaire as commentaire')
					->from('Materiel m')
					->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
					->leftjoin('m.Marque q ON  q.id =  m.marque_id')
					->leftJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
					->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
					//->where('m.typemateriel_id=?', $demande_materiel[0]['typemateriel_id'] )
					->andwhere('f.nommouvement LIKE "%STOCK%"')
					->andWhere('m.numeromateriel IS NOT NULL')
					->andwhere ('s.datefin IS  NULL'); */
		}	   

	

        $this->widgetSchema['materiel_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('Materiel'),
					'query' => $query,
                    'add_empty' => 'Selectionner le matériel en stock à la date du jour:',
                ));
        // et son validateur

        $this->validatorSchema['materiel_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => true,
                    'model' => $this->getRelatedModelName('Materiel'),
                    'column' => 'id',
                ));
				
       $this->widgetSchema['eleve_id'] = new sfWidgetFormDoctrineChoice(array(
                   'model' => $this->getRelatedModelName('Eleve'),
                   //'query' => $query1,
					//'table_method' => array('method' => 'getEleveAvecCDA', 'type' =>1),
					//'method' => 'getEleveCda', //method définie dans eleve.class.php retourne les champs affichés dans le select
                    'add_empty' => 'Selectionner l\'élève avec une notification valide :',
                )); 
				
				
	// champ eleve_id qui est en autocomplete			
 	//sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
  	//$this->widgetSchema['eleve_id']->setOption('renderer_class', 'sfWidgetFormDoctrineJQueryAutocompleter');
    //$this->widgetSchema['eleve_id'] = new sfWidgetFormDoctrineJQueryAutocompleter(
    //array(
    //    'model' => 'Eleve',
    //    'url'   => url_for('@ajax_materiel')
    //  ), array('size' => 40)
    //);	
        // et son validateur

		

/*$this->widgetSchema['eleve_id'] = new  sfWidgetFormDoctrineChoice(Array(
  										'model'=>'Eleve',
  										'renderer_class'=>'sfWidgetFormDoctrineJQueryAutocompleter',
  										'renderer_options'=>(array(
  													'model'=>'Eleve',
  													'url'=>'eleve_materiel/ajaxMateriel'))));*/
		
		
        $this->validatorSchema['eleve_id'] = new sfValidatorDoctrineChoice(array(
                    'required' => true,
                    'model' => $this->getRelatedModelName('Eleve'),
                    'column' => 'id',
                ));
      
  

		if(sfContext::getInstance()->getActionName() == 'edit' || sfContext::getInstance()->getActionName() == 'update')
		{
		// on enlève la réf à matériel Id qui est connue
		//----------------------------------------------
		$this->setWidget('eleve_id', new sfWidgetFormInputHidden());
		$this->setValidator('eleve_id', new sfValidatorString());
		
		
		 // on enlève la réf à matériel Id qui est connue
		 //---------------------------------------------
		$this->setWidget('materiel_id', new sfWidgetFormInputHidden());
		$this->setValidator('materiel_id', new sfValidatorString());  
		}
		if ($this->getObject()->getEleveId())  //test si l'eleve_id existe  cacher le champs a ne pas renseigné
		{
        if(sfContext::getInstance()->getActionName() == 'new'  || sfContext::getInstance()->getActionName() == 'create' )  
		{
       
        //on enlève la réf à l'élève qui est connue
		//----------------------------------------------
		$this->setWidget('eleve_id', new sfWidgetFormInputHidden());
		$this->setValidator('eleve_id', new sfValidatorString());
		
		// on enlève la réf à matériel Id qui est connue
		 //---------------------------------------------
		$this->setWidget('materiel_id', new sfWidgetFormInputHidden());
		$this->setValidator('materiel_id', new sfValidatorString());  
        
		}
		}else{
	     if(sfContext::getInstance()->getActionName() == 'new'   ||  sfContext::getInstance()->getActionName() == 'create' )  
		{
       
        //on enlève la réf au matériel qui est connue
		//----------------------------------------------
		$this->setWidget('materiel_id', new sfWidgetFormInputHidden());
		$this->setValidator('materiel_id', new sfValidatorString());
                //on enlève la réf à l'élève qui est connue
		//----------------------------------------------
		$this->setWidget('eleve_id', new sfWidgetFormInputHidden());
		$this->setValidator('eleve_id', new sfValidatorString());
		}
		}
		
			// --- pour palier aux erreurs à l'enregistrement on crée un champ _csrf_token qui ne s'affiche pas -------
			//afficher le champs dans le _form.php
		
			$this->setWidget('_csrf_token', new sfWidgetFormInputHidden());
			$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputText(array(), array("style"=>'width: 0px;'));
			$this->setValidator('_csrf_token' , new sfValidatorString());
			
			// --------------------------------------------------------------------------------------------------------	

	
        //contrôle sur les dates de début et fin d'attribution
		//--------------------------------------------------------
      //  $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
      //              new sfValidatorSchemaCompare('datedebut', sfValidatorSchemaCompare::LESS_THAN_EQUAL, 'datefin',
      //                      array('throw_global_error' => true),
      //                      array('invalid' => 'La date de debut ("%left_field%") doit etre inferieure à la date fin ("%right_field%")')
      //              )
      //          ))); 

      
 
    }

}
