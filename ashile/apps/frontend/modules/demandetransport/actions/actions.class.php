<?php

/**
 * demandetransport actions.
 *
 * @package    ash
 * @subpackage demandetransport
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandetransportActions extends sfActions
{

    public function executeDetail(sfWebRequest $request)
    {
        $this->demande_transports = Doctrine_Core::getTable('DemandeTransport')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->demande_transports = Doctrine_Core::getTable('DemandeTransport')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
                
       $exist = count($this->demande_transports);         

         if($exist == 0){
			$this->cda = 'NEW';
		}
		
		
		
        if($exist>0){

		
				
			if(!$this->demande_transports[0]->getDatedecisioncda() && $this->demande_transports[0]->getDecisioncda() == false && !$this->demande_transports[0]->getDatefinnotif() && !$this->demande_transports[0]->getDatedebutnotif() ) // il ne peut y avoir qu'une demande sessad
		   {
		    $this->cda = 'ATTENTE';
		   }
						
			   if($this->demande_transports[0]->getDatedecisioncda() && $this->demande_transports[0]->getDecisioncda() == true && $this->demande_transports[0]->getDatefinnotif() && $this->demande_transports[0]->getDatedebutnotif()) // il ne peut y avoir qu'une demande sessad
			   {
				  $this->cda = 'ACCORD';
				  
				 $transport_obtenu_a_completer = Doctrine_Core::getTable('TransportObtenu')
                ->createQuery('a')
                ->where('a.datedebut is null')
				->andwhere ('a.demandetransport_id=?', $this->demande_transports[0]['id'])
                ->execute();
				$this->count_transport_obtenu_a_completer =count($transport_obtenu_a_completer);
				
				
				   
			   }  

			   if($this->demande_transports[0]->getDatedecisioncda() && $this->demande_transports[0]->getDecisioncda() == false) // rejet
			   {
				   $this->cda = 'REJET';
			   }  		   
			 
		}        
    }

    public function executeNew(sfWebRequest $request)
    {
	
	 //recherche type transport ND
	 //----------------------------
		$transport = Doctrine_Query::create()
		->select('t.id as transport_id')
		->from('Transport t')
		->where('t.libelletransport LIKE "%ND%"')
		->limit(1)
		->execute();
	 
        $demande_transport = new DemandeTransport();
        $demande_transport->setMdphId($this->getRequestParameter('mdph_id'));
        $demande_transport->setDateDemandeTransport(date('Y-m-d',time()));
		$demande_transport->setTransportId ($transport[0]['transport_id']);
        $this->form = new DemandeTransportForm($demande_transport);
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DemandeTransportForm();
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($demandetransport = Doctrine_Core::getTable('DemandeTransport')->find(array($request->getParameter('id'))), sprintf('il n\'y a pas de demande transport (%s).', $request->getParameter('id')));
        $this->form = new DemandeTransportForm($demandetransport);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($demande_transport = Doctrine_Core::getTable('DemandeTransport')->find(array($request->getParameter('id'))), sprintf('il n\'y a pas de demande transport (%s).', $request->getParameter('id')));
        $this->form = new DemandeTransportForm($demande_transport);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {

        $this->forward404Unless($demande_transport = Doctrine_Core::getTable('DemandeTransport')->find(array($request->getParameter('id'))), sprintf('il n\'y a pas de demande transport (%s).', $request->getParameter('id')));
        $demande_transport->delete();

        $this->redirect('demandetransport/new?mdph_id=' . $demande_transport->getMdphId());
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form_param = $request->getParameter($form->getName());
        $form->bind($form_param, $request->getFiles($form->getName()));
        if ($form->isValid()) {
	 
            $demande_transport = $form->save();
            
            // recherche d'un moyen pour cette demande
			 $q = Doctrine_Core::getTable('Transportobtenu')
									->createQuery('a')
									->where('a.demandetransport_id =?', $demande_transport->getId())
									->fetchArray();
				 
			if(count($q) == 0){
            
					// --- on enregistre automatiquement un transport attribué si la demande a un accord CDA --- //

						if($demande_transport->getDatedebutnotif() && $demande_transport->getDatefinnotif() && $demande_transport->getDecisioncda() == true && $demande_transport->getDatedecisioncda()  ){ 
						// on cherche eleve_id
						//---------------------
						$eleveId = Doctrine::getTable('Mdph')->findOneById($demande_transport->getMdphId())->getEleveId();
						
							$transportAttribue = new Transportobtenu();
							$transportAttribue->setEleveId($eleveId);
							$transportAttribue->setTransportId($demande_transport->getTransportId());
							$transportAttribue->setDemandetransportId($demande_transport->getId());


										//	if($demande_transport->getDatedebutnotif()){
										//		$transportAttribue->setDatedebut($demande_transport->getDatedebutnotif());
										//	}
											if($demande_transport->getDatefinnotif()){
												$transportAttribue->setDatefin($demande_transport->getDatefinnotif());
											}

											$transportAttribue->save();
											$this->getUser()->setFlash('notice', 'enregistrée avec succès et création d\'un moyen de transport à compléter (onglet Transport)');
											$this->redirect('demandetransport/edit?id=' . $demande_transport->getId() . '&mdph_id=' . $demande_transport->getMdphId());
											
								if(!$demande_transport->getDatedebutnotif() | !$demande_transport->getDatefinnotif() ) { //pas date de notif
								$this->getUser()->setFlash('notice', 'saisir les dates de notification !!');
								}
							}
							}
						if(!$demande_transport->getDatedebutnotif() && !$demande_transport->getDatefinnotif() && $demande_transport->getDecisioncda() == false && $demande_transport->getDatedecisioncda()  ){ 
								$this->getUser()->setFlash('succes', 'Rejet enregistré avec succès ');
								}else{
						$this->getUser()->setFlash('succes', 'enregistré avec succès ');
						}
						$this->redirect('demandetransport/edit?id=' . $demande_transport->getId() . '&mdph_id=' . $demande_transport->getMdphId());
				}
		}	
}
