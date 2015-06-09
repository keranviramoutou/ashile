<?php

/**
 * mdph actions.
 *
 * @package    ash
 * @subpackage mdph
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdphActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->mdphs = Doctrine_Core::getTable('mdph')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->mdph = Doctrine_Core::getTable('mdph')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mdph);
  }

  public function executeNew(sfWebRequest $request)
  {
  
   //création d'un dossier mdph pour l'élève selectionné
   //---------------------------------------------------
	$mdph = new Mdph();
	$mdph->setEleveId($request->getParameter('eleve_id'));
	
	$mdph->save();
	
	$message = 'dosssier MDPH n°'.$mdph->getId().'créé avec succés' ;
	
	//création d'une demande avs correspondant au dossier MDPH créé
	//-----------------------------------------------------------
	$note = 'création Académique du : ' .date('d/m/Y h:m', time()); 
	$mdph_id = $mdph->getId();
	$demandeavs = new Demandeavs();
	$demandeavs->setNotes($note);
    $demandeavs->setMdphId($mdph_id);
	$demandeavs->save();
	
	$message = 'demande avs n° '.$demandeavs->getId(). ' pour le dossier MDPH n° '.$mdph->getId().' créée avec succès' ;
	$this->getUser()->setFlash('notice',$message );
	$this->redirect('eleve/recherche?eleve_id='.$request->getParameter('eleve_id').'eleve_nom='.$request->getParameter('eleve_nom').'&eleve_prenom=' . $request->getParameter('eleve_prenom').'&flag_recherche='.$request->getParameter('flag_recherche'));

  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new mdphForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mdph = Doctrine_Core::getTable('mdph')->find(array($request->getParameter('id'))), sprintf('Object mdph does not exist (%s).', $request->getParameter('id')));
    $this->form = new mdphForm($mdph);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mdph = Doctrine_Core::getTable('mdph')->find(array($request->getParameter('id'))), sprintf('Object mdph does not exist (%s).', $request->getParameter('id')));
    $this->form = new mdphForm($mdph);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $message='';
	
	//comptage des enregistrements à supprimer
	//-----------------------------------------
	
		$this->existdemandeavs = Doctrine_Query::create()
        ->select('d.id')
        ->from('DemandeAvs d')
		->Where('d.datedecisioncda is  null')
		->andwhere ('d.naturecontratavs_id IS NULL')
		->andwhere ('d.mdph_id=?',$request->getParameter('id'))
		->limit(1)
        ->fetchArray();
        $countdemande =count( $this->existdemandeavs);
		
	if($countdemande > 0)	{
	
    //suppression des demandes avs avant suppression du dossier mdph correspondant.
	//----------------------------------------------------------------------------
     $request->checkCSRFProtection();
	 			$this->demandeavs = Doctrine_Query::create()
                ->delete('*')
                ->from('DemandeAvs d')
			    ->Where('d.datedecisioncda IS NULL')
				->andwhere ('d.naturecontratavs_id IS NULL')
				->andwhere ('d.mdph_id=?',$request->getParameter('id'))
                ->fetchArray();

	
	 $this->forward404Unless($this->demandeavs, sprintf('Object demandeavs does not exist (%s).', $request->getParameter('id')));
	$message ='suppression réussie de(s) demande(s) d\'avs concernant le dossier MDPH n° '. $request->getParameter('id')	;
	
	}
	
	
	//suppression du dossier mdph si ils n'existent pas de demande avs traitée (décision cda est pas nulle et nature de la demande renseignée).
	//-----------------------------------------------------------------------------------------------------------------------------------
		 $this->existdemandeavs = Doctrine_Query::create()
        ->select('d.id')
        ->from('DemandeAvs d')
		->where ('d.naturecontratavs_id > 0')
		//->andwhere('d.decisioncda IS NOT NULL')
		->andwhere ('d.mdph_id=?',$request->getParameter('id'))
	    ->fetchArray();
        $countdemandeavs =count( $this->existdemandeavs);
		
	if ($countdemandeavs > 0)
	{ 
    $message='cette demande ne peut être supprimée cette demande a une nature de demande ';
	}else{//dossier mdph détruit si il n'existe pas de demandes en cours de traitement
	$this->forward404Unless($mdph = Doctrine_Core::getTable('mdph')->find(array($request->getParameter('id'))), sprintf('Object mdph does not exist (%s).', $request->getParameter('id')));
    $mdph->delete();
	$message = $message .',suppression réussi du dossier MDPH n°'. $request->getParameter('id');
	}
	$this->getUser()->setFlash('notice',$message );
	$this->redirect('demandeavs/list1?eleve_id='.$request->getParameter('eleve_id'));

  }
  
   public function executeSupprMdph(sfWebRequest $request)
  {
    //Suppression d'un dossier MDPH
	/////////////////////////////////
  	
	if ($_POST['eleve_id'] && $_POST['mdph_id']  ){
	
	$eleve_id = $_POST['eleve_id']; 
	$mdph_id = $_POST['mdph_id']; 	

	
	
	$this->eleve  = Doctrine_Query::Create()
	->select('*')
	->from ('Eleve e')
	->where('e.id = ?',$eleve_id)
	->fetcharray();
	
     $this->mdph  = Doctrine_Query::Create()
	->select('*')
	->from ('Mdph m')
	->where('m.eleve_id = ?',$eleve_id)
	->andwhere('m.id = ?',$_POST['mdph_id'])
	->execute();
	$count_mdph = count($this->mdph );
	
	if ($this->eleve &&  $count_mdph > 0){ //élève et dossier MDPH existant
 

		
	 foreach($this->mdph as $mdphs) {
			$this->message = $this->message.'<br><b>Dossier MDPH :'.$mdphs['id'].'</b><br>';
		  
		  //demande AESH
			$this->demandeavs = Doctrine_Core::getTable('DemandeAvs')->findByMdphId($mdphs['id']);
			$count_demande_avs = count($this->demandeavs);
			
			if($count_demande_avs > 0){
			
				    $this->demandeavs->delete();
					$this->message = $this->message.'<br>Demande AESH dossier AESH n° :'.$mdphs['id'].' supprimée';
				//	$this->getUser()->setFlash('notice','okkkkaaaaaaaaaaaaa' .$count_demande_avs.'gg'.$message);
			}
			
			//demande matériel
			$this->demandemateriel = Doctrine_Core::getTable('DemandeMateriel')->findByMdphId($mdphs['id']);
			$count_demandemateriel = count($this->demandemateriel);
			if($count_demandemateriel > 0){
				$this->demandemateriel->delete();
				$this->message = $this->message.'<br>Demande Matériel dossier AESH n° :'.$mdphs['id'].' supprimée';
			}
		
			//demande transport
			$this->demandetransport = Doctrine_Core::getTable('DemandeTransport')->findByMdphId($mdphs['id']);
		    $count_demandetransport = count($this->demandetransport);
			if( $count_demandetransport > 0){
				
				$this->demandetransport->delete();
				$this->message = $this->message.'<br>Demande de Transport dossier AESH n° :'.$mdphs['id'].' supprimée';
				//$this->getUser()->setFlash('notice', 'transport'.$this->demandetransport->mdph_id.$mdphs['id']);
			}

			//demande sessad
			$this->demandesessad = Doctrine_Core::getTable('DemandeSessad')->findByMdphId($mdphs['id']);
			 $count_demandesessad = count($this->demandesessad);
			if( $count_demandesessad > 0){
				$this->demandesessad->delete();
				$this->message = $this->message.'<br>Demande de Sessad dossier AESH n° :'.$mdphs['id'].' supprimée';
			}
			
			//Demande orientation
			$this->demandeorientation = Doctrine_Core::getTable('DemandeOrientation')->findByMdphId($mdphs['id']);
			 $count_demandeorientation = count($this->demandeorientation);
			if($count_demandeorientation > 0){
				$this->demandeorientation->delete();
				$this->message = $this->message.'<br>Demande d\'orientation dossier AESH n° :'.$mdphs['id'].' supprimée';
			}
			
			//Bilan(s)
			$this->bilan = Doctrine_Core::getTable('Bilan')->findByMdphId($mdphs['id']);
			 $count_bilan = count($this->bilan);
			if( $count_bilan > 0){
				$this->bilan->delete();
				$this->message = $this->message.'<br>Bilan(s) dossier AESH n °:'.$mdphs['id'].' supprimé(s)';
			}
			
			
			//piece(s) complémentaire(s) au dossier
			$this->piecedossier = Doctrine_Core::getTable('PiecesDossier')->findByMdphId($mdphs['id']);
			$count_piecedossier = count($this->piecedossier);
			if($count_piecedossier > 0){
				$this->piecedossier->delete();
				$this->message = $this->message.'<br>Pièces complémentaires(s) dossier AESH n °:'.$mdphs['id'].' supprimé(s)';
			}
			
			//dossier MDPH
			$this->mdph1 = Doctrine_Core::getTable('Mdph')->findById($mdphs['id']);
			$count_mdph1 = count($this->mdph1);
			if($count_mdph1 > 0){
				$this->mdph1->delete();
			     $this->getUser()->setFlash('notice', 'Suppression du dossier MDPH n° '. $this->mdph[0]['id'].' pour l\'élève  : '. $this->eleve[0]['nom'].'&nbsp;'.$this->eleve[0]['prenom'].' effectuée' );
				//$this->message = $this->message.'<br><b>Dossier(s) MDPH :'.$mdphs['id'].' supprimé(s)</b><br>';
			}

	
		}  // fin foreach
	
	
		//SAUVEGARDE de la trace de la suppression
		//----------------------------------------
		
		//sauvegarde du message pour l'élève est supprimé
		//---------------------------------------------------------
		$mail = new Mail();
		$corps_message = 'Suppression du dossier MDPH n° '.$this->mdph[0]['id'].' de '. $this->eleve[0]['nom'].' '.$this->eleve[0]['prenom'].' ('.$this->eleve[0]['id'].') réalisé avec succès';
		$date = date('Y-m-d', time()) ;
		$mail->setEleveId($this->eleve[0]['id']);
		$mail->setSfguarduserId($destinataire_eleve[0]['sfguarduser_id']);
		$mail->setSujet('Suppression de dossier MDPH n° '.$this->mdph[0]['id']);
		$mail->setTexte($corps_message);
		$mail->setDate($date);
		$mail->save();
		

		
		}else{ // test élève et dossier MDPH  existants
			if (!$this->eleve[0]['id']  ){  
				$info ='élève à l\'Id : '.$eleve_id. ' inexistant,' ;
			 }
			 
			if (!$this->mdph[0]['id'] ){  
			  $info = $info .' Dossier MDPH : '.$mdph_id. ' inexistant' ;
			 }
			$this->getUser()->setFlash('error',$info);
		}
		
		}else{ //fin de test valeur Id du dossier MDPH et élève saisie
	
		if (!$eleve_id ){  
		$info ='Saisir l\'élève Id' ;
		 }
		 
		if (!$mdph_id ){  
		  $info = $info .', saisir l\'id du dossier MDPH' ;
		 }
		$this->getUser()->setFlash('error', $info);
		}
	}




  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mdph = $form->save();

      $this->redirect('mdph/edit?id='.$mdph->getId());
    }
  }
  
  	public function executeAide(){}	
}
