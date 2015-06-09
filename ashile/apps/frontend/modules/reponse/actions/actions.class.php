<?php

/**
 * reponse actions.
 *
 * @package    ash
 * @subpackage reponse
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reponseActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->reponses = Doctrine_Core::getTable('Reponse')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->reponse = Doctrine_Core::getTable('Reponse')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->reponse);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ReponseForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ReponseForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($reponse = Doctrine_Core::getTable('Reponse')->find(array($request->getParameter('id'))), sprintf('Object reponse does not exist (%s).', $request->getParameter('id')));
    $this->form = new ReponseForm($reponse);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($reponse = Doctrine_Core::getTable('Reponse')->find(array($request->getParameter('id'))), sprintf('Object reponse does not exist (%s).', $request->getParameter('id')));
    $this->form = new ReponseForm($reponse);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($reponse = Doctrine_Core::getTable('Reponse')->find(array($request->getParameter('id'))), sprintf('Object reponse does not exist (%s).', $request->getParameter('id')));
    $reponse->delete();

    $this->redirect('reponse/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $reponse = $form->save();

      $this->redirect('reponse/edit?id='.$reponse->getId());
    }
  }
}
