<?php

/**
 * classe actions.
 *
 * @package    ash
 * @subpackage classe
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class classeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->classes = Doctrine_Core::getTable('Classe')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->classe = Doctrine_Core::getTable('Classe')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->classe);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ClasseForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ClasseForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($classe = Doctrine_Core::getTable('Classe')->find(array($request->getParameter('id'))), sprintf('Object classe does not exist (%s).', $request->getParameter('id')));
    $this->form = new ClasseForm($classe);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($classe = Doctrine_Core::getTable('Classe')->find(array($request->getParameter('id'))), sprintf('Object classe does not exist (%s).', $request->getParameter('id')));
    $this->form = new ClasseForm($classe);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($classe = Doctrine_Core::getTable('Classe')->find(array($request->getParameter('id'))), sprintf('Object classe does not exist (%s).', $request->getParameter('id')));
    $classe->delete();

    $this->redirect('classe/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $classe = $form->save();

      $this->redirect('classe/edit?id='.$classe->getId());
    }
  }
}
