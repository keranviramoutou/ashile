<?php

/**
 * accueil actions.
 *
 * @package    ash
 * @subpackage accueil
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accueilActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {  
	  
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
      public function executeAide(){

  }
}
