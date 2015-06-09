<?php

/**
 * sessad_obtenu actions.
 *
 * @package    ash
 * @subpackage sessad_obtenu
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sessad_obtenuActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sessad_obtenus = Doctrine_Query::Create()
      ->from('SessadObtenu s')
      ->innerJoin('s.Eleve e ON s.eleve_id = e.id')
       ->innerJoin('s.Sessad t ON s.sessad_id = t.id')
       ->innerJoin('t.Typesessad a ON t.typesessad_id = a.id')
      ->execute();


  }

  public function executeShow(sfWebRequest $request)
  {
    $this->sessad_obtenu = Doctrine_Core::getTable('SessadObtenu')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->sessad_obtenu);
  }

  public function executeNew(sfWebRequest $request)
  {
  
    //Dernière demande de sessad en cours à la date du jour pour l'élève selectionné
	//--------------------------------------------------------------------------------------
		$this->demande_sessad = Doctrine_Core::getTable('DemandeSessad')->getDemandeSessadSelectionner($request->getParameter('demandesessad_id'));
		$this->existdemande_sessad = count($this->demande_sessad);
		
    $eleve_id = $request->getParameter('EleveId');
	$this->eleve = Doctrine::getTable('Eleve')->findOneById($eleve_id);
	$sessadObtenu = new SessadObtenu();
	$sessadObtenu->setEleveId($eleve_id);
    $this->form = new SessadObtenuForm($sessadObtenu);
    
    // passage de la variable demandesessad_id
    $this->getUser()->setAttribute('demandesessad_id', $request->getParameter('demandesessad_id'));
    
   }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SessadObtenuForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  
    //Dernière demande de sessad en cours à la date du jour pour l'élève selectionné
	//--------------------------------------------------------------------------------------
		$this->demande_sessad = Doctrine_Core::getTable('DemandeSessad')->getDemandeSessadSelectionner($request->getParameter('demandesessad_id'));
		$this->existdemande_sessad = count($this->demande_sessad);
		
    $this->forward404Unless($sessad_obtenu = Doctrine_Core::getTable('SessadObtenu')->find(array($request->getParameter('id'))), sprintf('Object sessad_obtenu does not exist (%s).', $request->getParameter('id')));
    $this->form = new SessadObtenuForm($sessad_obtenu);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sessad_obtenu = Doctrine_Core::getTable('SessadObtenu')->find(array($request->getParameter('id'))), sprintf('Object sessad_obtenu does not exist (%s).', $request->getParameter('id')));
    $this->form = new SessadObtenuForm($sessad_obtenu);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sessad_obtenu = Doctrine_Core::getTable('SessadObtenu')->find(array($request->getParameter('id'))), sprintf('Object sessad_obtenu does not exist (%s).', $request->getParameter('id')));
    $sessad_obtenu->delete();

    $this->redirect('sessad_obtenu/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sessad_obtenu = $form->save();
            /* --------UPDATE------- */
            
            // mise a jour de la demande a traité
            $demandesessadId = $this->getUser()->getAttribute('demandesessad_id');
            if($demandesessadId){
            Doctrine_Query::Create()
                    ->update('demandesessad')
                    ->set('traite', true)
                    ->where('id = ?', $demandesessadId)
                    ->execute();
            }        
            /* -------------- */      

      $this->redirect('sessad_obtenu/edit?id='.$sessad_obtenu->getId().'&demandesessad_id='.  $demandesessadId);
    }
  }
}
