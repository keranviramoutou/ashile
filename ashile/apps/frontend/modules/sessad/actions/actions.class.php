<?php

/**
 * sessad actions.
 *
 * @package    ash
 * @subpackage sessad
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sessadActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sessads = Doctrine_Core::getTable('Sessad')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SessadForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SessadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sessad = Doctrine_Core::getTable('Sessad')->find(array($request->getParameter('id'))), sprintf('Object sessad does not exist (%s).', $request->getParameter('id')));
    $this->form = new SessadForm($sessad);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sessad = Doctrine_Core::getTable('Sessad')->find(array($request->getParameter('id'))), sprintf('Object sessad does not exist (%s).', $request->getParameter('id')));
    $this->form = new SessadForm($sessad);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sessad = Doctrine_Core::getTable('Sessad')->find(array($request->getParameter('id'))), sprintf('Object sessad does not exist (%s).', $request->getParameter('id')));
    $sessad->delete();

    $this->redirect('sessad/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sessad = $form->save();

      $this->redirect('sessad/edit?id='.$sessad->getId());
    }
  }
}
