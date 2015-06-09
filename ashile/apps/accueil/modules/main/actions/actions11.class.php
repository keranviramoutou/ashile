<?php

/**
 * main actions.
 *
 * @package    ash
 * @subpackage main
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
	
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
   public function executeErreur(sfWebRequest $request)
  {
  }
  
public function executeIndex(sfWebRequest $request)
  {
}
public function executeIndex1(sfWebRequest $request)
  {
	$this->messages = Doctrine_core::getTable('Accueil')->getLastOne();
	$this->texts = Doctrine::getTable('Mail')->findAll();
	
	// je commence pas tester user connecté (est il  connu par l'appli?)
	 $user = Doctrine_core::getTable('sfGuardUser')
		->findOneByEmailAddress($_SERVER['HTTP_CTEMAIL']);
		

			

	if($user->getId()){ //si l'utilisateur trouvé
	
		// on cherche le secteur de l'utilisateur (un secteur = un utilisateur)
	$secteur = Doctrine_core::getTable('Secteur')
			->findOneBySfguarduserId($user->getId());
	

			
	// on cherche les autorisations de cet utilisateur
	$q = $user->getPermissions();		
	$this->perm = $user->getPermissions();	
	
				
	if(!$secteur && $q[0]=='eref' ){ //si user pas de secteur attribué
		$this->redirect('/ashilep/erreur.php?user='.$_SERVER['HTTP_CTEMAIL'].'&secteur=1');
    }	
	
	// --- recherche des texts de user ------
	 $this->texts = Doctrine_Query::create()
			->select('m.*,e.nom as nom,e.prenom as prenom')
			->from('Mail m')
			->innerjoin('m.Eleve e')
			->where('m.sfguarduser_id = ?', $user->getId())
			->orderBy('m.date desc')
			->fetchArray();

	}else{
	 $this->redirect('/ashilep/erreur.php?user='.$_SERVER['HTTP_CTEMAIL']);
	}

	
	
	//ACCES VIA HTTPS:/PORTAIL.AC-REUNION.FR
	//---------------------------------------
    //accès via portail.ac-reunion.fr de l'application en dev côté frontend
	//--------------------------------------------------------------------------
	
	$this->app = "";
	
	if( $_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
	{
			$_SERVER['HTTP_CTEMAIL'] == 'eref.ash@ac-reunion.fr';
			$this->app ="eref";
			$this->getUser()->signIn($user);
			$this->getUser()->setAttribute('secteur', $secteur);
			$this->direction = 'https://localhost/data/appli/ashile/web/frontend.php/eleve/listeEleve';
			$this->retour = 'https://portail.ac-reunion.fr';
			
			
	 //accès via portail.ac-reunion.fr de l'application en dev côté académique
	//----------------------------------------------------------------------		
	} 
/* elseif($_SERVER['HTTP_CTEMAIL'] == 'acad.ash@ac-reunion.fr' && $_SERVER['HTTP_HOST'] == 'ashile2.ac-reunion.fr' && ($_SERVER['REMOTE_ADDR'] == '192.168.220.6' || $_SERVER['REMOTE_ADDR'] == '192.168.220.3')){
		
			$this->app ="acad";
			$this->getUser()->signIn($user);
			$this->direction ='https://portail.ac-reunion.fr/ashile/academie.php/eleve/recherche';
			$this->retour = 'https://portail.ac-reunion.fr';
	}
	*/
	
	 //accès via portail.ac-reunion.fr de l'application en prod côté frontend
	//--------------------------------------------------------------------------
	
	if(  $_SERVER['REMOTE_ADDR'] == '127.0.0.1') 
	{
			 $_SERVER['HTTP_CTEMAIL'] == 'eref.ash@ac-reunion.fr';
			$this->app ="eref";
			$this->getUser()->signIn($user);
			$this->getUser()->setAttribute('secteur', $secteur);
			//$this->direction = 'https://portail.ac-reunion.fr/ashilep/frontend.php/eleve?etab=sans';
			$this->direction = 'https://portail.ac-reunion.fr/ashilep/frontend.php/eleve/listeEleve';
			$this->retour = 'https://portail.ac-reunion.fr';
	
	//accès via portail.ac-reunion.fr de l'application en prod côté académique
	//------------------------------------------------------------------------		
	
	}
/* elseif($q[0]=='acad' && $_SERVER['HTTP_HOST'] == 'ashile.ac-reunion.fr' && ($_SERVER['REMOTE_ADDR'] == '192.168.220.6' || $_SERVER['REMOTE_ADDR'] == '192.168.220.3')){
		
			$this->app ="acad";
			$this->getUser()->signIn($user);
			$this->direction ='https://portail.ac-reunion.fr/ashilep/academie.php/eleve/recherche';
			$this->retour = 'https://portail.ac-reunion.fr';
	}
	*/
	
	//ACCES VIA HTTPS://ACCUEIL.IN.AC-REUNION.FR
	//------------------------------------------
	
	
    //accès via accueil.in.ac-reunion.fr de l'application en dev côté frontend
	//--------------------------------------------------------------------------
	
	/*	if($_SERVER['HTTP_CTEMAIL'] == 'eref.ash@ac-reunion.fr' && $_SERVER['HTTP_HOST'] == '127.0.0.1' && $_SERVER['REMOTE_ADDR'] == '127.0.0.1' )
	{
		
			$this->app ="eref";		
			$this->getUser()->signIn($user);
			$this->getUser()->setAttribute('secteur', $secteur);
			$this->direction = 'https://accueil.in.ac-reunion.fr/ashile/frontend.php/eleve/listeEleve';
			$this->retour = 'https://accueil.in.ac-reunion.fr';
			
			
	 //accès via accueil.in.ac-reunion.fr de l'application en dev côté académique
	//----------------------------------------------------------------------------
	} /*elseif($_SERVER['HTTP_CTEMAIL'] == 'acad.ash@ac-reunion.fr' && $_SERVER['HTTP_HOST'] == 'ashile2.ac-reunion.fr'&& $_SERVER['REMOTE_ADDR'] == '172.31.176.121'){
		
			$this->app ="acad";
			$this->getUser()->signIn($user);
			$this->direction ='https://accueil.in.ac-reunion.fr/ashile/academie.php/eleve/recherche';
			$this->retour = 'https://accueil.in.ac-reunion.fr';
	}
	*/

	
	//accès via accueil.in.ac-reunion.fr de l'application en prod côté frontend
	//--------------------------------------------------------------------------
	/*if($q[0]=='eref' && $_SERVER['HTTP_HOST'] == '127.0.0.1' && $_SERVER['REMOTE_ADDR'] == '127.0.0.1' )
	{
			
			$this->app ="eref";		
			$this->getUser()->signIn($user);
			$this->getUser()->setAttribute('secteur', $secteur);
			$this->direction = 'https://accueil.in.ac-reunion.fr/ashilep/frontend.php/eleve/listeEleve';
			$this->retour = 'https://accueil.in.ac-reunion.fr';
			
	//accès via accueil.in.ac-reunion.fr de l'application en prod côté académique
	//----------------------------------------------------------------------------
	}elseif($q[0]=='acad' && $_SERVER['HTTP_CTEMAIL'] == 'acad.ash@ac-reunion.fr' && $_SERVER['REMOTE_ADDR'] == '127.0.0.1'){
		
			$this->app ="acad";		
			$this->getUser()->signIn($user);
			$this->direction ='https://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve/recherche';
			$this->retour = 'https://accueil.in.ac-reunion.fr';
	}*/
	
	if($_SERVER['REMOTE_ADDR'] == '127.0.0.1'){
	// 1) compte des nouvelles demandes_Avs a traiter*****************************************************
	$Nb_nd_avs = Doctrine_Query::create()
				->SELECT('*')
				->from('Demandeavs d')
				->where('d.datedecisioncda IS NULL')
				;
	$this->nb_nd_avs = $Nb_nd_avs->COUNT();


	// 2) compte des demandes_Avs en attente de moyen
	$Nb_am_avs = Doctrine_Query::create()
		        ->select('*')
		        ->from('Demandeavs d')
		        ->where('d.datedecisioncda IS NOT NULL') // il existe une date de decision cda
                        ->andwhere('d.etat = false')	
		        ;
	$this->nb_am_avs = $Nb_am_avs->COUNT();


	// 1) compte des nouvelles demandes_Materiel a traiter**************************************************
	$Nb_nd_materiel = Doctrine_Query::create()
				->SELECT('*')
				->from('Demandemateriel m')
				->where('m.datedecisioncda IS NULL')
				;
	$this->nb_nd_materiel = $Nb_nd_materiel->COUNT();


	// 2) compte des demandes_materiel en attente de moyen
	$Nb_am_materiel = Doctrine_Query::create()
		        ->select('*')
		        ->from('Demandemateriel m')
		        ->where('m.datedecisioncda IS NOT NULL') // il existe une date de decision cda
                        ->andwhere('m.etat = false')	
		        ;
	$this->nb_am_materiel = $Nb_am_materiel->COUNT();

	// 1) compte des nouvelles demandes_Sessad a traiter******************************************************
	$Nb_nd_sessad = Doctrine_Query::create()
				->SELECT('*')
				->from('Demandesessad s')
				->where('s.datedecisioncda IS NULL')
				;
	$this->nb_nd_sessad = $Nb_nd_sessad->COUNT();


	// 2) compte des demandes_sessad en attente de moyen
	$Nb_am_sessad = Doctrine_Query::create()
		        ->select('*')
		        ->from('Demandesessad s')
		        ->where('s.datedecisioncda IS NOT NULL') // il existe une date de decision cda
                        ->andwhere('s.etat = false')	
		        ;
	$this->nb_am_sessad = $Nb_am_sessad->COUNT();

	// 1) compte des nouvelles demandes_transport a traiter****************************************************
	$Nb_nd_transport = Doctrine_Query::create()
				->SELECT('*')
				->from('Demandetransport t')
				->where('t.datedecisioncda IS NULL')
				;
	$this->nb_nd_transport = $Nb_nd_transport->COUNT();


	// 2) compte des demandes_transport en attente de moyen
	$Nb_am_transport = Doctrine_Query::create()
		        ->select('*')
		        ->from('Demandetransport t')
		        ->where('t.datedecisioncda IS NOT NULL') // il existe une date de decision cda
                        ->andwhere('t.etat = false')	
		        ;
	$this->nb_am_transport = $Nb_am_transport->COUNT();
	}
	
  }
  
 /**
  * Executes list action
  *
  * @param sfRequest $request A request object
  */  
  
  // une deuxième fonction list qui reprends les emails de l'utilisateur
    public function executeList(sfWebRequest $request)
  {
  	$this->texts = Doctrine_core::getTable('Accueil')->findAll();
	$this->texts = Doctrine::getTable('Mail')->findAll();
	
  
	// je commence pas tester user connecté (est il  connu par l'appli?)
	 /*$user = Doctrine_core::getTable('sfGuardUser')
		->findOneByEmailAddress($_SERVER['HTTP_CTEMAIL']);	

*/
	$secteur = Doctrine_core::getTable('Secteur')
			->findOneBySfguarduserId($user->getId());
	
	$q = $user->getPermissions();		
	
	// --- recherche des texts de user ------
	 $this->texts = Doctrine_Query::create()
			->select('m.*,e.nom as nom,e.prenom as prenom')
			->from('Mail m')
			->innerjoin('m.Eleve e')
			->where('m.sfguarduser_id = ?', $user->getId())
			->orderBy('m.date desc')
			->fetchArray();
  }
}
