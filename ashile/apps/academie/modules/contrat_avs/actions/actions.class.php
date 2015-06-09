<?php

/**
 * test_contrat_avs actions.
 *
 * @package    ash
 * @subpackage test_contrat_avs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class contrat_avsActions extends sfActions
{
	  public function executeIndex(sfWebRequest $request)
	  {
		//les AVS qui ont au moins un contrat
		//--------------------------------------
		$this->contrat_avss = Doctrine_Query::Create()
					->select ('id as id,nom as nom,prenom as prenom,date_naissance as date_naissance')
					->from('Avs a')
					->where('id in (select avs_id from contrat_avs c )')
					->fetchArray(); 
	   //------------------------------------
	  }
	    public function executeListpos(sfWebRequest $request)
    {    
   
        //liste des contrats avec l' Historique des positions
	   //----------------------------------------------------   
            $this->PosAvs = Doctrine_Core::getTable('ContratAvs')->getListeContratsAccavecPos($request->getParameter('avs_id'));
			$this->count_PosAvs = count($this->PosAvs);

    }
	
	
	 public function executePopup(sfWebRequest $request)
  {
  
  
      $this->getUser()->setAttribute('contrat',1); //gestion du retour dans le proccessform
      
     //$this->setLayout(false);
	 //$this->addJavascript('jquery.ui.datepicker-fr.js');
	// ----------- on trouve le contrat_avs en cours ------------
	$AvsId = $request->getParameter('avs_id');

	// ----------- on crée un objet positionAvs
	$contratAvs = new ContratAvs();
	// ----------- on donne le contratAvsid a cet objet ---------
	$contratAvs->setAvsId($AvsId); 
	// ----------- on crée le form por cet objet ----------------
  	$this->form = new ContratAvsForm($contratAvs);

    
  }
  	  public function executeShow(sfWebRequest $request)
	  {
	   //--- inclusion des position contrat avs -------
	   
	   	      //récupération des positions pour le contrat selectionné
			//----------------------------------------------------------------
	    				$this->position = Doctrine_Query::create()
							->select('t.libelletypepositionavs as libelletypepositionavs,p.datedebut as datedebut,.datefin as datefin,p.contratavs_id as contratavs_id,p.id as Id')
							->from('PositionAvs p')
							->innerjoin('p.TypePositionAvs t ON p.typepositionavs_id = t.id')
							->where('p.contratavs_id = ?', $request->getParameter('id'))
							->orderBy('p.id DESC')
							->fetchArray();
	   
							$this->existposition = count($this->position);
		 
		 
	   //---------------------------------------------- 
	 	  
         // recherche du contrat à afficher
		  //--------------------------------
		   $this->contrat_avs = Doctrine_Query::Create()
				->select ('a.nom as avsnom,a.prenom as avsprenom,c.id as contratId,a.id as id,c.temps_hebdo as temps_hebdo,c.date_debut_contrat as date_debut_contrat,c.date_fin_contrat as date_fin_contrat,et.id as etid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,tc.typecontrat as typecontrat')
				->from('ContratAvs c')
				->innerJoin('c.Avs a ON a.id = c.avs_id')
				->leftjoin('c.Etabsco et ON  et.id = c.etabsco_id')
				->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->innerjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
				->where('id = ?', $request->getParameter('id'))
				->orderby('date_debut_contrat desc,date_fin_contrat desc')
				->fetcharray();
           $this->forward404Unless($this->contrat_avs );
		   
				
	  }
	public function executeList(sfWebRequest $request)
	{
		  // Liste des contrats pour l'avs selectionne
		  //-------------------------------------------
		   $this->ContratEnCour = Doctrine_Query::Create()
				->select ('a.nom as avsnom,a.prenom as avsprenom,c.id as contratId,a.id as avsid,
				c.temps_hebdo as temps_hebdo,c.date_debut_contrat as date_debut_contrat,c.date_fin_contrat as date_fin_contrat,et.id as etid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,tc.typecontrat as typecontrat')
				->from('ContratAvs c')
				->innerJoin('c.Avs a ON a.id = c.avs_id')
				->leftjoin('c.Etabsco et ON  et.id = c.etabsco_id')
				->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->leftjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
				->where('avs_id = ?', $request->getParameter('avs_id'))
				->orderby('date_fin_contrat desc')
				->fetcharray();
		
		
			//les AVS qui ont au moins un contrat
			//------------------------------------
			$this->avschoisi = Doctrine_Query::Create()
				->select ('id as id,nom as nom,prenom as prenom,date_naissance as date_naissance,tel1 as tel1,tel2 as tel2,email as email')
				->from('Avs a')
				->where('id = ?', $request->getParameter('avs_id'))
				->fetchone();
				
				
	    // recherche des eleves suivi par l'avs selectionne
        //------------------------------------------------- 
         $this->eleveEnCharge = Doctrine_Query::Create()
                ->select ('a.avs_id as avs_id,e.id as EleveId,e.nom as nom,e.prenom as prenom,v.nom as avsnom,
				v.prenom as avsprenom,a.datefin as datefin,a.datedebut as datedebut,a.quotitehorraireavs as quotite,et.id as etid,o.id as orienid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,s.libellesecteur as secteur')
                ->from('EleveAvs a')
                ->innerJoin('a.Eleve e ON e.id = a.eleve_id')
                ->innerjoin('e.Secteur s ON s.id = e.secteur_id')
				->leftjoin('a.Avs v ON v.id = a.avs_id')
                ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
                ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->leftjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
                ->where('a.avs_id = ?', $request->getParameter('avs_id'))
				->andWhere('o.datefin >=?', date('Y-m-d', time()))
				->andWhere('a.datefin IS NULL OR a.datefin >=?', date('Y-m-d', time()))
 			    //->andWhere('a.datefin >=?', date('Y-m-d', time()))
                ->orderby('datedebut desc,datefin desc')
                ->fetcharray();

		 $this->existeleveEnCharge = count($this->eleveEnCharge); 
		 
	 //Total de la quotité horaire notifiée pour l'accompagnant sélectionné
	 //-----------------------------------------------------------------------
         $this->totalquotiteavs = Doctrine_Query::Create()
                ->select ('a.avs_id as avs_id,sum(a.quotitehorraireavs) as quotiteavs')
                ->from('EleveAvs a')
                ->where('avs_id = ?', $request->getParameter('avs_id'))
				//->andWhere('a.datefin >=?', date('Y-m-d', time()))
				->andWhere('a.datefin IS NULL OR a.datefin >=?', date('Y-m-d', time()))
				->groupBy('a.avs_id')
                ->fetcharray();	

		$this->existTotalquotiteavs = count($this->totalquotiteavs); 
		
	// Total quotité horaire contrats pour le personnel acc. selectionné à la date du jour
	//-------------------------------------------------------------------------------------
	
  	   $this->totalquotitécontratAvs = Doctrine_Query::Create()
			->select ('c.id as contratId,a.id as avsid,sum(c.temps_hebdo) as temps_hebdo')
			->from('ContratAvs c')
			->innerJoin('c.Avs a ON a.id = c.avs_id')
			->where('avs_id = ?', $request->getParameter('avs_id'))
			->andWhere('date_fin_contrat >=?', date('Y-m-d', time()))
			->groupby('c.avs_id')
			->fetcharray();	
		 $this->existtotalquotitécontratAvs = count($this->totalquotitécontratAvs);   
    
	}
	

  public function executeNew(sfWebRequest $request)
  {
	  
		// --------- on trouve l'avs en cours ---------
		$avs_id = $request->getParameter('avs_id');
		$this->avs = Doctrine::getTable('Avs')->findOneById($avs_id);
		$contratAvs = new ContratAvs();
		$contratAvs->setAvsId($avs_id);
		
	  
		$this->form = new ContratAvsForm($contratAvs);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ContratAvsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  
    // Liste des contrats pour l'avs selectionne
	//-------------------------------------------
		   $this->ContratEnCour = Doctrine_Query::Create()
				->select ('a.nom as avsnom,a.prenom as avsprenom,c.id as contratId,a.id as avsid,
				c.temps_hebdo as temps_hebdo,c.date_debut_contrat as date_debut_contrat,c.date_fin_contrat as date_fin_contrat,et.id as etid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,tc.typecontrat as typecontrat')
				->from('ContratAvs c')
				->innerJoin('c.Avs a ON a.id = c.avs_id')
				->leftjoin('c.Etabsco et ON  et.id = c.etabsco_id')
				->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->leftjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
				->where('avs_id = ?', $request->getParameter('avs_id'))
				->orderby('date_fin_contrat desc')
				->fetcharray();
    //récupération des informations conecernant l'avs du contrat selectionné
	//-----------------------------------------------------------------------
			$this->avs = Doctrine_Query::create()
			->select ('c.id as contratId,a.id as avsid,a.nom as nom,a.prenom as prenom,a.tel1 as tel1,a.tel2 as tel2,a.email as email,a.date_naissance as date_naissance')
			->from('Avs a')
			->innerJoin('a.ContratAvs c ON a.id = c.avs_id')
			->where('c.id = ?', $request->getParameter('id'))
			->fetchArray();
	

	  
    $this->forward404Unless($contrat_avs = Doctrine_Core::getTable('ContratAvs')->find(array($request->getParameter('id'))), sprintf('Object contrat_avs does not exist (%s).', $request->getParameter('id')));
    
    $this->contratAvs = $contrat_avs;
    
    $this->form = new ContratAvsForm($contrat_avs,$existetestPosition);
	
	
	// --- pour le partial du form position avs
   
/*     $pos = new positionAvs();
    $pos->setContratavsId($contrat_avs->getId());
    $this->form2 = new PositionAvsForm($pos); */
	

	
  	//$this->redirect('contrat_avs/list?avs_id='.$contrat_avs->getAvsId());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($contrat_avs = Doctrine_Core::getTable('ContratAvs')->find(array($request->getParameter('id'))), sprintf('Object contrat_avs does not exist (%s).', $request->getParameter('id')));
    $this->form = new ContratAvsForm($contrat_avs);
	
		//--- inclusion des position contrat avs -------
	$testPosition = Doctrine::getTable('PositionAvs')->findByContratavsId($request->getParameter('id'));	
	
	if($testPosition){
			$this->forward404Unless($this->position = Doctrine::getTable('PositionAvs')->findByContratavsId($request->getParameter('id')), sprintf('Contrat sans position (%s).', $request->getParameter('id')));			
	}else{
			$this->position = '';
	}  
	//---------------------------------------------- 
	$existetestPosition = count($testPosition);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }
  
  
    public function executeMessage(sfWebRequest $request)
  {
     
	 // Liste des contrats pour l'avs selectionne
	//-------------------------------------------
		   $this->contratsaisie = Doctrine_Query::Create()
				->select ('a.nom as avsnom,a.prenom as avsprenom,c.id as contratId,a.id as avsid,
				c.temps_hebdo as temps_hebdo,c.date_debut_contrat as date_debut_contrat,c.date_fin_contrat as date_fin_contrat,et.id as etid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,tc.typecontrat as typecontrat')
				->from('ContratAvs c')
				->innerJoin('c.Avs a ON a.id = c.avs_id')
				->leftjoin('c.Etabsco et ON  et.id = c.etabsco_id')
				->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->leftjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
				->where('c.id = ?', $request->getParameter('contratavs_id'))
				->orderby('date_fin_contrat desc')
				->fetcharray();
    
    }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();
    
	//--- recherche des position du contrat avs selectionné -------
	//-------------------------------------------------------------
	
	$this->testPosition = Doctrine::getTable('PositionAvs')->findByContratavsId($request->getParameter('id'));	
	$existetestPosition = count($this->testPosition); 
	
	
	if ($existetestPosition == 0){
		$this->forward404Unless($contrat_avs = Doctrine_Core::getTable('ContratAvs')->find(array($request->getParameter('id'))), sprintf('Object contrat_avs does not exist (%s).', $request->getParameter('id')));
		$contrat_avs->delete();
		$message = 'Suppression réussie du contrat AVS n°'. $request->getParameter('id');
  		$this->getUser()->setFlash('notice',$message );
		$this->redirect('avs/recherche?avs_nom='.$request->getParameter('avs_nom').'&avs_prenom='.$request->getParameter('avs_prenom'));

	}else{
	
		$message = 'Suppression impossible du contrat AVS n°'.$request->getParameter('id').', il existe des mouvements sur ce contrat';
		$this->getUser()->setFlash('error',$message );
	}
		$this->redirect('avs/recherche?avs_nom='.$request->getParameter('avs_nom').'&avs_prenom='.$request->getParameter('avs_prenom'));
		//$this->getUser()->setFlash('notice','tutu');
		//$this->redirect('contrat_avs/edit?id='.$request->getParameter('id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
	
	//récupération des valeurs saisies avant sauvegarde pour contôle de dates
     //-------------------------------------------------------------------------	 
	$datedebut = $form->getValue('date_debut_contrat');
	$datefin = $form->getValue('date_fin_contrat');		
	
	if ( $datefin < $datedebut){
	 $this->getUser()->setFlash('error', 'la date de fin de contrat doit être supérieure à la date de début de contrat');  
	$this->redirect('contrat_avs/edit?id='.$form->getobject()->getId());    
	}
	
	
    if ($form->isValid()) {
      $contrat_avs = $form->save();
	  $this->getUser()->setFlash('notice', 'Modification(s) Enregistrée(s) avec succès  pour '.$form->getobject().' - contrat n° '.$form->getobject()->getId());
	if($this->getUser()->getAttribute('contrat') == 1){ //on vient de la popup de création d'un orgnaisme
		    $this->redirect('contrat_avs/message?contratavs_id='. $contrat_avs->getId());
	   }
	   
     $this->redirect('contrat_avs/edit?id='.$form->getobject()->getId().'&avs_id='.$form->getobject()->getAvsId()); 
    //$this->getUser()->setFlash('notice', 'Modification(s) Enregistrée(s) avec succès  pour '.$form->getobject().' - contrat n° '.$form->getobject()->getId());	 
	// $this->redirect('contrat_avs/list?avs_id='.$contrat_avs->getAvsId());
	 
    }else{ 
    $this->getUser()->setFlash('error', 'modification(s) pas enregistrée(s)');  
  }
}

public function executeAide(){}	
}
