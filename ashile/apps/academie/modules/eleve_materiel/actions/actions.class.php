<?php

/**
 * eleve_materiel actions.
 *
 * @package    ash
 * @subpackage eleve_materiel
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eleve_materielActions extends sfActions
{
	
	////////// fonction exemple de 2 champs liés dynamiquement par Js ////////////////
	

	
	public function executeLesmats(sfWebRequest $request)
	{
		// la variable typemateriel_id ne passe pas !!
		
			$q = Doctrine_Query::Create()
					->select('m.id')
					->from('Materiel m')
					->where('m.typemateriel_id = ?', $request->getParameter('typemateriel_id'));
			$this->selection = $q->execute();
 
	}
	//////////////////////////////////////////////////////////////////////////////////
	

	public function executeAjaxMateriel(sfWebRequest $request)
  	{
        $this->getResponse()->setContentType('application/json');
        $choices = array();
 
        if($request->hasParameter('q') and $request->hasParameter('limit'))
        {
            $q = $request->getParameter('q');
            $limit = $request->getParameter('limit');
        } else
        {
            throw sfException('q et limit doivent être définis dans la requête.');
        }
	
        $section = Doctrine_Core::getTable('Eleve')->getEleveAutocompletion($q, $limit)->getData() ;
        foreach($section  as $p)
        {
            $choices[$p->id] = $p->nom.' - '.$p->prenom.' - né e le: '.date('d/m/Y',strtotime($p->datenaissance)).$p->decisioncda;
        }
 
        if($section != array())
        {
            return $this->renderText(json_encode($choices));
			//return $this->renderPartial('orientation/selectEtabsco', array('etabscos' => $etabscos, 'selected' => $request->getParameter('selected')));
        }
    }

    public function executeRecherche(sfWebRequest $request)
  {
  
     $etat_materiel = '%'.$_POST['etat'].'%';  
	 $libelle_mat ='%'.$_POST['libelle_mat'].'%'.
	 $date_observation =  strtotime($request->getPostParameter('maj'));
	if($_POST['typemat']){
	 $typemat = '%'.$request->getPostParameter('typemat').'%';
	 }else{
	 $typemat = '%';
	
	} 
	if($_POST['maj']){
	  $date_observation =  strtotime($request->getPostParameter('maj'));
	 }else{
	 $date_observation = time();
	 $_POST['maj']=  date('d/m/Y',time());
	} 
	
	
	if($_POST['etat'] == "index" && strlen($_POST['libelle_mat']) == 0){
	
		//liste des matériels attribués
		//-------------------------------
  		$this->attribues = Doctrine_Query::Create()
           ->select ('s.id as secteurid,e.id as eleve_id,o.id as orient_id,et.id as etabsco_id,s.libellesecteur as libellesecteur,m.eleve_id as eleve_id,m.materiel_id as materiel_id,m.dateconvention as dateconvention,m.datedebut as datedebut,m.datefin as datefin,
		   t.libellemateriel as libellemateriel,t.libellemateriel as libellemateriel,et.rne as rne,e.nom as nom,e.prenom as prenom,
		   e.datenaissance as datenaissance,ma.libellemarque as marque,ty.libelletypemateriel as libelletypemateriel,c.libellecatmateriel as libellecatmateriel, t.numeromateriel as numeromateriel')
           ->from ('EleveMateriel m')
		   ->innerJoin('m.Materiel t ON t.id = m.materiel_id ')
		   ->innerJoin('t.Marque ma ON ma.id = t.marque_id ')
			->leftjoin('t.Typemateriel ty ON  ty.id =  t.typemateriel_id')
			->leftjoin('t.Catmateriel c ON  c.id =  t.catmateriel_id')
           ->innerJoin('m.Eleve e ON e.id = m.eleve_id')
           ->innerJoin('e.Secteur s ON s.id = e.secteur_id')
           ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
           ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
		  ->Where('m.datedebut <=?', $date_observation)
		  ->andwhere ('ty.libelletypemateriel LIKE ?', $typemat)
          ->orderBy('m.datedebut asc')
          ->fetcharray();
		}

       	if($_POST['etat'] != "index" && strlen($_POST['libelle_mat']) == 0 ){	
		//liste des matériels en fonction de l'état à la date d'obervation et dernier mouvement 
		//------------------------------------------------------------------------------------
		$this->materiels = Doctrine_Query::Create()
                ->select ('m.id as id, q.libellemarque as marque,s.datefin as datefin,s.datedebut as datedebut, f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as nom,
				m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel,t.libelletypemateriel as libelletypemateriel,c.libellecatmateriel as libellecatmateriel,
				 m.numeromateriel as numeromateriel, m.commentaire as commentaire, m.libellemateriel as libellemateriel')
                ->from('Materiel m')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
				 ->leftjoin('m.Catmateriel c ON  c.id =  m.catmateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->innerJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
                ->innerJoin('s.Mouvement f ON f.id = s.mouvement_id')
				->where('f.nommouvement LIKE ?', $etat_materiel)
			    ->andwhere ('t.libelletypemateriel LIKE ?', $typemat)
			 	->andWhere('s.datedebut <=?', date('Y-m-d', $date_observation))
			    ->andWhere('s.datefin IS NULL')
                ->fetcharray(); 
		}
		
		if(strlen($_POST['libelle_mat']) != 0 ){	//recherche à partir du libéllé matérile ou du numéro matérile
		
		//liste des matériels en fonction recherché en fonction du libéllé 
		//------------------------------------------------------------------------------------
		$this->materiels = Doctrine_Query::Create()
                ->select ('m.id as id, q.libellemarque as marque,s.datefin as datefin,s.datedebut as datedebut, f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as nom,
				m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel,t.libelletypemateriel as libelletypemateriel,c.libellecatmateriel as libellecatmateriel,
				 m.numeromateriel as numeromateriel, m.commentaire as commentaire, m.libellemateriel as libellemateriel')
                ->from('Materiel m')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
				 ->leftjoin('m.Catmateriel c ON  c.id =  m.catmateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->leftJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
				->where(' m.libellemateriel LIKE ?',  $libelle_mat)
				->orwhere(' m.numeromateriel LIKE ?',  $libelle_mat)
                ->fetcharray(); 
		}
		
		$this->typemateriels = Doctrine_Query::Create()
				->select('libelletypemateriel as libelle')
				->from('Typemateriel t')
				->orderby('libelletypemateriel')
				->fetcharray(); 
  }
  public function executeIndex(sfWebRequest $request)
  {
      $this->elevemateriels = Doctrine_Query::Create()
           ->select ('s.id as secteurid,s.libellesecteur as libellesecteur,m.eleve_id as eleve_id,m.materiel_id as materiel_id,m.dateconvention as dateconvention,m.datedebut as datedebut,m.datefin as datefin,t.libellemateriel as libellemateriel,et.rne as rne,e.*,o.*,et.*,s.*')
           ->from ('EleveMateriel m')
			->innerJoin('m.Materiel t ON t.id = m.materiel_id ')
           ->innerJoin('m.Eleve e ON e.id = m.eleve_id')
           ->innerJoin('e.Secteur s ON s.id = e.secteur_id')
           ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
           ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
		   ->Where('m.datefin >=?', date('Y-m-d', time()))  // equivalent à 'DATE(NOW())' 
		  // ->andWhere('m.dateconvention IS NOT NULL')
           ->orderBy('m.datedebut asc')
           ->fetcharray();
  }
  
  public function executeList(sfWebRequest $request)
  {

      $this->elevemateriels = Doctrine_Query::Create()
           ->select ('m.id, t.id, e.id, o.id, et.id, s.id as secteurid,s.libellesecteur as libellesecteur,m.eleve_id as eleve_id, e.nom as nom, e.prenom as prenom, e.datenaissance as datenaissance, m.materiel_id as materiel_id,m.dateconvention as dateconvention,m.datedebut as datedebut,m.datefin as datefin,t.libellemateriel as libellemateriel,et.rne as rne')
           ->from ('EleveMateriel m')
			->innerJoin('m.Materiel t ON t.id = m.materiel_id ')
           ->innerJoin('m.Eleve e ON e.id = m.eleve_id')
           ->innerJoin('e.Secteur s ON s.id = e.secteur_id')
           ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
           ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
		   ->andWhere('m.dateconvention IS NULL')
           ->orderBy('m.datedebut asc')
           ->fetcharray();		  
 
  }
 
    public function executeList1(sfWebRequest $request)
  {
  
	//liste des matériels alloués  à la date du jour pour l'élève selectionné
	//-----------------------------------------------------------------------
	$this->elevemateriels= Doctrine_Core::getTable('Elevemateriel')-> getListMaterielEleve($request->getParameter('eleve_id'));
	$count_eleve_mat = count($this->elevemateriels);
  }
  
 
  public function executeShow(sfWebRequest $request)
  {
    $this->elevemateriel = Doctrine_Core::getTable('Elevemateriel')->find(array($request->getParameter('eleve_id'),
                                       $request->getParameter('materiel_id')));
    $this->forward404Unless($this->elevemateriel);
  }

    public function executeNew(sfWebRequest $request)
    {

		 //*****************************
	    // Si l'élève est selectionné
		//******************************
		
		
		if($request->getParameter('eleve_id') ){
	
		// Historique des matériels attribués à l'élève
		//--------------------------------------------
	            $this->materielEleve = Doctrine_Query::Create()
				->select('e.dateconvention as dateconvention,t.libelletypemateriel as typemateriel,e.eleve_id as eleveId, m.numeromateriel as numeromateriel,p.id as mouvementMaterielId, p.mouvement_id as mouvementId, e.materiel_id as materielId, m.typemateriel_id as typeMateriel,m.libellemateriel as libellemateriel, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin, ')
				->from('EleveMateriel e')
				->leftjoin('e.Materiel m ON m.id = e.materiel_id')
				->leftjoin('m.MouvementMateriel p ON p.materiel_id = m.id')
				->innerJoin('m.Typemateriel t ON t.id = m.typemateriel_id')
				->where('e.eleve_id = ?', $request->getParameter('eleve_id'))
				->fetcharray();
		
		//liste des demandes de matériel en cours à la date du jour à l'état "A ATTRIBUER' pour l'élève selectionné
		//---------------------------------------------------------------------------------------------------------
		$this->demande_materiel_selectionner = Doctrine_Core::getTable('DemandeMateriel')->getDerDemandeMatAttribuer($request->getParameter('eleve_id'));
		$this->count_dem_mat = count($this->demande_materiel_selectionner);
		
		
		// Demande de matériel selectionnée à la date du jour à l'état "A ATTRIBUER' pour l'élève selectionné
		//---------------------------------------------------------------------------------------------------------
	 //   $this->demande_materiel_selectionner = Doctrine_Core::getTable('DemandeMateriel')->getDemandeMatSelectionner($request->getParameter('demande_materiel_id'));
	//	$this->count_dem_mat = count($this->demande_materiel_selectionner);
	 //   $demandemateriel_id = $request->getParameter('demande_materiel_id');
		
		//Dernière demande de matériel en cours à la date du jour pour l'élève selectionné
		//--------------------------------------------------------------------------------------
		$this->demande_materiel_selectionner = Doctrine_Core::getTable('DemandeMateriel')->getDemandeMatSelectionner($request->getParameter('demandemateriel_id'));
		
	    $demandemateriel_id = $request->getParameter('demandemateriel_id');
	
			  // selection du matériel immatriculée en STOCK  aujourd'hui
			   //-----------------------------------------------------------	
				$this->mat_en_stock = Doctrine_Query::create()
	             ->select ('m.id as materiel_id, q.libellemarque as marque,s.datefin as datefin, f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as nom, m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel, m.caracteristiquemateriel as caracteristiqueMateriel,
				 m.numeromateriel as numeroMateriel, m.commentaire as commentaire,m.typemateriel_id as typemateriel_id,c.libellecatmateriel as catmateriel')
                ->from('Materiel m')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->leftJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
				->leftJoin('m.Catmateriel c ON c.id = m.catmateriel_id')
				->where('m.typemateriel_id=?',$this->demande_materiel_selectionner[0]['typemateriel_id'] )
				->andwhere('f.nommouvement LIKE "%STOCK%"')
				->andwhere('s.datefin is null')
				->orderby(' m.numeromateriel')
			//	->where('m.typemateriel_id=?', 127 )
				->fetcharray();
		
		
	

			//liste des demandes matériels à l'état (traitement) "A ATTRIBUER"
			$this->demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->getDerDemandeMatAttribuer($request->getParameter('eleve_id'));
			$this->existdemande_materiel = count($this->demande_materiel);
			
            $materiel_id = $request->getParameter('materielsel_id');
			$eleve_id = $request->getParameter('eleve_id');
			$this->eleve = Doctrine::getTable('Eleve')->findOneById($eleve_id); //utiliser pour afficher les infos dans le new
			$this->existeleve = count($this->eleve);
        
			//création de l'enregistrement
			$eleveMateriel = new Elevemateriel();
			$eleveMateriel->setEleveId($eleve_id);
			 $eleveMateriel->setMaterielId($materiel_id);
			//$date = date('Y-m-d', time()) ;
			//$eleveMateriel->setDatedebut($date);
			$this->form = new ElevematerielForm($eleveMateriel,$this->existeleve ,$this->eleve,$this->mat_en_stock);
		
		
			// --- on met la variable passée en url 'demandemateriel_id' en global 
			//$this->form = new ElevematerielForm(array(), array('eleveMateriel' =>$eleveMateriel, 'typemateriel_id' => $request->getParameter('typemateriel_id'), 'demandemateriel_id ' => $request->getParameter('demandemateriel_id')));        
			$this->getUser()->setAttribute('demandemateriel_id',$demandemateriel_id);
			// ----------------------------------------------------------------------------------------------
			}
			
		    //*************************************
			//si le matériel est selectionné
			//**************************************
			
			$materiel_id = $request->getParameter('materiel_id');
			$demandemateriel_id = $request->getParameter('demandematerielsel_id');
			if($request->getParameter('materiel_id') ){	
				$materiel_id = $request->getParameter('materiel_id');
				
				
				if($request->getParameter('demandematerielsel_id')){
				
				
				//recheche de l'élève correspondant à la demande matériel selectionné
				//------------------------------------------------------------------
					
					    $eleve_sel = Doctrine_Query::create()
						->select('e.id as eleve_id')
						->from('Eleve e')
                        ->leftJoin('e.Mdphs m ON e.id = m.eleve_id')
						->leftJoin('m.DemandeMateriels d  ')
						->where('d.id = ?', $request->getParameter('demandematerielsel_id'))
						->fetcharray();
					
				
				 // Historique des matériels attibués à l'élève
				 //--------------------------------------------
						$this->materielEleve = Doctrine_Query::Create()
						->select('e.dateconvention as dateconvention,t.libelletypemateriel as typemateriel,e.eleve_id as eleveId, m.numeromateriel as numeromateriel,p.id as mouvementMaterielId, p.mouvement_id as mouvementId, e.materiel_id as materielId, m.typemateriel_id as typeMateriel,m.libellemateriel as libellemateriel, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin, ')
						->from('EleveMateriel e')
						->leftjoin('e.Materiel m ON m.id = e.materiel_id')
						->leftjoin('m.MouvementMateriel p ON p.materiel_id = m.id')
						->innerJoin('m.Typemateriel t ON t.id = m.typemateriel_id')
						->where('e.eleve_id = ?', $eleve_sel[0]['eleve_id'])
						->fetcharray();
				}	
			
					//recherche du matériel selectionné pour trouver son type matériel
					//---------------------------------------------------------------
					$materiel_sel = Doctrine_Query::create()
					->select('m.id as materiel_id,m.typemateriel_id as typemateriel_id')
					->from('Materiel m')
					->where('m.id=?',$materiel_id )
					->fetcharray();
					
					
 			
				//Dernière demande matériel en cours à la date du jour  à l'état A ATTRIBUER avec le même type que le matériel selectionné
				//--------------------------------------------------------------------------------------------------------------------------
					$this->eleves = Doctrine_Query::create()
						->select('e.id as eleve_id,m.id as mdph_id,e.nom as nom,e.prenom as prenom,d.id as demandemateriel_id,t.libelletypemateriel as typemateriel,
						d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda')
						->from('Eleve e')
                        ->leftJoin('e.Mdphs m ON e.id = m.eleve_id')
						->leftJoin('m.DemandeMateriels d  ')
                        ->innerJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->innerJoin('d.Traitement ty ON ty.id = d.traitement_id')
						->where('ty.libelletraitement LIKE "%ATTRIBUER%"')
						->andwhere('d.typemateriel_id=?',$materiel_sel[0]['typemateriel_id'] )
						->andwhere('d.datedecisioncda IS NOT NULL')
						->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))						
					    ->orderby ('e.nom,e.prenom ASC')
						->fetcharray();
		
			
		
		
			$this->materiel = Doctrine::getTable('Materiel')->findOneById($materiel_id); //utiliser pour afficher les infos dans le new
			$this->existmateriel = count($this->materiel);
			$eleveMateriel = new Elevemateriel();
			$eleveMateriel->setMaterielId($materiel_id);
			$eleveMateriel->setEleveId($eleve_sel[0]['eleve_id']);
			//$date = date('Y-m-d', time()) ;
			//$eleveMateriel->setDatedebut($date);
			$this->form = new ElevematerielForm($eleveMateriel,$this->existmateriel, false);
			// --- on met la variable passée en url 'demandemateriel_id' en global 
			$this->getUser()->setAttribute('demandemateriel_id',$demandemateriel_id);
			// ----------------------------------------------------------------------------------------------
			}
        
 
    }
	
	
	public function executeTest(sfWebRequest $request)
    {

		 //*****************************
	    // Si l'élève est selectionné
		//******************************
		
		
		if($request->getParameter('eleve_id') ){
	
		// Historique des matériels attribués à l'élève
		//--------------------------------------------
	            $this->materielEleve = Doctrine_Query::Create()
				->select('e.dateconvention as dateconvention,t.libelletypemateriel as typemateriel,e.eleve_id as eleveId, m.numeromateriel as numeromateriel,p.id as mouvementMaterielId, p.mouvement_id as mouvementId, e.materiel_id as materielId, m.typemateriel_id as typeMateriel,m.libellemateriel as libellemateriel, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin, ')
				->from('EleveMateriel e')
				->leftjoin('e.Materiel m ON m.id = e.materiel_id')
				->leftjoin('m.MouvementMateriel p ON p.materiel_id = m.id')
				->innerJoin('m.Typemateriel t ON t.id = m.typemateriel_id')
				->where('e.eleve_id = ?', $request->getParameter('eleve_id'))
				->fetcharray();
		
		// Demande de matériel selectionnée à la date du jour à l'état "A ATTRIBUER' pour l'élève selectionné
		//---------------------------------------------------------------------------------------------------------
	    $this->demande_materiel_selectionner = Doctrine_Core::getTable('DemandeMateriel')->getDemandeMatSelectionner($request->getParameter('demande_materiel_id'));
		$this->count_dem_mat = count($this->demande_materiel_selectionner);
	    $demandemateriel_id = $request->getParameter('demande_materiel_id');
	
			  // selection du matériel immatriculée en STOCK  aujourd'hui
			   //-----------------------------------------------------------	
				$this->mat_en_stock = Doctrine_Query::create()
	             ->select ('m.id as materiel_id, q.libellemarque as marque,s.datefin as datefin, f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as nom, m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel, m.caracteristiquemateriel as caracteristiqueMateriel,
				 m.numeromateriel as numeroMateriel, m.commentaire as commentaire,m.typemateriel_id as typemateriel_id,c.libellecatmateriel as catmateriel')
                ->from('Materiel m')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->leftJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
				->leftJoin('m.Catmateriel c ON c.id = m.catmateriel_id')
				->where('m.typemateriel_id=?',$request->getParameter('typemateriel_id') )
				->andwhere('f.nommouvement LIKE "%STOCK%"')
				->andwhere('s.datefin is null')
				->orderby(' m.numeromateriel')
			//	->where('m.typemateriel_id=?', 127 )
				->execute();
		
			
           
			$eleve_id = $request->getParameter('eleve_id');
			$this->eleve = Doctrine::getTable('Eleve')->findOneById($eleve_id); //utiliser pour afficher les infos dans le new
			$this->existeleve = count($this->eleve);
      
			$this->getUser()->setFlash('notice', 'tiaaa'.$eleve_id);
	  
			//création du Prêt
			//------------------
			$eleveMateriel = new Elevemateriel();
			$eleveMateriel->setEleveId($eleve_id);
			$this->getUser()->setAttribute('demandemateriel_id',$demandemateriel_id);
			$this->form = new ElevematerielForm($eleveMateriel,array('query' => $this->mat_en_stock));
			
			}
		
        
 
    }


  public function executeCreate(sfWebRequest $request)
  {
  
  
    $this->forward404Unless($request->isMethod(sfRequest::POST));
	
	// attribution d'un matériel à l'élève selectionné
	//------------------------------------------------
	if($request->getParameter('eleve_id')){
	$eleve_id = $request->getParameter('eleve_id');
  	$request->setParameter('eleve_id', $request->getPostParameter('eleve_id'));
 	}
	
	//prêt d'un matériel à l'élève selectionné
	//----------------------------------------
    if($request->getParameter('materiel_id')){
	$eleve_id = $request->getParameter('eleve_id');
  	$request->setParameter('materiel_id', $request->getPostParameter('materiel_id'),eleve_id);
 	}
	
	$this->form = new ElevematerielForm($eleveMateriel);
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  
    //Dernière demande de matériel en cours à la date du jour pour l'élève selectionné
	//--------------------------------------------------------------------------------------
		$this->demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->getDerDemandeMatTraite($request->getParameter('eleve_id'),$request->getParameter('materiel_id'));
		$this->existdemande_materiel = count($this->demande_materiel);
	
	// Historique des matériels attibués à l'élève
	//--------------------------------------------
	$this->materielEleve = Doctrine_Query::Create()
				->select('e.dateconvention as dateconvention,t.libelletypemateriel as typemateriel,e.eleve_id as eleveId, m.numeromateriel as numeromateriel,p.id as mouvementMaterielId, p.mouvement_id as mouvementId, e.materiel_id as materielId, m.typemateriel_id as typeMateriel,m.libellemateriel as libellemateriel, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin, ')
				->from('EleveMateriel e')
				->leftjoin('e.Materiel m ON m.id = e.materiel_id')
				->leftjoin('m.MouvementMateriel p ON p.materiel_id = m.id')
				->innerJoin('m.Typemateriel t ON t.id = m.typemateriel_id')
				->where('e.eleve_id = ?', $request->getParameter('eleve_id'))
				->fetcharray();
				
	// liste des matériels édités sur une conventions pour un élève
	//-------------------------------------------------------------
	
	$this->conventionsMateriel = Doctrine_Query::Create()
				->select('e.eleve_id as eleveId, ee.nom as nomEleve, ee.ine as ine, e.dateconvention as dateConvention,e.numero_convention as numero_convention, e.datefin as datefin')
				->from('EleveMateriel e')
				->leftjoin('e.Eleve ee ON ee.id = e.eleve_id')
				->where('e.materiel_id =?', $request->getParameter('materiel_id'))
				->andWhere('e.datefin >=?', date('Y-m-d', time()))
				->andWhere('e.dateconvention is NOT NULL')
				->fetcharray();	
	 $this->existconventionsMateriel = count($this->conventionsMateriel); 
	
	//les matériels qui ne sont pas encore édités sur une convention
	//---------------------------------------------------------------
	$this->materielssansconv = Doctrine::getTable('EleveMateriel')->getMatSansConvParEleve($request->getParameter('eleve_id'));
	$this->countmaterielssansconv = count($this->materielssansconv);

	 
    $this->materielId = Doctrine_core::getTable('Materiel')->find($request->getParameter('materiel_id'))->getId();
    
    $this->eleveId = Doctrine::getTable('Eleve')->findOneById($request->getParameter('eleve_id'))->getId();
     
    $this->forward404Unless($elevemateriel = Doctrine_Core::getTable('Elevemateriel')->find(array($request->getParameter('id'),
                 )), sprintf('Object eleve materiel does not exist (%s).', $request->getParameter('id')
                 ));
    
    

	
	//$elevemateriel->setEleveId($request->getParameter('eleve_id'));
	//$elevemateriel->setMaterielId($request->getParameter('materiel_id'));                 

    $this->form = new ElevematerielForm($elevemateriel);
	
  }

  public function executeUpdate(sfWebRequest $request)
  {
      
   //Dernière demande de personnel acc. en cours à la date du jour pour l'élève selectionné
	//--------------------------------------------------------------------------------------
		$this->demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->getDerDemandeMat($request->getParameter('eleve_id'));
		$this->existdemande_materiel = count($this->demande_materiel);
		
  
	// Historique des matériels attibués à l'élève
	//--------------------------------------------
	$this->materielEleve = Doctrine_Query::Create()
				->select('e.eleve_id as eleveId, p.id as mouvementMaterielId, m.numeromateriel as numeromateriel,p.mouvement_id as mouvementId, e.materiel_id as materielId, m.typemateriel_id as typeMateriel,m.libellemateriel as libellemateriel, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin, ')
				->from('EleveMateriel e')
				->leftjoin('e.Materiel m ON m.id = e.materiel_id')
				->leftjoin('m.MouvementMateriel p ON p.materiel_id = m.id')
				->where('e.eleve_id = ?', $request->getParameter('eleve_id'))
				->fetcharray();	  
				
				
	// les  matériels à éditer sur conventions pour un élève
	//-------------------------------------------------------
	
	$this->conventionsMateriel = Doctrine_Query::Create()
				->select('e.eleve_id as eleveId, ee.nom as nomEleve, ee.ine as ine, e.dateconvention as dateConvention,e.datefin as datefin')
				->from('EleveMateriel e')
				->leftjoin('e.Eleve ee ON ee.id = e.eleve_id')
				->where('e.eleve_id =?', $request->getParameter('eleve_id'))
				->andWhere('e.datefin >=?', date('Y-m-d', time()))
				->andWhere('e.dateconvention is NOT NULL')
				->fetcharray();	
	 $this->existconventionsMateriel = count($this->conventionsMateriel); 
	
	 $this->materiel = Doctrine_core::getTable('Materiel')->find($request->getParameter('materiel_id'))->getId();
     $this->eleve = Doctrine::getTable('Eleve')->findOneById($request->getParameter('eleve_id'))->getId();  
	  
	  
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($elevemateriel = Doctrine_Core::getTable('Elevemateriel')->find($request->getParameter('id')), sprintf('Object elevemateriel does not exist (%s).', $request->getParameter('id')));
                 
	//	$elevemateriel->setEleveId($this->eleve);
   //	$elevemateriel->setMaterielId($this->materiel);
                 
   //$this->form = new EleveMaterielForm($elevemateriel, $this->materielEleve);
   
   $this->form = new EleveMaterielForm($elevemateriel);
   
   //$this->form = new EleveMaterielForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
	
    $this->forward404Unless($elevemateriel = Doctrine::getTable('Elevemateriel')->find(array($request->getParameter('id'))), sprintf('Object orientation does not exist (%s).', $request->getParameter('id')));
    $eleve_id = $elevemateriel->getEleveId()	;
	
	 //recherche si une demande matériel à ce numéro de matériel
	 $demande_sel = Doctrine_Query::create()
	->select('e.id as demande_id,e.datefinnotif as datefinnotif ')
	->from('DemandeMateriel e')
	->innerjoin('e.Mdph m ON  m.id = e.mdph_id')
	->where('e.materiel_id = ?', $elevemateriel->getMaterielId())
	->andwhere('m.eleve_id = ?', $elevemateriel->getEleveId())
	->fetchArray();
	$count_demande_sel = count($demande_sel);
	
		//recherche de l'ID traitement A ATTRIBUER
		$traitement = Doctrine_Query::create()
		->select('t.id as traitement_id')
		->from('Traitement t')
		->where('t.libelletraitement LIKE "%ATTRIBUER%"')
		->limit(1)
		->execute();
		
		
		
    ///////////////////////////////////////
	//MISE A JOUR DE LA DEMANDE MATERIEL //
	///////////////////////////////////////
	if ( $count_demande_sel > 0){
	                   //la demande matériel passe au code A ATTRIBUER et la référence du matériel materiel_id enlevé
						Doctrine_Query::Create() //on met a jour le traitement a affecté
						->update('DemandeMateriel dm')
						->set(array('dm.traitement_id'=>$traitement[0]['traitement_id'],'dm.materiel_id'=>null))
						->where('dm.id = ?',$demande_sel[0][demande_id])
						->execute();	
					}
	/////////////////////////////////////////				
	//MISE A JOUR DU MOUVEMENT DU MATERIEL //
	/////////////////////////////////////////
	$mouv_mat = Doctrine::getTable('Materiel')->find($elevemateriel->getMaterielId())->getDernierMouvId();
		if ( $mouv_mat){
		
		               	// --- récupèration du mouvement_id "STOCK"
						$stock = Doctrine_Query::create()
						->select('m.id as mouvement_id')
						->from('mouvement m')
						->where('m.nommouvement LIKE "%STOCK%"')
						->fetcharray();
						
					
					//Mise à jour de la date de fin du dernier mouvement avec la date du jour
						$updateMouvMat = Doctrine_Query::Create()
						->update('MouvementMateriel mm')
						->set('mm.datefin', '?', date('Y-m-d', time()))
						->where('mm.id = ?' , $mouv_mat)
						->execute();
					
					
					//  on créé le mouvement corespondant au matériel  à l'état EN STOCK
					$newMouvementsMateriel = new MouvementMateriel();
					$newMouvementsMateriel->setArray(array(
											'materiel_id'	=>	$elevemateriel->getMaterielId(),
											'mouvement_id'	=>	$stock[0]['mouvement_id'],
											// on fixe la date de debut 
											'datedebut'		=>	date('Y-m-d', time())
											));
				     $newMouvementsMateriel->save();
					 
					 
					}
	//////////////////////
	
	$this->getUser()->setFlash('error', 'attention une demande  de matériel attaché a ce prêt ,elle sera remis à l\'état A ATTRIBUER');
    //suppression du prêt
    $elevemateriel->delete();
    $this->redirect('eleve_materiel/list1?eleve_id='.$eleve_id);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
      
		if ($form->isValid())
		{
			$this->getUser()->setFlash('notice', 'eeeeetitieeeezzzzzzzzzz');
		    $datedebut_pret = '';
		    $datedebut_pret = $form->getValue('datedebut');
			$datefin_pret = $form->getValue('datefin');
			$eleveID = $form->getValue('eleve_id');
			
			//sauvegarde de l'enregistrement
			$elevemateriel = $form->save();
			$eleve_id = $elevemateriel->getEleveId();
			$materiel_id = $elevemateriel->getMaterielId()  ;
			$demandematerielId = $this->getUser()->getAttribute('demandemateriel_id');	
			
			
			if ( $materiel_id && $demandematerielId){
			
			 //on attribue le numéro du matériel selectionné à la demande matériel choisie
			 //-----------------------------------------------------------------------------
			 	$majdemande = Doctrine_Query::create()
				->update('DemandeMateriel d')
				->set('d.materiel_id','?',$materiel_id)
				->where('d.id = ?', $demandematerielId)
				->execute();
			}
			 
			 		    
				/* --------UPDATES------- */
				
				//recherche de l'ID traitement REMIS
					$traitement = Doctrine_Query::create()
					->select('t.id as traitement_id')
				    ->from('Traitement t')
					->where('t.libelletraitement LIKE "%REMIS%"')
					->limit(1)
					->execute();
					
					//recherche de l'ID traitement AFFECTE
					$traitement_affec = Doctrine_Query::create()
					->select('t.id as traitement_id')
				    ->from('Traitement t')
					->where('t.libelletraitement LIKE "%AFFECTE%"')
					->limit(1)
					->execute();
					
					//recherche de l'ID traitement A ATTRIBUER
					$traitement_prec = Doctrine_Query::create()
					->select('t.id as traitement_id')
				    ->from('Traitement t')
					->where('t.libelletraitement LIKE "%ATTRIBUER%"')
					->limit(1)
					->execute();
					
				$demandematerielId = $this->getUser()->getAttribute('demandemateriel_id');			
				
	           if($demandematerielId && $datefin_pret == '')
				{		
            		
				//récupération de la date de fin de notification de la demande matériel selectionnée
				//----------------------------------------------------------------------------------
									
					$demande_sel = Doctrine_Query::create()
								->select('e.id as id,e.datefinnotif as datefinnotif ')
								->from('DemandeMateriel e')
								->where('e.id = ?', $demandematerielId)
								->fetchArray();
					
								
				//MISE à jour de la date de fin de prêt avec la date de fin de notification selectionnée
			   //----------------------------------------------------------------------------------------						
						$majDate = Doctrine_Query::create()
							->update('EleveMateriel e')
							->set('e.datefin','?',$demande_sel[0]['datefinnotif'])
							//->where('e.datefin is null')
							->where('e.id = ?',  $elevemateriel->getId())
						    ->execute();
						}
			
				$demandematerielId = $this->getUser()->getAttribute('demandemateriel_id');
				
			  //MISE A JOUR DU TRAITEMENT DE LA DEMANDE MATERIEL RETENUE EN FONCTION DE LA DATE DE DEBUT DE PRËT
			  //------------------------------------------------------------------------------------------------
				
				if($datedebut_pret != ''){	// date de début de prêt renseignée
				$traitement = $traitement[0]['traitement_id'];
				
				//récupére la demande matériel via le numéro de matériel pour mettre le traitement de la demande à REMIS
				$majdemande = Doctrine_Query::create()
				->update('DemandeMateriel d')
				->set('d.traitement_id',$traitement)
				->where('d.materiel_id = ?', $materiel_id)
			//	->andwhere('d.id = ?', $demande_sel[0]['id'])
				->execute();

				}else{ //si la date de but de prêt non renseignée on met a jour la demande matériel qui vient d'être selectionné à l'état AFFECTE
				$traitement = $traitement_affec[0]['traitement_id'];
				
					if($demandematerielId){
						$majdemande1 = Doctrine_Query::Create() //on met a jour le traitement a affecté
						->update('DemandeMateriel dm')
						->set('dm.traitement_id',$traitement)
						->where('dm.materiel_id = ?', $materiel_id)
						->andwhere('dm.id = ?', $demande_sel[0]['id'])
						->andwhere('dm.traitement_id = ?',$traitement_prec[0]['traitement_id'])
						->execute();	
					}

				}

					
				// on met à jour la demande Materiel selectionnée si elle existe en passant le champ traité à "true"
				
				$demandematerielId = $this->getUser()->getAttribute('demandemateriel_id');
				
				
				if($demandematerielId){
				Doctrine_Query::Create()
								->update('DemandeMateriel dm')
								->set('dm.traite',true)
								->where('dm.id = ?',$demandematerielId)
								->execute();	
				}
			
				
			//DATE DE DEBUT PRET RENSEIGNEE OU DATE DE REMISE AU PARENT RENSEIGNEE  
			//------------------------------------------------------------------------
				
				if($datedebut_pret != ''){	 //Si la date de début prêt est renseignée 
				

				
				
				/*-----------UPDATE MOUVEMENT --------*/
				// ------------------------------------/
				$materiel = Doctrine::getTable('Materiel')->findOneById($elevemateriel->getMaterielId());
				
				// -----update de la fin mouvement a la date de debut du mouvement suivant ----------------//
				// --- on commence par trouver le dernier mouvement du materiel en cours date de fin non renseignée
				
				$res = Doctrine_Query::create()
							->select('b.materiel_id as materiel_id,MAX(b.datedebut) as datedebut,MAX(b.id) as id,f.nommouvement as nommouvement')
							->from('MouvementMateriel b')
							->where('b.datefin is null')
							->innerjoin('b.Mouvement f ON f.id = b.mouvement_id')
							->groupBy('b.materiel_id')
							->having('b.materiel_id = ?', $elevemateriel->getMaterielId())
							->fetchArray();
			
									
				// --- la mise a jour date fin du dernier mouvement mise à jour avec la date de
				// début de prêt
							 
				$majDate = Doctrine_Query::create()
						->update('MouvementMateriel a')
						->set('a.datefin','?',$elevemateriel ->getDatedebut())
						->where('a.materiel_id = ?', $elevemateriel->getMaterielId())
						->andWhere('a.id = ?', $res[0]['id']);

				 $majDate->execute();

			
			// --- on crée un mouvement pour ce materiel
				$mouv_mat = new MouvementMateriel();
				
				// --- récupèration du mouvement_id "REMIS"
				$remis = Doctrine_Query::create()
							->select('m.id as id')
							->from('mouvement m')
							->where('m.nommouvement LIKE "%REMIS%"')
							->fetcharray();
							
				// Initialisation du nouveau mouvement_materiel à l'état Remis avec une date
				//de début correspondant à la date de début d'attribution et date de fin non renseignée
				//------------------------------------------------------------------------------------
				$mouv_mat->setMaterielId($materiel->getId());
				$mouv_mat->setMouvementId($remis[0]['id']);
				$mouv_mat->setDatedebut($elevemateriel->getDatedebut());
			  //$mouv_mat->setDatefin($elevemateriel->getDatefin());
				
				$dernierMouv = $mouv_mat->save();
				

				}
				//-------------------------------------------------------------------------------------------------------------------------------//
				
				
				if($datedebut_pret == '' ){	 //si la date de début est vide (pas encore la date de remise au parent)
				
							
				/*-----------UPDATE du dernier MOUVEMENT --------*/
				// ----------------------------------------------------/
				$materiel = Doctrine::getTable('Materiel')->findOneById($elevemateriel->getMaterielId());
				
				// -----update de la fin mouvement a la date de debut du mouvement suivant ----------------//
				// --- on commence par trouver le dernier mouvement du materiel en cours date de fin non renseignée
				
				$res = Doctrine_Query::create()
							->select('b.materiel_id as materiel_id,MAX(b.datedebut) as datedebut,MAX(b.id) as id,b.mouvement_id as mouvement_id ')
							->from('MouvementMateriel b')
							->where('b.datefin is null')
							->groupBy('b.materiel_id')
							->having('b.materiel_id = ?', $elevemateriel->getMaterielId())
							->fetchArray();
							
			    // --- récupèration du mouvement_id " A AFFECTER"
				$affecte = Doctrine_Query::create()
							->select('m.id as mouvement_id')
							->from('mouvement m')
							->where('m.nommouvement LIKE "%AFFECTE%"')
							->fetcharray();
							
							
			    // --- récupèration du mouvement_id " EN STOCK"
				$stock = Doctrine_Query::create()
							->select('m.id as mouvement_id')
							->from('mouvement m')
							->where('m.nommouvement LIKE "%STOCK%"')
							->limit(1)
							->fetcharray();				
							
				if($res[0]['mouvement_id'] == $stock[0]['mouvement_id'] ){ // si le dernier mouvement est en STOCK
				
					// --- on crée un mouvement pour ce materiel
					$mouv_mat = new MouvementMateriel();
				
						
					// Initialisation du nouveau mouvement_materiel à l'état Remis avec une date
					//de début correspondant à la date de début d'attribution et date de fin non renseignée
					//------------------------------------------------------------------------------------
					$date = date('Y-m-d', time()) ;
					
					$mouv_mat->setMaterielId($materiel->getId());
					$mouv_mat->setMouvementId($affecte[0]['mouvement_id']);
					$mouv_mat->setDatedebut($date);
					//$mouv_mat->setDatefin($elevemateriel->getDatefin());
				
					$dernierMouv = $mouv_mat->save();
				
						
					// --- la mise a jour date fin du dernier mouvement mise à jour avec la date de
					// début de prêt
				
					//si la date de début de prêt existe
				 
					$majDate = Doctrine_Query::create()
						->update('MouvementMateriel a')
						->set('a.datefin','?',$date)
						->where('a.materiel_id = ?', $elevemateriel->getMaterielId())
						->andWhere('a.id = ?', $res[0]['id']);

					$majDate->execute();
				}
				}
			 
		//	$this->getUser()->setFlash('notice', ' prêt enregistré avec succès du matériel : '.$elevemateriel->getMateriel(). ' pour '.$elevemateriel->getEleve().' à la date du '.date('d/m/Y',strtotime($elevemateriel->getDatedebut())).'ffffeeeeeeeeeeeeeeeeeeeeeeee'.$demandematerielId);
		
		$this->getUser()->setFlash('notice', ' prêt enregistré avec succès du matériel : '.$elevemateriel->getMateriel(). ' pour '.$elevemateriel->getEleve());

		// ------------------------------------------------------------------------------------------------------------------------------------------------------
		}  //form valid
		
		// $this->redirect('@AttMoyDemandeMateriel');
		if($form->getObject()->getEleveId() ){ // on connait le eleve_id
		 //recherche du nom et du prénom de l'élève
		 				$eleve = Doctrine_Query::create()
							->select('e.id as eleve_id,e.nom as nom,e.prenom as prenom')
							->from('Eleve e')
							->where('e.id = ?', $elevemateriel->getEleveId())
							->limit(1)
							->fetcharray();	
		
		 //$this->redirect('eleve_materiel/list1?eleve_id='.$elevemateriel->getEleveId() ); 
		
		 $this->redirect('eleve/recherche?eleve_id='.$elevemateriel->getEleveId().'&eleve_nom='.$eleve[0]['nom'].'&eleve_prenom=' .$eleve[0]['prenom'].'&flag_recherche=1');
		}else{ //form pas valide
		$this->redirect('eleve_materiel/list1?eleve_id='.$eleveID ); 
		}
	
	}

	public function executeConv(sfWebRequest $request)
	{
	$this->materiels = Doctrine::getTable('EleveMateriel')->getMatSansConvParEleve($request->getParameter('eleve_id'));
	
    //référence de l'élève	
	$this->eleve = Doctrine::getTable('Orientation')->getDerSco($request->getParameter('eleve_id'));
	$this->info_eleve = Doctrine_Query::Create()
             ->select ('e.nom as nom,e.prenom as prenom,e.adresseleverue as adresseeleverue,adresseelevebat as adresseelevebat,s.libellesecteur as libellesecteur')
             ->from('Eleve e')
			 ->innerjoin('e.Secteur s on s.id=e.secteur_id')
			 ->where('e.id = ?',$request->getParameter('eleve_id'))
             ->execute();
	//$this->test = Doctrine::getTable('EleveMateriel')->getConvExpiration(); */
	
	//liste des conventions pour un élève
	//-------------------------------------
		$this->conventionsMateriel = Doctrine_Query::Create()
				->select('em.id, m.id as materiel_id,t.id, t.libelletypemateriel as typemateriel, m.numeromateriel as numeromateriel,em.datedebut as datedebut,em.datefin as datefin,
				em.eleve_id as eleve_id,em.numero_convention as numero_convention,em.chemin_conv as chemin_conv,em.dateconvention as dateconvention,
				m.libellemateriel as libellemateriel,c.id as catmateriel_id,c.libellecatmateriel as libellecatmateriel')		
				->from('EleveMateriel em')
				->innerJoin('em.Materiel m ON m.id = em.materiel_id')
				->innerJoin('m.Typemateriel t ON t.id = m.typemateriel_id')
				->leftJoin('m.Catmateriel c ON c.id = m.catmateriel_id')
				->where('em.dateconvention IS NOT NULL AND em.eleve_id = ?',$request->getParameter('eleve_id'))
				->andWhere('em.chemin_conv is NOT NULL')
				->fetcharray();	
	 $this->existconventionsMateriel = count($this->conventionsMateriel); 
	
	}
	
	public function executePdf(sfWebRequest $request)
	// génération de la convention au format PDf
    {
	
		$lesMats = $request->getParameter('lesMats');
        $eleve_id = $request->getParameter('eleve_id');
        $eleve = Doctrine::getTable('Eleve')->findOneById($eleve_id);
		
		
		//recherche du dernier numéro de convention
        //----------------------------------------------
             $conv = Doctrine_Query::Create()
             ->select ('max(em.numero_convention) as num_conv')
             ->from('EleveMateriel em')
             ->execute();
			 
	    //création du prochain numéro de convention
		//-------------------------------------------		
		if($conv[0]['num_conv'] >= 13300){
		 $num_conv = $conv[0]['num_conv'] + 1 ;
		}else{
		 $num_conv = 13300 ;
		}
		
         // recherche de l'annee scolaire en cours
         $anneescolaire = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();

        //recherche des matériels à éditer sur convention
		//----------------------------------------------------
		$mats = Doctrine_Query::Create()
		->select('e.id as id, m.numeromateriel as numero,m.libellemateriel as libelle,t.libelletypemateriel as libelletype,
		e.dateconvention as dateconvention, e.eleve_id as eleveId,
		e.materiel_id as materielId, m.typemateriel_id as typeMateriel, e.dateconvention as dateconvention, e.datedebut as datedebut,
		e.datefin as datefin,c.id as catmateriel_id,c.libellecatmateriel as libellecatmateriel,m.prixachat as prixachat ')
		->from('EleveMateriel e')
		->innerjoin('e.Materiel m ON m.id = e.materiel_id')
		->innerjoin('m.Typemateriel t ON t.id = m.typemateriel_id')
		->leftJoin('m.Catmateriel c ON c.id = m.catmateriel_id')
		->whereIn('m.id', explode(",",$lesMats))	// on enlève la virgule qui sépare les materiels selectionnés dans la fonction 'maFonction' de convSuccess
		->andwhere('e.eleve_id = ?',$request->getParameter('eleve_id'))
		->fetcharray();	
		
		
        $countmats = count($mats);
		
		
		
        $valeur_globale = 0;
		// --- la mise a jour date de convention pour les materiels concernés -----------				
        foreach ($mats as $mat){	
		Doctrine_Query::Create()
				->update('EleveMateriel em')
				->set('em.dateconvention','?',date('Y-m-d', time()))
				->where('em.id = ?', $mat['id'])
				->andwhere('em.eleve_id = ?',$request->getParameter('eleve_id'))
				->execute();
		$valeur_globale = $mat['prixachat'] + $valeur_globale;
		//--------------------------------------------------------------------------------------				
		}
		
		// --- la mise a jour du numéro de la convention -----------				
        foreach ($mats as $mat1){	
		Doctrine_Query::Create()
				->update('EleveMateriel em')
				->set('em.numero_convention','?',$num_conv)
				->where('em.id = ?', $mat1['id'])
				->andwhere('em.eleve_id = ?',$request->getParameter('eleve_id'))
				->execute();
		
		//--------------------------------------------------------------------------------------				
		}
		//recherche du responsable de l'élève
        $tuteur = Doctrine_query::create()
				->select ('t.eleve_id as id,R.nom as nom,R.prenom as prenom')
                ->from('Tuteur t')
				->innerjoin ('t.ResponsableEleve R ON R.id = t.responsableeleve_id')
                ->where('t.eleve_id=','?', $request->getParameter('eleve_id'))
                ->andWhere('t.tuteurlegal IS TRUE')
                ->fetcharray();
		
        ini_set('memory_limit', '-1');

        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetTitle('Convention Materiel');
        $pdf->SetSubject('convention materiel');
        $pdf->SetKeywords('convention, materiel');


        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetMargins(PDF_MARGIN_LEFT, 8, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
		
        //Entête convention
		//------------------
		
        //construction variables
        $html1 = '<i><span style="text-decoration:none;color:red;">&nbsp;Convention de prêt à usage individuel de matériel pédagogique adapté</span></i>';
		$html100='<i><span style="text-decoration:none;color:red;">Utilisable en dehors du milieu scolaire<center></span></i><br>';
        $pdf->SetX(30);
		$pdf->SetFont("Times", "", 14);
        $pdf->writeHTML($html1);
        $pdf->SetXY(60,15);
		$pdf->writeHTML($html100);
		$html11 = 'Secteur :      &nbsp;'.$eleve->getSecteur();
		$pdf->SetXY(15,30);
		$pdf->SetFont("Times", "", 10);
		$pdf->writeHTML($html11);
        $html111= 'N° de Convention :&nbsp;'.$num_conv ;
		$pdf->SetXY(130,30);
		$pdf->SetFont("Times", "", 10);
		$pdf->writeHTML($html111);
		
        // Article 1
		//------------
		
        $pdf->Cell(0, 10, "Article 1 :", 1, 1, 'L');

        $html2 = '<span style="line-height:3em;">La Présente convention détermine les conditions de prêt et l\'utilisation de matèriel acquis par l\'Education Nationale suite aux circulaires relatives au
" financement de matériel pédagogique adapté au bénéfice d\'élèves présentant des deficiences sensorielles, motrices ou mentales, intégrés en
milieu ordinaire " :</span>';
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html2);

        $html3 = '<BR>Ref : Circ 2001-061 du 05/04/01 - MENE0100757C, Circ 2001-221 du 29/10/01 - MENE0102353C,Circ IENA1/808/2001-2002/JYB-SB</P>';

        $pdf->SetFont("Times", "", 9);
        $pdf->writeHTML($html3);

        $recteur = constantes::RECTEUR;	// la classe constantes se trouve sous ashile/lib/constantes.php

       // $html6 = '<br>Le Rectorat de la Reunion représenté par, <B>Le Recteur de la Reunion : ' . $recteur . ' </B>';
    

        $html7 = 'Le Rectorat de la Reunion représenté par, <b>Le Recteur de la Reunion  </b><br>met à disposition de l\'élève : &nbsp;&nbsp;&nbsp;&nbsp;' . $eleve->getNom() .'&nbsp; '.  $eleve->getPrenom() .'  Né(e) le : ' . date('d-m-Y',strtotime($eleve->getDatenaissance())).
		'<br>domicilié : ' . $eleve->getAdresseelevebat() . ' ' . $eleve->getAdresseleverue() . ' ' . $eleve->getQuartier();
      
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html7);

		

        //$html8 = '<br><br>représenté par : ' . $tuteur[0]['nom'].'  '.$tuteur[0]['prenom'];

        //$pdf->SetFont("Times", "", 10);
        //$pdf->writeHTML($html8);

	
        
		 if ($countmats){ 
         if ($countmats == 1){  		 
        $html10 = '<br><span style="line-height:3em;">Le matériel pédagogique individuel adapté suivant : </span>' ;
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html10);
		}
		
		if ($countmats > 1){  		 
        $html10 = '<br><br>Les matériels pédagogiques individuel adaptés suivant : ' ;
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html10);
		}
		
        foreach ($mats as $mat) {
			$pdf->SetX(25);
            $listeMats = ' &nbsp;-&nbsp;'. $mat['libellecatmateriel'] . ', référence :'.$mat['libelle'].' immatriculé  sous le n° '. $mat['numero'].'</br>';
			$pdf->SetFont("Times", "", 10);
			$pdf->writeHTML( $listeMats);
        }

          

       	$prixglobale='<br><br>Valeur globale du matériel prêté '.$valeur_globale.' €';
		$html10 = '<br>pour son usage scolaire afin d\'effectuer des travaux afférents à sa scolarité.</span><br>';
				
		$pdf->writeHTML($prixglobale);
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html10);
		} //fin test countmats

		
		//Article 2
		//----------
        $pdf->SetFont("Times", "", 10);
        $pdf->Cell(0, 10, "Article 2 :", 1, 1, 'L');

        //$html11 = '<br>Ce prêt de matériel est '.$listeMats2.', et est révisable selon l\'évolution de la situation de l\'utilisateur.<br>';
        $html11 = '<span style="line-height:3em;">Ce prêt de matériel est consenti jusqu\'au  &nbsp;'.date('d-m-Y',strtotime($mat['datefin'])).', et est révisable selon l\'évolution de la situation de l\'utilisateur.</span>';
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html11);
		
		//Article 3
		//------------
        $pdf->SetFont("Times", "", 10);
        $pdf->Cell(0, 10, "Article 3 :", 1, 1, 'L');

        $html12 = '<span style="line-height:3em;">Le cocontractant utilisateur et ses représentants déclarent sur l\'honneur ne pas avoir été bénéficiaires par un dispositif
d\'état d\'une aide pour l\'acquisition ou d\'un prêt d\'un matériel similaire à celui décrit dans le présente convention.</span>';
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html12);
		
		//Article 4
		//------------
        $pdf->SetFont("Times", "", 10);
        $pdf->Cell(0, 10, "Article 4 :", 1, 1, 'L');

        $html13 = '<span style="line-height:3em;">Le cocontractant utilisateur et ses représentants sont tenus de veiller " en bon père de famille " à la garde 
et à la conservation du matériel pédagogique désigné ci-dessus.Le cocontractant utilisateur ne pourra utiliser, en classe et à son
domicile, que dans le cadre de sa scolarité et pour effectuer des travaux afférents à sa scolarité.Le tout à peine de dommages et
intérêts, s\'il y a lieu.

Le cocontractant utilisateur et ses représentants sont tenus de porter à la connaissance du Rectorat tout sinistre affectant le
matériel prêté.

Il est rappelé que, conformément à l\'article 1884 du Code civil, le responsabilité des représentants de l\'utilisateur sera engagé
en cas de perte, vol ou dégradation autre que celle liée à l\'usage conforme du matériel. </span>
';

        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html13);
		
		//Article 5
		//--------------
        $pdf->SetFont("Times", "", 10);
        $pdf->Cell(0, 10, "Article 5 :", 1, 1, 'L');

        $html14 = '<span style="line-height:3em;">La souscription d\'une assurance contractée par les représentants de l\'utilisateur pour ce matériel est vivement conseillée.<span>
';
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html14);
     
		
		//Article 6
		//-----------
		 $pdf->SetFont("Times", "", 10);
        $pdf->Cell(0, 10, "Article 6 :", 1, 1, 'L');

        $html15 = '<span style="line-height:3em;">Les frais d\'utilisation de ce matériel pouvant être amené au domicile sont, dans ce cadre, à la charge des représentants de l\'utilisateur.
A ce titre, les cartouches d\'encre, le changement de batterie de l\'ordinateur, et les éléments optionnels pouvant se greffer sur ces matériels sont à la charge de l\'utilisateur.</span><br><br>';
        $pdf->SetFont("Times", "", 10);
        $pdf->writeHTML($html15);

       
        $pdf->SetFont("Times", "", 10);
		$pdf->SetXY(30,237);
		$html555 = 'A SAINT DENIS le '.date('d-m-Y',time());
        $pdf->writeHTML($html555);
        //$pdf->SetXY(120,237);
		//$html555 ='le:   '.date('d-m-Y',time());
		//$pdf->writeHTML($html555);
		 $pdf->SetFont("Times", "", 10);
		$pdf->SetXY(120,237);
		$pdf->writeHTML("Livré le:");
		$pdf->SetXY(30,249);
        $pdf->writeHTML("Pour le Rectorat:");

        $pdf->SetXY(110,249);
		$pdf->writeHTML("NOM,PRENOM,QUALITE et SIGNATURE");
		
		
		$nom_conv='conv_'.$num_conv.'_sect_'.$info_eleve[0]['libellesecteur'].'_'.date('d-m-Y',time()).'_'.$eleve->getNom().'-'.$eleve->getPrenom().'.pdf';
       // $nom_conv ='titi.pdf';

        //visualisation de la convention
		//---------------------------------
		ob_end_clean();
		$pdf->Output($nom_conv, 'I');
		
		
		//enregistrement de la convention sur le serveur 
		////----------------------------------------------
		$uploadDir = sfConfig::get('sf_upload_dir') ;
		$pdf->Output( $uploadDir . "/conventions/" .$nom_conv, 'F');
        
		
		//enregistrement du path de la convention pour chaque prêt présent sur la convention
		//---------------------------------------------------------------------------------
		if($_SERVER['REMOTE_ADDR'] == '192.168.220.3' || $_SERVER['REMOTE_ADDR'] == '192.168.220.6'){ //serveur portail
		$chemin_conv = 'https://portail.ac-reunion.fr/ashilep/uploads/conventions/'.$nom_conv;
		}
		if($_SERVER['REMOTE_ADDR'] == '172.31.176.121'){ //serveur accueil
		$chemin_conv = 'https://accueil.in.ac-reunion.fr/ashilep/uploads/conventions/'.$nom_conv;
		}
	//

      // --- la mise a jour du chemin de stockage de la convention -----------				
        foreach ($mats as $mat1){	
		Doctrine_Query::Create()
				->update('EleveMateriel em')
				->set('em.chemin_conv','?',$chemin_conv)
				->where('em.id = ?', $mat1['id'])
				->execute();
		}
		//--------------------------------------------------------------------------------------
		$this->getUser()->setFlash('notice', 'ne pas oublier de finaliser le traitement des demandes de matériel : ');

		
        // Stop symfony process
        throw new sfStopException();
        
     	
}

public function executeBdlpdf(sfWebRequest $request)
	// Génération du bon de livraison par secteur au format PDf
    {
        
		//récupération de la liste des matériels selectionnés
		$lesMats = $request->getParameter('lesMats');
   
    		
         // recherche de l'annee scolaire en cours
        $anneescolaire = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();

        //recherche des matériels à éditer sur le bon de livraison
		//---------------------------------------------------------
		$mats = Doctrine_Query::Create()
		->select('e.id as id,s.id as secteur_id,el.id as eleve_id,m.numeromateriel as numero,m.libellemateriel as libelle,t.libelletypemateriel as libelletype,e.dateconvention as dateconvention,
		e.eleve_id as eleveId, p.id as mouvementMaterielId, p.mouvement_id as mouvementId, e.materiel_id as materiel_id, 
		m.typemateriel_id as typeMateriel, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin,el.secteur_id as secteur_id,
		s.libellesecteur as libellesecteur,el.nom as nom,el.prenom as prenom,el.datenaissance as datenaissance')
		->from('EleveMateriel e')
		->innerjoin('e.Materiel m ON m.id = e.materiel_id')
		->leftjoin('m.Typemateriel t ON t.id = m.typemateriel_id')
		->leftjoin('m.MouvementMateriel p ON p.materiel_id = m.id')
		->leftjoin('e.Eleve el ON e.eleve_id = el.id')
		->leftjoin('el.Secteur s ON el.secteur_id = s.id')
	//	->where('e.id =?',  1865)
		->whereIn('e.id', explode(",",$lesMats))	// on enlève la virgule qui sépare les materiels selectionnés dans la fonction 'editionBdl' de convSuccess
		->fetcharray();	
        $countmats = count($mats);
		
		 
		 
		//Mise à jour de la date de remise aux parents pour le matériel selectionné
		//----------------------------------------------------------------------------
		if(strlen($lesMats) > 0 && $request->getParameter('dateremiseparent')){	 //Si le matériel est selectionné
		
		
		     	// --- récupèration du mouvement_id "REMIS"
				//-----------------------------------------
				$remis = Doctrine_Query::create()
							->select('m.id as id')
							->from('mouvement m')
							->where('m.nommouvement LIKE "%REMIS%"')
							->fetcharray();
							
				//recherche de l'ID traitement REMIS
				//-------------------------------------
				$traitement = Doctrine_Query::create()
				->select('t.id as traitement_id')
				->from('Traitement t')
				->where('t.libelletraitement LIKE "%REMIS%"')
				->limit(1)
				->execute();

	           foreach ($mats as $mat1){	
		
				$dateremiseparent =  date('Y-m-d',strtotime($request->getParameter('dateremiseparent')));
				// -----update de la fin mouvement a la date de debut du mouvement suivant ----------------//
				// --- on commence par trouver le dernier mouvement du materiel en cours date de fin non renseignée
				
				$res = Doctrine_Query::create()
							->select('b.materiel_id as materiel_id,MAX(b.datedebut) as datedebut,MAX(b.id) as id,f.nommouvement as nommouvement')
							->from('MouvementMateriel b')
							->where('b.datefin is null')
							->innerjoin('b.Mouvement f ON f.id = b.mouvement_id')
							->groupBy('b.materiel_id')
							->having('b.materiel_id = ?', $mat1['materiel_id'])
							->fetchArray();
			
									
				// --- la mise a jour date fin du dernier mouvement mise à jour avec la date de
				// début de prêt
							 
				$majDate = Doctrine_Query::create()
						->update('MouvementMateriel a')
						->set('a.datefin','?',$dateremiseparent)
						->where('a.materiel_id = ?', $mat1['materiel_id'])
						->andWhere('a.id = ?', $res[0]['id']);

				 $majDate->execute();

			
			// --- on crée un mouvement pour ce materiel
				$mouv_mat = new MouvementMateriel();
				

				
				//mise au format de la date de remise au aux parents
				$dateremiseparent =  date('Y-m-d',strtotime($request->getParameter('dateremiseparent')));
				
				// Initialisation du nouveau mouvement_materiel à l'état Remis avec une date
				//de début correspondant à la date de début d'attribution et date de fin non renseignée
				//------------------------------------------------------------------------------------
				$mouv_mat->setMaterielId($mat1['materiel_id']);
				$mouv_mat->setMouvementId($remis[0]['id']);
				$mouv_mat->setDatedebut($dateremiseparent);

				
				$dernierMouv = $mouv_mat->save();
				//mise à jour de la date de début de prêt avec la date saisie de remise au parents pour chaque matériel selectionné
				
					Doctrine_Query::Create()
					->update('EleveMateriel d')
					->set(array('d.datedebut' =>$dateremiseparent))
					->where('d.id = ?', $mat1['id'])
					->execute();
					
				//Mise à jour de la  demande matériel via le numéro de matériel pour mettre le traitement de la demande à REMIS
				//------------------------------------------------------------------------------------------------------------
				$majdemande = Doctrine_Query::create()
				->update('DemandeMateriel d')
				->set('d.traitement_id',$traitement[0]['id'])
				->where('d.materiel_id = ?', $mat1['materiel_id'])
				->execute();
				
		      }// foreach
					$this->getUser()->setFlash('notice', 'la date de remise aux parents du matériel mise à jour  à la date du  '.$request->getParameter('dateremiseparent').' pour le secteur de '.$mats[0]['libellesecteur']);
					$this->redirect('secteur/recherche3?secteur_id='.$mats[0]['secteur_id']);
		}
		
		//MISE à jour de la dateremiseerf pour les prêts selectionnés (pas d'affichage du bon de livraison)
		//------------------------------------------------------------------------------------------------
		
		//récupération de la date saisie
		 $daremiseref =  date('Y-m-d',strtotime($request->getParameter('dateremiseerf')));
		 
		if($request->getParameter('dateremiseerf')   && strlen($lesMats) > 0){ //si la date de mise à jour est saisie et les prêts selectionnés
	    // --- la mise à jour des prêts selectionnées - champs concernant la date remise erf				
			foreach ($mats as $mat1){	
			Doctrine_Query::Create()
					->update('EleveMateriel d')
					->set(array('d.dateremiseerf' =>  $daremiseref))
					->where('d.id = ?', $mat1['id'])
					->execute();
			}
			
			
		$this->getUser()->setFlash('notice', 'la date de remise à l\'enseignant du matériel mise à jour  à la date du  '.$request->getParameter('dateremiseerf').' pour le secteur de '.$mats[0]['libellesecteur']);
		$this->redirect('secteur/recherche3?secteur_id='.$mats[0]['secteur_id']);
		
		}elseif($request->getParameter('dateremiseerf') && strlen($lesMats) == 0) {
		$this->getUser()->setFlash('error', 'Vous devez selectionner un matériel');
		$this->redirect('secteur/recherche3?secteur_id='.$mats[0]['secteur_id']);
		}
		
		
         ini_set('memory_limit', '-1');

        $config = sfTCPDFPluginConfigHandler::loadConfig();

        // pdf object
        $pdf = new sfTCPDF();

        // set document information
        $pdf->SetTitle('Bon de livraison du Materiel');
        $pdf->SetSubject('Bon de livraison du Materiel');
        $pdf->SetKeywords('livraison, materiel');


        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetMargins(PDF_MARGIN_LEFT, 8, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Ajouter une page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();
		
        //Entête Bon de Livraison
		//-------------------------
	    //construction variables
		$secteur = $mats[0]['libellesecteur'];
		
		//Entête édition;
        $html1 = '<i><span style="text-decoration:none;color:red;">&nbsp;Bon de livraison du matériel</span></i>';
		$html100='<i><span style="text-decoration:none;color:red;">Secteur de :<center></span></i><br>';
		$html101='<i><span style="text-decoration:none;color:red;">'.$secteur.'<center></span></i><br>';
        $pdf->SetX(70);
		$pdf->SetFont("Times", "", 14);
        $pdf->writeHTML($html1);
        $pdf->SetXY(70,15);
		$pdf->writeHTML($html100);
		$pdf->SetXY(95,15);
		$pdf->writeHTML($html101);

		//Liste des matériels livrés
		//---------------------------
		$pdf->SetFont("Times", "", 10);
	    $pdf->SetXY(150,30);
		
		if ($countmats >= 1){  		 
		
        foreach ($mats as $mat) {
			
            $listeMats = '- '.$mat['libelletype'].'- réf : '. $mat['libelle'] . ' immatriculé  sous le n° '. $mat['numero'].'</br>';
			
			$eleve = 'prêté(e) à : ' . $mat['nom'].'  '.$mat['prenom'].' né(e) le  '.date('d-m-Y',strtotime($mat['datenaissance']));
			$prêt = 'pour la période du '.date('d-m-Y',strtotime($mat['datedebut'])).' au '.date('d-m-Y',strtotime($mat['datefin']));
			$pdf->SetX(25);
			$pdf->writeHTML( $listeMats);
			$pdf->SetX(29);
		    $pdf->writeHTML($eleve);
			$pdf->SetX(29);
		    $pdf->writeHTML($prêt);
        }
        }
	
        $nomfichier = 'bdl-'.$mat['libellesecteur'];	
	    $pdf->Output($nomfichier, 'I');
        // Stop symfony process
        throw new sfStopException();
        
     	
}

public function executeAide(){}	
}
