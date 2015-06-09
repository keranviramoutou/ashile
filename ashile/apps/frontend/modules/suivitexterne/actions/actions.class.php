<?php

/**
 * suivitexterne actions.
 *
 * @package    ash
 * @subpackage suivitexterne
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class suivitexterneActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->suivit_externes = Doctrine_Core::getTable('SuivitExterne')
      ->createQuery('a')
      ->where('a.eleve_id=?', $this->getRequestParameter('eleve_id'))
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->suivit_externe = Doctrine_Core::getTable('SuivitExterne')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->suivit_externe);
  }

  public function executeNew(sfWebRequest $request)
  {
   //gestion du retour sur la fiche élève si on créé un nouvel organisme
	$this->getUser()->setAttribute('eleve_id',$this->getRequestParameter('eleve_id'));
    
	$se = new SuivitExterne();
	$se->setEleveId($this->getRequestParameter('eleve_id')); 
    $this->form = new SuivitExterneForm($se);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SuivitExterneForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($suivit_externe = Doctrine_Core::getTable('SuivitExterne')->find(array($request->getParameter('id'))), sprintf('Pas de suivit externe (%s).', $request->getParameter('id')));
    $this->form = new SuivitExterneForm($suivit_externe);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($suivit_externe = Doctrine_Core::getTable('SuivitExterne')->find(array($request->getParameter('id'))), sprintf('Pas de suivit externe (%s).', $request->getParameter('id')));
    $this->form = new SuivitExterneForm($suivit_externe);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($suivit_externe = Doctrine_Core::getTable('SuivitExterne')->find(array($request->getParameter('id'))), sprintf('Pas de suivit externe (%s).', $request->getParameter('id')));
    $eleve_id=$suivit_externe->getEleveId();
	$libelle = $suivit_externe->getNaturesuiviext();
	$specialiste = $suivit_externe->getSpecialiste();
	if ($suivit_externe->getSpecialisteId()  && $suivit_externe->getNaturesuiviextId()){

	$message ='suivi externe de type :'.$libelle.' effectué par '. $specialiste.' supprimé avec succès';
	}else{
	$message ='suivi externe supprimé avec succès';
	}	
	
	
    //suppression du suivi externe
	//------------------------------
    $suivit_externe->delete();
    $this->getUser()->setFlash('succes',$message);
	$this->redirect('suivitexterne/index?eleve_id='. $eleve_id.'#div_suivitext');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {

      $this->getUser()->setCulture('fr_FR');
      $this->getUser()->getCulture();
      $suivit_externe = $form->save();
      $this->getUser()->setFlash('succes', 'Enregistré avec succès');
      //$this->redirect('suivitexterne/edit?id='.$suivit_externe->getId().'&eleve_id='.$suivit_externe->getEleveId());
	  $this->redirect('suivitexterne/index?id='.$suivit_externe->getId().'&eleve_id='.$suivit_externe->getEleveId());
    }
  }
  
  public function executeAide(){}
}
