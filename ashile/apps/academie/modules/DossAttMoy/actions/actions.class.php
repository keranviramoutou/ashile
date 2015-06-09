<?php

/**
 * DossAttMoy actions.
 *
 * @package    ash
 * @subpackage DossAttMoy
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DossAttMoyActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	// demande avs

	$this->demandeavss = Doctrine_Query::create()
		        ->select('*')
		        ->from('Demandeavs d')
		        ->where('d.datedecisioncda IS NOT NULL') // il existe une date de decision cda
		        ->andwhere('d.decisioncda = true')   // la demande est acceptée
		        ->andwhere('d.traite IS NULL') // la demande n'a pas encore de moyen attribué
		        ->execute();
/*
	// demande sessad
	     $this->demandesessads = Doctrine_Query::create()
			->select('*')
			->from('Demandesessad')
			->where('Datedecisioncda is not null' )
			->execute();

	// demande materiel
	    $this->demandemateriels = Doctrine_Query::create()
			->select('*')
			->from('Demandemateriel')
			->where('Datedecisioncda is not null' )
			->execute();

	// demande transport
	    $this->demandetransports = Doctrine_Query::create()
			->select('*')
			->from('Demandetransport')
			->where('Datedecisioncda is not null' )
			->execute(); 
*/


  }
}
