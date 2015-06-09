<?php

/**
 * eleve actions.
 *
 * @package    labo
 * @subpackage eleve
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eleveActions extends sfActions
{
	
/**
  * Executes recherche action
  *
  * @param sfRequest $request A request object
  */
  public function executeRecherche(sfWebRequest $request)
  {
    $this->user = $this->getUser();
	$secteur_user = $this->getUser()->getAttribute('secteur');
   // $this->getUser()->setFlash('notice', ' saisir au moins le nom ou le prénom !' .$secteur_user);
    

 	   	// je commence par récupérer le secteur de l'utilisateur connecté.
		//-----------------------------------------------------------------
        $this->secteur = Doctrine_Query::create()
                ->select('s.id as secteur_id')
                ->from('Secteur s')
              // ->where('s.sfguarduser_id=?', $this->getUser()->getGuardUser()->getId())
			  ->where('s.libellesecteur LIKE ?', $secteur_user)
                ->execute();	

	
      if ($request->isMethod('post')){
	    $eleve_nom = '%'.$_POST['nom_eleve'].'%';  
		$eleve_prenom = '%'.$_POST['prenom_eleve'].'%';
		
			
		 if(null != $_POST['nom_eleve'] || null != $_POST['prenom_eleve'])
		 {
		 
				$this->resultat = Doctrine_Query::create()
                ->select('e.id as eleve_id,t.id as typetab_Id,et.id as EtabId,em.eleve_id as em_eleve_id,e.nom as nom,e.prenom as prenom,,s.libellesecteur as libellesecteur,s.id as secteur_id,
				e.datenaissance as datenaissance,o.id as orientId')
                ->from('Eleve e')
                ->leftjoin('e.Secteur s ON s.id = e.secteur_id')
			    ->leftjoin('e.Orientation o ON e.id = o.eleve_id')
				->leftJoin('e.Eleves em ON e.id = em.eleve_id') // table élève_matériel
				->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->leftjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->andWhere('e.datesortie IS NULL')
				->andwhere ('e.nom LIKE ?', $eleve_nom)
				->andwhere ('e.prenom LIKE ?', $eleve_prenom)
	            ->orderBy('s.libellesecteur,e.nom')
                ->addOrderBy('e.nom')
                ->fetchArray();
					
	
			}else{
			$this->getUser()->setFlash('notice', ' saisir au moins le nom ou le prénom !' );
			} 
			}else {
				$this->resultat = Doctrine_Query::create()
                ->select('e.id as eleve_id,em.eleve_id as em_eleve_id,m.id as mdph_id,e.nom as nom,e.prenom as prenom,s.libellesecteur as libellesecteur,s.id as secteur_id,
				e.datenaissance as datenaissance,o.id as orientId')
                ->from('Eleve e')
                ->leftjoin('e.Secteur s ON s.id = e.secteur_id')
				->leftjoin('e.Orientation o ON e.id = o.eleve_id')
				->leftJoin('e.Mdphs m ON m.eleve_id = e.id')
				//->leftJoin('m.DemandeAvss d ON m.id = d.mdph_id')
				->leftJoin('e.Eleves em ON e.id = em.eleve_id') // table élève_matériel
			    ->andWhere('e.datesortie IS NULL')
				->andwhere ('e.nom LIKE ?', $request->getParameter('eleve_nom'))
				//->andwhere ('e.prenom LIKE ?', $request->getParameter('eleve_prenom'))
                ->orderBy('s.libellesecteur,e.nom')
                ->addOrderBy('e.nom')
                ->fetchArray();
			
			}
  }
  
   /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
    public function executeIndex(sfWebRequest $request)
    {
		
	//echo var_dump($secteur);
        $this->user = $this->getUser();
		$secteur = $this->getUser()->getAttribute('secteur');
        // creation d'un objet $secteur récupérable plus loin dans le code
        if ($request->getParameter('etab'))
            $this->user->setAttribute('etab', $request->getParameter('etab'));

        $this->etab = sfContext::getInstance()->getUser()->getAttribute('etab');
        $this->pager = new sfDoctrinePager('Eleve', sfConfig::get('app_eleve_par_page'));

      // Ici on appelle les requetes correspondantes au choix de l'utilisateurs via le bouton ou son
        // dernier choix qui est memorisé dans son instance
        if ($this->etab == 'avec')
            $this->pager->setQuery(Doctrine_Core::getTable('Eleve')->getEleveParEtab($secteur));
        if ($this->etab == 'sans')
            $this->pager->setQuery(Doctrine_Core::getTable('Eleve')->getEleveSansEtab($secteur));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }
    public function executeIndex1(sfWebRequest $request)
    {
          $this->user = $this->getUser();
         $secteur = $this->getUser()->getAttribute('secteur');
         $this->elevessansetab =  Doctrine_Core::getTable('Eleve')->getEleveSansEtab;
		 //$this->getUser()->setFlash('notice', 'vous êtes sur le secteur de '.$secteur->getId());
 
    }
	
	
	   public function executePbscolarite(sfWebRequest $request)
    {

         $secteur = $this->getUser()->getAttribute('secteur');
         $this->elevespbscolarite =  Doctrine_Core::getTable('Eleve')->getEleveAvecScolaritéIncomplete($secteur->getId());
 
    }
 /**
  * Executes listeEleve action
  *
  * @param sfRequest $request A request object
  */
    public function executeListeEleve(sfWebRequest $request)
    {
        $secteur = $this->getUser()->getAttribute('secteur');
        $this->eleves = Doctrine::getTable('Eleve')->getListElevesparSecteurGenerale;
        //($secteur->getId());
       // $annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
       // $deb = $annee->getDatedebutanneescolaire();
       // $fin = $annee->getDatefinanneescolaire();

    

 /**
  * Executes synthese action
  * 
  *cette fonction sert à présenté de façon synthétique toutes les données de l'eleve selectionné
  * 
  * @param sfRequest $request A request object
  */
  }
	 public function executeSynthese(sfWebRequest $request)
    {

        $date = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();

        $eleveId = sfContext::getInstance()->getUser()->getAttribute('eleve_id', $request->getParameter('id'));
        $this->eleve = Doctrine_core::getTable('Eleve')->find($eleveId);

		
	    //liste des transports alloués non traités pour l'élève
		//------------------------------------------------------
		$this->transport_alerte = Doctrine_Core::getTable('Transportobtenu')->TransportaTraiterEleve($eleveId);

        //historique des messages concernant l'élève
		//----------------------------------------
		$this->mails = Doctrine_Query::Create()
		        ->from('Mail m')
                ->where('m.eleve_id=?', $eleveId)
                ->andwhere('m.date >=?', $date->getDatedebutanneescolaire())
                ->andwhere('m.date <=?', $date->getDatefinanneescolaire())
				->limit(15)
				->orderBy('id Desc')
                ->fetcharray();
		 $this->existmails = count($this->mails);
		
        // 1) le tuteur
        //--------------
        $this->tuteurs = Doctrine_Query::Create()
		        ->select('t.*,t.tuteurlegal as tuteurlegal,ty.denomination as typeresp,r.nom as nom,r.prenom as prenom,r.tel1  as tel1,r.tel2 as tel2,r.email as email')
		        ->from('Tuteur t')
				->innerjoin('t.TypeResponsableEleve ty')
				->innerjoin('t.ResponsableEleve r')
				->where('t.eleve_id =?', $eleveId)
				->execute();
       
				//Scolarité en milieu ordinaire en cours dans l'année scolaire 
				//----------------------------------------------------------------
				$this->orientations = Doctrine_core::getTable('Orientation')->getDerSco($eleveId) ;  
   
				// Scolarité en milieu spécialisé
				//----------------------------------
				$this->modnonscos = Doctrine_core::getTable('Modnonsco')->getScoencour($eleveId) ;  

				
				//  demande sessad droit ouvert
				//--------------------------------
					$this->demande_sessads = Doctrine_core::getTable('DemandeSessad')->getDemandeSessaddroitouvert($eleveId) ;  
			  
				//  demande sessad en cours
				//--------------------------------
					$this->demande_sessads_cour = Doctrine_core::getTable('DemandeSessad')->getDemandeSessadencour($eleveId) ;
               
				// demande d'AVS droit ouvert
				//----------------------------
					$this->demande_avs = Doctrine_core::getTable('DemandeAvs')->getDemandeAVSdroitouvert($eleveId);
           
				// demande d'AVS en cours
				//-----------------------
				$this->demande_avs_cour = Doctrine_core::getTable('DemandeAvs')->getDemandeAVSencour($eleveId);

				// demande d'orientation droit ouvert
				//-----------------------------------
					$this->demande_orientation = Doctrine_core::getTable('DemandeOrientation')->getDemandeorientationdroitouvert($eleveId);

				 // demande d'orientation en cours
				//---------------------------------
				  $this->demande_orientation_cour = Doctrine_core::getTable('DemandeOrientation')->getDemandeorientationencour($eleveId);
					
				// demande materiel droit ouvert
				//--------------------------------
					$this->demande_materiel = Doctrine_core::getTable('DemandeMateriel')->getDemandematerieldroitouvertdiff($eleveId);
 			
				// demande materiel en cours
				//--------------------------------
					$this->demande_materiel_cour = Doctrine_core::getTable('DemandeMateriel')->getDemandematerielencour($eleveId);

				// demande transport droit ouvert
				//--------------------------------
				 $this->demande_transport= Doctrine_core::getTable('DemandeTransport')->getDemandetransportdroitouvert($eleveId);
  			
				// demande transport en cours
				//----------------------------
				$this->demande_transport_cour = Doctrine_core::getTable('DemandeTransport')->getDemandetransportencour($eleveId);
  
			   //suivi externe en cour
			   //-----------------------
					$this->suivi_externe_cour = Doctrine_core::getTable('SuivitExterne')->getSuiviexterneencourEleve($eleveId);
				
				//dernière reunion 
				//------------------
					$this->reunion = Doctrine_core::getTable('Reunion')->getDerReunion($eleveId);
				
				//liste des Sessad  pour l'élève selectionné
				//----------------------------------------------
					$this->sessad_alerte = Doctrine_Core::getTable('Sessadobtenu')->SessadaTraiterEleve($eleveId);
       
     
    }

/**
  * Executes getCommune action
  *
  * cette fonction sert à afficher la commune du quartier selectionné
  * 
  * @param sfRequest $request A request object
  */
    public function executeGetCommune(sfWebRequest $request)
    {
        $quartier = Doctrine_Core::getTable('Quartier')->find($request->getParameter('quartier_id'));
        $commune = $quartier ? $quartier->getCommune() : '';
        return $this->renderPartial('eleve/getCommune', array('commune' => $commune));
    }
    
    
     /**
  * Executes show action
  *
  * @param sfRequest $request A request object
  */
  
    public function executeShow(sfWebRequest $request)
    {
        $this->forward404Unless($eleve = Doctrine_Core::getTable('Eleve')->find(array($request->getParameter('id'))), sprintf('cet eleve n\'existe pas (%s).', $request->getParameter('id')));
    }

 /**
  * Executes new action
  *
  * @param sfRequest $request A request object
  */
    public function executeNew(sfWebRequest $request)
    {
        // je commence par récupérer le secteur de l'utilisateur connecté.
		//----------------------------------------------------------------
     
	/*   $q = Doctrine_Query::create()
                ->select('s.id')
                ->from('Secteur s')
                ->where('s.sfguarduser_id=?', $this->getUser()->getGuardUser()->getId())
                ->execute();

		//recherche du secteur ND pour création élève par le gestionnaire Académique
	    ///////////////////////////////////////////////////////////////////////////
		if($request->getParameter('academie'))
        { 
	    $secteur = Doctrine_Query::create()
                ->select('s.id')
                ->from('Secteur s')
                ->where('s.libellesecteur LIKE?', 'ND')
                ->execute();
		}
		*/
         //recherche du dernier id de l'élève
		 //------------------------------------
        $req = Doctrine_Query::create()
                ->select('max(e.id) as maxId')
                ->from('Eleve e')
                ->fetcharray();
				
		//$eleve_id = $req[0]['maxId'] + 20000 ;
		$eleve_id = $req[0]['maxId'] + 1 ;
		
		
        
        // on attribue le secteur de l'utilisateur (eref) à l'eleve qui est crée si création par l'ERF
        if(!$request->getParameter('academie'))
        { 		
        $secteur=$q['0'];
		}
		
		
		//on attribue le secteur ND si création par le gestionnaire académique
		 if($request->getParameter('academie'))
        { 
        $secteur = $secteur['0'];		
        
		}
		
		//on initialise l'INE avec n°enregistrement  + 1
		$eleve = new Eleve();
		$eleve->setSecteur($secteur);
		$eleve->setIne($eleve_id);
		$eleve->setNumeromdph($eleve_id);
		//$eleve->setsexe('G');
        $this->form = new EleveForm($eleve);
    }

 /**
  * Executes create action
  *
  * @param sfRequest $request A request object
  */
    public function executeCreate(sfWebRequest $request)
    {

        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EleveForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

 /**
  * Executes edit action
  *
  * @param sfRequest $request A request object
  */
    public function executeEdit(sfWebRequest $request)
    {
	//	$Id_user = $this->getUser()->getGuardUser()->getId();
		//groupe du user
		//$q = $this->getUser()->getPermissions();
      //  $this->forward404Unless($eleve = Doctrine_Core::getTable('Eleve')->find(array($request->getParameter('id'))), sprintf('cet eleve n\'existe pas (%s).', $request->getParameter('id')));
		
       // $secteur_eleve = $eleve->getSecteurId();
		$secteur_user = Doctrine_Query::create()
                ->select('s.id as secteur_id,sfguarduser_id as sfguarduser_id  ')
                ->from('Secteur s')
				->where('sfguarduser_id = ?',$Id_user)
                ->fetchArray();
		

		
		 if($q[0]=='acad')
        { 	
		// --------- PASSAGE DU SECTEUR SUR ACAD ------------------------
		$this->getUser()->setAttribute('secteur', $eleve->getSecteur());
		$this->getUser()->setFlash('notice', 'vous êtes sur le secteur de '.$this->getUser()->getAttribute('secteur'));

		// --------------------------------------------------------------
		}else if($secteur_user[0]['secteur_id'] != $secteur_eleve && $q[0]=='eref')
		{
			$this->getUser()->setFlash('error', 'vous êtes sur le secteur de '.$this->getUser()->getAttribute('secteur').', vous ne pouvez pas consulter les élèves du secteur   

			'.$eleve->getSecteur() );
            $this->redirect('eleve/listeEleve?secteur='.$secteur_user[0]['secteur_id'] );
		}
		
		
		//contrôle scolarité ordinaire en cours
		$scolarite_en_cours = Doctrine::getTable('Orientation')->getDerSco($request->getParameter('id'));
		$this->count_scolarite_en_cours = count($scolarite_en_cours );
		
		//contrôle scolarité spé en cours
		$scolarite_spe_en_cours = Doctrine::getTable('Modnonsco')->getScoencour($request->getParameter('id'));
		$this->count_scolarite_spe_en_cours = count($scolarite_spe_en_cours );
		
        //contrôle sessad obtenu à compléter		
		$sessad_alerte = Doctrine_Core::getTable('Sessadobtenu')->SessadaTraiterEleve($request->getParameter('id'));
		$this->count_sessad_alerte = count($sessad_alerte);
		
		$transport_alerte = Doctrine_Core::getTable('Transportobtenu')->TransportaTraiterEleve($request->getParameter('id'));
		$this->count_transport_alerte = count($transport_alerte);
		
        $this->chapeau = Doctrine::getTable('Eleve')->findOneById($request->getParameter('id'))->getIne() . " " . Doctrine::getTable('Eleve')->findOneById($request->getParameter('id'))->getNom() . " " . Doctrine::getTable('Eleve')->findOneById($request->getParameter('id'))->getPrenom();
        $this->form = new EleveForm($eleve );

    }

 /**
  * Executes update action
  *
  * @param sfRequest $request A request object
  */
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($eleve = Doctrine_Core::getTable('Eleve')->find(array($request->getParameter('id'))), sprintf('cet élève n\'existe pas (%s).', $request->getParameter('id')));
        $this->form = new EleveForm($eleve);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

 /**
  * Executes delete action
  *
  * @param sfRequest $request A request object
  */
    public function executeDelete(sfWebRequest $request)
    {
        $request->checkCSRFProtection();

        $this->forward404Unless($eleve = Doctrine_Core::getTable('Eleve')->find(array($request->getParameter('id'))), sprintf(' cet élève n\'existe pas (%s).', $request->getParameter('id')));
        $eleve->delete();
        $this->getUser()->setFlash('notice', sprintf('l\'eleve à été correctement effacé!'));
        $this->redirect('eleve/index');
    }

	
	 /**
  * Executes confirm action
  *
  * @param sfRequest $request A request object
  */
    public function executeConfirm(sfWebRequest $request)
    {
				$this->eleves = Doctrine_Query::create()
                ->select('e.id as eleve_id,t.id as typetab_Id,et.id as EtabId,em.eleve_id as em_eleve_id,e.nom as nom,e.prenom as prenom,s.libellesecteur as libellesecteur,s.id as secteur_id,
				e.datenaissance as datenaissance,o.id as orientId')
                ->from('Eleve e')
                ->leftjoin('e.Secteur s ON s.id = e.secteur_id')
				->leftjoin('e.Orientation o ON e.id = o.eleve_id')
				->leftJoin('e.Eleves em ON e.id = em.eleve_id') // table élève_matériel
				->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->leftjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
			//	->andWhere('e.datesortie IS NULL')
				//->andwhere ('e.id =?', $request->getParameter('eleve_id'))
				->where('e.nom LIKE ?',$request->getParameter('eleve_nom'))
				->andwhere('e.datenaissance = ?',$request->getParameter('datenaissance'))
                ->orderBy('s.libellesecteur,e.nom')
                ->addOrderBy('e.nom')
                ->fetchArray();
				
	}
	
	 /**
  * ProcessForm action
  *
  * @param sfRequest $request A request object
  * @param sfForm $form a form object
  */
    protected function processForm(sfWebRequest $request, sfForm $form)
    {

        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
		
		//récupération des valeurs saisies avant sauvegarde
        //---------------------------------------------------------	 
		$nom = $form->getValue('nom');
		$datenaissance = $form->getValue('datenaissance');
		$numeromdph = $form->getValue('numeromdph');
		$numeromdph = $form->getValue('numeromdph');
		
		//recherche si numéro mdph existe déjà si $numeromdph est renseigné
		//------------------------------------------------------------------
	/*	if($numeromdph){
		      $req1 = Doctrine_Query::create()
                ->select('e.nom as nom,e.prenom as prenom,e.datenaissance as datenaissance,s.libellesecteur as libellesecteur')
                ->from('Eleve e')
				->innerjoin('e.Secteur s on s.id = e.secteur_id')
				->where('e.numeromdph =?',$numeromdph)
				->andwhere('e.nom !=?',$nom)
                ->fetcharray();
				$nbnumeromdph = count($req1);
			
		}
		
		if($nbnumeromdph > 0){
		 $this->getUser()->setFlash('error', '  n° MDPH identique pour l\'élève '.$req1[0]['nom'].' '.$req1[0]['prenom'].' né(e) le '.date('d-m-Y',strtotime($req1[0]['datenaissance'])).' secteur '.$req1[0]['libellesecteur']);
		// $this->redirect('eleve/edit?id=' . $form->getobject()->getId());
		}
		*/
		if ($form->isNew()){
		

         //recherche des aumonymes (nom + date de naissance)
		 //----------------------------------------------
        $req = Doctrine_Query::create()
                ->select('*')
                ->from('Eleve e')
				->where('e.nom LIKE ?',$nom)
				->andwhere('e.datenaissance = ?',$datenaissance)
                ->fetcharray();
				$nbeleve = count($req );
				
			 if ($nbeleve > 0 ) {
	        // $this->getUser()->setFlash('notice', sprintf('il existe déja un élève avec le Nom  :'). $nom.' né(e) le '.$datenaissance. 'enregistrement sauvegardée');
			// $this->redirect('eleve/confirm?&eleve_nom='.$nom.'&datenaissance='.$datenaissance);
			 $message = 'il existe déja un élève avec le Nom  :'. $nom.' né(e) le '.date('d-m-Y',strtotime($datenaissance)). ' , enregistrement sauvegardé' ;
			 }else {
			 $message = 'enregistrement sauvegardé'; 
			 }
		 } //nouvel élève
            $eleve = $form->save();
            $this->getUser()->setFlash('succes', $message);
			if (!$form->isNew()){
			$this->getUser()->setFlash('succes', 'Modification(s) Fiche Elève enregistrée(s) avec succès');
			}
				if ($form->isNew()){
				$this->getUser()->setFlash('succes', 'Fiche Elève créée avec succès');
				}
            $this->redirect('eleve/edit?id=' . $form->getobject()->getId().'#div_eleve');
			
			 
        }else{
		$this->getUser()->setFlash('error', sprintf('erreur de saisie'));
		//$eleve = new Eleve();
		//$eleve->setNom($nom);
        //$eleve->setDatenaissance($datenaissance);
        //$this->form = new EleveForm($eleve);
		//$this->redirect('eleve/new');
		}
    }
	
	
	 private function createObjectExcel()
    {
        $this->setLayout(false);
        $secteur = $this->getUser()->getAttribute('secteur');
        //$secteur = Doctrine_Core::getTable('Secteur')->find(1);
         $objPhpExcel = new PHPExcel();
        $anneeSco = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $objPhpExcel->setActiveSheetIndex(0);
        $sheet = $objPhpExcel->getActiveSheet();

        PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
        // Les largeurs des colonnes
        $this->setColumnWidth($objPhpExcel);
        // Le titre
        $this->titreRender($objPhpExcel, 'Situation des élèves du secteur (secteur : ' . $secteur->getLibellesecteur() . ') ' . $anneeSco->__toString());
        // Entete
            $this->setLayout(false);
     // initialisation du secteur
	  	$secteur = $this->getUser()->getAttribute('secteur'); // passé dans le module menu 
	 	 
	  		
 
		//liste des élèves du secteur
		//-----------------------------
	   	$eleves =  $this->eleves = Doctrine::getTable('Eleve')->getListElevesparSecteurGenerale($secteur->getId());

			  
			   
        $objPhpExcel = new PHPExcel();
        $anneeSco = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $objPhpExcel->setActiveSheetIndex(0);
        $sheet = $objPhpExcel->getActiveSheet();

        PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
        // Les largeurs des colonnes
        $this->setColumnWidth($objPhpExcel);
        // Le titre
        $this->titreRender($objPhpExcel, 'Liste des élèves  (secteur : ' . $secteur->getLibellesecteur() . ') ');

   
        $ligne = 2;
		$colonne = 1;
		//ligne entête
        //----------------
		        $this->celluleRender($objPhpExcel, 'A' . $ligne,'n° élève', null);
                $this->celluleRender($objPhpExcel, 'B' . $ligne, 'Nom', null);
                $this->celluleRender($objPhpExcel, 'C' . $ligne, 'Prénom', null);
                $this->celluleRender($objPhpExcel, 'D' . $ligne, 'date de Naissance', 'center');
				$this->celluleRender($objPhpExcel, 'E' . $ligne, 'sexe', null);
				
				//scolarité
				$this->celluleRender($objPhpExcel, 'F' . $ligne, 'Scolarité', null); 
				$this->celluleRender($objPhpExcel, 'G' . $ligne, 'Rne', null);
				$this->celluleRender($objPhpExcel, 'H' . $ligne,'Classe', null);
				$this->celluleRender($objPhpExcel, 'I' . $ligne,'Niveau sco.', null);
				
				//scolarité en milieu spé
				$this->celluleRender($objPhpExcel, 'J' . $ligne, 'Scolarité externe', null); 
				$this->celluleRender($objPhpExcel, 'K' . $ligne,'Classe scolarité externe', null);
				$this->celluleRender($objPhpExcel, 'L' . $ligne,'Date de début scolarité externe', null);
				$this->celluleRender($objPhpExcel, 'M' . $ligne,'Date de fin scolarité externe', null);
				
				//demande d'avs notifiée
				$this->celluleRender($objPhpExcel, 'N' . $ligne,'Demande d\'acc  notifiée :quotité horaire notifié', null);
				$this->celluleRender($objPhpExcel, 'O' . $ligne,'Demande d\'acc notifiée : date décision CDA', null);
				$this->celluleRender($objPhpExcel, 'P' . $ligne,'Demande d\'acc  notifiée : date de début de notification', null);
				$this->celluleRender($objPhpExcel, 'Q' . $ligne,'Demande d\'acc  notifiée : date de fin de notification', null);
				$this->celluleRender($objPhpExcel, 'R' . $ligne,'Demande d\'acc  notifiée : type AVS', null);
				
				//acc. 1 affecté
				$this->celluleRender($objPhpExcel, 'S' . $ligne,'Accompagnement1 notifiée ', null);
				$this->celluleRender($objPhpExcel, 'T' . $ligne,'Accompagnement1 notifiée :début de prise en charge ', null);
				$this->celluleRender($objPhpExcel, 'U' . $ligne,'Accompagnement1 notifiée :fin de de prise en charge ', null);
				$this->celluleRender($objPhpExcel, 'V' . $ligne,'Acc1 quotité horaire ', null);
				
				//acc. 2 affecté
				$this->celluleRender($objPhpExcel, 'W' . $ligne,'Accompagnement2 notifiée ', null);
				$this->celluleRender($objPhpExcel, 'X' . $ligne,'Accompagnement2 notifiée : début de prise en charge ', null);
				$this->celluleRender($objPhpExcel, 'Y' . $ligne,'Accompagnement2 notifiée : fin de de prise en charge ', null);
				$this->celluleRender($objPhpExcel, 'Z' . $ligne,'Acc2 quotité horaire ', null);
				
				//demande mat 1
				$this->celluleRender($objPhpExcel, 'AA' . $ligne,'Demande de matériel notifiée : date de décision de la CDA', null);
				$this->celluleRender($objPhpExcel, 'AB' . $ligne,'Demande de matériel notifiée : Type matériel', null);
				$this->celluleRender($objPhpExcel, 'AC' . $ligne,'Demande de matériel notifiée : date de début de notification', null);
				$this->celluleRender($objPhpExcel, 'AD' . $ligne,'Demande de matériel notifiée : date de fin de notification', null);
				
				//demande mat 2
        		$this->celluleRender($objPhpExcel, 'AE' . $ligne,'Demande de matériel notifiée :date de décision de la CDA', null);
				$this->celluleRender($objPhpExcel, 'AF' . $ligne,'Demande de matériel notifiée : Type matériel', null);
				$this->celluleRender($objPhpExcel, 'AG' . $ligne,'Demande de matériel notifiée : date de début de notification', null);
				$this->celluleRender($objPhpExcel, 'AH' . $ligne,'Demande de matériel notifiée : date de fin de notification', null);
				
	            //demande mat 3
				$this->celluleRender($objPhpExcel, 'AI' . $ligne,'Demande de matériel notifiée :date de décision de la CDA', null);
				$this->celluleRender($objPhpExcel, 'AJ' . $ligne,'Demande de matériel notifiée : Type matériel', null);
				$this->celluleRender($objPhpExcel, 'AK' . $ligne,'Demande de matériel notifiée : date de début de notification', null);
				$this->celluleRender($objPhpExcel, 'AL' . $ligne,'Demande de matériel notifiée : date de fin de notification', null);
				 //demande mat 4
                $this->celluleRender($objPhpExcel, 'AM' . $ligne,'Demande de matériel notifiée :date de décision de la CDA', null);
				$this->celluleRender($objPhpExcel, 'AN' . $ligne,'Demande de matériel notifiée : Type matériel', null);
				$this->celluleRender($objPhpExcel, 'AO' . $ligne,'Demande de matériel notifiée : date de début de notification', null);
				$this->celluleRender($objPhpExcel, 'AP' . $ligne,'Demande de matériel notifiée : date de fin de notification', null);
				
				//matériel alloué 1
				$this->celluleRender($objPhpExcel, 'AQ' . $ligne,'Matériel alloué : numéro', null);
				$this->celluleRender($objPhpExcel, 'AR' . $ligne,'Matériel alloué : Libéllé', null);
				$this->celluleRender($objPhpExcel, 'AS' . $ligne,'Matériel alloué : Marque', null);
				$this->celluleRender($objPhpExcel, 'AT' . $ligne,'Matériel alloué : Catégorie', null);
				$this->celluleRender($objPhpExcel, 'AU' . $ligne,'Matériel alloué : début prêt', null);
				$this->celluleRender($objPhpExcel, 'AV' . $ligne,'Matériel alloué : fin du prêt', null);
				
				//matériel alloué 2
				$this->celluleRender($objPhpExcel, 'AW' . $ligne,'Matériel alloué : numéro', null);
				$this->celluleRender($objPhpExcel, 'AX' . $ligne,'Matériel alloué : Libéllé', null);
				$this->celluleRender($objPhpExcel, 'AY' . $ligne,'Matériel alloué : Marque', null);
				$this->celluleRender($objPhpExcel, 'AZ' . $ligne,'Matériel alloué : Catégorie', null);
				$this->celluleRender($objPhpExcel, 'BA' . $ligne,'Matériel alloué : début prêt', null);
				$this->celluleRender($objPhpExcel, 'BB' . $ligne,'Matériel alloué : fin du prêt', null);
				
				//matériel alloué 3
				$this->celluleRender($objPhpExcel, 'BC' . $ligne,'Matériel alloué : numéro', null);
				$this->celluleRender($objPhpExcel, 'BD' . $ligne,'Matériel alloué : Libéllé', null);
				$this->celluleRender($objPhpExcel, 'BE' . $ligne,'Matériel alloué : Marque', null);
				$this->celluleRender($objPhpExcel, 'BF' . $ligne,'Matériel alloué : Catégorie', null);
				$this->celluleRender($objPhpExcel, 'BG' . $ligne,'Matériel alloué : début prêt', null);
				$this->celluleRender($objPhpExcel, 'BH' . $ligne,'Matériel alloué : fin du prêt', null);
				
				//matériel alloué 4
				$this->celluleRender($objPhpExcel, 'BI' . $ligne,'Matériel alloué : numéro', null);
				$this->celluleRender($objPhpExcel, 'BJ' . $ligne,'Matériel alloué : Libéllé', null);
				$this->celluleRender($objPhpExcel, 'BK' . $ligne,'Matériel alloué : Marque', null);
				$this->celluleRender($objPhpExcel, 'BL' . $ligne,'Matériel alloué : Catégorie', null);
				$this->celluleRender($objPhpExcel, 'BM' . $ligne,'Matériel alloué : début prêt', null);
				$this->celluleRender($objPhpExcel, 'BN' . $ligne,'Matériel alloué : fin du prêt', null);
				
				
				//demande sessad notifiée
                $this->celluleRender($objPhpExcel, 'BO' . $ligne,'Demande de Sessad notifiée : date de décision de la CDA', null);
				$this->celluleRender($objPhpExcel, 'BP' . $ligne,'Demande de Sessad notifiée : Type Sessad', null);
				$this->celluleRender($objPhpExcel, 'BQ' . $ligne,'Demande de Sessad notifiée : date de début de notification', null);
				$this->celluleRender($objPhpExcel, 'BR' . $ligne,'Demande de Sessad notifiée : date de fin de notification', null);
				
				//demande de transport notifiée
                $this->celluleRender($objPhpExcel, 'BS' . $ligne,'Demande de Transport notifiée : date de décision de la CDA', null);
				$this->celluleRender($objPhpExcel, 'BT' . $ligne,'Demande de Transport notifiée : Type Transport', null);
				$this->celluleRender($objPhpExcel, 'BU' . $ligne,'Demande de Transport notifiée : date de début de notification', null);
				$this->celluleRender($objPhpExcel, 'BV' . $ligne,'Demande de Transport notifiée : date de fin de notification', null);
				
		foreach ($eleves as $eleve) {
		
				//dernière scolarisation de l'élève en cours à la date du jour
				//--------------------------------------------------------------
				$dersco = Doctrine_Core::getTable('Orientation')->getDerSco($eleve['eleveId']);
				$count_dersco = count($dersco);
		
				// Scolarité en milieu spécialisé
				//----------------------------------
				$modnonscos = Doctrine_core::getTable('Modnonsco')->getDerModnonSco($eleve['eleveId']) ; 
			
				//dernier accompagnement notifiée de l'élève  à la date du jour
				//---------------------------------------------------------------------
				$eleve_avs = Doctrine_Core::getTable('EleveAvs')->getEleveAcc($eleve['eleveId']);
				$count_avs = count($eleve_avs);
		    
				//liste des demandes  AVS notifiée à la date du jour pour l'élève selectionné
				//-----------------------------------------------------------------------
				$dem_avs = Doctrine_Core::getTable('DemandeAvs')->getListDerDemandeAcc($eleve['eleveId']);
				$count_dem_avs = count($dem_avs);
				
				//Liste des  demandes matériel notifiée à la date du jour pour l'élève selectionné
				//---------------------------------------------------------------------------------
				$dem_mat = Doctrine_Core::getTable('DemandeMateriel')->getDerDemandeMat($eleve['eleveId']);
				$count_dem_mat = count($dem_mat);
				
			    //Liste des  demandes matériel notifiée à la date du jour pour l'élève selectionné
				//---------------------------------------------------------------------------------
				$eleve_mat = Doctrine_Core::getTable('EleveMateriel')->getListMaterielencoursEleve($eleve['eleveId']);
				$count_eleve_mat = count($eleve_mat);
				
				// demande sessad droit ouvert
				//--------------------------------
				$demande_sessads = Doctrine_core::getTable('DemandeSessad')->getDemandeSessaddroitouvert($eleve['eleveId']) ;  
			  
				// demande transport droit ouvert
				//--------------------------------
				 $demande_transport= Doctrine_core::getTable('DemandeTransport')->getDemandetransportdroitouvert($eleve['eleveId']);
			  
                $ligne++;
                // Preparation de données

                // Couleur de fond de cellule
                $couleurFond = $ligne % 2 == 0 ? 'FFD7E4BC' : 'FFEAF1DD';
                $sheet->getStyle('A' . $ligne . ':I' . $ligne)->getFill() //ligne avec fond de couleur
                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($couleurFond);
			$couleurFond = $ligne % 2 == 0 ? 'FFFFFF00':'FFF2F5A9';
                $sheet->getStyle('J' . $ligne . ':M' . $ligne)->getFill() //ligne avec fond de couleur
                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($couleurFond);
                // Preparation des cellules
                $this->celluleRender($objPhpExcel, 'A' . $ligne, $eleve['ine'], 'center');
                $this->celluleRender($objPhpExcel, 'B' . $ligne, $eleve['nom'], null);
                $this->celluleRender($objPhpExcel, 'C' . $ligne, $eleve['prenom'], null);
                $this->celluleRender($objPhpExcel, 'D' . $ligne, $eleve['datenaissance'], 'center');
				$this->celluleRender($objPhpExcel, 'E' . $ligne, $eleve['sexe'], null);
				$this->celluleRender($objPhpExcel, 'F' . $ligne, $dersco[0]['typetab'].' - '.$dersco[0]['nometabsco'], null); 
				$this->celluleRender($objPhpExcel, 'G' . $ligne, $dersco[0]['rne'], null);
				$this->celluleRender($objPhpExcel, 'H' . $ligne, $dersco[0]['nomtypeclasse'], null);
				$this->celluleRender($objPhpExcel, 'I' . $ligne, $dersco[0]['nomniveauscolaire'], null);
				
				//scolarité en milieu spé
				$this->celluleRender($objPhpExcel, 'J' . $ligne, $modnonscos[0]['nometabnonsco'], null); 
				$this->celluleRender($objPhpExcel, 'K' . $ligne, $modnonscos[0]['libelle_classe_spe'], null);
				$this->celluleRender($objPhpExcel, 'L' . $ligne, $modnonscos[0]['datedebut'], null);
				$this->celluleRender($objPhpExcel, 'M' . $ligne, $modnonscos[0]['datefin'], null);
				
				//dernière demande d'AVS notifiée à la date du jour
				$this->celluleRender($objPhpExcel, 'N' . $ligne, $dem_avs[0]['quotitehorrairenotifie'], null);
				$this->celluleRender($objPhpExcel, 'O' . $ligne,$dem_avs[0]['datedecisioncda'], null);
				$this->celluleRender($objPhpExcel, 'P' . $ligne,$dem_avs[0]['datedebutnotif'], null);
				$this->celluleRender($objPhpExcel, 'Q' . $ligne,$dem_avs[0]['datefinnotif'], null);
				$this->celluleRender($objPhpExcel, 'R' . $ligne,$dem_avs[0]['naturecontrat'], null);
				
				//accompagnement notifiée 1
				$this->celluleRender($objPhpExcel, 'S' . $ligne, $eleve_avs[0]['avsnom'].' '. $eleve_avs[0]['avsprenom'], null);
				$this->celluleRender($objPhpExcel, 'T' . $ligne,$eleve_avs[0]['datedebut'], null);
				$this->celluleRender($objPhpExcel, 'U' . $ligne,$eleve_avs[0]['datefin'], null);
				$this->celluleRender($objPhpExcel, 'V' . $ligne,$eleve_avs[0]['quotitehorraireavs'], null);
				
				//accompagnement notifiée 2
				$this->celluleRender($objPhpExcel, 'W' . $ligne, $eleve_avs[1]['avsnom'].' '. $eleve_avs[1]['avsprenom'], null);
				$this->celluleRender($objPhpExcel, 'X' . $ligne,$eleve_avs[1]['datedebut'], null);
				$this->celluleRender($objPhpExcel, 'Y' . $ligne,$eleve_avs[1]['datefin'], null);
				$this->celluleRender($objPhpExcel, 'Z' . $ligne,$eleve_avs[1]['quotitehorraireavs'], null);
				
				//matériel demandé notifiée 1
				$this->celluleRender($objPhpExcel, 'AA' . $ligne,$dem_mat[0]['datedecisioncda'], null);
				$this->celluleRender($objPhpExcel, 'AB' . $ligne,$dem_mat[0]['libellecatmateriel'], null);
				$this->celluleRender($objPhpExcel, 'AC' . $ligne,$dem_mat[0]['datedebutnotif'], null);
				$this->celluleRender($objPhpExcel, 'AD' . $ligne,$dem_mat[0]['datefinnotif'], null);
				
				//matériel demandé notifiée 2
				$this->celluleRender($objPhpExcel, 'AE' . $ligne,$dem_mat[1]['datedecisioncda'], null);
				$this->celluleRender($objPhpExcel, 'AF' . $ligne,$dem_mat[1]['libellecatmateriel'], null);
				$this->celluleRender($objPhpExcel, 'AG' . $ligne,$dem_mat[1]['datedebutnotif'], null);
				$this->celluleRender($objPhpExcel, 'AH' . $ligne,$dem_mat[1]['datefinnotif'], null);
				
				//matériel demandé notifiée 3
				$this->celluleRender($objPhpExcel, 'AI' . $ligne,$dem_mat[2]['datedecisioncda'], null);
				$this->celluleRender($objPhpExcel, 'AJ' . $ligne,$dem_mat[2]['libellecatmateriel'], null);
				$this->celluleRender($objPhpExcel, 'AK' . $ligne,$dem_mat[2]['datedebutnotif'], null);
				$this->celluleRender($objPhpExcel, 'AL' . $ligne,$dem_mat[2]['datefinnotif'], null);
				
				//matériel demandé notifiée 4
				$this->celluleRender($objPhpExcel, 'AM' .  $ligne,$dem_mat[3]['datedecisioncda'], null);
				$this->celluleRender($objPhpExcel, 'AN' . $ligne,$dem_mat[3]['libellecatmateriel'], null);
				$this->celluleRender($objPhpExcel, 'AO' . $ligne,$dem_mat[3]['datedebutnotif'], null);
				$this->celluleRender($objPhpExcel, 'AP' . $ligne,$dem_mat[3]['datefinnotif'], null);
				
				//matériel alloué 1
				$this->celluleRender($objPhpExcel, 'AQ' . $ligne,$eleve_mat[0]['numeroMateriel'], null);
				$this->celluleRender($objPhpExcel, 'AR' . $ligne,$eleve_mat[0]['libelleMateriel'], null);
				$this->celluleRender($objPhpExcel, 'AS' . $ligne,$eleve_mat[0]['libellemarque'], null);
				$this->celluleRender($objPhpExcel, 'AT' . $ligne,$eleve_mat[0]['libellecatmateriel'], null);
				$this->celluleRender($objPhpExcel, 'AU' . $ligne,$eleve_mat[0]['datedebut'], null);
				$this->celluleRender($objPhpExcel, 'AV' . $ligne,$eleve_mat[0]['datefin'], null);
				
				
				//matériel alloué 2
				$this->celluleRender($objPhpExcel, 'AW' . $ligne,$eleve_mat[1]['numeroMateriel'], null);
				$this->celluleRender($objPhpExcel, 'AX' . $ligne,$eleve_mat[1]['libelleMateriel'], null);
				$this->celluleRender($objPhpExcel, 'AY' . $ligne,$eleve_mat[1]['libellemarque'], null);
				$this->celluleRender($objPhpExcel, 'AZ' . $ligne,$eleve_mat[1]['libellecatmateriel'], null);
				$this->celluleRender($objPhpExcel, 'BA' . $ligne,$eleve_mat[1]['datedebut'], null);
				$this->celluleRender($objPhpExcel, 'BB' . $ligne,$eleve_mat[1]['datefin'], null);
				
				//matériel alloué 3
				$this->celluleRender($objPhpExcel, 'BC' . $ligne,$eleve_mat[2]['numeroMateriel'], null);
				$this->celluleRender($objPhpExcel, 'BD' . $ligne,$eleve_mat[2]['libelleMateriel'], null);
				$this->celluleRender($objPhpExcel, 'BE' . $ligne,$eleve_mat[2]['libellemarque'], null);
				$this->celluleRender($objPhpExcel, 'BF' . $ligne,$eleve_mat[2]['libellecatmateriel'], null);
				$this->celluleRender($objPhpExcel, 'BG' . $ligne,$eleve_mat[2]['datedebut'], null);
				$this->celluleRender($objPhpExcel, 'BH' . $ligne,$eleve_mat[2]['datefin'], null);
				
				//matériel alloué 4
				$this->celluleRender($objPhpExcel, 'BI' . $ligne,$eleve_mat[3]['numeroMateriel'], null);
				$this->celluleRender($objPhpExcel, 'BJ' . $ligne,$eleve_mat[3]['libelleMateriel'], null);
				$this->celluleRender($objPhpExcel, 'BK' . $ligne,$eleve_mat[3]['libellemarque'], null);
				$this->celluleRender($objPhpExcel, 'BL' . $ligne,$eleve_mat[3]['libellecatmateriel'], null);
				$this->celluleRender($objPhpExcel, 'BM' . $ligne,$eleve_mat[3]['datedebut'], null);
				$this->celluleRender($objPhpExcel, 'BN' . $ligne,$eleve_mat[3]['datefin'], null);
				
				//demande sessad notifiée 
				$this->celluleRender($objPhpExcel, 'BO' .  $ligne,$demande_sessad[0]['datedecisioncda'], null);
				$this->celluleRender($objPhpExcel, 'BP' . $ligne,$demande_sessad[0]['libelletypesessad'], null);
				$this->celluleRender($objPhpExcel, 'BQ' . $ligne,$demande_sessad[0]['datedebutnotif'], null);
				$this->celluleRender($objPhpExcel, 'BR' . $ligne,$demande_sessad[0]['datefinnotif'], null);
				
				//demande transport notifiée 
				$this->celluleRender($objPhpExcel, 'BS' .  $ligne,$demande_transport[0]['datedecisioncda'], null);
				$this->celluleRender($objPhpExcel, 'BT' . $ligne,$demande_transport[0]['libelletransport'], null);
				$this->celluleRender($objPhpExcel, 'BU' . $ligne,$demande_transport[0]['datedebutnotif'], null);
				$this->celluleRender($objPhpExcel, 'BV' . $ligne,$demande_transport[0]['datefinnotif'], null);
				
				
                // Transformation des cellules au format date français
                $sheet->getStyle('D' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('O' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('J' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('K' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('L' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('M' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('O' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('P' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
			    $sheet->getStyle('Q' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('T' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('U' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('X' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('Y' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AA' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AC' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AD' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AE' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AG' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AH' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AI' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AK' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AL' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AM' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AO' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AP' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AU' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('AV' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BA' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BB' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BG' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BH' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BM' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BN' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BQ' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BR' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BU' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('BV' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
                $this->celluleRender($objPhpExcel, 'E' . $ligne, $eleve['sexe'], 'center');
          

        }
      
        //Page setup
        $sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        $sheet->getPageSetup()->setHorizontalCentered(true);
        $sheet->getPageSetup()->setVerticalCentered(false);
        // Les marges
        $sheet->getPageMargins()->setTop(0.25);
        $sheet->getPageMargins()->setRight(0.25);
        $sheet->getPageMargins()->setLeft(0.25);
        $sheet->getPageMargins()->setBottom(0.25);
        return $objPhpExcel;
    }

    private function setColumnWidth(PHPExcel $objPhpExcel)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(18);
        $sheet->getColumnDimension('C')->setWidth(18);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(14);
        $sheet->getColumnDimension('G')->setWidth(11);
        $sheet->getColumnDimension('H')->setWidth(14);
        $sheet->getColumnDimension('I')->setWidth(14);
        $sheet->getColumnDimension('J')->setWidth(14);
        $sheet->getColumnDimension('K')->setWidth(14);
        $sheet->getColumnDimension('L')->setWidth(14);
    }

    private function titreRender(PHPExcel $objPhpExcel, $titre)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $sheet->mergeCells('A1:L1');
        $sheet->getStyle('A1')->getFont()->setName('Cambria');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(18);
        $sheet->getStyle('A1')->getFont()->getColor()->setARGB('FF1F497D');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('A1', $titre);
    }

    private function etabRender(PHPExcel $objPhpExcel, $noLigne, $nomEtab)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $etabStyle = array(
            'font' => array(
                'bold' => true,
                'name' => 'Arial',
                'size' => 12,
                'color' => array('argb' => 'FF1F497D'),
            ),
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FF1F497D')
                )
            )
        );
        $sheet->mergeCells('A' . $noLigne . ':L' . $noLigne);
        $sheet->getStyle('A' . $noLigne . ':L' . $noLigne)->applyFromArray($etabStyle);
        $sheet->setCellValue('A' . $noLigne, 'Etablissement : ' . $nomEtab);
    }

    private function classeRender(PHPExcel $objPhpExcel, $noLigne, $nomClasse)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $classeStyle = array(
            'font' => array(
                'bold' => true,
                'name' => 'Arial',
                'size' => 11,
                'color' => array('argb' => 'FF1F497D'),
            ),
        );
        $sheet->mergeCells('A' . $noLigne . ':L' . $noLigne);
        $sheet->getStyle('A' . $noLigne)->applyFromArray($classeStyle);
        $sheet->setCellValue('A' . $noLigne, 'Classe : ' . $nomClasse);
    }

    private function enteteRender(PHPExcel $objPhpExcel, $noLigne)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $enteteStyle = array(
            'font' => array(
                'bold' => true,
                'name' => 'Arial',
                'size' => 10,
                'color' => array('argb' => '00000000'),
            ),
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFFFFFF')
                ),
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FFFFFFFF')
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FFFFFFFF')
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FFFFFFFF')
                ),
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'argb' => 'FF98B957'
                )
            )
        );
        $sheet->getRowDimension($noLigne)->setRowHeight(30);
        $sheet->setCellValue('A' . $noLigne, 'INE');
        $sheet->getStyle('A' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('B' . $noLigne, 'NOM');
        $sheet->getStyle('B' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('C' . $noLigne, 'PRENOM');
        $sheet->getStyle('C' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('D' . $noLigne, 'DATE DE NAISSANCE');
        $sheet->getStyle('D' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('E' . $noLigne, 'SEXE');
        $sheet->getStyle('E' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('F' . $noLigne, 'DATE D\'ENVOI DOSSIER');
        $sheet->getStyle('F' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('G' . $noLigne, 'CLASSE INCLUSION');
        $sheet->getStyle('G' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('H' . $noLigne, 'TRANSPORT');
        $sheet->getStyle('H' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('I' . $noLigne, 'AVS');
        $sheet->getStyle('I' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('J' . $noLigne, 'SESSAD');
        $sheet->getStyle('J' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('K' . $noLigne, 'MATERIEL');
        $sheet->getStyle('K' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('L' . $noLigne, 'AUTRES SUIVIS');
        $sheet->getStyle('L' . $noLigne)->applyFromArray($enteteStyle);
    }

    private function celluleRender(PHPExcel $objPhpExcel, $cellule, $value, $alignement)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $alignement = $alignement == 'center' ? PHPExcel_Style_Alignment::HORIZONTAL_CENTER : ($alignement == 'right' ? PHPExcel_Style_Alignment::HORIZONTAL_RIGHT : PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $celluleStyle = array(
            'font' => array(
                'name' => 'Arial',
                'size' => 10,
                'color' => array('argb' => '00000000'),
            ),
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FFFFFFFF')
                )
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => $alignement
            ),
        );
        $sheet->getCell($cellule)->setValue($value);
        $sheet->getStyle($cellule)->applyFromArray($celluleStyle);
    }

    public function executeExcel(sfWebRequest $request)
    {
	
		ini_set('memory_limit', '256M');
		set_time_limit(60);
        $this->getResponse()->setHttpHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment;filename=eleve.xlsx');
        $this->getResponse()->setHttpHeader('Cache-Control', 'max-age=0');
        $objPhpExcel = $this->createObjectExcel();
        $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
        unset($objPhpExcel);
        $this->getResponse()->sendHttpHeaders();
        $objWriter->save('php://output');
        return sfView::NONE;
		//return $this->renderText("<html><body>Hello, World!</body></html>");
		 //$this->redirect('eleve/listEleve');
    }

    public function executePdf(sfWebRequest $request)
    {
		ini_set('memory_limit', '256M');
		set_time_limit(60);
		
        $this->getResponse()->setHttpHeader('Content-Type', 'application/pdf');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment;filename=eleves.pdf');
        $this->getResponse()->setHttpHeader('Cache-Control', 'max-age=0');
        $objPhpExcel = $this->createObjectExcel();
        $objPhpExcel->setActiveSheetIndex(0)->setShowGridlines(false);
        $objWriter = new PHPExcel_Writer_PDF($objPhpExcel);
        unset($objPhpExcel);
        $this->getResponse()->sendHttpHeaders();
        $objWriter->save('php://output');
        return sfView::NONE;
    }

 /**
  * Executes aide action
  *
  * @param sfRequest $request A request object
  */
	public function executeAide(sfWebRequest $request){}

	public function execute404(sfWebRequest $request)
	{
			// 
	}

	public function execute500(sfWebRequest $request)
	{
			// 
	}

}
