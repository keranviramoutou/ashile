<?php

/**
 * commande actions.
 *
 * @package    ash
 * @subpackage commande
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class commandeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->commandes = Doctrine_Core::getTable('Commande')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->commande = Doctrine_Core::getTable('Commande')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->commande);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new CommandeForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new CommandeForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($commande = Doctrine_Core::getTable('Commande')->find(array($request->getParameter('id'))), sprintf('Object commande does not exist (%s).', $request->getParameter('id')));
    $this->form = new CommandeForm($commande);
							
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($commande = Doctrine_Core::getTable('Commande')->find(array($request->getParameter('id'))), sprintf('Object commande does not exist (%s).', $request->getParameter('id')));
    $this->form = new CommandeForm($commande);

    $this->processForm($request, $this->form);
    
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($commande = Doctrine_Core::getTable('Commande')->find(array($request->getParameter('id'))), sprintf('Object commande does not exist (%s).', $request->getParameter('id')));
    $commande->delete();

    $this->redirect('commande/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $commande = $form->save();
      

      $this->redirect('commande/edit?id='.$commande->getId());
    }
  }
}
