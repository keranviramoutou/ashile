<?php

/**
 * demandemeteriel actions.
 *
 * @package    ash
 * @subpackage demandemateriel
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandematerielActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
	
	$this->page = 'en attente de traitement';
	// demande materiel en attente de traitement CDA
	//----------------------------------------------
	    $this->demande_materiels = Doctrine_Query::create()
			->select('s.id as secteur_id,etab.id as etabsco_id, e.id as eleve_id,t.id as typemateriel_id, e.id as eleve_id, m.id as mdph_id, o.id as orientation_id, 
			d.id as demandemateriel_id, e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve, t.libelletypemateriel as typemateriel,
			e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, 
			etab.nometabsco as nometabsco,etab.rne as rne,ty.nomtypeetablissement as typetab,ty.id as typeetabsco_id')
						->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
						->leftjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
			->where('d.datedecisioncda IS NULL' )
			->fetchArray();
    }
	
   public function executeRdd(sfWebRequest $request)
    {
	
	$this->page = 'en attente de traitement';
	
   //recherche du traitement correspondant au traitement "RDD"
	//-------------------------------------------------------------------
    	$trait_materiel = Doctrine_Query::create()
		->select('t.id as traitement_id')
		->from('Traitement t')
		->where('t.libelletraitement LIKE "%RDD%"')
		->limit(1)
		->fetcharray();
	
	// demande materiel à l'état RDD pour traitement
	//----------------------------------------------
	    $this->demande_materiels = Doctrine_Query::create()
			->select('s.id as secteur_id,etab.id as etabsco_id, e.id as eleve_id,t.id as typemateriel_id, e.id as eleve_id, m.id as mdph_id, o.id as orientation_id, 
			d.id as demandemateriel_id, e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve, t.libelletypemateriel as typemateriel,
			e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, 
			etab.nometabsco as nometabsco,etab.rne as rne,ty.nomtypeetablissement as typetab,tr.libelletraitement as libelletraitement')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
						->leftjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
						->innerJoin('d.Traitement tr ON d.traitement_id = tr.id')
						->where('d.traitement_id = ?',$trait_materiel[0]['traitement_id'])
					//	->where('d.datedecisioncda IS NOT NULL' )
						->fetchArray();
    }
  public function executeSuivante(sfWebRequest $request)
    {

// demande materiel en attente de traitement CDA
	//----------------------------------------------
	    $demande_suivante = Doctrine_Query::create()
			->select('s.id as secteur_id,etab.id as etabsco_id, e.id as eleve_id,t.id as typemateriel_id, 
			e.id as eleve_id, m.id as mdph_id, o.id as orientation_id, d.id as demandemateriel_id, 
			e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve,
			t.libelletypemateriel as typemateriel, e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, 
			m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, 
			etab.nometabsco as nometabsco,etab.rne as rne,ty.id as type_id,ty.nomtypeetablissement as typetab')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
						->leftjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
						->whereNotIn('d.id', $request->getParameter('precedente') )
						->andwhere('t.libelletypemateriel LIKE "%ND%"')
					//	->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))	
						->limit(1)
						->fetchArray();
		$countdemande_suivante = count ($demande_suivante);
		
		if($countdemande_suivante == 0) //dernière à traiter
		{
		// demande materiel en attente de traitement CDA
	   //----------------------------------------------
	    $demande_actuel = Doctrine_Query::create()
			->select('s.id as secteur_id,etab.id as etabsco_id, e.id as eleve_id,t.id as typemateriel_id, 
			e.id as eleve_id, m.id as mdph_id, o.id as orientation_id, d.id as demandemateriel_id, 
			e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve,
			t.libelletypemateriel as typemateriel, e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, 
			m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, 
			etab.nometabsco as nometabsco,etab.rne as rne,ty.id as type_id,ty.nomtypeetablissement as typetab')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
						->leftjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
						->where('t.libelletypemateriel LIKE "%ND%"')
					//	->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))	
						->where('d.id =?', $request->getParameter('precedente') )
						->fetchArray();
		$countdemande_actuel = count($demande_actuel);

		}
		// demande materiel en attente de traitement CDA
	   //----------------------------------------------
	    $demande_courante = Doctrine_Query::create()
			->select('s.id as secteur_id,etab.id as etabsco_id, e.id as eleve_id,t.id as typemateriel_id, 
			e.id as eleve_id, m.id as mdph_id, o.id as orientation_id, d.id as demandemateriel_id, 
			e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve,
			t.libelletypemateriel as typemateriel, e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, 
			m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, 
			etab.nometabsco as nometabsco,etab.rne as rne,ty.id as type_id,ty.nomtypeetablissement as typetab')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
						->leftjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
						//->Where('d.datefinnotif >=?', date('Y-m-d', time()))	
						//->where('t.libelletypemateriel NOT LIKE  "%ND%"')
						->andwhere('d.id =?', $request->getParameter('precedente') )
						->fetchArray();	
		   $countdemande_courante = count($demande_courante);
		
		
    if($countdemande_suivante != 0  ){					
	$this->redirect('demandemateriel/edit?id=' . $demande_suivante[0]['demandemateriel_id'] .'&secteur_id=' . $demande_suivante[0]['secteur_id'].'&eleve_nom=' . $demande_suivante[0]['nomeleve'].'&eleve_prenom=' . $demande_suivante[0]['prenomeleve'].'&eleve_id=' . $demande_suivante[0]['eleve_id']. '&retour='. 1);
    $this->getUser()->setFlash('notice', 'deamnde suivante à traiter de type ND');
	}
	 if($countdemande_actuel == 1  ){					
	$this->redirect('demandemateriel/edit?id=' . $demande_actuel[0]['demandemateriel_id'] .'&secteur_id=' . $demande_actuel[0]['secteur_id'].'&eleve_nom=' . $demande_actuel[0]['nomeleve'].'&eleve_prenom=' . $demande_actuel[0]['prenomeleve'].'&eleve_id=' . $demande_actuel[0]['eleve_id']. '&retour='. 1);
    $this->getUser()->setFlash('notice', 'dernière demande à traiter de type ND');
    }

  

	}
  public function executeTraitementcda(sfWebRequest $request)
    {
	//récupération de la liste des demandes selectionnées
	//---------------------------------------------------
	$this->lesMats = $request->getParameter('lesMats');
	$this->decisioncda   = $request->getParameter('decisioncda');
	$this->datedecisioncda   = date('Y-m-d',strtotime($request->getParameter('datedecisioncda')));
	$this->datedebutnotif   = date('Y-m-d',strtotime($request->getParameter('datedebutnotif')));
	$this->datefinnotif  =   date('Y-m-d',strtotime($request->getParameter('datefinnotif')));
	
	
	// demande materiel en attente de traitement CDA
	//----------------------------------------------
	    $this->demande_materiel1s = Doctrine_Query::create()
			->select('s.id as secteur_id,etab.id as etabsco_id, e.id as eleve_id,t.id as typemateriel_id, 
			e.id as eleve_id, m.id as mdph_id, o.id as orientation_id, d.id as demandemateriel_id, 
			e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve,
			t.libelletypemateriel as typemateriel, e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, 
			m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, 
			etab.nometabsco as nometabsco,etab.rne as rne,ty.id as type_id,ty.nomtypeetablissement as typetab')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
						->leftjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
						->where('d.datedecisioncda IS NULL' )
						->fetchArray();
	
	if ($this->lesMats){
	
			// demande materiel selectionnées en attente de traitement CDA
			//----------------------------------------------------------------
			$demande_materiels = Doctrine_Query::create()
				->select('d.id as demandemateriel_id')
				->from('DemandeMateriel d')
				->whereIn('d.id', explode(",",$this->lesMats))
				->fetchArray();
			$countdemande_materiels=count($demande_materiels);	
	
			if ($request->getParameter('decisioncda') == 1){//décision cda ACCEPTEE
		
		       // --- la mise à jour des demande matériels selectionnées - champs concernant la décision cda --				
				foreach ($demande_materiels as $demande_materiel){	
				Doctrine_Query::Create()
						->update('DemandeMateriel d')
						->set(array(
						'd.decisioncda' => $this->decisioncda,
						'd.datedecisioncda' =>$this->datedecisioncda,
						'd.datedebutnotif' =>$this->datedebutnotif,
						'd.datefinnotif' =>$this->datefinnotif,
						))
						->where('d.id = ?',   $demande_materiel['demandemateriel_id'])
						->execute();
				}
			//gestion du message d'information décision ACCEPTEE
			//----------------------------------------------------
			
			    if($request->getParameter('datedebutnotif')){
			    $message1 = ' - Notifiée du  '.$request->getParameter('datedebutnotif');
				$type='notice';
				}
				if($request->getParameter('datefinnotif') ){
			    $message1 =  $message1 . ' au '.$request->getParameter('datefinnotif');
				$type='notice';
				}
				
				if($request->getParameter('decisioncda') == 1){
			    $message = ' et la décision est ACCEPTEE  ';
				$type='notice';
				}
				
			    if($request->getParameter('datedecisioncda')){
			    $message = 'demandes matériels traitées avec un date de décision au '
				.$request->getParameter('datedecisioncda').$message.$message1;
				}
          
				$this->getUser()->setFlash($type, $message); 
			} //fin test decision cda ACCEPTEE
			
		  //--------------------------------------------------------------------------------------
		  
    	  if ($request->getParameter('decisioncda') != 1){ //décision cda refusée
		
		// --- la mise à jour des demande matériels selectionnées - champs concernant la décision cda --				
			foreach ($demande_materiels as $demande_materiel){	
			Doctrine_Query::Create()
					->update('DemandeMateriel d')
					->set(array(
					'd.decisioncda' => $this->decisioncda,
					'd.datedecisioncda' =>$this->datedecisioncda,
					))
					->where('d.id = ?',   $demande_materiel['demandemateriel_id'])
					->execute();
			}	

          	//gestion du message d'information pour décision refusée
			//------------------------------------------------------

				if($request->getParameter('decisioncda') != 1){
				  $message1 = '    
				   
				    
					et la décision est REFUSEE ';
				  $type='error';
				}
				
			    if($request->getParameter('datedecisioncda')){
			    $message = 'demandes matériels traitées avec un date de décision au '
				.$request->getParameter('datedecisioncda').$message1;
				}
             
			$this->getUser()->setFlash($type, $message); 
						
		  }
	    }else{
		$this->getUser()->setFlash('error','Il faut selectionner une demande matériel à traiter !!'); 
		}  //fin test $this->lesMats
	 }
	
	 public function executeIndex1(sfWebRequest $request)
    {
	//Dernière demande matériel en attente de traitement CDA  pour l'élève selectionné
	//----------------------------------------------------------------------------------
	$dem_mat_cda = Doctrine_Core::getTable('DemandeMateriel')->getDerDemandeMatCDA($eleve['id']);
	$count_dem_mat_cda = count($dem_mat_cda);
    }
	
	
	public function executeDupli(sfWebRequest $request)
    {
	

    $this->redirect('demandemateriel/edit?id='.$demandemat->getId());
    }
	
	
	public function executeList(sfWebRequest $request)
	{
	$this->page = 'en attente de moyen';
	
	//recherche du traitement correspondant au traitement "A ATTRIBUER"
	//-------------------------------------------------------------------
    	$trait_materiel = Doctrine_Query::create()
		->select('t.id as traitement_id')
		->from('Traitement t')
		->where('t.libelletraitement LIKE "%ATTRIBUER%"')
		->limit(1)
		->fetcharray();
	
	// Demande materiel
	//-----------------
	$this->demande_materiels = Doctrine_Query::create()
			->select('s.id as secteur_id,etab.id as etabsco_id, t.id as typemateriel_id, e.id as eleve_id, m.id as mdph_id, o.id as orientation_id, d.id as demandemateriel_id, 
			e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve, t.libelletypemateriel as typemateriel, e.numeromdph as numeromdph,
			m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, etab.nometabsco as nometabsco,
			c.libellecatmateriel as libellecatmateriel,tr.libelletraitement as libelletraitement ,
			d.datedecisioncda as datedecisioncda, d.datedebutnotif as datedebutnotif, d.datefinnotif as datefinnotif')
			->from('DemandeMateriel d')
			->innerJoin('d.Traitement tr ON d.traitement_id = tr.id')
			->innerJoin('d.Mdph m ON d.mdph_id = m.id')
			->innerJoin('m.Eleve e ON m.eleve_id = e.id')
			->innerJoin('e.Orientation o ON o.eleve_id = e.id')
			->innerJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
			->innerJoin('e.Secteur s ON s.id = e.secteur_id')
			->innerJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
			->leftJoin('d.Catmateriel c ON c.id = d.catmateriel_id')
			->where('d.decisioncda = ?', true)            
			//->where('d.datedecisioncda IS NOT NULL') // il existe une date de decision cda
			->andWhere('d.traite = ?', false) // il n'y a pas encore de moyen dispo
			->andWhere('d.traitement_id = ?',$trait_materiel[0]['traitement_id'])
			->fetchArray();
}

  public function executeNew(sfWebRequest $request)
  {
	//récupération dela scolarité de l'élève
    $this->orientation = Doctrine::getTable('Orientation')->findOneByEleveId($request->getParameter('eleve_id'));
   	// --- récupèration du type matétiel à "ND" 
	//-------------------------------------------
	$type_materiel = Doctrine_Query::create()
		->select('t.id as id')
		->from('typemateriel t')
		->where('t.libelletypemateriel LIKE "%ND%"')
		->limit(1)
		->fetcharray();
	
	//recherche du traitement correspondant au traitement "A ATTRIBUER"
	//-------------------------------------------------------------------
    	$trait_materiel = Doctrine_Query::create()
		->select('t.id as id')
		->from('Traitement t')
		->where('t.libelletraitement LIKE "%ATTRIBUER%"')
		->limit(1)
		->fetcharray();
	
	 // --- vérification si une demande n'est pas en attente de décision CDA
	//----------------------------------------------------------------------
	$dem_mat_cda = Doctrine_Core::getTable('DemandeMateriel')->getDerDemandeMatCDA($request->getParameter('eleve_id'));
	$count_dem_mat_cda = count($dem_mat_cda);
	
	//création d'un dossier mdph pour création demande matériel
	//-----------------------------------------------------------
	
	//if ($count_dem_mat_cda == 0){
	if ($request->getParameter('mdph_id')){
	
	//création d'une demande matériel correspondant au dossier MDPH 
	//-----------------------------------------------------------
	$note = 'création Académique du : ' .date('d/m/Y h:m', time()); 

	$mdph_id = $request->getParameter('mdph_id');
	$demandemat = new DemandeMateriel();
	$demandemat->setNotes($note);
	$demandemat->setDateDemandeMateriel(date('Y-m-d',time()));;
	$demandemat->setTypematerielId($type_materiel[0]['id']);
    $demandemat->setMdphId($request->getParameter('mdph_id'));
	$demandemat->setTraitementId($trait_materiel[0]['id']);
	$demandemat->save();
	$message = 'demande matériel n° '.$demandemat->getId(). ' pour le dossier MDPH existant n° '.$demandemat->getMdphId().' créée avec succès' ;
	$this->getUser()->setFlash('notice',$message );
	
	}else{ //création dossier mdph
	
	//création d'un dossier mdph pour l'élève selectionné
    //---------------------------------------------------
	$mdph = new Mdph();
	$mdph->setEleveId($request->getParameter('eleve_id'));
	$mdph->save();
	$message = 'dosssier MDPH n°'.$mdph->getId().'&nbsp;créé avec succés' ;
	$this->getUser()->setFlash('notice',$message );
	
	//création d'une demande matériel correspondant au dossier MDPH  créé
	//-------------------------------------------------------------------
	$note = 'création Académique du : ' .date('d/m/Y h:m', time()); 
	$mdph_id = $mdph->getId();
	$demandemat = new DemandeMateriel();
	$demandemat->setDateDemandeMateriel(date('Y-m-d',time()));;
	$demandemat->setNotes($note);
	$demandemat->setTypematerielId($type_materiel[0]['id']);
    $demandemat->setMdphId($mdph->getId());
	$demandemat->setTraitementId($trait_materiel[0]['id']);
	$demandemat->setTraitementId($trait_materiel[0]['id']);
	$demandemat->save();
	$message = 'demande matériel n° '.$demandemat->getId(). ' pour le dossier MDPH créé n° '.$demandemat->getMdphId().' créée avec succès' ;
	$this->getUser()->setFlash('notice',$message );
	
	}
	//}else{
	//$message= "une demande matériel en attente de traitement cda existe déjà, impossible de créer une nouvelle demande";
	//$this->getUser()->setFlash('notice',$message );
	//}
	$this->redirect('eleve/recherche?eleve_id='.$request->getParameter('eleve_id').'&eleve_nom='.$request->getParameter('eleve_nom').'&eleve_prenom=' . $request->getParameter('eleve_prenom').'&flag_recherche=1');
	
	
    //	$this->form = new DemandeMaterielForm();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->demande_materiel);
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DemandeMaterielForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
	// Historique des matériels attribués à l'élève
	//--------------------------------------------
	$this->materielEleve = Doctrine_Query::Create()
				->select('e.dateconvention as dateconvention, t.libelletypemateriel as typemateriel,e.eleve_id as eleveId, m.numeromateriel as numeromateriel,p.id as mouvementMaterielId, p.mouvement_id as mouvementId, e.materiel_id as materielId, m.typemateriel_id as typeMateriel,m.libellemateriel as libellemateriel, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin, ')
				->from('EleveMateriel e')
				->leftjoin('e.Materiel m ON m.id = e.materiel_id')
				->innerJoin('m.Typemateriel t ON t.id = m.typemateriel_id')
				->leftjoin('m.MouvementMateriel p ON p.materiel_id = m.id')
				->where('e.eleve_id = ?', $request->getParameter('eleve_id'))
				->fetcharray();

				
	//récupération dela scolarité de l'élève
    $this->orientation = Doctrine::getTable('Orientation')->findOneByEleveId($request->getParameter('eleve_id'));
    $this->forward404Unless($demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->find($request->getParameter('id')), sprintf('Object demande_materiel does not exist (%s)', $request->getParameter('id')));
   
   if($demande_materiel->getMaterielId()){
		// matériel attribué à l'éléve
		//------------------------------
    	$this->materielattribué = Doctrine_Query::Create()
				->select('e.id as Elev_mat_Id,e.dateconvention as dateconvention, t.libelletypemateriel as typemateriel,e.eleve_id as eleveId, m.numeromateriel as numeromateriel,p.id as mouvementMaterielId, p.mouvement_id as mouvementId, e.materiel_id as materielId, m.typemateriel_id as typeMateriel,m.libellemateriel as libellemateriel, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin, ')
				->from('EleveMateriel e')
				->leftjoin('e.Materiel m ON m.id = e.materiel_id')
				->innerJoin('m.Typemateriel t ON t.id = m.typemateriel_id')
				->leftjoin('m.MouvementMateriel p ON p.materiel_id = m.id')
				->where('e.eleve_id = ?', $request->getParameter('eleve_id'))
				->andwhere('m.id = ?',$demande_materiel->getMaterielId() )
				->limit(1)
				->fetcharray();
	}
	//récupération des informations concernant le dossier mdph
	$this->mdph = Doctrine::getTable('Mdph')->find($demande_materiel->getMdphId() );
	
	//affectation d'une variable pour voir si il s'agit d'une prolongation ui permet de mettre à jour la fin de date de fin de prêt avec la date de fin de la notification de prolongation
	$this->getUser()->setAttribute('prolonge',$request->getParameter('prolonge'));
	// ----------------------------------------------------------------------------------------------
	     if ($request->getParameter('retour') == 1) {
		$this->getUser()->setAttribute('retour',1);
		}else{
		$this->getUser()->setAttribute('retour',2);
		}
	$this->form = new DemandeMaterielForm($demande_materiel,$this->materielEleve,$this->orientation,$this->mdph);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->find($request->getParameter('id')), sprintf('Object demande_materiel does not exist (%s)', $request->getParameter('id')));
    $this->form = new DemandeMaterielForm($demande_materiel);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

	 $this->forward404Unless($demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->find(array($request->getParameter('id'))), sprintf('Object eleve does not exist (%s).', $request->getParameter('id')));
    if(!$demande_materiel->getMaterielId() && $request->getParameter('confirm') == false){
		$demande_materiel->delete();
	   $this->getUser()->setFlash('notice','Demande matériel supprimée  '); 
   }else if ($demande_materiel->getMaterielId()) { 
		$this->getUser()->setFlash('error','impossible de supprimer cette demande, un matériel est attaché à cette demande, il faut d\'abord supprimer le prêt  ');   
   }
		$this->redirect('eleve/recherche?eleve_nom='.$request->getParameter('eleve_nom').'&eleve_prenom=' . $request->getParameter('eleve_prenom').'&flag_recherche=1');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
   
    {
	   
       $demandemateriel = $form->save();  //sauvegarde de l'enregistrement
   
	  	// recherche de l'eleve_id
		//--------------------------
			$mdph = Doctrine_Query::Create()
				->select('d.id as mdph_id,m.eleve_id as eleve_id')
				->from('DemandeMateriel d')
				->innerJoin('d.Mdph m ON m.id = d.mdph_id')
				->where('d.id = ?', $demandemateriel->getId())
				->limit(1)
				->fetcharray();
				
		
		//recherche de l'identité élève
		//--------------------------------
		 $eleve = Doctrine_Query::Create()
		->select('d.nom as nom,d.prenom as prenom,d.id as eleve_id')
		->from('eleve d')
		->where('d.id = ?', $mdph[0]['eleve_id'])
		->fetcharray();
				
					
		//recherche de l'ID traitement à REMIS
		//-------------------------------------
		$traitement = Doctrine_Query::create()
		->select('t.id as traitement_id')
		->from('Traitement t')
		->where('t.libelletraitement LIKE "%REMIS%"')
		->limit(1)
		->execute();
		
		//recherche de l'ID traitement à RDD
		//-------------------------------------
		$traitement_rdd = Doctrine_Query::create()
		->select('t.id as traitement_id')
		->from('Traitement t')
		->where('t.libelletraitement LIKE "%RDD%"')
		->limit(1)
		->execute();
		
		
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//traitement de la demande matériel de prolongation de le demande à partir de DOSSIER MDPH  (changement de l'état à RDD)//
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		if ( $demandemateriel->getTraitementId() === $traitement_rdd[0]['traitement_id'] ){  //traitement de prolongation ( RDD)
		
			//recherche de la demande matériel précédente avec la même catégorie et du même type à l'état REMIS	que la demande à traiter pour l'éléve selectionné
			//----------------------------------------------------------------------------------------------------------------------------------------------------
		
				 $demande_mat_prec = Doctrine_Query::Create()
				->select('d.id as demandemat_id,d.id as mdph_id,m.eleve_id as eleve_id,d.materiel_id as materiel_id')
				->from('DemandeMateriel d')
				->innerJoin('d.Catmateriel c ON c.id = d.catmateriel_id')
				->innerJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
				->innerJoin('d.Traitement tr ON d.traitement_id = tr.id')
				->innerJoin('d.Mdph m ON m.id = d.mdph_id')
				->where('d.id != ?', $demandemateriel->getId()) //différent de la demande en cours de traitement
				->andwhere('m.eleve_id = ?',$mdph[0]['eleve_id']) // pour l'élève selectionné
				->andwhere('d.typemateriel_id = ?',$demandemateriel->getTypematerielId()) 
				->andwhere('d.catmateriel_id = ?',$demandemateriel->getCatmaterielId())
				->andwhere('tr.libelletraitement LIKE "%REMIS%"')  
				->limit(1)
				->fetcharray();
				
			//recherche du prêt pour le matériel et l'élève selectionné pour la demande matériel précédente
			//-----------------------------------------------------------------------------------------------
		    if( $demande_mat_prec[0]['materiel_id']){ // si numéro de matériel existe pour la demande précédente
			
				//MISE à jour de la date de fin de prêt avec la date de fin de notification de prolongation
				//-----------------------------------------------------------------------------------------
						$majDate = Doctrine_Query::create()
						->update('EleveMateriel e')
						->set('e.datefin','?',$demandemateriel->getDatefinnotif() )
						->where('e.eleve_id = ?', $mdph[0]['eleve_id'])
						->andwhere('e.materiel_id = ?',$demande_mat_prec[0]['materiel_id'] )
						->execute();
						
				//Modification de la demande matériel de prolongation passage à l'état REMIS
				//--------------------------------------------------------------------------
				   $notes = $demandemateriel->getNotes().'Demande non dupliquée (traiter à l\'état RDD) modifiée pour prolonger le prêt pour le matériel n°'.$demande_mat_prec[0]['materiel_id'];
						$majdemandemat = Doctrine_Query::create()
						->update('DemandeMateriel d')
						->set('d.traitement_id','?',$traitement[0]['traitement_id'] )
						->where('d.id = ?', $demandemateriel->getId())
						->execute();
						
						//mise à jour du matériel de la  demande de prolongation
						//-------------------------------------------------------
						$majdemandemat = Doctrine_Query::create()
						->update('DemandeMateriel d')
						->set('d.materiel_id','?',$demande_mat_prec[0]['materiel_id'])
						->where('d.id = ?', $demandemateriel->getId())
						->execute();
						
						//mise à jour des notes de la demande de prolongation
						//-------------------------------------------------------
						$majdemandemat = Doctrine_Query::create()
						->update('DemandeMateriel d')
						->set('d.notes','?',$notes)
						->where('d.id = ?', $demandemateriel->getId())
						->execute();
						
				
				$message = 'la date de fin de prêt a été mise à jour avec la date de fin de notification , la demande matériel passée à l\'état REMIS';
				$this->getUser()->setFlash('notice',$message);
				}else{
				$message = 'pas de demande précédente du même type et de la même catégorie à l\'état Remis, la date de fin de prêt ne sera pas mise à jour avec la date de fin de notification de la demandede prolongation';
				$this->getUser()->setFlash('error',$message);
				}
			
		}else{
			$message = 'pas en RDD';
			$this->getUser()->setFlash('error',$message);
		
		}
		
		
		if($demandemateriel->getMaterielId()){
		
		//recherche du prêt pour le matériel et l'élève selectionné
		//-------------------------------------------------------------
	    	     $materielEleve = Doctrine_Query::Create()
				->select('e.dateconvention as dateconvention,e.datedebut as datedebut, e.datefin as datefin')
				->from('EleveMateriel e')
				->where('e.eleve_id = ?',$mdph[0]['eleve_id'])
				->andwhere('e.materiel_id = ?',$demandemateriel->getMaterielId())
				->limit(1)
				->fetcharray();
		}	
		
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//traitement de la demande matériel de prolongation à partir de la demande matériel à prolonger  (bouton Dupliquer)//
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
	 	 //création d'une demande matériel Dupliquée pour le cas ou il y a prolongation de la demande
		//-------------------------------------------------------------------------------------------
	   if($request->getParameter('prolongation') ==  'Dupliquer'){
	            $notes = 'demande matériel dupliquée, prologongation du prêt du matériel n°'.$demandemateriel->getMaterielId();
				$date = date('Y-m-d', time());
				$demandemateriel = new DemandeMateriel();
				$demandemateriel->setDateDemandeMateriel($date);
				$demandemateriel->setDatedecisioncda($form->getValue('datedecisioncda'));
				$demandemateriel->setDatedebutnotif($form->getValue('datedebutnotif'));
				$demandemateriel->setDatefinnotif($form->getValue('datefinnotif'));
				$demandemateriel->setNotes( $notes);
				$demandemateriel->setTypematerielId($form->getValue('typemateriel_id'));
				$demandemateriel->setMdphId($form->getValue('mdph_id'));
				$demandemateriel->setCatmaterielId($form->getValue('catmateriel_id'));
				$demandemateriel->setDecisioncda($form->getValue('decisioncda'));
				$demandemateriel->setTraitementId($form->getValue('traitement_id'));
				$demandemateriel->setMaterielId($form->getValue('materiel_id'));
				$demandemateriel->setTraite($form->getValue('traite'));
				$demandemateriel->setEtat($form->getValue('etat'));
				$demandemateriel->save();
				$valeur = '1';
				$this->getUser()->setFlash('notice','demande matériel dupliquée ( prolongation du prêt est faite automatiquement !!) '.$request->getParameter('prolongation'));   
				$this->redirect('demandemateriel/edit?id='.$demandemateriel->getId().'&materiel_id='.$demandemateriel->getMaterielId().'&prolonge='.$valeur.'&eleve_id='.$mdph[0]['eleve_id'].'&eleve_nom='.$eleve[0]['nom'].'&eleve_prenom=' . $eleve[0]['prenom']);	  

	  }
		//récupération dela variable initialiser en edit
		//----------------------------------------------
		$prolonge  = $this->getUser()->getAttribute('prolonge');	
		
	  //mise à jour de la date de fin de prêt de l'élève avec la date de fin de notification si le champs materiel_id est renseigné 
	  // et si il s'agit d'une prolongation de la demande
	  //--------------------------------------------------	 
      if($prolonge === '1'){
	  			
				//MISE à jour de la date de fin de prêt avec la date de fin de notification selectionnée
			   //-----------------------------------------------------------------------------------------
				$majDate = Doctrine_Query::create()
				->update('EleveMateriel e')
				->set('e.datefin','?',$demandemateriel->getDatefinnotif() )
				->where('e.eleve_id= ?', $mdph[0]['eleve_id'])
				->andwhere('e.materiel_id = ?',$demandemateriel->getMaterielId() )
				->execute();
	    $message = 'la date de fin de prêt a été mise à jour car la notification a été prolongée ';
		$this->getUser()->setFlash('notice',$message);
	  } 
	
	  
	
     $this->getUser()->setFlash('notice', 'Demande matériel enregistrée avec succès');
	// gestion du bouton Retour
	//------------------------------
	$retour = $this->getUser()->getAttribute('retour');	// valeur définie dans l'action edit
	
	if ( $retour == 2){ //retour vers la liste des demandes
      $this->redirect('demandemateriel/edit?id='.$demandemateriel->getId().'&materiel_id='.$demandemateriel->getMaterielId().'&eleve_id='.$mdph[0]['eleve_id'].'&eleve_nom='.$eleve[0]['nom'].'&eleve_prenom=' . $eleve[0]['prenom'].'&retour=2');
    }else{ //retour vers la recherche élève
	  $this->redirect('demandemateriel/edit?id='.$demandemateriel->getId().'&materiel_id='.$demandemateriel->getMaterielId().'&eleve_id='.$mdph[0]['eleve_id'].'&eleve_nom='.$eleve[0]['nom'].'&eleve_prenom=' . $eleve[0]['prenom'].'&flag_recherche=1');
	}
	}
  }
  
  public function executeAide(){}	
}
