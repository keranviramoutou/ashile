<?php

/**
 * demandesessad actions.
 *
 * @package    ash
 * @subpackage demandesessad
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandesessadActions extends sfActions
{
    public function executeDetail(sfWebRequest $request)
    {
        $this->demande_sessads = Doctrine_Core::getTable('DemandeSessad')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->demande_sessads = Doctrine_Core::getTable('DemandeSessad')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
        
       $exist = count($this->demande_sessads);         

        // si la demande a une décision cda on empèche la modification de cette demande
        
		
         if($exist == 0){
			$this->cda = 'NEW';
		}
		
        if($exist > 0){
			if(!$this->demande_sessads[0]->getDatedecisioncda() &&!$this->demande_sessads[0]->getDecisioncda()  && !$this->demande_sessads[0]->getDatefinnotif() && !$this->demande_sessads[0]->getDatedebutnotif() ) // il ne peut y avoir qu'une demande sessad
		   {
		    $this->cda = 'ATTENTE';
		   }
					
		   if($this->demande_sessads[0]->getDatedecisioncda() && $this->demande_sessads[0]->getDecisioncda() == true && $this->demande_sessads[0]->getDatefinnotif() && $this->demande_sessads[0]->getDatedebutnotif()) // il ne peut y avoir qu'une demande sessad
		   {
			   $this->cda = 'ACCORD';
			   
				  
				 $sessad_obtenu_a_completer = Doctrine_Core::getTable('SessadObtenu')
                ->createQuery('a')
                ->where('a.datedebut is null')
				->andwhere ('a.demandesessad_id=?', $this->demande_sessads[0]['id'])
                ->execute();
				$this->count_sessad_obtenu_a_completer =count($sessad_obtenu_a_completer);
		   }  

		   if($this->demande_sessads[0]->getDatedecisioncda() && $this->demande_sessads[0]->getDecisioncda() == false) // rejet
		   {
			   $this->cda = 'REJET';
		   }  		   
        } 
               
    }
    
    public function executeIndex(sfWebRequest $request)
    {
        $this->demande_sessads = Doctrine_Core::getTable('DemandeSessad')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
    }
    public function executeNew(sfWebRequest $request)
    {
        $demande_sessad = new DemandeSessad();
	    $demande_sessad->setMdphId($request->getParameter('mdph_id'));
        $demande_sessad->setDateDemandeSessad(date('Y-m-d',time()));
        $this->form = new DemandeSessadForm($demande_sessad);

    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new DemandeSessadForm();
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
	    $this->forward404Unless($demande_sessad = Doctrine_Core::getTable('DemandeSessad')->find(array($request->getParameter('id'))), sprintf('Cette demande n\'existe pas (%s).', $request->getParameter('id')));
        $this->form = new DemandeSessadForm($demande_sessad);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($demande_sessad = Doctrine_Core::getTable('DemandeSessad')->find(array($request->getParameter('id'))), sprintf('Cette demande n\'existe past (%s).', $request->getParameter('id')));

		// 1) injection du mdph_id
		//$demande_sessad->setMdphId(89);
		
		// 2) injection du type sessad    
	//	$demande_sessad->setTypesessadId(1);	
		     
        $this->form = new DemandeSessadForm($demande_sessad);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {

        $this->forward404Unless($demande_sessad = Doctrine_Core::getTable('DemandeSessad')->find(array($request->getParameter('id'))), sprintf('Cette demande n\'existe pas (%s).', $request->getParameter('id')));
        $demande_sessad->delete();

        $this->redirect('demandesessad/new?mdph_id=' . $request->getParameter('mdph_id'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {

		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
			
			if ($form->isValid()) {
		
				 $demande_sessad = $form->save();
				 
				 // recherche d'un moyen pour cette demande
				 //----------------------------------------
				 $q = Doctrine_Core::getTable('SessadObtenu')
								->createQuery('a')
								->where('a.demandesessad_id =?', $demande_sessad->getId())
								->fetchArray();
				 
				if(count($q) == 0){
					 if($demande_sessad->getDatedebutnotif() && $demande_sessad->getDatefinnotif() && $demande_sessad->getDecisioncda() == true && $demande_sessad->getDatedecisioncda()){    //saisie dates notificatiion obligatoire
						
							// --- on enregistre automatiquement un sessad attribué si la demande a un accord CDA et si dates de notifications saisies --- //
							//------------------------------------------------------------------------------------------------------------------------------
						
							// on cherche eleve_id
								$eleveId = Doctrine::getTable('Mdph')->findOneById($demande_sessad->getMdphId())->getEleveId();
								
								// on recherche l'établissement spécialisé de type Sessad ND
									 $sessad_etab = Doctrine_Core::getTable('Sessad')
										->createQuery('a')
										->innerjoin('a.Etabnonsco e On e.id = a.etabnonsco_id' )
										->where('e.nometabnonsco LIKE ?', '%ND%')
										->limit(1)
										->execute();
								
								$sessadAttribue = new Sessadobtenu();
								$sessadAttribue->setEleveId($eleveId);
								$sessadAttribue->setSessadId($sessad_etab[0]['id']);
								$sessadAttribue->setDemandesessadId($demande_sessad->getId());

								//	if($demande_sessad->getDatedebutnotif()){
								//		$sessadAttribue->setDatedebut($demande_sessad->getDatedebutnotif());
								//	}
									if($demande_sessad->getDatefinnotif()){
										$sessadAttribue->setDatefin($demande_sessad->getDatefinnotif());
									}

									$sessadAttribue->save();
					   				$this->getUser()->setFlash('succes', 'enregistré avec succès et création de moyen à compléter (onglet Sessad)');
									$this->redirect('demandesessad/edit?id=' . $demande_sessad->getId() . '&mdph_id=' . $demande_sessad->getMdphId());
									
						if(!$demande_sessad->getDatedebutnotif() | !$demande_sessad->getDatefinnotif() ) { //pas date de notif
						$this->getUser()->setFlash('notice', 'saisir les dates de notification !!');
						}
					}
				}	
				
						if(!$demande_sessad->getDatedebutnotif() && !$demande_sessad->getDatefinnotif() && $demande_sessad->getDecisioncda() == false && $demande_sessad->getDatedecisioncda()  ){ 
								$this->getUser()->setFlash('succes', 'Rejet enregistré avec succès ');
								}else{
						$this->getUser()->setFlash('succes', 'enregistré avec succès ');
						}
				
				
				$this->redirect('demandesessad/edit?id=' . $demande_sessad->getId() . '&mdph_id=' . $demande_sessad->getMdphId());
		}
	}
}
