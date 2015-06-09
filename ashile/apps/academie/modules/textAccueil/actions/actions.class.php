<?php

/**
 * textAccueil actions.
 *
 * @package    ash
 * @subpackage textAccueil
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class textAccueilActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->accueils = Doctrine_Core::getTable('accueil')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->accueil = Doctrine_Core::getTable('accueil')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->accueil);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new accueilForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new accueilForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($accueil = Doctrine_Core::getTable('accueil')->find(array($request->getParameter('id'))), sprintf('Object accueil does not exist (%s).', $request->getParameter('id')));
    $this->form = new accueilForm($accueil);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($accueil = Doctrine_Core::getTable('accueil')->find(array($request->getParameter('id'))), sprintf('Object accueil does not exist (%s).', $request->getParameter('id')));
    $this->form = new accueilForm($accueil);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($accueil = Doctrine_Core::getTable('accueil')->find(array($request->getParameter('id'))), sprintf('Object accueil does not exist (%s).', $request->getParameter('id')));
    $accueil->delete();

    $this->redirect('textAccueil/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $accueil = $form->save();

      $this->redirect('textAccueil/edit?id='.$accueil->getId());
    }
  }
}
