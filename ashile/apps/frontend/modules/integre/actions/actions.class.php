<?php

/**
 * integre actions.
 *
 * @package    ash
 * @subpackage integre
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class integreActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->integres = Doctrine_Core::getTable('Integre')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->integre = Doctrine_Core::getTable('Integre')->find(array($request->getParameter('equipesuiviscolarite_id'),
                                                   $request->getParameter('specialiste_id')));
    $this->forward404Unless($this->integre);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new IntegreForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new IntegreForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($integre = Doctrine_Core::getTable('Integre')->find(array($request->getParameter('equipesuiviscolarite_id'),
                             $request->getParameter('specialiste_id'))), sprintf('Object integre does not exist (%s).', $request->getParameter('equipesuiviscolarite_id'),
                             $request->getParameter('specialiste_id')));
    $this->form = new IntegreForm($integre);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($integre = Doctrine_Core::getTable('Integre')->find(array($request->getParameter('equipesuiviscolarite_id'),
                             $request->getParameter('specialiste_id'))), sprintf('Object integre does not exist (%s).', $request->getParameter('equipesuiviscolarite_id'),
                             $request->getParameter('specialiste_id')));
    $this->form = new IntegreForm($integre);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($integre = Doctrine_Core::getTable('Integre')->find(array($request->getParameter('equipesuiviscolarite_id'),
                             $request->getParameter('specialiste_id'))), sprintf('Object integre does not exist (%s).', $request->getParameter('equipesuiviscolarite_id'),
                             $request->getParameter('specialiste_id')));
    $integre->delete();

    $this->redirect('integre/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $integre = $form->save();

      $this->redirect('integre/edit?equipesuiviscolarite_id='.$integre->getEquipesuiviscolariteId().'&specialiste_id='.$integre->getSpecialisteId());
    }
  }
}
