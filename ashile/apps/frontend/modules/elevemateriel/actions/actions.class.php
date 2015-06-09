<?php

/**
 * elevemateriel actions.
 *
 * @package    ash
 * @subpackage elevemateriel
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class elevematerielActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    
	 $this->materiels= Doctrine_Core::getTable('Elevemateriel')-> getListMaterielEleve($request->getParameter('eleve_id'));
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->mat = Doctrine_Core::getTable('Materiel')->findOneById($request->getParameter('materiel_id'));	
    $this->demande_mat =  Doctrine_Core::getTable('Demandemateriel')->findOneByMaterielId($request->getParameter('materiel_id'));
    $this->materiel = Doctrine_Core::getTable('EleveMateriel')->findOneById($request->getParameter('id'));
   // $this->forward404Unless($this->materiel);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ElevematerielForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ElevematerielForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($elevemateriel = Doctrine_Core::getTable('Elevemateriel')->find(array($request->getParameter('eleve_id'),
                 $request->getParameter('materiel_id'))), sprintf('Object elevemateriel does not exist (%s).', $request->getParameter('eleve_id'),
                 $request->getParameter('materiel_id')));
    $this->form = new ElevematerielForm($elevemateriel);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($elevemateriel = Doctrine_Core::getTable('Elevemateriel')->find(array($request->getParameter('eleve_id'),
                 $request->getParameter('materiel_id'))), sprintf('Object elevemateriel does not exist (%s).', $request->getParameter('eleve_id'),
                 $request->getParameter('materiel_id')));
    $this->form = new ElevematerielForm($elevemateriel);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($elevemateriel = Doctrine_Core::getTable('Elevemateriel')->find(array($request->getParameter('eleve_id'),
                 $request->getParameter('materiel_id'))), sprintf('Object elevemateriel does not exist (%s).', $request->getParameter('eleve_id'),
                 $request->getParameter('materiel_id')));
    $elevemateriel->delete();
    $this->redirect('elevemateriel/edit?id='.$eleve->getId());
    $this->redirect('elevemateriel/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $elevemateriel = $form->save();

      $this->redirect('elevemateriel/edit?eleve_id='.$elevemateriel->getEleveId().'&materiel_id='.$elevemateriel->getMaterielId());
    }
  }
  
  public function executeAide(sfWebRequest $request){}

}
