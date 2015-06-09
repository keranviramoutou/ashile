<?php

/**
 * sessadobtenu actions.
 *
 * @package    ash
 * @subpackage sessadobtenu
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sessadobtenuActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$this->anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();	  
	  
		  
    $this->sessadobtenus = Doctrine_Query::create()
      ->select('a.*,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda')
	  ->from('Sessadobtenu a')
	  ->leftjoin('a.DemandeSessad d on d.id = a.demandesessad_id')
      ->where('a.eleve_id =?', $request->getParameter('eleve_id'))
	  ->orderBy('a.datefin DESC')
      ->execute();
  }

  public function executeList(sfWebRequest $request)
  {
    $this->sessadobtenus = Doctrine_Core::getTable('Sessadobtenu')
      ->createQuery('a')
      ->where('a.eleve_id =?',$this->eleve_id)
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->sessadobtenu = Doctrine_Core::getTable('Sessadobtenu')->find(array(
							$request->getParameter('id')));
							//$request->getParameter('eleve_id'),
							//$request->getParameter('sessad_id')));
    $this->forward404Unless($this->sessadobtenu);
  }

  public function executeNew(sfWebRequest $request) {
        $sessadobtenu = new Sessadobtenu();
        $sessadobtenu->setEleveId($this->getRequestParameter('eleve_id'));
        $sessadobtenu->setDemandesessadId($this->getRequestParameter('demandesessad_id'));
        $this->form = new SessadobtenuForm($sessadobtenu);
    }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SessadobtenuForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sessadobtenu = Doctrine_Core::getTable('Sessadobtenu')->find(array($request->getParameter('id'))), sprintf('ce sessad n\'existe pas (%s).', $request->getParameter('id')));
    $this->form = new SessadobtenuForm($sessadobtenu);
    
	//$this->test = $request->getParameter('demandesessad_id');
    //$this->sessadDorigine = Doctrine::getTable('DemandeSessad')->findOneById($sessadobtenu->getDemandesessadId());
    
    $this->demandesessad = Doctrine_Query::Create()
								->select('so.id as sessaobtenu_id,ds.id as demandesessad_id,ds.typesessad_id as typesessad_id,ds.datefinnotif  as datefinnotif,ds.datedebutnotif as datedebutnotif,ds.mdph_id as mdph_id,ds.datedecisioncda as datedecisioncda')
								->from('Sessadobtenu so')
								->innerJoin('so.DemandeSessad ds ON ds.id = so.demandesessad_id')
								->where('so.demandesessad_id=?',$sessadobtenu->getDemandesessadId())
								->fetchArray();
    $this->count_demndesessad = count($this->demandesessad);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sessadobtenu = Doctrine_Core::getTable('Sessadobtenu')->find(array($request->getParameter('id'))), sprintf('ceupdate sessad n\'existe pas (%s).', $request->getParameter('id')));
    $this->form = new SessadobtenuForm($sessadobtenu);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($sessadobtenu = Doctrine_Core::getTable('Sessadobtenu')->find(array($request->getParameter('id'))), sprintf('ce sessad n\'existe pas (%s).', $request->getParameter('id')));
    $sessadobtenu->delete();
   $this->getUser()->setFlash('notice', 'Sessad supprimé !');
    $this->redirect('sessadobtenu/index?id=' . $sessadobtenu->getId() .'&eleve_id=' . $sessadobtenu->getEleveId());

  }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
			$sessadobtenu = $form->save();
			$this->getUser()->setFlash('notice', 'Sessad Enregistré avec succès');
            $this->redirect('sessadobtenu/index?id=' . $sessadobtenu->getId() .'&eleve_id=' . $sessadobtenu->getEleveId());

        }
    }
	
	
    public function executeAide(){}

}
