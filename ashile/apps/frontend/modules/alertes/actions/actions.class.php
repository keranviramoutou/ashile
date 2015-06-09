<?php

/**
 * alertes actions.
 *
 * @package    ash
 * @subpackage alertes
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class alertesActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
		$secteur = $this->getUser()->getAttribute('secteur');
	
        $this->demandeAvss = $this->getDemande('DemandeAvs', $secteur);
        $this->demandeSessads = $this->getDemande('DemandeSessad',$secteur);
        $this->demandeTransports = $this->getDemande('DemandeTransport', $secteur);
        $this->demandeMateriels = $this->getDemande('DemandeMateriel', $secteur);
    }
	
	public function executeSuividemande(sfWebRequest $request)
    {
		$secteur = $this->getUser()->getAttribute('secteur');
     							
		$this->suividemandes = Doctrine_Query::Create()
       ->select('e.id as eleve_id, e.nom as nom ,e.prenom as prenom,m.id,dm.decisioncda as decisioncda,e.datenaissance as datenaissance,dm.id as demandemateriel_id,da.id as demandeavs_id
	   ,do.id as demandeorientation_id,ds.id as demandesessad_id,dt.id as demandetransport_id')
		->from('Eleve e')
		->innerJoin('e.Mdphs m ON e.id = m.eleve_id')
		->leftJoin('m.DemandeMateriels dm  ')
		->leftJoin('m.DemandeAvss da ')
		->leftJoin('m.DemandeSessads ds')
		->leftJoin('m.DemandeOrientations do ')
		->leftJoin('m.DemandeTransports dt ')
		->where('e.secteur_id=?', $secteur->getId()) 
	    ->andwhere('da.datedecisioncda is null ')
		->andwhere('do.datedecisioncda is null ')
		->andwhere('dm.datedecisioncda is null ')
		->andwhere('ds.datedecisioncda is null ')
		->andwhere('dt.datedecisioncda is null ')
		->fetchArray(); 
		


    }
		public function executeSuividemandetermine(sfWebRequest $request)
    {
		$this->secteur = $this->getUser()->getAttribute('secteur');
     							
		$this->suividemandes = Doctrine_Query::Create()
       ->select('e.id as eleve_id, e.nom as nom ,e.prenom as prenom,m.id,e.datenaissance as datenaissance ')
		->from('Eleve e')
		->innerJoin('e.Mdphs m ON e.id = m.eleve_id')
	     ->where('e.secteur_id=?', $this->secteur->getId()) 
		->fetchArray(); 
		


    }
    
 public function executeIndex1(sfWebRequest $request)	
 {
	    //liste des transports alloués non traités
		//-----------------------------------------
		$this->transport_alerte = Doctrine_Core::getTable('Transportobtenu')->TransportaTraiter($this->getUser()->getAttribute('secteur')->getId());
      	
	    //liste des Sessad alloués non traités
		//-----------------------------------------
		$this->sessad_alerte = Doctrine_Core::getTable('Sessadobtenu')->SessadaTraiter($this->getUser()->getAttribute('secteur')->getId());

	}
	
 public function executeIndex2(sfWebRequest $request)	
 {
	    //liste des transports alloués non traités
		//-----------------------------------------
		$this->transport_alerte = Doctrine_Core::getTable('DemandeAvs')->DemandeAvsaTraiter($this->getUser()->getAttribute('secteur')->getId());
      	
	    //liste des Sessad alloués non traités
		//-----------------------------------------
		$this->sessad_alerte = Doctrine_Core::getTable('DemandeMateriel')->MaterielaTraiter($this->getUser()->getAttribute('secteur')->getId());

	}
    
    protected function getDemande($demande, $secteur)
    {
        return Doctrine_Query::Create()
		                ->select('m.eleve_id as eleve_id,d.id as demande_id')
                        ->from($demande. ' d')
                        ->innerJoin('d.Mdph m')
                        ->innerJoin('m.Eleve e')
                        ->where('e.secteur_id=?', $secteur->getId())
					//	->andWhere('d.datefinnotif <= ?', date('Y-m-d', time()))
						->andwhere ('d.datedecisioncda is null')
					//	->groupBy('m.eleve_id')
					//	->having('m.eleve_id,demande_id') 
                        ->orderBy('d.datefinnotif')
                        ->execute();
		
    }
    
    public function executeAide(){}
	
	

}
