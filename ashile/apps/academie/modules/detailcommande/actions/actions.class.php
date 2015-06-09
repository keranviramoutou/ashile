<?php

/**
 * detailcommande actions.
 *
 * @package    ash
 * @subpackage detailcommande
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class detailcommandeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->detail_commandes = Doctrine_Core::getTable('DetailCommande')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->detail_commande = Doctrine_Core::getTable('DetailCommande')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->detail_commande);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DetailCommandeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DetailCommandeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($detail_commande = Doctrine_Core::getTable('DetailCommande')->find(array($request->getParameter('id'))), sprintf('Object detail_commande does not exist (%s).', $request->getParameter('id')));
    $this->form = new DetailCommandeForm($detail_commande);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($detail_commande = Doctrine_Core::getTable('DetailCommande')->find(array($request->getParameter('id'))), sprintf('Object detail_commande does not exist (%s).', $request->getParameter('id')));
    $this->form = new DetailCommandeForm($detail_commande);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($detail_commande = Doctrine_Core::getTable('DetailCommande')->find(array($request->getParameter('id'))), sprintf('Object detail_commande does not exist (%s).', $request->getParameter('id')));
    $detail_commande->delete();

    $this->redirect('detailcommande/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $detail_commande = $form->save();

      $this->redirect('detailcommande/edit?id='.$detail_commande->getId());
    }
  }
}
