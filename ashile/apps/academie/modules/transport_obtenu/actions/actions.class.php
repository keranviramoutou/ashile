<?php

/**
 * transport_obtenu actions.
 *
 * @package    ash
 * @subpackage transport_obtenu
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transport_obtenuActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->transport_obtenus = Doctrine_Query::Create()
      ->from ('TransportObtenu t')    
      ->innerJoin('t.Eleve e ON t.eleve_id = e.id')
     ->innerJoin('t.Transport u ON t.transport_id = u.id')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->transport_obtenu = Doctrine_Core::getTable('TransportObtenu')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->transport_obtenu);
  }

  public function executeNew(sfWebRequest $request)
  {
	$eleve_id = $request->getParameter('eleve_id');
	
	  //Dernière demande de transport en cours à la date du jour pour l'élève selectionné
	//--------------------------------------------------------------------------------------
		$this->demande_transport = Doctrine_Core::getTable('Demandetransport')->getDemandetransportSelectionner($request->getParameter('demandetransport_id'));
		$this->existdemande_transport = count($this->demande_transport);
		
	$this->eleve = Doctrine::getTable('Eleve')->findOneById($eleve_id);	 
	$transportObtenu = new TransportObtenu();
	$transportObtenu->setEleveId($eleve_id);
    $this->form = new TransportObtenuForm($transportObtenu);
    
    // passage de la variable demandetransport_id
    $this->getUser()->setAttribute('demandetransport_id', $request->getParameter('demandetransport_id'));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TransportObtenuForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    //Dernière demande de transport en cours à la date du jour pour l'élève selectionné
	//--------------------------------------------------------------------------------------
		$this->demande_transport = Doctrine_Core::getTable('Demandetransport')->getDemandetransportSelectionner($request->getParameter('demandetransport_id'));
	$this->existdemande_transport = count($this->demande_transport);
    $this->forward404Unless($transport_obtenu = Doctrine_Core::getTable('TransportObtenu')->find(array($request->getParameter('id'))), sprintf('Object transport_obtenu does not exist (%s).', $request->getParameter('id')));
    $this->form = new TransportObtenuForm($transport_obtenu);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($transport_obtenu = Doctrine_Core::getTable('TransportObtenu')->find(array($request->getParameter('id'))), sprintf('Object transport_obtenu does not exist (%s).', $request->getParameter('id')));
    $this->form = new TransportObtenuForm($transport_obtenu);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($transport_obtenu = Doctrine_Core::getTable('TransportObtenu')->find(array($request->getParameter('id'))), sprintf('Object transport_obtenu does not exist (%s).', $request->getParameter('id')));
    $transport_obtenu->delete();

    $this->redirect('transport_obtenu/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $transport_obtenu = $form->save();
            /* --------UPDATE------- */
            
			// mise a jour de la demande à traité
            $demandetransportId = $this->getUser()->getAttribute('demandetransport_id');
            Doctrine_Query::Create()
                    ->update('demandetransport')
                    ->set('traite', true)
                    ->where('id = ?', $demandetransportId)
                    ->execute();
            /* -------------- */       

      $this->redirect('transport_obtenu/edit?id='.$transport_obtenu->getId().'&demandetransport_id='. $demandetransportId);
    }
  }
}
