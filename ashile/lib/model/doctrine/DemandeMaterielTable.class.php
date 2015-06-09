<?php

/**
 * DemandeMaterielTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class DemandeMaterielTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object DemandeMaterielTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('DemandeMateriel');
    }
		public function getListDemandeMat()
	{
	
  //liste des  demandes de matériel en cours à la date du jour
  //---------------------------------------------------------
					
			$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,tr.libelletraitement as libelletraitement,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda,d.notes as notes')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->leftJoin('d.Traitement tr ON tr.id = d.traitement_id')
						//->where('m.eleve_id=?',$eleve_id) 
						->where('d.datedecisioncda IS NOT NULL')
						->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))						
						->groupby ('d.id');

			return $q->fetchArray();
	
	}
	public function getDerDemandeMat($eleve_id)
	{
	//Dernière demande de matériel en cours à la date du jour pour l'élève selectionné
	//------------------------------------------------------------------------------------
			
				
			$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,tr.libelletraitement as libelletraitement,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda, d.decisioncda as decisioncda,
			 c.libellecatmateriel as libellecatmateriel')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->leftJoin('d.Traitement tr ON tr.id = d.traitement_id')
						 ->leftJoin('d.Catmateriel c ON c.id = d.catmateriel_id')
						->where('m.eleve_id=?',$eleve_id) 
						->andwhere('d.datedecisioncda IS NOT NULL') ;
					 //	->andWhere('d.datefinnotif >=?', date('Y-m-d', time()));						
					//	->groupby ('d.id'); //

			return $q->fetchArray();
	
	}
	public function getDerDemandeMatTraite($eleve_id,$materiel_id)
	{
	//Dernière demande de matériel en cours à la date du jour pour l'élève selectionné
	//------------------------------------------------------------------------------------
			
				
			$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,tr.libelletraitement as libelletraitement,
			 c.libellecatmateriel as libellecatmateriel,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda, d.decisioncda as decisioncda')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->leftJoin('d.Traitement tr ON tr.id = d.traitement_id')
						 ->leftJoin('d.Catmateriel c ON c.id = d.catmateriel_id')
						->where('m.eleve_id=?',$eleve_id) 
						->andwhere('d.datedecisioncda IS NOT NULL')
						->andWhere('d.materiel_id =?', $materiel_id)
						->andWhere('d.datefinnotif >=?', date('Y-m-d', time()));
					
					//	->groupby ('d.id'); //

			return $q->fetchArray();
	
	}
	public function getDerDemandeMatAttribuer($eleve_id)
	{
	//Dernière demande de matérielà l'atat de traitement "A ATTRIBUER" à la date du jour pour l'élève selectionné
	//-----------------------------------------------------------------------------------------------------------
			$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda,ty.libelletraitement as libelletraitement,c.libellecatmateriel as catmateriel ')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->leftJoin('d.Traitement ty ON ty.id = d.traitement_id')
						->leftJoin('d.Catmateriel c ON c.id = d.catmateriel_id')
						->where('m.eleve_id=?',$eleve_id) 
						->andwhere('d.datedecisioncda IS NOT NULL')
						->andwhere('ty.libelletraitement LIKE "%ATTRIBUER%"')
						->andWhere('d.datefinnotif >=?', date('Y-m-d', time()));						
					//	->groupby ('d.id'); //

			return $q->fetchArray();
	
	}	
	
	public function getDemandeMatSelectionner($demandemateriel_id)
	{
	
	//Dernière demande de matériel à l'état de traitement "A ATTRIBUER" à la date du jour pour le type de matériel selectionné
	//-------------------------------------------------------------------------------------------------------------------------
			$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,c.libellecatmateriel as libellecatmateriel,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda,ty.libelletraitement as libelletraitement,d.notes as notes,c.id as catmateriel_id ,ty.id as traitement_id')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->leftJoin('d.Traitement ty ON ty.id = d.traitement_id')
						->leftJoin('d.Catmateriel c ON c.id = d.catmateriel_id')
						->where('d.id=?',$demandemateriel_id) ;

			return $q->fetchArray();
	
	}
	
	public function getDerDemandeMatCDA($eleve_id)
	{
	//Dernière demande de matériel en attente de décision CDA 
	//---------------------------------------------------------
	        $tot_mat = 0;
			$res = Doctrine_Query::create()
			->select('max(m.id) as max_mdph_id,max(d.id) as max_demmat_id,m.eleve_id as eleve_id')
			->from('Mdph m')
			->innerJoin('m.DemandeMateriels d ON m.id = d.mdph_id')
			//->where('d.datedecisioncda IS NOT NULL')
			->groupBy('m.eleve_id')
			->having('m.eleve_id=?',$eleve_id) 
			->limit(1)
			->fetchArray();
            $tot_mat = count($res)		;
			
		  if ($tot_mat > 0){				
			$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->where('d.datedecisioncda IS NULL' )
						->whereIn('d.id',$res[0]['max_demmat_id'])	
						//->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))						
						->groupby ('d.id');

			return $q->fetchArray();
			}
			
								
	}
	
	
	public function getListDemandeMatCDA($eleve_id)
	{
	
	//liste des demandes de matériel en attente de décision CDA pour l'élève selectionné
	//-----------------------------------------------------------------------------------
			$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda,ty.libelletraitement as libelletraitement ')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->leftJoin('d.Traitement ty ON ty.id = d.traitement_id')
						->where('d.datedecisioncda IS NULL' )
						
						->andwhere('m.eleve_id=?',$eleve_id) ;

			return $q->fetchArray();
	
	}
	

	
		public function getDemandematerielencour($eleve_id)
	{
				
		  //  demande materiel en cours
          //--------------------------------
			$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda,ty.libelletraitement as libelletraitement ')
			->from('DemandeMateriel d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
						->leftJoin('d.Traitement ty ON ty.id = d.traitement_id')
						->where('d.datedecisioncda IS NULL' )
						->andwhere('m.eleve_id=?',$eleve_id) ;

			return $q->fetchArray();
	
	}
	
			public function getDemandematerieldroitouvert($eleve_id)
	{
				
		  //  demande materiel droit ouvert
          //--------------------------------
				$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda,ty.libelletraitement as libelletraitement ')
                -> from('DemandeMateriel d')
                ->leftJoin('d.Typemateriel t ON d.typemateriel_id = t.id')
				->leftjoin('d.Mdph m on m.id = d.mdph_id')
				->leftJoin('d.Traitement ty ON ty.id = d.traitement_id')
				->where('m.eleve_id=?',$eleve_id)
               // ->where ('m.mdph_id=?',$users[0]['num_doss1'])
			   ->andwhere('d.datedebutnotif <=?',date('Y-m-d', time()))
			   ->andWhere('d.datefinnotif >=?', date('Y-m-d', time()));

				return $q->fetchArray();
	
	}
			public function getDemandematerieldroitouvertdiff($eleve_id)
	{
				
		  //  demande materiel droit ouvert
          //--------------------------------
				$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda,ty.libelletraitement as libelletraitement ')
                -> from('DemandeMateriel d')
                ->leftJoin('d.Typemateriel t ON d.typemateriel_id = t.id')
				->leftjoin('d.Mdph m on m.id = d.mdph_id')
				->leftJoin('d.Traitement ty ON ty.id = d.traitement_id')
				->where('m.eleve_id=?',$eleve_id)
			   ->andwhere('d.datedebutnotif <=?',date('Y-m-d', time()))
			   ->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
			   ->groupby('d.datefinnotif');
				return $q->fetchArray();
	
	}
	
	public function getDemandematerieldroitouvert6mois($eleve_id)
	{
				
		  //  demande materiel droit ouvert
          //--------------------------------
				$q = $this->createQuery('c')
			->select('t.id as typemateriel_id, m.eleve_id as eleve_id, m.id as MdphId, d.id as demandemateriel_id, t.libelletypemateriel as typemateriel,
			 m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,
			 d.datefinnotif as datefinnotif,d.datedebutnotif as datedebutnotif,d.datedecisioncda as datedecisioncda,ty.libelletraitement as libelletraitement ,DATE_ADD( d.datefinnotif , INTERVAL -6 MONTH ) as date_fin_projete')
                -> from('DemandeMateriel d')
                ->leftJoin('d.Typemateriel t ON d.typemateriel_id = t.id')
				->leftjoin('d.Mdph m on m.id = d.mdph_id')
				->leftJoin('d.Traitement ty ON ty.id = d.traitement_id')
				->where('m.eleve_id=?',$eleve_id)
     		   ->andwhere('d.datedebutnotif <=?',date('Y-m-d', time()))
			    ->andWhere('DATE_ADD( d.datefinnotif , INTERVAL -6 MONTH ) <=?', date('Y-m-d', time()))
			   ->andWhere('d.datefinnotif >=?', date('Y-m-d', time()));

				return $q->fetchArray();
	
	}
	
}
