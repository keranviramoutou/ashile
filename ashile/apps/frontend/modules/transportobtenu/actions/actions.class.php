<?php

/**
 * transportobtenu actions.
 *
 * @package    ash
 * @subpackage transportobtenu
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class transportobtenuActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$this->anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
	  
    $this->transportobtenus = Doctrine_Query::create()
     		
	->select('a.*,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda')
	  ->from('Transportobtenu a')
	  ->leftjoin('a.DemandeTransport d on d.id = a.demandetransport_id')
      ->where('a.eleve_id =?', $request->getParameter('eleve_id'))
	   ->orderBy('a.datefin DESC')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->transportobtenu = Doctrine_Core::getTable('Transportobtenu')->find($request->getParameter('id'));
    $this->forward404Unless($this->transportobtenu);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TransportobtenuForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TransportobtenuForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {

	   $this->forward404Unless($transportobtenu = Doctrine_Core::getTable('Transportobtenu')->find(array($request->getParameter('id'))), sprintf('Object transport does not exist (%s).', $request->getParameter('id')));
      $this->form = new TransportobtenuForm($transportobtenu);
       
       $this->demandetransport = Doctrine_Query::Create()
								->select('to.id as transportobtenu_id, dt.id as demandetransport_id, dt.datedebutnotif as datedebut, dt.datefinnotif as datefin,dt.mdph_id as mdph_id,dt.datedecisioncda as datedecisioncda')
								->from('Transportobtenu to')
								->innerJoin('to.DemandeTransport dt ON dt.id = to.demandetransport_id')
								->where('dt.id = ?', $transportobtenu->getDemandetransportId())
								->fetchArray();
		$this->count_demndetransport = count($this->demandetransport);
								
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($transportobtenu = Doctrine_Core::getTable('Transportobtenu')->find(array($request->getParameter('id'))), sprintf('Object transportobtenucrcrcrccraaa does not exist (%s).', $request->getParameter('id')));
    $this->form = new TransportobtenuForm($transportobtenu);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($transportobtenu = Doctrine_Core::getTable('Transportobtenu')->find(array($request->getParameter('id'),
            )), sprintf('Object transportobtenu does not exist (%s).', $request->getParameter('id')));
   $transportobtenu->delete();
    $this->getUser()->setFlash('notice', 'Transport supprimé !');
    $this->redirect('transportobtenu/index?id=' . $transportobtenu->getId() .'&eleve_id=' . $transportobtenu->getEleveId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
		$transportobtenu = $form->save();
		$this->getUser()->setFlash('notice', 'Transport Enregistrè avec succès');
		//$this->redirect('transportobtenu/edit?transport_id='.$transportobtenu->getTransportId().'&eleve_id='.$transportobtenu->getEleveId());
		$this->redirect('transportobtenu/index?id=' . $transportobtenu->getId() .'&eleve_id=' . $transportobtenu->getEleveId());
    }
  }
  
   public function executeAide(){}
}
