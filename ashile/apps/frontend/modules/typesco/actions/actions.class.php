<?php

/**
 * typesco actions.
 *
 * @package    ash
 * @subpackage typesco
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class typescoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->typescos = Doctrine_Core::getTable('Typesco')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->typesco = Doctrine_Core::getTable('Typesco')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->typesco);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TypescoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TypescoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($typesco = Doctrine_Core::getTable('Typesco')->find(array($request->getParameter('id'))), sprintf('Object typesco does not exist (%s).', $request->getParameter('id')));
    $this->form = new TypescoForm($typesco);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($typesco = Doctrine_Core::getTable('Typesco')->find(array($request->getParameter('id'))), sprintf('Object typesco does not exist (%s).', $request->getParameter('id')));
    $this->form = new TypescoForm($typesco);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($typesco = Doctrine_Core::getTable('Typesco')->find(array($request->getParameter('id'))), sprintf('Object typesco does not exist (%s).', $request->getParameter('id')));
    $typesco->delete();

    $this->redirect('typesco/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $typesco = $form->save();

      $this->redirect('typesco/edit?id='.$typesco->getId());
    }
  }
}
