<?php

/**
 * orientation actions.
 *
 * @package    ash
 * @subpackage orientation
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orientationActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
		
        $this->param = '0';
        $this->orientations = $this->getOrientations($request);

		
	// --- RECHERCHE DE LA DERNIERE ORIENTATON	----
		$orientation = Doctrine_Core::getTable('Orientation')->getDerSco($request->getParameter('eleve_id'));
		$this->count_orientation =count($orientation);
		//****************************************	

    }

    public function executeList(sfWebRequest $request)
    {
        $this->param = '1';
        $this->orientations = $this->getHistoriques($request);
    }

    protected function getOrientations(sfWebRequest $request)
    {
        $anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        return Doctrine_Core::getTable('Orientation')
                        ->createQuery('a')
                        ->where('a.eleve_id =?', $request->getParameter('eleve_id') )
                      //  ->leftjoin ('a.Classe c ON a.classe_id = c.id')
                        ->andWhere('a.datedebut >=?', $anneeScolaire->getDatedebutanneescolaire())
                        ->andWhere('a.datefin <=?', $anneeScolaire->getDatefinanneescolaire())
                        ->execute();
    }
    
    protected function getHistoriques(sfWebRequest $request)
    {
        $anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        return Doctrine_Core::getTable('Orientation')
                        ->createQuery('a')
                        ->where('a.eleve_id =?', $request->getParameter('eleve_id'))
                        ->andWhere('a.datefin <=?', $anneeScolaire->getDatedebutanneescolaire())
                        ->execute();
    }

	public function executeAjaxNiveau(sfWebRequest $request)
    {
		$etab = Doctrine::getTable('Etabsco')->find($request->getParameter('etabsco_id'));
		$etab_degre = $etab->getDegreetabsco()  ;
		
		if ( strstr($etab_type = $etab->getTypeetablissement(),'L') && !strstr($etab_type = $etab->getTypeetablissement(),'CLG')){ //si lycée
		
				$niveaus = Doctrine_Query::Create()
				->from('Niveauscolaire n')
				->where( 'n.degreetabsco LIKE "%LYC%"')
      			->orderBy('n.ordre')	
				->execute();
		
		}else{
			$niveaus = Doctrine_Query::Create()
				->from('Niveauscolaire n')
				->where( 'n.degreetabsco = ?', $etab_type)	
			    ->orderBy('n.ordre')
				->execute();
				
	    }
								
		return $this->renderPartial('orientation/selectNiveau', array('niveaus' => $niveaus, 'selected' => $request->getParameter('selected')));						
	}
	
	
    /**
     * requete ajax pour avoir la liste des classe de etab
     *
     * @param sfWebRequest $request
     */
    public function executeAjaxClasse(sfWebRequest $request)
    {
		// selection par switch case des classes / etab clis ulis etc..
		
		$etab = Doctrine::getTable('Etabsco')->find($request->getParameter('etabsco_id'));
		
		// fonction qui retourne les classes CLIS ULIS ou ND en fonction du EtabInclusion_id de Etabsco

			// ---- on commence par récuperer inclusionetab de l'etablissement
			$etabInclu = Doctrine::getTable('Etabsco')->findOneById($etab->getId())->getEtabscoInclusion();
			// --- on retourne les classes concernées
	
			//$Classe_clis_Ulis_ND = '*'.implode('* *', explode(' ', $etabInclu)).'*';

			
			if($etabInclu == 'ND') // ---( on prend toutes les classes sans les CLIS et ULIS)
			{
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->orderBy('tc.ordre');
						
			}
			///////////////////////////////////////////////
			//TRAITEMENT DES CLASSES POUR LE PREMIER DEGRE
			//////////////////////////////////////////////
			if($etabInclu == 'CLIS1'){	///etablissement avec une classe de CLIS1 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')

							->orderBy('tc.ordre');
			}
			
			if($etabInclu == 'CLIS2'){	///etablissement avec une classe de CLIS2 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');	
			}
			
			if($etabInclu == 'CLIS3'){	///etablissement avec une classe de CLIS3 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');							
			}
   			if($etabInclu == 'CLIS4'){	///etablissement avec une classe de CLIS4 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->orderBy('tc.ordre');	
			}
			
			 if($etabInclu == 'CLIS1  CLIS4'){	 ///etablissement avec une classe de CLIS1 et CLIS4 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->orderBy('tc.ordre');
			}
			
			 if($etabInclu == 'CLIS1 TED'){	 ///etablissement avec une classe de CLIS1 et CLIS TED et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');
			}
			
			if($etabInclu == 'CLIS TED'){	///etablissement avec une classe de CLIS1 TED et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1')	//permet de selectionner les classes 'CLIS1 TED'
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');
			}
			

			//////////////////////////////////////////////
			//TRAITEMENT DES CLASSES POUR LE SECOND DEGRE
			//////////////////////////////////////////////
			
			 if($etabInclu == 'ULIS TFC'){	 ///etablissement avec une classe de ULIS TFC et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');
			}
			
			 if($etabInclu == 'ULIS TFM'){	 ///etablissement avec une classe de ULIS TFM et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');							
			}
			
			
			if($etabInclu == 'ULIS TFA'){	 ///etablissement avec une classe de ULIS TFA et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');
			}
			
			
			if($etabInclu == 'ULIS TFV'){	 ///etablissement avec une classe de ULIS TFV et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');
			}
			
			if($etabInclu == 'ULIS LP'){	 ///etablissement avec une classe de ULIS TFV et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->orderBy('tc.ordre');
			}
			
			
				if($etabInclu == 'ULIS TFC TFM'){	 ///etablissement avec une classe de ULIS TFC et TFM et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');
					
			}
					
			$classes = $q->execute();	
		
			

		 
		return $this->renderPartial('orientation/selectClasse', array('classes' => $classes, 'selected' => $request->getParameter('selected')));

    } 

    public function executeShow(sfWebRequest $request)
    {
        $this->param = $this->getRequestParameter('param');

        $this->orientation = Doctrine_Core::getTable('Orientation')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->orientation);
    }
	
	    public function executeMessage(sfWebRequest $request)
  {
    }
	public function executeChangeSecteur(sfWebRequest $request)
    {
	    //--------------------------------------------------------------------------
	    //changement de secteur avec écran de saisie de la date de fin de scolarité
		//---------------------------------------------------------------------------
		
        //année scolaire en cours
		//-------------------------
				$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
				$this->deb = $annee->getDatedebutanneescolaire();
				$this->fin = $annee->getDatefinanneescolaire();
		
		//liste des accompagnements en cours 
		/////////////////////////////////////
		
		 $this->eleve_avss = Doctrine_Query::Create()
		->select ('avs.id as avs_id, avs.nom as avsnom, avs.prenom as avsprenom, e.id as eleve_id,e.nom as nom,e.prenom as prenom,a.quotitehorraireavs as quotitehorraireavs,a.datefin as datefin,a.datedebut as datedebut,
		    ca.date_debut_contrat as date_debut_contrat,ca.date_fin_contrat as date_fin_contrat,a.id as eleveavs_id ,ty.id as typecontratavs_id,ty.typecontrat as typecontrat,ca.temps_hebdo as temps_hebdo ')
		->from('EleveAvs a')
		->innerJoin('a.Eleve e ON e.id = a.eleve_id')
		->innerJoin('a.Avs avs ON avs.id = a.avs_id')
	    ->innerJoin('avs.ContratAvs ca ON avs.id = ca.avs_id')
		 ->innerJoin('ca.TypeContratAvs ty ON ty.id = ca.typecontratavs_id')
        ->where('a.eleve_id =?', $request->getParameter('eleve_id'))
        ->andwhere('ca.date_fin_contrat > ?',$this->deb)
 	    ->andwhere('ca.date_fin_contrat > ?',date('Y-m-d', time()))
		->orderby('datedebut desc,datefin desc')
		->fetcharray();
		 $this->count_eleveavs = count($this->eleve_avss);
		

		
		
	    // --- RECHERCHE DE LA DERNIERE ORIENTATON	----
		$this->orientation = Doctrine_Core::getTable('Orientation')->getDerSco($request->getParameter('eleve_id'));
		$count_orientation =count($this->orientation);
		//******************************************
		
		// --- RECHERCHE des accompagnements en cours pour l'élève selectionné	----
		$eleve_avs = Doctrine_Core::getTable('EleveAvs')->getEleveAcc($request->getParameter('eleve_id'));
		$count_eleve_avs =count($eleve_avs);
		//****************************************************************************
		
		
		// --- Liste des secteurs différents du secteur d'origine --------
		$this->secteur =Doctrine_Query::Create()
						->select('s.id as secteur_id,s.libellesecteur as libellesecteur')
						->from('Secteur s')
						->where('s.id != ?', $this->orientation[0]['secteur_id'])
						->orderby('s.libellesecteur')
						->fetchArray();
		//****************************************************
		
	
				  
		if($request->getParameter('flag') == 1 && $count_orientation > 0)
		{
		
		//Mise au format de la date de fin de scolarité
		 $date_maj =  date('Y-m-d',strtotime($request->getPostParameter('maj')));
		 
		 
		// --- SI LA DATE DE FIN ORIENTATION DEPASSE LA DATE DU JOUR ON MET CETTE DATE A JOUR	
		if($this->orientation[0]['datefin'] >= date('Y-m-d', time()) && $_POST['secteur_id']){

			$r = Doctrine_Query::Create()
						->update('Orientation o')
						->set('o.datefin', '?', $date_maj) // mettre la datefin (precedente)orientation à la date du jour si on change le secteur de l'eleve.
						->where('o.id = ?', $this->orientation[0]['id'])
						->execute();
		
		//Mise à jour du secteur de l'élève
		//------------------------------------					
		     $q = Doctrine_Query::Create()
			->update('Eleve e')
			->set('e.secteur_id', '?',$_POST['secteur_id'] ) 
			->where('e.id = ?', $request->getParameter('eleve_id'))
			->execute();
			
		//recherche du secteur d'accueil
		//-------------------------------
		$secteur_acc =Doctrine_Query::Create()
			->select('s.id as secteur_id,s.libellesecteur as libellesecteur')
			->from('Secteur s')
			->where('s.id = ?', $_POST['secteur_id'])
			->orderby('s.libellesecteur')
			->fetchArray();
		
		$this->getUser()->setFlash('notice', 'Changement de secteur  enregistré avec succès'.$_POST['secteur_id'].$date_maj.' ddd'.$request->getPostParameter('maj'));
			 
		//SAUVEGARDE de la trace du changement de SECTEUR
		//--------------------------------------------------
		
		//recherche de l'ERF du secteur d'origine de l'eleve 
		//-------------------------------------------------------
		$destinataire_eleve = Doctrine_Query::Create()
	   ->select('s.id,s.id as sf_id,s.libellesecteur as libellesecteur,sf.email_address as adresse_mail,s.sfguarduser_id as sfguarduser_id ')
	   ->from('Secteur s')
	   ->innerJoin('s.sfguarduser sf ON sf.id = s.sfguarduser_id')
	   ->where('s.id=?', $this->orientation[0]['secteur_id'])
	   ->fetcharray();
	   
	   
	   	//recherche de l'ERF du secteur d'accueil de l'élève 
		//-------------------------------------------------------
		$destinataire_eleve_recep = Doctrine_Query::Create()
	   ->select('s.id,s.id as sf_id,s.libellesecteur as libellesecteur,sf.email_address as adresse_mail,s.sfguarduser_id as sfguarduser_id ')
	   ->from('Secteur s')
	   ->innerJoin('s.sfguarduser sf ON sf.id = s.sfguarduser_id')
	   ->where('s.id=?',$_POST['secteur_id'])
	   ->fetcharray();
	   
	   
		//sauvegarde du message pour l'élève qui céde son dossier
		//---------------------------------------------------------
		$mail = new Mail();
		$corps_message = 'Changement de secteur de '.$destinataire_eleve[0]['libellesecteur']. ' à '.$secteur_acc[0]['libellesecteur'].' pour l\'élève '.$this->orientation[0]['nom'].' '.$this->orientation[0]['prenom'].' ('.$this->orientation[0]['eleveId'].' )';
		$date = date('Y-m-d', time()) ;
		$mail->setEleveId($request->getParameter('eleve_id'));
		$mail->setSfguarduserId($destinataire_eleve[0]['sfguarduser_id']);
		$mail->setSujet('Changement de secteur pour l\'élève '.$this->orientation[0]['nom'].' '.$this->orientation[0]['prenom'].' ('.$this->orientation[0]['eleveId'].' )');
		$mail->setTexte($corps_message);
		$mail->setDate($date);
		$mail->save();
		
		
		//si des accompagnements sont sont en cours
		//-----------------------------------------
		if($count_eleve_avs == 1 ){
		 $this->getUser()->setFlash('error', 'Acc en cours !!!');
		
				$corps_message = $corps_message .'
				
- Attention !!! Il faut peut être modifier ou clôturer les accompagnement en cours :
-  AESH :'. $eleve_avs[0]['avsnom']. ' '.$eleve_avs[0]['avsprenom']. '
- accompagnement du '. date('d-m-Y',strtotime($eleve_avs[0]['datedebut'])). ' pour une quotité de '.$eleve_avs[0]['quotite'].' heure(s)';
			
		}
		
	     //Envoi Mail 
		 //------------
		 
		//Formatage et envoi du message à l'ERF du secteur d'origine de l'élève
		//-----------------------------------------------------------------
		$message = Swift_Message::newInstance()
		//->setTo($destinataire_eleve[0]['email_address'])
		->setFrom('acad@ac-reunion.fr')
		->setTo('franck.gelez@ac-reunion.fr' )
		->setSubject('TEST : Changement de secteur '.$this->orientation[0]['nom'].' '.$this->orientation[0]['prenom'].' ('.$this->orientation[0]['eleveId'].' )'.'avs'.$acc[0]['avsprenom'])
		->setBody(html_entity_decode($corps_message));
		$this->getMailer()->send($message);
		
		
	   //Formatage et envoi du message à l'ERF du secteur d'accueil de l'élève
		//-----------------------------------------------------------------
		$message = Swift_Message::newInstance()
		//->setTo($destinataire_eleve_recep[0]['email_address'])
		->setFrom('acad@ac-reunion.fr')
		 ->setTo('franck.gelez@ac-reunion.fr' )
		->setSubject('TEST : Changement de secteur  '.$this->orientation[0]['nom'].' '.$this->orientation[0]['prenom'].' ('.$this->orientation[0]['eleveId'].' )')
		->setBody(html_entity_decode($corps_message));
		$this->getMailer()->send($message);
		
		
	    //Formatage et envoi du message àau gestionnaire académique
		//------------------------------------------------------------
		$message = Swift_Message::newInstance()
		//->setTo($destinataire_eleve_recep[0]['email_address'])
		->setFrom('acad@ac-reunion.fr')
		 ->setTo('franck.gelez@ac-reunion.fr' )
		->setSubject('TEST : Changement de secteur  '.$this->orientation[0]['nom'].' '.$this->orientation[0]['prenom'].' ('.$this->orientation[0]['eleveId'].' )')
		->setBody(html_entity_decode($corps_message));
		$this->getMailer()->send($message);
		
		 $this->redirect('orientation/message');
		}else{
			if(!$_POST['secteur_id']){
			  $this->getUser()->setFlash('error', 'selectionner un secteur !!!');
			}
			
			
        }		
		   
		}elseif ($request->getParameter('flag') == 1 &&  $count_orientation == 0){
		 $this->getUser()->setFlash('error', 'Impossible pas de scolarité en cours à la date du jour !!!');
		  $this->redirect('orientation/message');
		}
		
    }
    
    
    public function executeShowHisto(sfWebRequest $request)
    {
        $this->orientation = Doctrine_Core::getTable('Orientation')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->orientation);		
	}
	
    public function executeNew(sfWebRequest $request)
    {
	
  	    // --- RECHERCHE DE LA DERNIERE scolarisation ordinaire en cours---
		$this->orientation = Doctrine_Core::getTable('Orientation')->getDerScoMax($request->getParameter('eleve_id'));
		$count_orientation =count($this->orientation);
		//*************************************************
		
		$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $or = new Orientation();
		$or->setEleveId($request->getUrlParameter('eleve_id'));
		
		if($count_orientation == 0){
		// initialisation de l'orientation aux dates debut et fin d'année scolaire
        $or->setDatedebut($anneeScolaire->getDatedebutanneescolaire());
     	}else{ //si changement de scolarité 
		
			 if ($this->orientation[0]['datefin'] == $anneeScolaire->getDatefinanneescolaire()) {
			  $this->getUser()->setFlash('error', 'Impossible de créer une nouvelle scolarité,la denière se termine le '.date('d-m-Y',strtotime( $anneeScolaire->getDatefinanneescolaire())));
			  $this->redirect('orientation/index?eleve_id='.$request->getParameter('eleve_id'));
			 }else{
			$dt =strtotime($this->orientation[0]['datefin']);
			$dt=strtotime("+ 1day",$dt);
			$or->setDatedebut($dt);
			}
	
		}
		$or->setDatefin($anneeScolaire->getDatefinanneescolaire());
		$this->form = new OrientationForm($or);
        $this->eleve_id = $request->getUrlParameter('eleve_id');
    }
    

    
	
    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new OrientationForm();
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
	
	
		//année scolaire en cours
		//-------------------------
		$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
		$this->deb = $annee->getDatedebutanneescolaire();
		$this->fin = $annee->getDatefinanneescolaire();

		
        $this->forward404Unless($orientation = Doctrine_Core::getTable('Orientation')->find(array($request->getParameter('id'))), sprintf('cet(te) élève n\'a pas d\'orientation (%s).', $request->getParameter('id')));
        $orientation->setDatedebut($orientation->getDatedebut());
        $orientation->setDatefin($orientation->getDatefin());
        $orientation->setClasseId($orientation->getClasseId());
        $this->form = new OrientationForm($orientation,$deb);
        $this->eleve_id = $orientation->getEleveId();
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($orientation = Doctrine_Core::getTable('Orientation')->find(array($request->getParameter('id'))), sprintf('Object orientation does not exist (%s).', $request->getParameter('id')));
        $this->form = new OrientationForm($orientation);
        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
		//$request->checkCSRFProtection();
        $this->forward404Unless($orientation = Doctrine_Core::getTable('Orientation')->find(array($request->getParameter('id'))), sprintf('Object orientation does not exist (%s).', $request->getParameter('id')));
        $orientation->delete();
        $this->redirect('orientation/index?eleve_id=' . $orientation->getEleveId());
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
		//sfContext::getInstance()->getUser()->getAttribute('eleve');
				
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {

			//contrôle des accompagnements si nouvelle scolarisation dans le même secteur sur année scolaire en cours
			//-------------------------------------------------------------------------------------------------------
		     if ($form->isNew()) {
			$eleveavs = Doctrine_Core::getTable('EleveAvs')->getEleveAcc($form->getValue('eleve_id'));
			$count_eleveavs =count($eleveavs);
			if ($count_eleveavs > 0){
			$this->getUser()->setFlash('error', 'Cet(te) élève est accompagné vous devez faire une demande d\'avenant à l\'ASH');
			}
			}	
				
			//sauvegarde de l\'enregistrement
			//---------------------------------
		    $eleve_id =$form->getValue('eleve_id');
            $orientation = $form->save();
            $this->getUser()->setFlash('succes', 'Scolarisation ordinataire enregistrée avec succès');
           // $this->redirect('orientation/edit?id=' . $orientation->getId());
		   $this->redirect('orientation/index?eleve_id='.$orientation->getEleveId());
		   
        }else{
		
		 $this->getUser()->setFlash('error', 'Scolarisation ordinaire non enregistrée '.$form->getValue('datefin'));
          if(!$form->isNew()){ 
		  $this->redirect('orientation/index?eleve_id='.$eleve_id );
		  }else{
		  	$this->redirect('orientation/index');
		  }
		}
    }
    
    public function executeAide(sfWebRequest $request){	}

}
