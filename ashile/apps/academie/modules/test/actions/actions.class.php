<?php

/**
 * test actions.
 *
 * @package    ash
 * @subpackage test
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class testActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->questions = Doctrine_Core::getTable('question')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->question = Doctrine_Core::getTable('question')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->question);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new questionForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new questionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($question = Doctrine_Core::getTable('question')->find(array($request->getParameter('id'))), sprintf('Object question does not exist (%s).', $request->getParameter('id')));
    $this->form = new questionForm($question);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($question = Doctrine_Core::getTable('question')->find(array($request->getParameter('id'))), sprintf('Object question does not exist (%s).', $request->getParameter('id')));
    $this->form = new questionForm($question);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($question = Doctrine_Core::getTable('question')->find(array($request->getParameter('id'))), sprintf('Object question does not exist (%s).', $request->getParameter('id')));
    $question->delete();
	$this->redirect('question/index);
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $question = $form->save();

      $this->redirect('test/edit?id='.$question->getId());
    }
  }
}
