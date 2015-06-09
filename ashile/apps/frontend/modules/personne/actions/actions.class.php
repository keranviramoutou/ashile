<?php

/**
 * personne actions.
 *
 * @package    ash
 * @subpackage personne
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class personneActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->personnes = Doctrine_Core::getTable('Personne')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->personne = Doctrine_Core::getTable('Personne')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->personne);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PersonneForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PersonneForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($personne = Doctrine_Core::getTable('Personne')->find(array($request->getParameter('id'))), sprintf('Object personne does not exist (%s).', $request->getParameter('id')));
    $this->form = new PersonneForm($personne);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($personne = Doctrine_Core::getTable('Personne')->find(array($request->getParameter('id'))), sprintf('Object personne does not exist (%s).', $request->getParameter('id')));
    $this->form = new PersonneForm($personne);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($personne = Doctrine_Core::getTable('Personne')->find(array($request->getParameter('id'))), sprintf('Object personne does not exist (%s).', $request->getParameter('id')));
    $personne->delete();

    $this->redirect('personne/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $personne = $form->save();

      $this->redirect('personne/edit?id='.$personne->getId());
    }
  }
}
