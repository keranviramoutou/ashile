<?php

/**
 * materiel2 actions.
 *
 * @package    ash
 * @subpackage materiel2
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class materielActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	//if(isset($_POST['etat'])){  
    //$etat_matériel = '%'.$_POST['etat'].'%';  
	$liste_materiel = $request->getParameter('listemateriel');
	$liste_materiel = str_replace('|', ',', $liste_materiel );

	
    // liste des materiels
	//--------------------
	$this->materiels = Doctrine_Query::Create()
                ->select ('m.id as id, q.libellemarque as marque,s.datefin as datefin, f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as nom, m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel, m.caracteristiquemateriel as caracteristiqueMateriel, m.numeromateriel as numeroMateriel, m.commentaire as commentaire')
                ->from('Materiel m')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->leftJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
				->whereIn('m.id',explode(",",$liste_materiel))
			//	->where ('f.nommouvement LIKE ?', $etat_matériel)
				//->andWhere('s.datefin >=?', date('Y-m-d', time()))
                ->fetcharray();  
  }

  
    public function executeTraitementMat(sfWebRequest $request)
  {

	if(Null == $request->getParameter('lesMats')){
	
	// $this->getUser()->setFlash('notice','gggaaa'.$request->getParameter('lesMats'));
	
    // Liste des matériels en stock
	//---------------------------------
		//liste des matériels en fonction de l'état à la date d'obervation et dernier mouvement 
		//------------------------------------------------------------------------------------
		$this->materiels = Doctrine_Query::Create()
                ->select ('m.id as id, q.libellemarque as marque,s.datefin as datefin,s.datedebut as datedebut, f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as nom,
				m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel,t.libelletypemateriel as libelletypemateriel,c.libellecatmateriel as libellecatmateriel,
				 m.numeromateriel as numeromateriel, m.commentaire as commentaire, m.libellemateriel as libellemateriel')
                ->from('MouvementMateriel s')
				->innerJoin('s.Materiel m ON s.materiel_id = m.id')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
				->leftjoin('m.Catmateriel c ON  c.id =  m.catmateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
				->where('f.nommouvement LIKE ?', '%STOCK%')
				//->andwhere ('t.libelletypemateriel LIKE ?', $typemat)
			 //	->andWhere('s.datedebut <=?', date('Y-m-d', $date_observation))
			    ->andWhere('s.datefin IS NULL')
			    ->andWhere('m.numeromateriel = "" ')
                ->fetcharray(); 
				
				
    }else if(strlen($request->getParameter('lesMats')) > 1 ){
  
  
       // $this->getUser()->setFlash('error','gggaaaqqq'.$request->getParameter('lesMats'));
	   	$listmat =explode(",",$request->getParameter('lesMats') );
		$count=count($listmat) ;
		$listmat= array_chunk($listmat, 2) ; //redimensionne la variable en tableau à 2 dimensions
	
		if($count == 2){
		$limit = 1;
		}else{
		$limit = $count -1;
		}
		$list_mat=array();
			
       	// --- la mise a jour du numéro de matériel -----------		
        //--------------------------------------------------------		
        for($ligne = 0; $ligne < count($listmat); $ligne++) {

					$majMat = Doctrine_Query::Create()
					->update('Materiel m')
					->set('m.numeromateriel', '?',$listmat[$ligne][1] )
					->where('m.id = ?', $listmat[$ligne][0])
					->andwhere ('m.numeromateriel = "" ')
					->execute();		
          
	   //	$this->getUser()->setFlash('error','listmat '.$listmat[0][1].' id '.$listmat[0][0].' count '.$count);
			
		}
		
  		//liste des matériels en fonction de l'état à la date d'obervation et dernier mouvement 
		//------------------------------------------------------------------------------------
		$this->materiels = Doctrine_Query::Create()
                ->select ('m.id as id, q.libellemarque as marque,s.datefin as datefin,s.datedebut as datedebut, f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as nom,
				m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel,t.libelletypemateriel as libelletypemateriel,c.libellecatmateriel as libellecatmateriel,
				 m.numeromateriel as numeromateriel, m.commentaire as commentaire, m.libellemateriel as libellemateriel')
                ->from('MouvementMateriel s')
				 ->innerJoin('s.Materiel m ON s.materiel_id = m.id')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
				->leftjoin('m.Catmateriel c ON  c.id =  m.catmateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
				->where('f.nommouvement LIKE ?', '%STOCK%')
				//->andwhere ('t.libelletypemateriel LIKE ?', $typemat)
			 //	->andWhere('s.datedebut <=?', date('Y-m-d', $date_observation))
			    ->andWhere('s.datefin IS NULL')
			    ->andWhere('m.numeromateriel = "" ')
                ->fetcharray(); 
  
  }
}
  
  public function executeNew(sfWebRequest $request)
  {
    
	//recherche du dernier id de l'élève
	//------------------------------------
     $req = Doctrine_Query::create()
                ->select('max(m.numeromateriel) as maxnumero')
                ->from('Materiel m')
                ->fetcharray();
				
		if($req[0]['maxnumero'] >= 10000){
		$numeromateriel = $req[0]['maxnumero'] + 1 ;
		}else{
		$numeromateriel = 10000 ;
		}
		//Affectation d'un numéro de matériel
		//------------------------------------
		$materiel = new Materiel();
		$materiel->setNumeromateriel($numeromateriel);
		$materiel->setLibellemateriel('');
		$this->form = new MaterielForm($materiel);
  }

  public function executeCreate(sfWebRequest $request)
  {
	  
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MaterielForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  
  }

  public function executeEdit(sfWebRequest $request)
  {
 
	// liste des eleves a qui ont a pr^té le matériel selectionné 
	//-----------------------------------------------------------
	$this->eleveMateriel = Doctrine_Query::Create()
				->select('e.eleve_id as eleve_id, e.materiel_id as materiel_id, e.dateconvention as dateconvention, e.datedebut as datedebut, e.datefin as datefin, l.nom as nomeleve, l.prenom as prenomeleve')
				->from('EleveMateriel e')
				->innerJoin('e.Materiel m ON m.id = e.materiel_id')
				->innerJoin('e.Eleve l ON l.id = e.eleve_id')
				->where('e.materiel_id = ?', $request->getParameter('id'))
				->fetchArray();
	
 
	// les mouvements du materiel selectionné
	//-------------------------------------------
	$this->mouvements = Doctrine_Query::Create()
                ->select ('v.id as mouvementmateriel_id, v.datedebut as datedebut,v.materiel_id as materiel_id, v.datefin as datefin, m.nommouvement as nommouvement,v.notes as notes')
                ->from('MouvementMateriel v')
                ->innerJoin('v.Materiel t ON  t.id =  v.materiel_id')
                ->innerJoin('v.Mouvement m ON  m.id =  v.mouvement_id')
                ->where('v.materiel_id = ?', $request->getParameter('id'))
                ->fetchArray();
    
 
    $this->forward404Unless($materiel = Doctrine_Core::getTable('Materiel')->find(array($request->getParameter('id'))), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    
    $this->materiel = $materiel;
    $materiel_id = $this->materiel->getId();
    $this->form = new MaterielForm( $this->materiel,$this->mouvements,$this->eleveMateriel,$materiel_id);
  }

  public function executeUpdate(sfWebRequest $request)
  {
	  
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($materiel = Doctrine_Core::getTable('Materiel')->find(array($request->getParameter('id'))), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterielForm($materiel);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($materiel = Doctrine_Core::getTable('Materiel')->find(array($request->getParameter('id'))), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $materiel->delete();

    $this->redirect('materiel/index');
  }

	protected function processForm(sfWebRequest $request, sfForm $form)
  {
	  
	  	$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
	  	$param = $request->getParameter($form->getName());
	  	
		// --- préparation des libelles
		$marque = Doctrine::getTable('Marque')->find($param['marque_id']);
		$type = Doctrine::getTable('Typemateriel')->find($param['typemateriel_id']);
		$libelle = $param['libellemateriel'];
		$nb = intval($param['nbmateriel']);		
	  
	if($form->getObject()->isNew())
	{  

			if ($form->isValid())
			{
			$form->save();

					// 1) recherche de l'id du mouvement 'CREATION'
					$stock = Doctrine_Query::Create()
								->select('m.id')
								->from('Mouvement m')
							//	->where('m.nommouvement LIKE "%CREATION%"')
							    ->where('m.nommouvement LIKE "%STOCK%"')
								->fetchArray();
				
			
					// 2) on créé le mouvement corespondant au matériel  à l'état EN STOCK
					$newMouvementsMateriel = new MouvementMateriel();
					$newMouvementsMateriel->setArray(array(
											'materiel_id'	=>	$form->getObject()->getId(),
											'mouvement_id'	=>	$stock[0]['id'],
											// on fixe la date de debut 
											'datedebut'		=>	date('Y-m-d', time())
											));
				     $newMouvementsMateriel->save();
					 
                   $listemateriel=$form->getObject()->getId();					 
				
			     //Duplication des fiches de matériel si le nombre de matériel à dupliquer > à 1
							
					$newMat = $form->getObject();
					// ------------ boucle for qui ajoute le nombre de materiel a enregistrer dans la base ---------	
					for($i = 1; $i<$nb; $i++)
					{
					    //duplication fiche matériel
						$newMat = $newMat->copy(true);
						$newMat->save();
						
					$listemateriel=$newMat->getId().'|'.$listemateriel;
					$listemateriel=preg_replace('/\s/', '', $listemateriel); 	
						// on recrée des mouvements_materiel pour les materiels x nb à l'état CREATION	
						$newMouvementsMateriel = new MouvementMateriel();
						$newMouvementsMateriel->setArray(array(
													'materiel_id'	=>	$newMat->getId(),
													'mouvement_id'	=>	$stock[0]['id'],
													'datedebut' 	=> 	date('Y-m-d', time()),
													//'datefin'     => 	date('Y-m-d', time())
													));
						$newMouvementsMateriel->save(); 						
					}
		        $this->getUser()->setFlash('notice',$nb.' création(s) de matériel de type '.$type.' '.$libelle.' de marque '.$marque.' sauvegardé(s)'); // Pour les message	
		} // fin test enregistrement est nouveau
			if(!$form->getObject()-> getLibellemateriel()){
				$this->getUser()->setFlash('error','le libellé est un champs obligatoire'.$form->getObject()-> getLibellemateriel()); // Pour les message d'erreur
			    $this->redirect('materiel/new');
			}else{
			//$this->redirect('materiel/index');
		    $this->redirect('materiel/index?listemateriel='.$listemateriel);
			}
			
	}	
	
	   // --- Modification d'un matériel ----
	   //-------------------------------------
		if(!$form->getObject()->isNew()) //matériel en edit
		{
			if ($form->isValid())
			{
		    /* 
			// -- recherche du dernier mouvement de ce materiel ----
				$derMouvMat = $form->getObject()->getDernierMouvId();
			*/	
					
				$form->save();											// on enregistre le form
			/*	$newMouvMat = $form->getObject()->getDernierMouvId();  		// on regarde si un nouveau materiel_mouvement a été enregistré
				
				if($newMouvMat)
				{
					$mouv = Doctrine::getTable('MouvementMateriel')->findOneById($derMouvMat);		// le mouvement avant enregistement
					$newMouv = Doctrine::getTAble('MouvementMateriel')->findOneById($newMouvMat);		// le mouvement après l'enregistrement
	
						if($mouv->getMouvement() == 'REMIS')	// si ce dernier mouvement est 'REMIS' on doit mettre la date de fin eleve_materiel à la date de début du nouveau mouvement_materiel
						{
							// -- recherche du dernier eleve_materiel de ce materiel
							$derEleveMatId = $form->getObject()->getDerElveMatId();   // cette methode retourne l'id du dernier eleve_mat de ce materiel
																	
							// -- update de ce eleve_materiel
							$updateEleveMat = Doctrine_Query::Create()
										->update('EleveMateriel em')
										->set('em.datefin', '?',  $newMouv->getDatedebut())
										->where('em.id = ?', $derEleveMatId);
							
							$updateEleveMat->execute();		
						}
					// si il y a un nouveau mouvement_materiel pour ce materiel	
					if($newMouvMat != $derMouvMat)
					{	
					  $dateDebutNewMouv = Doctrine::getTable('MouvementMateriel')->findOneById($newMouvMat);	
					// -- update du dernier mouvement-materiel
							$updateMouvMat = Doctrine_Query::Create()
										->update('MouvementMateriel mm')
										->set('mm.datefin', '?', $dateDebutNewMouv->getDatedebut())
										->where('mm.id = ?' , $derMouvMat);

						$updateMouvMat->execute();
					}
				} 

				*/
				$this->getUser()->setFlash('notice', 'Enregistrement sauvegardé'); // Pour les message
				$this->redirect('materiel/edit?id='.$form->getObject()->getId());
 			
			}
		}
	}
  public function executeAide(){}	
}
