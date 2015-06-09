<?php

/**
 * demandeavs actions.
 *
 * @package    ash
 * @subpackage demandeavs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandeavsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
/*
    $this->demandeavss = Doctrine_Core::getTable('Demandeavs')
      ->createQuery('a')
      ->execute();
*/
	// demande avs
    $this->demandeavss = Doctrine_Query::create()
		->select('*')
		->from('Demandeavs')
		->where('Datedecisioncda IS NULL' )
		->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->demandeavs = Doctrine_Core::getTable('Demandeavs')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->demandeavs);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DemandeavsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DemandeavsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {

    $this->forward404Unless($demandeavs = Doctrine_Core::getTable('Demandeavs')->find(array($request->getParameter('id'))), sprintf('Object demandeavs does not exist (%s).', $request->getParameter('id')));

	// passage de $eleve
	//1) mdphId
	$mdphId = Doctrine_core::getTable('Mdph')->findOneById($demandeavs->getMdphId());
	//2) eleve
	$this->eleve = Doctrine_core::getTable('Eleve')->findOneById(Doctrine_core::getTable('Mdph')
									->find($mdphId)
									->getEleveId());


    $this->form = new DemandeavsForm($demandeavs);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($demandeavs = Doctrine_Core::getTable('Demandeavs')->find(array($request->getParameter('id'))), sprintf('Object demandeavs does not exist (%s).', $request->getParameter('id')));
    $this->form = new DemandeavsForm($demandeavs);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($demandeavs = Doctrine_Core::getTable('Demandeavs')->find(array($request->getParameter('id'))), sprintf('Object demandeavs does not exist (%s).', $request->getParameter('id')));
    $demandeavs->delete();

    $this->redirect('demandeavs/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $demandeavs = $form->save();

      $this->redirect('demandeavs/edit?id='.$demandeavs->getId());

    }
  }
      public function executeAide(){}
}
