<?php

/**
 * piecesdossier actions.
 *
 * @package    ash
 * @subpackage piecesdossier
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class piecesdossierActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$this->pieces_dossiers = Doctrine::getTable('Piecesdossier')->findByMdphId($request->getParameter('mdph_id'));
	$this->mdphId = $request->getParameter('mdph_id');
 
  }
  
    public function executeList(sfWebRequest $request)
  {
	$this->pieces_dossiers = Doctrine::getTable('Piecesdossier')->findByMdphId($request->getParameter('mdph_id'));
	$this->mdphId = $request->getParameter('mdph_id');
	$this->pjc = count($this->pieces_dossiers);
 
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->pieces_dossier = Doctrine_Core::getTable('PiecesDossier')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->pieces_dossier);
  }

  public function executeNew(sfWebRequest $request)
  {
	$this->mdphId = $request->getParameter('mdph_id');
	  
	$pdossier = new PiecesDossier(); 
	$pdossier->setMdphId($request->getParameter('mdph_id')); 
    $this->form = new PiecesDossierForm($pdossier);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PiecesDossierForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($pieces_dossier = Doctrine_Core::getTable('PiecesDossier')->find(array($request->getParameter('id'))), sprintf('Object pieces_dossier does not exist (%s).', $request->getParameter('id')));
    $this->form = new PiecesDossierForm($pieces_dossier);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($pieces_dossier = Doctrine_Core::getTable('PiecesDossier')->find(array($request->getParameter('id'))), sprintf('Object pieces_dossier does not exist (%s).', $request->getParameter('id')));
    $this->form = new PiecesDossierForm($pieces_dossier);

    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($pieces_dossier = Doctrine_Core::getTable('PiecesDossier')->find(array($request->getParameter('id'))), sprintf('Object pieces_dossier does not exist (%s).', $request->getParameter('id')));
    //$this->toto = $pieces_dossier->controleDelete();
    $pieces_dossier->delete();

    $this->redirect('piecesdossier/list?mdph_id='.$request->getParameter('mdph_id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $pieces_dossier = $form->save();
      $this->getUser()->setFlash('succes', 'Enregistré avec succés');
      $this->redirect('piecesdossier/edit?id='.$pieces_dossier->getId());
    }
  }
}
