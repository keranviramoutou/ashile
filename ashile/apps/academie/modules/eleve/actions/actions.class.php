
<?php

/**
 * eleve actions.
 *
 * @package    ash
 * @subpackage eleve
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eleveActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {

        $annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $deb = $annee->getDatedebutanneescolaire();
        $fin = $annee->getDatefinanneescolaire();

        $this->eleves = Doctrine_Core::getTable('Eleve')->getListEleves();
		
  }
  
  	
	   public function executePbscolarite(sfWebRequest $request)
    {

        
         $this->elevespbscolarite =  Doctrine_Core::getTable('Eleve')->getListeEleveAvecScolaritéIncomplete();
 
    }
  
    public function executeCompareSecteurScoSecteurEleve(sfWebRequest $request)
  {
        $this->comparesecteur = Doctrine_Core::getTable('Orientation')->getCompareSecteurScoSecteurEleve();
		$nbsynchro =count($this->comparesecteur);
		if( $request->getParameter('synchro') == 1) {
		
	        $nb=0;
		     foreach($this->comparesecteur as $comparesecteurs) {
			$nb=$nb+1;
     		//MISE à jour du secteur de la fiche élève avec le secteur de l'établissement de la scolarité en cours
			//-----------------------------------------------------------------------------------------------------						
						$majDate = Doctrine_Query::create()
							->update('Eleve e')
							->set('e.secteur_id','?',$comparesecteurs['secteur_id_etab'])
							->where('e.id = ?', $comparesecteurs['eleve_id'])
						    ->execute(); 
			}
      $this->getUser()->setFlash('notice', 'Modification(s) effectuées avec succès : pour '.$nb.' élève(s)');
 
			
		}
  }
  
 /*liste des élèves par secteur
 
  public function executeSecteur(sfWebRequest $request)
  {
	    $secteur_id= '%'.$_POST['secteur_id'].'%';  
        $annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $deb = $annee->getDatedebutanneescolaire();
        $fin = $annee->getDatefinanneescolaire();

        $this->eleves = Doctrine_Core::getTable('Eleve')->getListElevesparSecteur($request->getParameter('secteur_id'));
	
  }
     */
    public function executeIndex1(sfWebRequest $request)
  {
		//liste des élèves qui ont un AVS affecté.
		//-------------------------------------------
		
		$this->eleves = Doctrine_Core::getTable('Eleve')-> getListeEleveSuiviAVS();
		        
  }
  
  public function executeNew(sfWebRequest $request)
  {
  
    $eleve_nom = $_POST['nom_eleve'];  
	$eleve_prenom = $_POST['prenom_eleve'];
	$eleveAvs = new Eleve();
	$eleve->setNom($eleve_nom);
	$eleve->setPrenom($eleve_nom);

	$this->form = new EleveForm();
  }
      public function executeRecherchedetail(sfWebRequest $request)
  {
 	 
				$this->resultat = Doctrine_Query::create()
                ->select('e.id as eleve_id,e.nom as nom,e.prenom as prenom,e.etat_acc as etat_acc,e.datesortie as datesortie,s.libellesecteur as libellesecteur,s.id as secteur_id,
				e.datenaissance as datenaissance,e.ine as ine,e.etat_acc as etat_acc,e.etat_mat as etat_mat')
                ->from('Eleve e')
                ->leftjoin('e.Secteur s ON s.id = e.secteur_id')
				->Where('e.id =?', $request->getParameter('eleve_id'))
                ->orderBy('s.libellesecteur,e.nom')
                ->addOrderBy('e.nom')
                ->fetchArray();

  }

    public function executeRecherche(sfWebRequest $request)
  {
 
		//$this->forward404Unless($request->isMethod('post')); 
		// $this->form = new EleveForm($eleves,$eleve_nom);
 
	if( $request->getParameter('flag_recherche') != 2) { //affichage détail		de la recherche
      if ($request->isMethod('post'))
			{
				$eleve_nom = '%'.$_POST['nom_eleve'].'%';  
				$eleve_prenom = '%'.$_POST['prenom_eleve'].'%';
	 
	
				// je commence par récupérer le secteur de l'utilisateur connecté.
				//-----------------------------------------------------------------
				$q = Doctrine_Query::create();
              /*  ->select('s.id')
                ->from('Secteur s')
                ->where('s.sfguarduser_id=?', $this->getUser()->getGuardUser()->getId())
                ->execute();*/
				 if( strlen($_POST['nom_eleve']) > 2  || strlen($_POST['prenom_eleve']) > 2)
				 {
					 
					if(null != $_POST['nom_eleve'] || null != $_POST['prenom_eleve'])
					{
				 
						$this->resultat = Doctrine_Query::create()
						->select('e.id as eleve_id,e.nom as nom,e.prenom as prenom,e.etat_acc as etat_acc,e.datesortie as datesortie,s.libellesecteur as libellesecteur,s.id as secteur_id,
						e.datenaissance as datenaissance,e.ine as ine,e.etat_acc as etat_acc,e.etat_mat as etat_mat')
						->from('Eleve e')
						->leftjoin('e.Secteur s ON s.id = e.secteur_id')
						//->andWhere('e.datesortie IS NULL')
						->andWhere('e.nom LIKE ?', $eleve_nom)
						->andWhere('e.prenom LIKE ?', $eleve_prenom)
						->orderBy('s.libellesecteur,e.nom')
						->addOrderBy('e.nom')
						->fetchArray();

					}else{
					$this->getUser()->setFlash('notice', ' saisir au moins le nom ou le prénom !' );
					}
							
				}else{ 
						$this->getUser()->setFlash('error','la chaine recherchée doit contenir au moins 3 lettres  !' );
				}			// fin test longueur nom
			}else { //test post
				$this->resultat = Doctrine_Query::create()
                ->select('e.id as eleve_id,e.nom as nom,e.prenom as prenom,s.libellesecteur as libellesecteur,s.id as secteur_id,
				e.datenaissance as datenaissance,e.etat_acc as etat_acc,e.datesortie as datesortie,e.ine as ine,e.etat_acc as etat_acc,e.etat_mat as etat_mat')
                ->from('Eleve e')
                ->leftjoin('e.Secteur s ON s.id = e.secteur_id')
				//->andWhere('e.datesortie IS NULL')
				//->andwhere ('e.nom LIKE ?', $request->getParameter('eleve_nom'))
				//->andwhere ('e.prenom LIKE ?', $request->getParameter('eleve_prenom'))
				->Where('e.id =?', $request->getParameter('eleve_id'))
                ->orderBy('s.libellesecteur,e.nom')
                ->addOrderBy('e.nom')
                ->fetchArray();
			
			}
		}else{
			   $eleve_nom = '%'.$_POST['nom_eleve'].'%';  
	   	      $eleve_prenom = '%'.$_POST['prenom_eleve'].'%';
				$this->resultat = Doctrine_Query::create()
                ->select('e.id as eleve_id,e.nom as nom,e.prenom as prenom,e.etat_acc as etat_acc,e.datesortie as datesortie,s.libellesecteur as libellesecteur,s.id as secteur_id,
				e.datenaissance as datenaissance,e.ine as ine,e.etat_acc as etat_acc,e.etat_mat as etat_mat')
                ->from('Eleve e')
                ->leftjoin('e.Secteur s ON s.id = e.secteur_id')
				->Where('e.id =?', $request->getParameter('eleve_id'))
                ->orderBy('s.libellesecteur,e.nom')
                ->addOrderBy('e.nom')
                ->fetchArray();
		}
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EleveForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }
  public function executeEdit(sfWebRequest $request) // on vient de eleve_avs
  {
	 // on cherche les accompagnants affectés à un élève
	 //-------------------------------------------------
         $this->EleveAvs = Doctrine_Query::Create()
                ->select ('a.avs_id as avs_id,e.id as EleveId,a.quotitehorraireavs as quotitehorraireavs,a.datefin as datefin,a.datedebut as datedebut,a.quotitehorraireavs as quotite,et.id as etid,o.id as orienid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,s.libellesecteur as secteur')
                ->from('EleveAvs a')
                ->innerJoin('a.Eleve e ON e.id = a.eleve_id')
                ->innerjoin('e.Secteur s ON s.id = e.secteur_id')
                ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
                ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->leftjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
                ->where('e.id = ?', $request->getParameter('id'))
				//->andWhere('datefin >=?', date('Y-m-d', time()))				
                ->orderby('datedebut desc,datefin desc')
                ->fetcharray();
		$this->existEleveAvs = count($this->EleveAvs);	
         //-------------------------------------------
		 
	//Dernière demande AVS en cours à la date du jour pour l'élève selectionné
	//-----------------------------------------------------------------------
			$this->demande_avs = Doctrine_Query::Create()
								->Select('d.id as DemandeAvsId,m.id as MdphId,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,
								quotitehorrairenotifie as quotitehorrairenotifie,naturecontrat as naturecontrat')
								->from('DemandeAvs d')
								->innerJoin('d.Mdph m ON m.id = d.mdph_id')
								->leftJoin('d.Naturecontratavs n ON d.naturecontratavs_id = n.id')
								->where ('m.eleve_id=?',$request->getParameter('id'))
								->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
								->fetcharray();	 
			$this->existAvs = count($this->demande_avs);
		 
	 //Total de la quotité horaire notifiée pour l'élève sélectionné
	 //---------------------------------------------------------------
         $this->totalquotiteeleve = Doctrine_Query::Create()
                ->select ('a.eleve_id as avs_id,sum(a.quotitehorraireavs) as quotiteeleve')
                ->from('EleveAvs a')
                ->where('eleve_id = ?', $request->getParameter('id'))
				->andWhere('a.datefin >=?', date('Y-m-d', time()))
				->groupBy('a.eleve_id')
                ->fetcharray();	
        $this->existTotalquotiteeleve = count($this->totalquotiteeleve);
		
      
	 // creation d'un objet orientation pour l'eleve --------------------------------------------
	$this->or = Doctrine::getTable('Orientation')->getDerSco($request->getParameter('id'));
	// -------------------------------------------------------------------------------------------
	
	//recherche secteur de l'etablissement
	//-------------------------------------
	$this->secteur_etab = Doctrine_Query::Create()
	->select('s.id as secteur_id,s.libellesecteur as libellesecteur,se.etabsco_id as etabsco_id')
	->from ('SecteurEtabsco se')
	->innerjoin('se.Secteur s on s.id = se.secteur_id')
	->where('se.etabsco_id = ?',$this->or[0]['etabsco_id'])
	->fetcharray();
	
         
	  $this->forward404Unless($eleve = Doctrine_Core::getTable('Eleve')->find(array($request->getParameter('id'))), sprintf('L\'eleve n\{existe pas (%s).', $request->getParameter('id')));

	  
      $this->form = new EleveForm($eleve, $this->EleveAvs);
  }
  
    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($eleve = Doctrine_Core::getTable('Eleve')->find(array($request->getParameter('id'))), sprintf('cet élève n\'existe pas (%s).', $request->getParameter('id')));
        $this->form = new EleveForm($eleve);

        $this->processForm($request, $this->form);

        $this->redirect('eleve_avs/index');
    }  
  
    public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($eleve = Doctrine_Core::getTable('Eleve')->find(array($request->getParameter('id'))), sprintf('Object eleve does not exist (%s).', $request->getParameter('id')));
    $eleve->delete();

    $this->redirect('eleve/index');
	
	
  }
  
    public function executeTransfertmdph(sfWebRequest $request)
  {
  	if (!$_POST['eleve_id']){
		$this->message = $this->message.'saisir l\'id de l\'élève qui à un dossier MDPH à transférer : '.$eleve_id;
	}
      	if (!$_POST['mdph_id']){
			$this->message =  $this->message.'<br>saisir l\'id du dossier MDPH : '.$eleve_id;
	}
	  	if (!$_POST['eleve_id_recep']){
			$this->message = $this->message. '<br>saisir l\'id de l\'élève qui reçoit le dossier MDPH : '.$eleve_id;
	}
	
	if($_POST['eleve_id_recep'] && $_POST['mdph_id'] && $_POST['eleve_id'] ){ // saisie des paramètres ok
	//recherche de l'élève a qui on doit retire le dossier
	$this->eleve  = Doctrine_Query::Create()
	->select('*')
	->from ('Eleve e')
	->where('e.id = ?',$_POST['eleve_id'])
	->fetcharray();
	$count_eleve = count($this->eleve);
	
	
		
	//recherche de l'élève a qui on doit transférer le dossier
	 $this->eleve_recep  = Doctrine_Query::Create()
	->select('*')
	->from ('Eleve e')
	->where('e.id = ?',$_POST['eleve_id_recep'])
	->fetcharray();
	$count_eleve_recep =count($this->eleve_recep);
	
	
	if($count_eleve_recep == 0){
	$this->message = $this->message.'<br><FONT COLOR="#FF0000">élève avec l\'ID <b>'.$_POST['eleve_id'].'</b>&nbsp;&nbsp;inexistant</font>';
	}
	
	if($count_eleve == 0){ //id eleve existe
	$this->message = '<FONT COLOR="#FF0000">élève avec l\'ID<b>'.$_POST['eleve_id'].'</b>&nbsp;&nbsp;inexistant</font>';
	}else{

	//recherche du dossier MDPH
	 $this->mdph  = Doctrine_Query::Create()
	->select('*')
	->from ('Mdph m')
	->where('m.id = ?',$_POST['mdph_id'])
	->andwhere('m.eleve_id = ?',$_POST['eleve_id'])
	->fetcharray();
	$count_mdph = count($this->mdph);

	
	 	if($count_mdph == 0){
			$this->message = '<br><FONT COLOR="#FF0000">élève&nbsp;&nbsp;<b>'.$this->eleve[0]['nom'].'&nbsp;'.$this->eleve[0]['prenom'].'&nbsp;('.$this->eleve[0]['id'].')</b>&nbsp;n\'a pas de dossier MDPH  n° &nbsp;<b>'.$_POST['mdph_id'].'</b><br>Imposible de transférer le dossier !!!'.'</font>';
		}else{ //dossier MDPH  existe
			  
			    //attribution du dossier MDPH à l'élève_recep
				Doctrine_Query::Create()
						->update('MDPH m')
						->set(array(
						'm.eleve_id' =>$_POST['eleve_id_recep'],
						))
						->where('m.id = ?',$_POST['mdph_id'])
						->andwhere('m.eleve_id = ?',$_POST['eleve_id'])
						->execute();
						$this-> message = 'réalisé avec succès';
						
						
			
    		//Recherche si demande transport attachée à ce dossier MDPH
			$demandetransport = Doctrine_Query::Create()
    			->select('*')
				->from ('DemandeTransport m')
				->where('m.mdph_id = ?',$_POST['mdph_id'])
				->fetcharray();
		    $count_demandetransport = count($demandetransport);
			
			if( $count_demandetransport > 0){
				//vérification si  moyen transport attribué
				//transport obtenu
					
			   	$transportobtenu = Doctrine_Query::Create()
			    ->select('*')
				->from ('Transportobtenu m')
				->where('m.demandetransport_id= ?',$demandetransport[0]['id'])
				->andwhere('m.eleve_id = ?',$_POST['eleve_id'])
				->limit(1)
				->fetcharray();
				
			  if(count($transportobtenu) > 0 ){
     			 //transfert moyen attribué transport au nouvel élève
				Doctrine_Query::Create()
						->update('Transportobtenu t')
						->set(array(
						't.eleve_id' =>$_POST['eleve_id_recep']
						))
						->where('t.demandetransport_id = ?',$demandetransport[0]['id'])
						->andwhere('t.id = ?',$transportobtenu[0]['id'])
						->execute();
						$message_transport = '\nTransfert du transport obtenu attaché à ce dossier MDPH';
				}
		
			}

			//Recherche si demande Sessad attachée à ce dossier MDPH
			$demandesessad = Doctrine_Query::Create()
			    ->select('*')
				->from ('DemandeSessad m')
				->where('m.mdph_id = ?',$_POST['mdph_id'])
				->limit(1)
				->fetcharray();
				
			$count_demandesessad = count($demandesessad);
			
			if( $count_demandesessad > 0){
	
			     $sessadobtenu = Doctrine_Query::Create()
			    ->select('*')
				->from ('Sessadobtenu m')
				->where('m.demandesessad_id= ?',$demandesessad[0]['id'])
				->andwhere('m.eleve_id = ?',$_POST['eleve_id'])
				->limit(1)
				->fetcharray();
				
				
			   //Vérification moyen sessad attribué pour cette demande Sessad
			    if(count($sessadobtenu )> 0 ){
				
				 //Transfert moyen Sessad attribué au nouvel élève
				Doctrine_Query::Create()
						->update('Sessadobtenu t')
						->set(array(
						't.eleve_id' =>$_POST['eleve_id_recep']
						))
						->where('t.demandesessad_id = ?',$demandesessad[0]['id'])
						->andwhere('t.id = ?',$sessadobtenu[0]['id'])
						->execute();
						$message_sessad = '\nTransfert du Sessad obtenu attaché à ce dossier MDPH';
				}	
		
			}
		$this->getUser()->setFlash('notice', 'Transfert du dossier MDPH n° '.$this->mdph[0]['id'].' de '. $this->eleve[0]['nom'].' '.$this->eleve[0]['prenom'].' ('.$this->eleve[0]['id'].') vers '.$this->eleve_recep[0]['nom'].' '.$this->eleve_recep[0]['prenom'].' ('.$this->eleve_recep[0]['id'].') réalisé avec succès');		
		
		//SAUVEGARDE de la trace du TRANSFERT
		//-------------------------------------
		
		//recherche de l'ERF destinataire du mail eleve qui cède son dossier
		//--------------------------------------------------------------------
		$destinataire_eleve = Doctrine_Query::Create()
	   ->select('s.id,s.id as sf_id,s.libellesecteur as libellesecteur,sf.email_address as adresse_mail,s.sfguarduser_id as sfguarduser_id ')
	   ->from('Secteur s')
	   ->innerJoin('s.sfguarduser sf ON sf.id = s.sfguarduser_id')
	   ->where('s.id=?',$this->eleve[0]['secteur_id'])
	   ->fetcharray();
	   
	   
	   	//recherche de l'ERF destinataire du mail élève qui recoit le dossier
		//----------------------------------------------------------------------
		$destinataire_eleve_recep = Doctrine_Query::Create()
	   ->select('s.id,s.id as sf_id,s.libellesecteur as libellesecteur,sf.email_address as adresse_mail,s.sfguarduser_id as sfguarduser_id ')
	   ->from('Secteur s')
	   ->innerJoin('s.sfguarduser sf ON sf.id = s.sfguarduser_id')
	   ->where('s.id=?',$this->eleve_recep[0]['secteur_id'])
	   ->fetcharray();
	   
	   
		//sauvegarde du message pour l'élève qui céde son dossier
		//---------------------------------------------------------
		$mail = new Mail();
		$corps_message = 'Transfert du dossier MDPH n° '.$this->mdph[0]['id'].' de '. $this->eleve[0]['nom'].' '.$this->eleve[0]['prenom'].' ('.$this->eleve[0]['id'].') vers '.$this->eleve_recep[0]['nom'].' '.$this->eleve_recep[0]['prenom'].' ('.$this->eleve_recep[0]['id'].') réalisé avec succès'.$message_sessad.'  '.$message_transport ;
		$date = date('Y-m-d', time()) ;
		$mail->setEleveId($this->eleve[0]['id']);
		$mail->setSfguarduserId($destinataire_eleve[0]['sfguarduser_id']);
		$mail->setSujet('Transfert de dossier MDPH');
		$mail->setTexte($corps_message);
		$mail->setDate($date);
		$mail->save();
		
		 //Formatage et envoi du message à l'ERF d'origine
		 //--------------------------------------------
		 
		 $message = Swift_Message::newInstance()
		// ->setTo($destinataire_eleve[0]['adresse_mail'])
		 ->setFrom('acad@ac-reunion.fr')
		 ->setTo('franck.gelez@ac-reunion.fr' )
		 ->setSubject('Transfert de dossier MDPH')
		 ->setBody($corps_message);
		 $this->getMailer()->send($message);
		
		
		//sauvegarde du message pour l'élève qui reçoit le dossier
		//---------------------------------------------------------
		$mail = new Mail();
		$corps_message = 'Transfert du dossier MDPH n° '.$this->mdph[0]['id'].' de '. $this->eleve[0]['nom'].' '.$this->eleve[0]['prenom'].' ('.$this->eleve[0]['id'].') vers '.$this->eleve_recep[0]['nom'].' '.$this->eleve_recep[0]['prenom'].' ('.$this->eleve_recep[0]['id'].') réalisé avec succès'.$message_sessad.'  '.$message_transport ;
		$date = date('Y-m-d', time()) ;
		$mail->setEleveId($this->eleve_recep[0]['id']);
		$mail->setSfguarduserId($destinataire_eleve_recep[0]['sfguarduser_id']);
		$mail->setSujet('Transfert de dossier MDPH');
		$mail->setTexte($corps_message);
		$mail->setDate($date);
		$mail->save();
		
		
	     //Formatage et envoi du message à l'ERF d'origine
		 //-----------------------------------------------
		 
		 $message = Swift_Message::newInstance()
		// ->setTo($destinataire_eleve_recep[0]['adresse_mail'])
		 ->setFrom('acad@ac-reunion.fr')
		 ->setTo('franck.gelez@ac-reunion.fr' )
		 ->setSubject('Transfert de dossier MDPH')
		 ->setBody($corps_message);
		 $this->getMailer()->send($message);

		
		}//dossier mdph existe
	} //id eleve existe
	
	
	
	} //saisie des paramètres ok
  }
  
   public function executeSuppr(sfWebRequest $request)
  {
    //Suppression d'un élève de la base ashile avec toutes les donnèes le concernant
	////////////////////////////////////////////////////////////////////////////////
    
	//sauvegarde des données de l'élève avant suppression
	
	if ($_POST['eleve_id']){
	//$this->getUser()->setFlash('notice', 'titi'.$_POST['eleve_id']);
	$eleve_id = $_POST['eleve_id']; 
		
	//$this->$eleve = Doctrine_Core::getTable('Eleve')->find(array($eleve_id));
	
	
	$this->eleve  = Doctrine_Query::Create()
	->select('*')
	->from ('Eleve e')
	->where('e.id = ?',$eleve_id)
	->fetcharray();
	
	
	if ($this->eleve){ //élève existant
   $this->getUser()->setFlash('notice', 'Supression pour élève à l\'ID : '.$eleve_id. ' nom :'. $eleve[0]['nom'].'&nbsp;'.$eleve[0]['prenom'].' en cours' );
	$this->scolarité  = Doctrine_Query::Create()
	->select('*')
	->from ('orientation o')
	->where('o.eleve_id = ?',$eleve_id)
	->execute();
	
	$this->modnonsco  = Doctrine_Query::Create()
	->select('*')
	->from ('Modnonsco o')
	->where('o.eleve_id = ?',$eleve_id)
	->execute();
	
	$this->accompagnement  = Doctrine_Query::Create()
	->select('*')
	->from ('EleveAvs ea')
	->where('ea.eleve_id = ?',$eleve_id)
	->execute();
	
	
	$this->mdph  = Doctrine_Query::Create()
	->select('*')
	->from ('Mdph m')
	->where('m.eleve_id = ?',$eleve_id)
	->execute();
	
		
        //accompagnement obtenu
		$this->accompagnement = Doctrine_Core::getTable('EleveAvs')->findByEleveId($eleve_id);		
		if($this->accompagnement ){
			$this->accompagnement->delete();
			$this->message = '- Accompagnement(s) obtenu(s) supprimé(s)';
		}
        		
		//transport obtenu
		$this->transportobtenu = Doctrine_Core::getTable('Transportobtenu')->findByEleveId($eleve_id);		
		if($this->transportobtenu ){
			$this->transportobtenu->delete();
			$this->message = 	$this->message .'<br>- Transport(s) obtenu(s) supprimé(s)';
		}
		
		// sessad obtenu
		$this->sessadobtenu = Doctrine_Core::getTable('Sessadobtenu')->findByEleveId($eleve_id);	
		if($this->sessadobtenu){
			$this->sessadobtenu->delete();
			$this->message = $this->message.'<br>- Sessad obtenu(s) supprimé(s)';
		}
		
		
		//messages ( mail )
		$this->mail = Doctrine_Core::getTable('Mail')->findByEleveId($eleve_id);	
		$count_mail = count($this->mail);
		if($count_mail> 0){
			$this->mail->delete();
			$this->message = $this->message.'<br>- messages(s) o supprimé(s)';
		}
		
		//Scolarité ordinaire
		if($this->scolarité){
			$this->scolarité->delete();
			$this->message = $this->message.'<br>- Scolarité(s) ordinaire(s) supprimée(s)';
		}
		
		//Scolarité spécialisée
		if($this->modnonsco){
			$this->modnonsco->delete();
			$this->message = $this->message.'<br>- Scolarité(s) spécialisées(s) supprimée(s)';
		}
		
		//Réunion 
		$this->reunion = Doctrine_Core::getTable('Reunion')->findByEleveId($eleve_id);	
		   if($this->reunion){
		   	$this->reunion->delete();
			$this->message = $this->message.'<br>- Réunion(s) o supprimée(s)';
		}
		
		//Suivi externe
		$this->suiviexterne= Doctrine_Core::getTable('SuivitExterne')->findByEleveId($eleve_id);	
		   if($this->suiviexterne){
		   	$this->suiviexterne->delete();
			$this->message = $this->message.'<br>- Suivi(s) externe(s) o supprimé(s)';
		}
		
		
		// matériel obtenu
		$this->materielobtenu = Doctrine_Core::getTable('EleveMateriel')->findByEleveId($eleve_id);	
		if($this->materielobtenu){
			$this->materielobtenu->delete();
			$this->message = $this->message.'<br>- Matériel(s) obtenu(s) supprimé(s)';
		}
		
	    //Responsable
		$this->tuteur = Doctrine_Core::getTable('Tuteur')->findByEleveId($eleve_id);	
		   if($this->tuteur){
		   	$this->tuteur->delete();
			$this->message = $this->message.'<br>- Responsable(s) supprimé(s) ';
		}
		
		
		//Enquête Dgesco
		$this->dgesco = Doctrine_Core::getTable('Dgesco')->findByEleveId($eleve_id);	
		   if($this->dgesco){
		   	$this->dgesco->delete();
			$this->message = $this->message.'<br>- Réponse(s) à l\'enquête DGESCO  supprimée(s) ';
		}
		
		
	
	if($this->mdph){ //test existance dossier MDPH
	
		
	 foreach($this->mdph as $mdphs) {
			$this->message = $this->message.'<br><b>Dossier MDPH :'.$mdphs['id'].'</b><br>';
		   //demande AESH
			$this->demandeavs = Doctrine_Core::getTable('DemandeAvs')->findByMdphId($mdphs['id']);
			$count_demande_avs = count($this->demandeavs);
			if($count_demande_avs > 0){
				    $this->demandeavs->delete();
					$this->message = $this->message.'<br>Demande AESH dossier AESH n° :'.$mdphs['id'].' supprimée';
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
	 
	$this->dgesco = Doctrine_Core::getTable('Dgesco')->findByEleveId($eleve_id);
	} //test dossier mdph
	
	    //suppression de la fiche élève
		//-----------------------------
		$this->eleve1 = Doctrine_Core::getTable('Eleve')->findById($eleve_id);		
	    if($this->eleve1){
			$this->eleve1->delete();
			$this->message = $this->message. '-<b> Elève SUPPRIME(E) '.$this->eleve[0]['nom'].'&nbsp;'.$this->eleve[0]['prenom'].'</b>';
		
		
		//SAUVEGARDE de la trace du TRANSFERT
		//-------------------------------------
		
		//recherche de l'ERF destinataire du mail eleve qui est supprimé
		//----------------------------------------------------------------
		$destinataire_eleve = Doctrine_Query::Create()
	   ->select('s.id,s.id as sf_id,s.libellesecteur as libellesecteur,sf.email_address as adresse_mail,s.sfguarduser_id as sfguarduser_id ')
	   ->from('Secteur s')
	   ->innerJoin('s.sfguarduser sf ON sf.id = s.sfguarduser_id')
	   ->where('s.id=?',$this->eleve[0]['secteur_id'])
	   ->fetcharray();
   
       
		
	 //Formatage et envoi du message à l'ERF 
     //------------------------------------
	 $corps_message = 'Suprresion élève '. $this->eleve[0]['nom'].' '.$this->eleve[0]['prenom'].' ('.$this->eleve[0]['id'].')'.' réalisée avec succès';
	 $message = Swift_Message::newInstance()
	// ->setTo($destinataire_eleve[0]['email_address'])
	 ->setFrom('acad@ac-reunion.fr')
	 ->setTo('franck.gelez@ac-reunion.fr' )
	 ->setSubject('Suppression élève '.$this->eleve[0]['nom'].' '.$this->eleve[0]['prenom'].' ('.$this->eleve[0]['id'].')')
	 ->setBody($corps_message);
	 $this->getMailer()->send($message);
	 
	 	 //Formatage et envoi du message à l'ASH
     //----------------------------------------
	 $corps_message = 'Suprresion élève '. $this->eleve[0]['nom'].' '.$this->eleve[0]['prenom'].' ('.$this->eleve[0]['id'].')'.' réalisée avec succès';
	 $message = Swift_Message::newInstance()
	// ->setTo($destinataire_eleve[0]['email_address'])
	 ->setFrom('acad@ac-reunion.fr')
	 ->setTo('ashile@ac-reunion.fr' )
	 ->setSubject('Suppression élève '.$this->eleve[0]['nom'].' '.$this->eleve[0]['prenom'].' ('.$this->eleve[0]['id'].')')
	 ->setBody($corps_message);
	 $this->getMailer()->send($message);
		

		
		}
		
	}else{ // test élève existant
	$this->getUser()->setFlash('error', 'élève à l\'ID : '.$eleve_id. ' inexistant');
	}
	}
	//suppression des enregistrements concernant l'élève ID
	
	//$request->checkCSRFProtection();

   // $this->forward404Unless($eleve = Doctrine_Core::getTable('Eleve')->find(array($request->getParameter('id'))), sprintf('Object eleve does not exist (%s).', $request->getParameter('id')));
   // $eleve->delete();

    //$this->redirect('eleve/suppr');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
	
	//nombre d'affectation supérieures ou égal à la date de fin d'accompagnement
	 //---------------------------------------------------------------
         $this->Nbrelevavs= Doctrine_Query::Create()
                ->select ('e.id as id,e.etat_acc as etat_acc')
                ->from('Eleve e')
				->innerjoin('e.EleveAvss a ON e.id=a.eleve_id')
                ->where('id = ?', $request->getParameter('id'))
				->andWhere('a.datefin >=?', $form->getobject()->getEtatAcc())
                ->fetcharray();	
        $this->total1 = count($this->Nbrelevavs);
				
	//message informatif concernant la date de fin d'accompagnement
	//-------------------------------------------------------------
    $info='';
    
    /*
	if ($form->getobject()->getEtatAcc() && $this->total1 > 0 && $form->isValid()  )
	{
	$eleve = $form->save();
	$info = 'La date de fin d \'acc. est renseignée,il y a des affectation(s) avec une date de fin supérieure à la date de fin d\'acc. : '.$form->getobject()->getEtatAcc();
	$this->getUser()->setFlash('error', $info);
	$this->getUser()->setFlash('notice', 'Modification(s) Enregistrée(s) avec succès : pour '.$form->getobject());
	$this->redirect('eleve/edit?id='.$eleve->getId());
	}
	*/
    if ($form->isValid())
    {
	  //recherche du secteur de l'élève  avant saisie
	  //---------------------------------------------
	  $recherche_eleve = Doctrine_Query::Create()
		->select ('e.id as eleve_id,e.secteur_id as secteur_id,s.libellesecteur as libellesecteur')
		->from('Eleve e')
		->innerjoin('e.Secteur s ON s.id = e.secteur_id')
		->Where('e.id =?', $form->getobject()->getId())
		->limit(1)
		->fetcharray();	
	 
      $eleve = $form->save();
	  
	  
	  //recherche du secteur de l'élève  après sauvegarde
	  //------------------------------------------------
	  $recherche_secteur = Doctrine_Query::Create()
		->select ('s.id as secteur_id,s.libellesecteur as libellesecteur')
		->from('Secteur s')
		->Where('s.id =?', $eleve->secteur_id)
		->limit(1)
		->fetcharray();	
		
		
	if($recherche_eleve[0]['secteur_id'] != $eleve->secteur_id)
	{ //secteur différent envoi d'un mail
	
	$titi = $recherche_eleve[0]['secteur_id'].'après'. $eleve->secteur_id;
	
	  ////////////////////////////////////////////////////////////////////////////
	 //Envoi du mail à l'ERF du secteur de destination si changement de SECTEUR //
     ////////////////////////////////////////////////////////////////////////////
	 
	 //Recherche de l'ERF destinataire du mail (l'ERF du secteur après modification)' 
	 //----------------------------------------------------------------------------
		$destinataire = Doctrine_Query::Create()
	   ->select('s.id,s.id as sf_id,s.libellesecteur as libellesecteur,sf.email_address as adresse_mail,s.sfguarduser_id as sfguarduser_id ')
	   ->from('Secteur s')
	   ->innerJoin('s.sfguarduser sf ON sf.id = s.sfguarduser_id')
	   ->where('s.id=?',$recherche_eleve[0]['secteur_id'])
	   ->fetcharray();
	   
	   
	    $corps_message = ' l\'élève '.$eleve->nom.' '.$eleve->prenom.' né(e)le '.date('d-m-Y',strtotime( $eleve->datenaissance)).' a changé de secteur, il est passé du secteur de '.
	     $recherche_eleve[0]['libellesecteur'].' au secteur de '.$recherche_secteur[0]['libellesecteur'].', vous devez lui créer une nouvelle scolarité';
	 
	 //Formatage et envoi du message
     //------------------------------- 
	 $message = Swift_Message::newInstance()
	 ->setTo($destinataire[0]['email_address'])
	 ->setFrom('acad@ac-reunion.fr')
	// ->setTo('franck.gelez@ac-reunion.fr' )
	 ->setSubject('Changement de secteur')
	 ->setBody($corps_message);
	 $this->getMailer()->send($message);

	//sauvegarde du mail envoyé
    //-------------------------
		$mail = new Mail();
		$date = date('Y-m-d', time()) ;
		$mail->setEleveId($recherche_eleve[0]['eleve_id']);
		$mail->setSfguarduserId($destinataire[0]['sfguarduser_id']);
		$mail->setSujet('Changement de secteur');
		$mail->setTexte($corps_message);
		$mail->setDate($date);
		$mail->save();
		
     $info = ', message envoyé à '.$destinataire[0]['adresse_mail'];
	
	}
      $this->getUser()->setFlash('notice', 'Modification(s) Enregistrée(s) avec succès : pour '.$form->getobject().$info);
      $this->redirect('eleve/edit?id='.$eleve->getId().'&eleve_nom='.$eleve->nom.'&eleve_prenom=' .$eleve->prenom);
    }

	}  
    public function executeMiseAjour(sfWebRequest $request)
    {
		
		// on commence par créer un objet $eleve_as donné par $request
		//------------------------------------------------------------
	 	$this->forward404Unless($eleve_avs = Doctrine_Core::getTable('EleveAvs')->findOneById(array($request->getParameter('id'))), sprintf('Object eleve_avs does not exist (%s).', $request->getParameter('id')));
	
		// ------- Récupération eleve_id -------------	
       $eleveId = Doctrine::getTable('EleveAvs')->findOneById($eleve_avs->getId())->getEleveId();
	   
	   //récupération de la date de fin d'accompagnement
	   //--------------------------------------------
		       $this->Eleve = Doctrine_Query::Create()
                ->select ('e.etat_acc as etat_acc')
                ->from('Eleve e')
                ->where('e.id = ?', $eleveId)
                ->fetcharray();
				
		// ------- le date transmise par $POST --------
		$laDate = $_POST['maj'];
		
				
		if ($laDate){
		$q = Doctrine_Query::create()
					->update('EleveAvs e')
					->set('e.datefin', '?', $laDate)
					->where('e.eleve_id ='.$eleveId)
					->andWhere('e.datefin >=?', date('Y-m-d', time()));

		$rows = $q->execute();
		$this->getUser()->setFlash('notice', ' Clôture de(s) accompagnement(s) pour l\'élève : '. $eleve_avs->getEleve().' à la date du '.$laDate);
		}else{
		$this->getUser()->setFlash('error', 'Pas de date saisie pour la clôture des affectations');
		}
		
		
		$this->redirect('eleve/edit?id='.$eleveId);
	}
	public function executeAide(){}	
}
