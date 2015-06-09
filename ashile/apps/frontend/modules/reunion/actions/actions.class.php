<?php

/**
 * reunion actions.
 *
 * @package    ash
 * @subpackage reunion
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reunionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->reunions = Doctrine_Query::Create()
						->from('Reunion r')
						->where('r.eleve_id =?', $this->getRequestParameter('eleve_id'))
						->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->reunion = Doctrine_Core::getTable('Reunion')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->reunion);
  }

  public function executeNew(sfWebRequest $request)
  {
        $rn = new Reunion();
        $rn->setEleveId($request->getUrlParameter('eleve_id'));
        $this->form = new ReunionForm($rn);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ReunionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($reunion = Doctrine_Core::getTable('Reunion')->find(array($request->getParameter('id'))), sprintf('Object reunion does not exist (%s).', $request->getParameter('id')));
    $this->form = new ReunionForm($reunion);
  }


  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($reunion = Doctrine_Core::getTable('Reunion')->find(array($request->getParameter('id'))), sprintf('Object reunion does not exist (%s).', $request->getParameter('id')));
    $this->form = new ReunionForm($reunion);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($reunion = Doctrine_Core::getTable('Reunion')->find(array($request->getParameter('id'))), sprintf('Cette reunion n\'existe pas (%s).', $request->getParameter('id')));
	$eleve_id=$reunion->getEleveId();
	$libelle = $reunion->getLibellereunion();
	$date = $reunion->getDatereunion();
	if ($reunion->getDatereunion()){

	$message ='réunion intitulée :'.$libelle.' du '.date('d-m-Y',strtotime($date)).' supprimée avec succès';
	}else{
	$message ='réunion intitulée :'.$libelle.' supprimée avec succès';
	}
    $reunion->delete();
   $this->getUser()->setFlash('succes',$message);
    $this->redirect('reunion/index?eleve_id='.$eleve_id.'#div_reunion');
	  
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $reunion = $form->save();
            $this->getUser()->setFlash('succes', 'Enregistré avec succès');
            //$this->redirect('reunion/edit?id=' . $reunion->getId().'&eleve_id='.$reunion->getEleveId());
			$this->redirect('reunion/index?id=' . $reunion->getId().'&eleve_id='.$reunion->getEleveId());
        }else{
		 $this->getUser()->setFlash('error', 'Modification(s) non enregistrée(s)');
		}
    }
    
    public function executeAide(){}
}
