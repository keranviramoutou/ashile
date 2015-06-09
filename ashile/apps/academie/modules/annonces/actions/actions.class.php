<?php

/**
 * annonces actions.
 *
 * @package    ash
 * @subpackage annonces
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class annoncesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->accueils = Doctrine_Core::getTable('Accueil')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AccueilForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AccueilForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($accueil = Doctrine_Core::getTable('Accueil')->find(array($request->getParameter('id'))), sprintf('Object accueil does not exist (%s).', $request->getParameter('id')));
    $this->form = new AccueilForm($accueil);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($accueil = Doctrine_Core::getTable('Accueil')->find(array($request->getParameter('id'))), sprintf('Object accueil does not exist (%s).', $request->getParameter('id')));
    $this->form = new AccueilForm($accueil);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($accueil = Doctrine_Core::getTable('Accueil')->find(array($request->getParameter('id'))), sprintf('Object accueil does not exist (%s).', $request->getParameter('id')));
    $accueil->delete();

    $this->redirect('annonces/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $accueil = $form->save();

      $this->redirect('annonces/edit?id='.$accueil->getId());
    }
  }
}
