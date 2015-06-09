<?php

/**
 * dossiersIncomplets actions.
 *
 * @package    ash
 * @subpackage dossiersIncomplets
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dossiersIncompletsActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
	
	
		$secteur = $this->getUser()->getAttribute('secteur');
         //liste des élèves avec un dossier MDPH incomplets
		   //Dernière scolarisation
			//-----------------------------------------------------------------------
				$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
				$deb = $annee->getDatedebutanneescolaire();
				$fin = $annee->getDatefinanneescolaire();
        $this->dossierIncomplets = $this->getDossiersIncomplets($secteur,$deb,$fin);
       // $this->test = $this->getPiecesDossierMdph($secteur);
	
	   
	
    }

    protected function getBilansMdph($secteur,$deb,$fin)
    {
        return Doctrine_Query::Create()
						-> select('m.*,m.id as Mdph_id,b.*,o.id as orientationId,e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab,m.datecreationpps as datecreationpps
 ,m.dateenvoiedossier as,m.dateenvoiedossier as dateenvoiedossier,DATE_ADD( m.datecreationpps, INTERVAL 1 MONTH ) as date1,DATE_ADD( m.datecreationpps, INTERVAL 3 MONTH ) as date2')
                        ->from('Bilan b')
                        ->innerJoin('b.Mdph m')
                        ->innerJoin('m.Eleve e')
						->innerJoin('e.Orientation o ON e.id = o.eleve_id')
						->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
						->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
                        ->where('e.secteur_id=?', $secteur->getId())
                        ->andWhere('b.date_bilan IS NULL')
						 ->andWhere('o.datedebut >=?', $deb)
						->andWhere('o.datefin <=?', $fin)
						->andwhere('m.dateenvoiedossier is Null') 
						->andwhere('m.dateess is  not Null') 
						->andwhere('m.depotparent != 1') 
						//->andwhere('m.datecreationpps is  not Null') 
                        ->orderBy('e.id')
                        ->execute();
    }

    protected function getPiecesDossierMdph($secteur,$deb,$fin)
    {
        return Doctrine_Query::Create()
						-> select('m.*,m.id as Mdph_id,p.*,o.id as orientationId,e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab,m.datecreationpps as datecreationpps
						 ,m.dateenvoiedossier as dateenvoiedossier,DATE_ADD( m.datecreationpps, INTERVAL 1 MONTH ) as date1,DATE_ADD( m.datecreationpps, INTERVAL 2 MONTH ) as date2')
                        ->from('PiecesDossier p')
                        ->innerJoin('p.Mdph m')
                        ->innerJoin('m.Eleve e')
						->innerJoin('e.Orientation o ON e.id = o.eleve_id')
						->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
						->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
                        ->where('e.secteur_id=?', $secteur->getId())
                        ->andWhere('p.daterecep is Null')
					    ->andWhere('o.datedebut >=?', $deb)
						->andWhere('o.datefin <=?', $fin)
						->andwhere('m.dateenvoiedossier is  Null') 
					//	->andwhere('m.datecreationpps is  not Null') 
						->andwhere('m.dateess is  not Null') 
						->andwhere('m.depotparent != 1') 
                        ->orderBy('e.id')
                        ->execute();
    }
	
	    protected function getPiecesDossierObligatoireMdph($secteur,$deb,$fin)
    {
	  
        return Doctrine_Query::Create()
		 -> select('m.*,m.id as Mdph_id,m.datecreationpps as datecreationpps, o.id as orientationId,e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab,m.datecreationpps as datecreationpps,
		 ,m.dateenvoiedossier as dateenvoiedossier,DATE_ADD( m.datecreationpps, INTERVAL 1 MONTH ) as date1,DATE_ADD( m.datecreationpps, INTERVAL 2 MONTH ) as date2')
 	     ->from('Mdph m')
    	 ->innerJoin('m.Eleve e on m.eleve_id= e.id')
		 ->innerJoin('e.Orientation o ON e.id = o.eleve_id')
		->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
		->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
		 ->where('e.secteur_id=?', $secteur->getId())
		->andwhere('m.datepjdom is Null or m.datecreationpps is Null or m.datepjident is Null or datebilanmedical is Null ')
		->andwhere('m.dateenvoiedossier is  Null') 
		->andwhere('m.depotparent != 1') 
	//	->andwhere('m.datecreationpps is  not Null') 
		->andwhere('m.dateess is  not Null') 
		->andWhere('o.datedebut >=?', $deb)
        ->andWhere('o.datefin <=?', $fin)
		 ->orderBy('e.id')
		 ->execute();
		          
    }

    protected function getDossiersIncomplets($secteur,$deb,$fin)
    {
        $tabs = array();
        $bilans = $this->getBilansMdph($secteur,$deb,$fin);
        $dossiers = $this->getPiecesDossierMdph($secteur,$deb,$fin);
		$pjobligatoires = $this->getPiecesDossierObligatoireMdph($secteur,$deb,$fin);
		
        foreach ($bilans as $bilan){
			$tabs[$bilan->Mdph->Eleve->getId()]['bilan'][] = $bilan;
			$tabs[$bilan->Mdph->Eleve->getId()]['id'] = $bilan->Mdph->getEleveId();
			$tabs[$bilan->Mdph->Eleve->getId()]['Mdph_id'] = $bilan['Mdph_id'];
            $tabs[$bilan->Mdph->Eleve->getId()]['nom'] = $bilan->Mdph->Eleve->getNom();
            $tabs[$bilan->Mdph->Eleve->getId()]['prenom'] = $bilan->Mdph->Eleve->getPrenom();
			$tabs[$bilan->Mdph->Eleve->getId()]['datenaissance'] = $bilan->Mdph->Eleve->getDatenaissance();
            $tabs[$bilan->Mdph->Eleve->getId()]['ine'] = $bilan->Mdph->Eleve->getIne();
			$tabs[$bilan->Mdph->Eleve->getId()]['rne'] = $bilan['rne'];
			$tabs[$bilan->Mdph->Eleve->getId()]['typetab'] = $bilan['typetab'];
			$tabs[$bilan->Mdph->Eleve->getId()]['nometabsco'] = $bilan['nometabsco'];
			$tabs[$bilan->Mdph->Eleve->getId()]['date1'] = $bilan['date1'];
			$tabs[$bilan->Mdph->Eleve->getId()]['date2'] = $bilan['date2'];
			$tabs[$bilan->Mdph->Eleve->getId()]['datecreationpps'] = $bilan['datecreationpps'];
        }
        foreach ($dossiers as $dossier){
            $tabs[$dossier->Mdph->Eleve->getId()]['dossier'][] = $dossier;
			$tabs[$dossier->Mdph->Eleve->getId()]['id'] = $dossier->Mdph->getEleveId();
			$tabs[$dossier->Mdph->Eleve->getId()]['Mdph_id'] = $dossier['Mdph_id'];
            $tabs[$dossier->Mdph->Eleve->getId()]['nom'] = $dossier->Mdph->Eleve->getNom();
            $tabs[$dossier->Mdph->Eleve->getId()]['prenom'] = $dossier->Mdph->Eleve->getPrenom();
			$tabs[$dossier->Mdph->Eleve->getId()]['datenaissance'] = $dossier->Mdph->Eleve->getDatenaissance();
            $tabs[$dossier->Mdph->Eleve->getId()]['ine'] = $dossier->Mdph->Eleve->getIne();
			$tabs[$dossier->Mdph->Eleve->getId()]['rne'] = $dossier['rne'];
			$tabs[$dossier->Mdph->Eleve->getId()]['typetab'] = $dossier['typetab'];
			$tabs[$dossier->Mdph->Eleve->getId()]['nometabsco'] = $dossier['nometabsco'];
			$tabs[$dossier->Mdph->Eleve->getId()]['date1'] = $dossier['date1'];
			$tabs[$dossier->Mdph->Eleve->getId()]['date2'] = $dossier['date2'];
			$tabs[$dossier->Mdph->Eleve->getId()]['datecreationpps'] = $dossier['datecreationpps'];
			$tabs[$dossier->Mdph->Eleve->getId()]['datebilanmedical'] = $dossier['datebilanmedical'];
        }
		
		 foreach ($pjobligatoires as $pjobligatoire){
            $tabs[$pjobligatoire->Eleve->getId()]['pjobligatoire'][] = $pjobligatoire;
			$tabs[$pjobligatoire->Eleve->getId()]['id'] = $pjobligatoire->getEleveId();
			$tabs[$pjobligatoire->Eleve->getId()]['Mdph_id'] = $pjobligatoire['Mdph_id'];;
            $tabs[$pjobligatoire->Eleve->getId()]['nom'] = $pjobligatoire->Eleve->getNom();
            $tabs[$pjobligatoire->Eleve->getId()]['prenom'] = $pjobligatoire->Eleve->getPrenom();
			$tabs[$pjobligatoire->Eleve->getId()]['datenaissance'] = $pjobligatoire->Eleve->getDatenaissance();
            $tabs[$pjobligatoire->Eleve->getId()]['ine'] = $pjobligatoire->Eleve->getIne();
			$tabs[$pjobligatoire->Eleve->getId()]['rne'] = $pjobligatoire['rne'];
			$tabs[$pjobligatoire->Eleve->getId()]['typetab'] = $pjobligatoire['typetab'];
			$tabs[$pjobligatoire->Eleve->getId()]['nometabsco'] = $pjobligatoire['nometabsco'];
			$tabs[$pjobligatoire->Eleve->getId()]['date1'] = $pjobligatoire['date1'];
			$tabs[$pjobligatoire->Eleve->getId()]['date2'] = $pjobligatoire['date2'];
			$tabs[$pjobligatoire->Eleve->getId()]['datecreationpps'] = $pjobligatoire['datecreationpps'];
        }
        asort($tabs);
        return $tabs;
    }
    
    public function executeAide(){}

}
