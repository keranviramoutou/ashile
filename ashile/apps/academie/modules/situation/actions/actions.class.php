<?php

/**
 * situation actions.
 *
 * @package    ash
 * @subpackage situation
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class situationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->situations = Doctrine_Core::getTable('Situation')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->situation = Doctrine_Core::getTable('Situation')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->situation);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SituationForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SituationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($situation = Doctrine_Core::getTable('Situation')->find(array($request->getParameter('id'))), sprintf('Object situation does not exist (%s).', $request->getParameter('id')));
    $this->form = new SituationForm($situation);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($situation = Doctrine_Core::getTable('Situation')->find(array($request->getParameter('id'))), sprintf('Object situation does not exist (%s).', $request->getParameter('id')));
    $this->form = new SituationForm($situation);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($situation = Doctrine_Core::getTable('Situation')->find(array($request->getParameter('id'))), sprintf('Object situation does not exist (%s).', $request->getParameter('id')));
    $situation->delete();

    $this->redirect('situation/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $situation = $form->save();

      $this->redirect('situation/edit?id='.$situation->getId());
    }
  }
}
