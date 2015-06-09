<?php

/**
 * mail actions.
 *
 * @package    ash
 * @subpackage mail
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mailActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  
   $this->secteur = $this->getUser()->getAttribute('secteur');
	
		
	
	// --- recherche des texts de user ------
	 $this->texts = Doctrine_Query::create()
			->select('m.*,e.nom as nom,e.prenom as prenom')
			->from('Mail m')
			->innerjoin('m.Eleve e')
			->where('e.secteur_id = ?', $this->secteur->getId())
			->orderBy('m.date desc')
			->fetchArray();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->mail = Doctrine_Core::getTable('mail')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->mail);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new mailForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new mailForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mail = Doctrine_Core::getTable('mail')->find(array($request->getParameter('id'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id')));
    $this->form = new mailForm($mail);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mail = Doctrine_Core::getTable('mail')->find(array($request->getParameter('id'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id')));
    $this->form = new mailForm($mail);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mail = Doctrine_Core::getTable('mail')->find(array($request->getParameter('id'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id')));
    $mail->delete();

    $this->redirect('mail/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $mail = $form->save();

      $this->redirect('mail/edit?id='.$mail->getId());
    }
  }
  

}
