<?php

/**
 * organismesuivit actions.
 *
 * @package    ash
 * @subpackage organismesuivit
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class organismesuivitActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

	$secteur = $this->getUser()->getAttribute('secteur');
	$this->libelle_secteur =  $secteur ;
    $this->getUser()->setAttribute('eleve_id',0);
    $this->organisme_suivits = Doctrine_Core::getTable('OrganismeSuivit')
      ->createQuery('a')
	   ->where('a.secteur_id=?', $secteur->getId())
	   ->OrderBy('a.id asc')
      ->execute();
  }
  
  public function executeList(sfWebRequest $request)
  {
    $secteur = $this->getUser()->getAttribute('secteur'); 
	  
	$this->organisme_suivits = Doctrine_Core::getTable('OrganismeSuivit')
      ->createQuery('a')
       ->where('a.secteur_id=?', $secteur->getId())
	   ->execute();
	  
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->organisme_suivit = Doctrine_Core::getTable('OrganismeSuivit')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->organisme_suivit);
  }

  public function executeNew(sfWebRequest $request)
  {
  
	  	// recherche user
	$userId = sfContext::getInstance()->getUser()->getGuardUser()->getId();
	$secteur = Doctrine::getTable('Secteur')->findBySfguarduserId($userId);
	  
	
	$os = new OrganismeSuivit();
	$os->setSecteurId($secteur[0]->getId());  
    $this->form = new OrganismeSuivitForm($os);
  }
  
  
    public function executePopup(sfWebRequest $request)
  {
  
	 // recherche user
	$userId = sfContext::getInstance()->getUser()->getGuardUser()->getId();
	$this->getUser()->setAttribute('organisme',1); //gestion du retour
	$secteur = Doctrine::getTable('Secteur')->findBySfguarduserId($userId);
	  
	
	$os = new OrganismeSuivit();
	$os->setSecteurId($secteur[0]->getId());  
    $this->form = new OrganismeSuivitForm($os);
  }
  
  
  
    public function executeMessage(sfWebRequest $request)
  {
    }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OrganismeSuivitForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($organisme_suivit = Doctrine_Core::getTable('OrganismeSuivit')->find(array($request->getParameter('id'))), sprintf('Object organisme_suivit does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrganismeSuivitForm($organisme_suivit);
	$this->getUser()->setAttribute('organisme',0); //gestion du retour
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($organisme_suivit = Doctrine_Core::getTable('OrganismeSuivit')->find(array($request->getParameter('id'))), sprintf('Object organisme_suivit does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrganismeSuivitForm($organisme_suivit);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();
    //recherche si organisme de suivi déjà utlisé dans un suivi extérieur 
	///--------------------------------------------------------------------
	  $recherche_organisme = Doctrine_Core::getTable('SuivitExterne')
      ->createQuery('a')
	   ->where('a.organismesuivit_id=?', $request->getParameter('id'))
      ->execute();
	$count_recherche =count($recherche_organisme);
	
	 //recherche si organisme de suivi déjà utlisé comme lieu d'exercice d'un partenaire
	///----------------------------------------------------------------------------------
	  $recherche_organisme1 = Doctrine_Core::getTable('Specialiste')
      ->createQuery('a')
	   ->where('a.organismesuivit_id=?', $request->getParameter('id'))
      ->execute();
	$count_recherche1 =count($recherche_organisme1);
	
	
	
	if($count_recherche == 0 && $count_recherche1 == 0){
    $this->forward404Unless($organisme_suivit = Doctrine_Core::getTable('OrganismeSuivit')->find(array($request->getParameter('id'))), sprintf('Object organisme_suivit does not exist (%s).', $request->getParameter('id')));
    $organisme_suivit->delete();
	$this->getUser()->setFlash('notice', 'organisme : '.$organisme_suivit->getNometabnonsco().' supprimé');
	 $this->redirect('organismesuivit/index');
	 
	}else if($count_recherche > 0 ||$count_recherche1 > 0){
    
	$this->getUser()->setFlash('error', 'organisme déjà utilisé dans un suivi externe ou pour un partenaire, impossible de le supprimer !!');
	$this->redirect('organismesuivit/edit?id='.$request->getParameter('id'));
	}
   
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if (1)
    {
      $organisme_suivit = $form->save();
	  $this->getUser()->setFlash('succes', 'Etablissement de suivi : '.   $organisme_suivit->getNometabnonsco().' enregistrè avec succès' );
	 
	   if($this->getUser()->getAttribute('organisme') == 1){ //on vient de la popup de création d'un orgnaisme
		    $this->redirect('organismesuivit/message');
	   }
	   	   if($this->getUser()->getAttribute('organisme') == 0){ //on vient de l'edit de création d'un organisme
		  	$this->redirect('organismesuivit/index');
			}
	   
     if($this->getUser()->getAttribute('eleve_id') !== 0 && $this->getUser()->getAttribute('eleve_id') !== 999999999  ){ //on vient de la liste des suivis suiviextérieur
		$eleveid = $this->getUser()->getAttribute('eleve_id');	//récupération de la variable définit dans action/new de suiviexterne
	    $this->getUser()->getAttributeHolder()->remove('eleve_id');
		$this->redirect('organismesuivit/message');
		$this->redirect('eleve/edit?id='.$eleveid .'#div_suivitext');
		$this->getUser()->setFlash('succes', 'test'.$this->getUser()->getAttribute('eleve_id'));
	 // réinitialise la variable
	}
	
	
	 if($this->getUser()->getAttribute('eleve_id') === 0){ //on vient de la liste des organismes
		//$specialiste_id = $this->getUser()->getAttribute('specialiste_id');	//récupération de la variable définit dans action/new de specialiste
		$this->redirect('organismesuivit/index' );
	
	}
	
	
	if($this->getUser()->getAttribute('eleve_id')  === 999999999){  // on vient de liste des spécialistes

		$this->redirect('specialiste/index');
		 $this->getUser()->setAttribute('specialiste_id'); // réinitialise la variable
	}
	

	
      $this->redirect('organismesuivit/edit?id='.$organisme_suivit->getId());
    }
	
  }
  
  public function executeAide(){}
}
