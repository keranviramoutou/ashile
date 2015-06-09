<?php

/**
 * specialiste actions.
 *
 * @package    ash
 * @subpackage specialiste
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class specialisteActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$secteur = $this->getUser()->getAttribute('secteur');
 
	
	$this->getUser()->setAttribute('eleve_id',999999999); // gestion de la redirection suite à une création d'organisme 
    $this->specialistes = Doctrine_Core::getTable('Specialiste')
      ->createQuery('a')
      ->where('a.secteur_id=?', $secteur->getId())
      ->execute();
  }
  
    public function executeList(sfWebRequest $request)
  {
  //  Recherche d'un spécialiste qui a fait un suivi externe pour le secteur selectionné
  //------------------------------------------------------------------------------------
  
 	$secteur = $this->getUser()->getAttribute('secteur');
  
	       $this->secteur = $this->getUser()->getAttribute('secteur');
			$this->specialiste = Doctrine_Query::create()
	          ->select('s.secteur_id as secteur_id,o.id as organismesuivit_id_id,sp.id as specialite_id,s.id as specialiste,sp.libellespecialite as libellespecialite,s.nom as nom,s.prenom as prenom,
			  st.id as secteur_id,st.libellesecteur as libellesecteur')
              ->from('Specialiste s')
			  ->innerjoin('s.Specialite sp ON sp.id = s.specialite_id')
			  ->innerjoin('s.OrganismeSuivit o ON o.id = s.organismesuivit_id')
			  ->innerjoin('s.Secteur st ON st.id = s.secteur_id')
		      ->where('st.libellesecteur LIKE ?',$this->secteur)
			  ->andwhere('s.id in (select specialiste_id from suivit_externe )')
			  ->orderby('nom,prenom ASC')
              ->fetcharray();
	

	if($_POST['specialiste_id']){ //recherche des suivis externe avec les élèves concernés
				$this->suivi_externe =Doctrine_Query::Create()
				->select('n.id as naturesuiviext_id,n.libellenaturesuiviext as libellenaturesuiviext,s.id as suiviexterne_id,s.datedebutpriseencharge as datedebutpriseencharge,s.datefinpriseencharge as datefinpriseencharge,e.id as eleve_id,e.nom as eleve_nom,e.prenom as eleve_prenom
				e.prenom as eleve_prenom,sp.id as specialiste_id,sp.nom as specialiste_nom,sp.prenom as specialiste_prenom,s.datedebutpriseencharge as datedebutpriseencharge,s.datefinpriseencharge as datefinpriseencharge,spe.libellespecialite as libellespecialite,
				ty.nomtypeetablissement as nomtypeetablissement,ty.id as typeetabnonsco_id,o.id as organismedesuivi_id,o.nometabnonsco as nometabnonsco,o.teletabnonsco as teletabnonsco,q.nom_quartier as nom_quartier')
                -> from('SuivitExterne s')
                ->innerJoin('s.Naturesuiviext n ON s.naturesuiviext_id = n.id')
				->innerJoin('s.Eleve e ON s.eleve_id = e.id')
				->innerjoin('s.Specialiste sp ON sp.id = s.specialiste_id')
			    ->innerjoin('sp.Specialite spe ON spe.id = sp.specialite_id')
		     	->innerjoin('s.OrganismeSuivit o ON o.id = s.organismesuivit_id')
				->innerjoin('o.Quartier q ON q.id = o.quartier_id')
				 ->innerjoin('o.Typeetablissementnonsco ty ON ty.id = o.typeetablissement_id')
				->where('s.specialiste_id=?',$_POST['specialiste_id'])
			//	->andWhere('s.datefinpriseencharge IS NULL OR s.datefinpriseencharge >=?', date('Y-m-d', time()))
			    ->orderby('s.id desc') 
			   ->fetchArray();
			   $this->count_suivi_externe =count($this->suivi_externe);	 
			   $this->flag = 1;
	
	}	

  }

  public function executeShow(sfWebRequest $request)
  {
    $this->specialiste = Doctrine_Core::getTable('Specialiste')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->specialiste);
  }

  public function executeNew(sfWebRequest $request)
  {
	$secteur = $this->getUser()->getAttribute('secteur');

	$spe = new Specialiste();
	$spe->setSecteurId($secteur->getId());  
    $this->form = new SpecialisteForm($spe);
  }
  
  
    public function executePopup(sfWebRequest $request)
  {
	$secteur = $this->getUser()->getAttribute('secteur');
	$this->getUser()->setAttribute('partenaire',1); //gestion du retour

	$spe = new Specialiste();
	$spe->setSecteurId($secteur->getId());  
    $this->form = new SpecialisteForm($spe);
  }

  
      public function executeMessage(sfWebRequest $request)
  {
  	
/*	if($this->getUser()->getAttribute('mdph_id')){ //on vient du dossier MDPH
	 
	     $mdph = Doctrine_Query::Create()
		    ->select('m.id as mdph_id,m.eleve_id as eleve_id,e.id as eleve_id')
			->from('Eleve e')
			->innerjoin('e.Mdphs m ON e.id = m.eleve_id')
			->where('m.id =?', $this->getUser()->getAttribute('mdph_id'))
			->limit(1)
			->fetcharray();
			
		$this->redirect('eleve/edit?id='.$mdph[0]['eleve_id'] .'#div_mdph'); 
	
	} */

    }
	
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SpecialisteForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
  $this->getUser()->setAttribute('partenaire',0); //gestion du retour
    $this->forward404Unless($specialiste = Doctrine_Core::getTable('Specialiste')->find(array($request->getParameter('id'))), sprintf('Object specialiste does not exist (%s).', $request->getParameter('id')));

    $this->form = new SpecialisteForm($specialiste);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($specialiste = Doctrine_Core::getTable('Specialiste')->find(array($request->getParameter('id'))), sprintf('Object specialiste does not exist (%s).', $request->getParameter('id')));
    $this->form = new SpecialisteForm($specialiste);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
   // $request->checkCSRFProtection();
    //recherche si le spécialiste  déjà utlisé dans un suivi extérieur 
	///------------------------------------------------------------------
	  $recherche_suivi = Doctrine_Core::getTable('SuivitExterne')
      ->createQuery('a')
	   ->where('a.specialiste_id=?', $request->getParameter('id'))
      ->execute();
	$count_suivi =count($recherche_suivi);
	
	 //recherche si spécialiste déjà utlisé dans un bilan
	///-----------------------------------------------------
	  $recherche_bilan = Doctrine_Core::getTable('Bilan')
      ->createQuery('a')
	   ->where('a.specialiste_id=?', $request->getParameter('id'))
      ->execute();
	$count_bilan =count($recherche_bilan);
	
	if($count_suivi == 0 && $count_bilan == 0){
    $this->forward404Unless($specialiste = Doctrine_Core::getTable('Specialiste')->find(array($request->getParameter('id'))), sprintf('Object specialiste does not exist (%s).', $request->getParameter('id')));
    $specialiste->delete();
	$this->getUser()->setFlash('notice', 'partenaire '.$specialiste->getNom().'  '.$specialiste->getPrenom().' supprimé');
	 $this->redirect('specialiste/index');
    }else if($count_suivi > 0 ||$count_bilan > 0){
    
	$this->getUser()->setFlash('error', 'partenaire déjà saisi dans un suivi externe ou pour une pièce complémentaire (bilan), impossible de le supprimer !!');
	 $this->redirect('specialiste/edit?id='.$request->getParameter('id'));
	}
   
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if (1)
    {
     $specialiste = $form->save();
	 

	if($this->getUser()->getAttribute('partenaire') == 1){ //on vient de la popup de création d'un partenaire (spécialiste)
		$this->redirect('specialiste/message');
	}
	$this->getUser()->setFlash('succes', 'Spécialiste enregistré avec succès');
      $this->redirect('specialiste/edit?id='.$specialiste->getId());
	  
    }
  }
  
  public function executeAide(){}
}
