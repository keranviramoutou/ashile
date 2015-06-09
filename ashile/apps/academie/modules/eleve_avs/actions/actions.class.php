<?php

/**
 * eleve_avs actions.
 *
 * @package    ash
 * @subpackage eleve_avs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eleve_avsActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {    
          $t1=0 ;
        //liste des élèves avec personnel accompagnant à la date du jour
	   //------------------------------------------------------------------         
        $this->eleve_avss = Doctrine_Core::getTable('EleveAvs')->getEleveAvecAcc();

    }

	    public function executeListpos(sfWebRequest $request)
    {    
   
        //liste des contarts avec l' Hisotique des positions
	   //----------------------------------------------------   
            $this->PosAvs = Doctrine_Core::getTable('EleveAvs')->getListeContratsAccavecPos($request->getParameter('eleve_id'));
			$this->count_PosAvs = count($this->PosAvs);

    }
    
    public function executeSecteur(sfWebRequest $request)
    {
	   // liste des élèves accompagnés par secteur
	   //------------------------------------------
		$secteur_id = $request->getParameter('secteur_id');
		$this->eleve_avss =Doctrine_Core::getTable('EleveAvs')->getListeEleveparSecteur($request->getParameter('secteur_id'));
		
	}
    public function executeList(sfWebRequest $request)
    {
   	 // on cherche les accompagnement(s)  d'un élève
	 //---------------------------------------------
		$this->eleve_avss = Doctrine_Core::getTable('EleveAvs')->getEleveAvecAcc($request->getParameter('eleve_id'));
		$this->existEleveAvs = count($this->eleve_avss);
		$this->dersco1 = Doctrine_Core::getTable('Orientation')->getDerSco($request->getParameter('eleve_id'));
		if(!$existEleveAvs){
			$this->eleve = Doctrine::getTable('Eleve')->findOneById($request->getParameter('eleve_id'));
			$eleve = $this->eleve;
			$_POST['nom_eleve'] ='POB';
		//$this->redirect('eleve/recherche?eleve_nom='.$eleve);
		 
		}
	}
	    public function executeList1(sfWebRequest $request)
    {
   	 // on cherche l'historique des accompagnements pour un élève
	 //------------------------------------------------------------
		$this->eleve_avss = Doctrine_Core::getTable('EleveAvs')->getHistoEleveAcc($request->getParameter('avs_id'));
		$this->existEleveAvs = count($this->eleve_avss);
			 
		
	}
	
    public function executeNew(sfWebRequest $request)
    {
	
		$this->nomModule = $this->getModuleName();
   //dernière scolarisation de l'élève en cours à la date du jour
  //--------------------------------------------------------------
	$this->orientation = Doctrine_Core::getTable('Orientation')->getDerSco($request->getParameter('eleve_id'));
	$this->existorientation = count($this->orientation);	
	
	//Dernière demande de personnel acc. en cours à la date du jour pour l'élève selectionné
	//--------------------------------------------------------------------------------------
		$this->demande_avs = Doctrine_Core::getTable('DemandeAvs')->getDerDemandeAcc($request->getParameter('eleve_id'));
		$this->existAvs = count($this->demande_avs);
	
	 //Total de la quotité horaire notifiée pour l'accompagnant sélectionné
	 //-----------------------------------------------------------------------
        $this->totalquotiteavs = Doctrine_Core::getTable('EleveAvs')->getTotalQHcontratacc($request->getParameter('avs_id'));
		$this->existTotalquotiteavs = count($this->totalquotiteavs); 
		
		 
	 // Total quotité horaire contrats pour le personnel acc. selectionné à la date du jour
	//-------------------------------------------------------------------------------------
		$this->totalquotitécontratAvs = Doctrine_Core::getTable('ContratAvs')->getTotalQHcontratacc($request->getParameter('avs_id'));
		$this->existtotalquotitécontratAvs = count($this->totalquotitécontratAvs); 
	  
	  
	   
	 //Total de la quotité horaire notifiée pour l'élève sélectionné à la date du jour
	 //----------------------------------------------------------------------------------
        $this->totalquotiteeleve = Doctrine_Core::getTable('EleveAvs')->getTotalQHnotifiEleve($request->getParameter('eleve_id'));
   		$this->existTotalquotiteeleve = count($this->totalquotiteeleve);	


   	 // on cherche les acc. affectés à un élève
	 //-----------------------------------------
	 
		$this->EleveAvs = Doctrine_Core::getTable('EleveAvs')->getEleveAcc($request->getParameter('eleve_id'));
		$this->existEleveAvs = count($this->EleveAvs);
		

		
		
	   if ($request->getParameter('eleve_id')){
	   
	   //liste des contrats pour l'avs
	   //------------------------------
	   $this->contratAvs = Doctrine::getTable('Avs');
	   $this->existContratAvs = count($this->contratAvs);
	   
	   
	   $eleve_id = $request->getParameter('eleve_id');
	   $this->eleve = Doctrine::getTable('Eleve')->findOneById($eleve_id);
	   
	   $this->eleve = Doctrine_Query::create()
                ->select('e.id as eleveId,o.id as orientationId,e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,
				s.libellesecteur as libellesecteur,s.id as secteur_id,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab')
                ->from('Eleve e')
                ->leftjoin('e.Secteur s ON s.id = e.secteur_id')
                ->leftJoin('e.Orientation o ON e.id = o.eleve_id')
                ->leftjoin('o.Etabsco et ON o.etabsco_id = et.id')
                ->leftjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->where('e.id = ?', $eleve_id)
                ->orderBy('s.libellesecteur,et.nometabsco ASC,e.nom')
				->fetcharray();
		
		
	   $eleve = $this->eleve;
	   $this->secteur_id =$request->getParameter('secteur_id');
	   $eleveAvs = new Eleveavs();
	   $eleveAvs->setEleveId($eleve_id);
	   $this->form = new EleveAvsForm($eleveAvs, Array($this->demande_avs, $this->eleve,$this->secteur_id,$this->existeleve), false);
       }
	   
	   if ($request->getParameter('avs_id')){
	   
	   //liste des contrats pour l'avs
	   //------------------------------
	   $avs_id = $request->getParameter('avs_id');
	   $this->contratAvs = Doctrine::getTable('ContratAvs')->findOneById($avs_id);
	   $this->existContratAvs = count($this->contratAvs);
	   
	   $this->Avs = Doctrine::getTable('Avs')->findOneById($avs_id);
	   $eleveAvs = new Eleveavs();
	   $eleveAvs->setAvsId($avs_id);
	   $this->form = new EleveAvsForm($eleveAvs,$this->Avs );
	   
	   }

	   
   	// passage de la variable 'demandeavs_id'
	//---------------------------------------
   	  $this->getUser()->setAttribute('demandeavs_id', $request->getParameter('demandeavs_id')); 
      $this->getUser()->setAttribute('secteur_id',$request->getParameter('secteur_id')) ;	
	  $this->getUser()->setAttribute('eleve_id',$request->getParameter('eleve_id')) ;	
	  

        
    }
	
				
    public function executeCreate(sfWebRequest $request)
    {
	    //echo var_dump($request->getParameterHolder());
	
		
	    $secteur = $this->getUser()->getAttribute('secteur_id');
		$this->eleve_avss =Doctrine_Core::getTable('EleveAvs')->getListeEleveparSecteur($request->getParameter('secteur_id'));
	
	    //liste des élèves avec personnel accompagnant à la date du jour
	   //------------------------------------------------------------------         
        $this->eleve_avss = Doctrine_Core::getTable('EleveAvs')->getEleveAvecAcc();
       
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EleveAvsForm();

        $this->processForm($request, $this->form);
		
       
        $this->redirect('eleve_avs/secteur?secteur_id='.$secteur);
    }

    public function executeAjaxAvs(sfWebRequest $request)
    {
        // recherche des eleves suivi par l'avs selectionne
        //------------------------------------------------- 
        $this->eleveEnCharge = Doctrine_Core::getTable('EleveAvs')->getRechEleveviaAcc($request->getParameter('avs_id'));
 		$this->existeleveEnCharge = count($this->eleveEnCharge);
	
        return $this->renderPartial('eleve_avs/infoAvs');

    }
  
    public function executeContratAvs(sfWebRequest $request)
    {

	  // Liste des contrats en cours à la date du jour pour l'accompagnant selectionne
	  //------------------------------------------------------------------------------
		$this->contratAvs = Doctrine_Core::getTable('ContratAvs')->ContratsAcc($request->getParameter('avs_id'));
		$this->existContratAvs = count($this->contratAvs);
		   
		return $this->renderPartial('eleve_avs/contratAvs');	
		
	}	
    
    public function executeEdit(sfWebRequest $request)
    {

		$this->nomModule = $this->getModuleName();

		// Liste des contrats pour l'accompagnant selectionne
		//---------------------------------------------------
		$this->contratAvs = Doctrine_Core::getTable('ContratAvs')->ContratsAcc($request->getParameter('avs_id'));
		$this->existContratAvs = count($this->contratAvs);
		$this->forward404Unless($eleve_avs = Doctrine_Core::getTable('EleveAvs')->find(array($request->getParameter('id'))), sprintf('Object eleve_avs does not exist (%s).', $request->getParameter('id')));
   
		// on cherche les acc. affectés à un élève
		//-----------------------------------------
		$this->EleveAvs = Doctrine_Core::getTable('EleveAvs')->getEleveAcc($request->getParameter('eleve_id'));
		//-------------------------------------------
		$this->existEleveAvs = count($this->EleveAvs);
   
   
		//Dernière demande AVS en cours à la date du jour pour l'élève selectionné
		//-----------------------------------------------------------------------
		$this->demande_avs = Doctrine_Core::getTable('DemandeAvs')->getDerDemandeAcc($request->getParameter('eleve_id'));
								
		// --- test si il existe au moins une valeur retourné par la requete							
		$this->existAvs = count($this->demande_avs);					
								
		//Total de la quotité horaire notifiée pour l'accompagnant sélectionné
		//-----------------------------------------------------------------------
		$this->totalquotiteavs = Doctrine_Core::getTable('EleveAvs')->getTotalQHnotifieacc($request->getParameter('avs_id'));
		$this->existTotalquotiteavs = count($this->totalquotiteavs); 	
		
		// Total quotité horaire contrats pour le personnel acc. selectionné à la date du jour
		//-------------------------------------------------------------------------------------
		$this->totalquotitécontratAvs = Doctrine_Core::getTable('ContratAvs')->getTotalQHcontratacc($request->getParameter('avs_id'));
		$this->existtotalquotitécontratAvs = count($this->totalquotitécontratAvs);   

		//**********************************************************************************************
		$elv = Doctrine::getTable('Eleve')->find($request->getParameter('eleve_id')); 	
		$this->secteur_id =$elv->getSecteurId();	
		$se = Doctrine::getTable('Secteur')->findOneById($this->secteur_id);  
		$this->sfGuardUser = $se->getSfguarduser(); 
		//**********************************************************************************************				
				
		//Total de la quotité horaire notifiée pour l'élève sélectionné
		//-----------------------------------------------------------------------
		$this->totalquotiteeleve = Doctrine_Core::getTable('EleveAvs')->getTotalQHnotifiEleve($request->getParameter('eleve_id'));						
		$this->existTotalquotiteeleve = count($this->totalquotiteeleve); 						

		//$this->forward404Unless($demande_avs = Doctrine_Core::getTable('DemandeAvs')->find(array($request->getParameter('id'))), sprintf('Object eleve_avs does not exist (%s).', $request->getParameter('id')));
		$eleve_avs->setAvsId($request->getParameter('avs_id'));
		$this->form = new EleveAvsForm($eleve_avs,$this->contratAvs, $this->demande_avs);

		//on propose l'envoie d'un email lorsqu'on a enregistré un changement sur eleve_avs

		//---------------------------------------------------------------------------------
	

    }
    
    public function executeUpdate(sfWebRequest $request)
    {
	
		// Liste des contrats pour l'accompagnant selectionne
	    //---------------------------------------------------
		$this->contratAvs = Doctrine_Core::getTable('ContratAvs')->ContratsAcc($request->getParameter('avs_id'));
		$this->existContratAvs = count($this->contratAvs);

	    //Total de la quotité horaire notifiée pour l'élève sélectionné
	    //-----------------------------------------------------------------------
        $this->totalquotiteeleve = Doctrine_Core::getTable('EleveAvs')->getTotalQHnotifiEleve($request->getParameter('eleve_id'));
		$this->existTotalquotiteeleve = count($this->totalquotiteeleve); 
		
		   
		//Dernière demande AVS en cours à la date du jour pour l'élève selectionné
		//-----------------------------------------------------------------------
		$this->demande_avs = Doctrine_Core::getTable('DemandeAvs')->getDerDemandeAcc($request->getParameter('eleve_id'));
		$this->existAvs = count($this->demande_avs);					
								
		//Total de la quotité horaire notifiée pour l'accompagnant sélectionné
		//-----------------------------------------------------------------------
		$this->totalquotiteavs = Doctrine_Core::getTable('EleveAvs')->getTotalQHnotifieacc($request->getParameter('avs_id'));
		$this->existTotalquotiteavs = count($this->totalquotiteavs); 
		
				
		// Total quotité horaire contrats pour le personnel acc. selectionné à la date du jour
		//-------------------------------------------------------------------------------------
		$this->totalquotitécontratAvs = Doctrine_Core::getTable('ContratAvs')->getTotalQHcontratacc($request->getParameter('avs_id'));
		$this->existtotalquotitécontratAvs = count($this->totalquotitécontratAvs); 
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($eleve_avs = Doctrine_Core::getTable('EleveAvs')->find(array($request->getParameter('id'))),
		sprintf(' Object eleve_avs does not exist (%s).', $request->getParameter('id')));
		
	
		$this->form = new EleveAvsForm($eleve_avs, $this->contratAvs);

		$this->processForm($request, $this->form);

		//$this->setTemplate('edit');
		$this->setTemplate('show');

    }

    public function executeDelete(sfWebRequest $request)
    {
        $this->forward404Unless($eleve_avs = Doctrine_Core::getTable('EleveAvs')->find(array(
        $request->getParameter('id'))), sprintf('Object eleve_avs does not exist (%s).', $request->getParameter('eleve_id'), $request->getParameter('avs_id')));
        $eleve_id = $eleve_avs->getEleveId();
		$eleve_avs->delete();
      // $this->redirect('eleve_avs/index');
		$this->redirect('eleve_avs/list?eleve_id='.$eleve_id);
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
		
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        $eleveAvsPrec = $form->getObject();
		
		//récupération des valeurs saisies avant sauvegarde pour contôle de dates
		 //-------------------------------------------------------------------------	 
		$datedebut = $form->getValue('datedebut');
		$datefin = $form->getValue('datefin');		
		$id = $form->getValue('id');
		$eleve_id = $form->getValue('eleve_id');
		$avs_id  =	$form->getValue('avs_id');
		
		if ( $datefin && $datefin < $datedebut  ){
		 $this->getUser()->setFlash('error', 'la date de fin de contrat saisie '.date('d-m-Y',strtotime($datefin)) .' doit être supérieure à la date de début de contrat saisie : '.date('d-m-Y',strtotime($datedebut)));  
		 $this->redirect('eleve_avs/edit?id='.$id.'&eleve_id=' . $eleve_id. '&avs_id='.$avs_id ); 
	
	}
	
      if ($form->isValid()) 
          {

	    $eleve_avs = $form->save();
		  
			/* --------UPDATE------- */
			
			$mdph = Doctrine_core::getTable('Mdph')->findOneByEleveId($eleve_avs->getEleveId());
			$eleve = Doctrine_core::getTable('Eleve')->findOneById($eleve_avs->getEleveId());
			$this->getUser()->setFlash('notice', 'Modification(s) Enregistrée(s) avec succés pour la ligne concernant l\'élève : '.$mdph->getEleve().'et l\'accompagnant: '.$eleve_avs->getAvs());  
			if($mdph){	
			   //mise à jour de la demandeavs traitée
			   //------------------------------------
				$demandeavsId =  $this->getUser()->getAttribute('demandeavs_id');
				if($demandeavsId){
						Doctrine_Query::Create()
							->update('DemandeAvs da')
							->set('da.traite', true)
							->where('da.id = ?', $demandeavsId)
							->execute();
				}
 
			}


	/*
		///////////////////////// EMAILS /////////////////////////////////////////////////////////////////////
		
			// ****** ENVOIE AUTOMATIQUE DE L'EMAIL A EREF **************************************
			$destinataire = $form->getObject()->getDestinataire($form->getObject()->getEleveId());
			$message = Swift_Message::newInstance()
				  ->setFrom('acad@ac-reunion.fr')
				  ->setTo($destinataire[0]['email_address']) //->setTo('eref.ash@ac-reunion.fr')
				  ->setSubject($nomModule)
				  ->setBody('s mmmmmmmm rr ppp');
		 
			$this->getMailer()->send($message);
			// ***********************************************************************************

			
			// ----- ENREGISTREMENT AUTOMATIQUE DE L'EMAIL EN BDD --------------------------------
			$mail = new Mail();
			$mail->setEleveId($form->getObject()->getEleveId());
			$mail->setSfGuardUserId($destinataire[0]['email_address']);
			$mail->setDate(date('Y-m-d', time()));
			$mail->setSujet($nomModule);
			$mail->setTexte("STRINNNGggg");
			
			$mail->save();
			
			//------------------------------------------------------------------------------------
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////
		
	*/	
////////////////////////  FIN \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//////////////////////////////////\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\		
		
        }  
			$this->redirect('eleve_avs/edit?id='.$form->getobject()->getId().'&eleve_id=' . $form->getObject()->getEleveId(). '&avs_id='.$form->getObject()->getAvsId().'&eleve_nom='.$eleve->getNom().'&eleve_prenom='.$eleve->getPrenom().'&retour=1'); 
       
      }
 
    public function executeMiseAjour(sfWebRequest $request)
    {
		
		// on commence par créer un objet $eleve_as donné par $request
		$this->forward404Unless($eleve_avs = Doctrine_Core::getTable('EleveAvs')->find(array($request->getParameter('id'))), sprintf('Object eleve_avs does not exist (%s).', $request->getParameter('id')));
	
		// ------- recupération eleve_id -------------	
		$eleveId = Doctrine::getTable('EleveAvs')->findOneById($eleve_avs->getId())->getAvsId();
		
		// ------- le date transmise par $POST --------
		$laDate = $_POST['maj'];
		
		if ($laDate){ // test si la date est saisie
		$q = Doctrine_Query::create()
					->update('EleveAvs e')
					->set('e.datefin', '?', $laDate)
					->where('e.avs_id ='.$eleveId);
					//->andWhere('e.datefin >=?', date('Y-m-d', time()));

		$rows = $q->execute();
		$this->getUser()->setFlash('notice', 'les accompagnements de : '.$eleve_avs->getAvs().'ont étaient clôturés avec succès à la date du ');//.format_date($laDate,'dd/MM/yyyy'));

		// --------------------------------------
		}else{
		$this->getUser()->setFlash('error', 'Pas de date saisie pour la clôture des affectations');
		}
		$this->redirect('eleve_avs/edit?id='.$eleve_avs['id'].'&eleve_id=' . $eleve_avs['eleve_id'] . '&avs_id=' . $eleve_avs['avs_id']);

	}
  
       public function executeAide(){}
}
