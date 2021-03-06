<?php

/**
 * EleveMaterielTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class EleveMaterielTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object EleveMaterielTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('EleveMateriel');
    }
    
    public function getMatSansConv()
    {
		$q = Doctrine_Query::Create()
				->select('em.id')
				->from('EleveMateriel em')
				->where('em.dateconvention IS ?', NULL)
				->orWhere('em.datefin < ?', date('Y-m-d', time()));
				
		return $q->fetchArray();		
	}
	
	 public function getMatSansConvParEleve($eleveId)
    {
		$q = Doctrine_Query::Create()
				->select('em.id, m.id as materiel_id,t.id, t.libelletypemateriel as typemateriel, m.numeromateriel as numeromateriel,em.datedebut as datedebut,em.datefin as datefin,
				em.eleve_id as eleve_id,em.numero_convention as numero_convention,m.libellemateriel as libellemateriel,c.id as catmateriel_id,c.libellecatmateriel as libellecatmateriel,m.prixachat as prixachat')		
				->from('EleveMateriel em')
				->innerJoin('em.Materiel m ON m.id = em.materiel_id')
				->innerJoin('m.Typemateriel t ON t.id = m.typemateriel_id')
				->leftJoin('m.Catmateriel c ON c.id = m.catmateriel_id')
				->where('em.dateconvention IS NULL AND em.eleve_id = ?', $eleveId);
				
		return $q->fetchArray();		
	}
	
	public function getConvExpiration()
	{
		$q =Doctrine_Query::Create()
					->select('em.id')
					->from('EleveMateriel em')
					->where( 'DATEDIFF(em.datefin, CURRENT_DATE) < ?', 30 );

					
		return $q->fetchArray();			
	}
	
	public function getListMaterielEleve($eleve_id)

	{
				$q =Doctrine_Query::Create()
                ->select ('e.eleve_id as eleve_id,e.id as eleve_materiel_Id,m.id as materiel_id,el.nom as nom,el.prenom as prenom,datenaissance as datenaissance, q.libellemarque as libellemarque,e.datefin as datefin, e.datedebut as datedebut,
				dateconvention as dateconvention,e.numero_convention as numero_convention,m.libellemateriel as libelleMateriel,t.libelletypemateriel as libelletypemateriel
				, m.numeromateriel as numeroMateriel, m.commentaire as commentaire,e.dateconvention as dateconvention,c.id as catmateriel_id,c.libellecatmateriel as libellecatmateriel')
                ->from ('EleveMateriel e')
				->innerJoin('e.Eleve el ON el.id = e.eleve_id') //eleve_matériel
				->innerJoin('e.Materiel m ON m.id = e.materiel_id')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
  			    ->leftjoin('el.Orientation o ON  e.id =  o.eleve_id')
				->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
				->leftJoin('m.Catmateriel c ON c.id = m.catmateriel_id')
				->where('e.eleve_id = ?', $eleve_id)
				//->andWhere('e.datefin is Null');
				//->andWhere('e.datefin >=?', date('Y-m-d', time()));
				->orderby('e.datefin Desc,e.datedebut Asc');
                return $q->fetchArray();	
	}

	public function getListMaterielencoursEleve($eleve_id)

	{
				$q =Doctrine_Query::Create()
                ->select ('e.eleve_id as eleve_id,e.id as eleve_materiel_Id,m.id as materiel_id,el.nom as nom,el.prenom as prenom,datenaissance as datenaissance, q.libellemarque as libellemarque,e.datefin as datefin, e.datedebut as datedebut,
				dateconvention as dateconvention,
				,f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as libelletypemateriel, m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel, 
				m.caracteristiquemateriel as caracteristiqueMateriel, m.numeromateriel as numeroMateriel, m.commentaire as commentaire')
                ->from ('EleveMateriel e')
				->innerJoin('e.Eleve el ON el.id = e.eleve_id') //eleve_matériel
				->innerJoin('e.Materiel m ON m.id = e.materiel_id')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->leftJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
			    ->leftjoin('el.Orientation o ON  e.id =  o.eleve_id')
				->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
				->where('e.eleve_id = ?', $eleve_id)
			//	->andWhere('e.datefin is Null');
				->andWhere('e.datefin IS NULL OR e.datefin >=?', date('Y-m-d', time()));
				//->andWhere('e.datefin >=?', date('Y-m-d', time()));
                return $q->fetchArray();	
	}
	
		public function getListEleveMateriel($materiel_id)

	{
				$q =Doctrine_Query::Create()
                ->select ('e.eleve_id as eleve_id,e.id as eleve_materiel_Id,m.id as materiel_id,el.nom as nom,el.prenom as prenom,datenaissance as datenaissance, q.libellemarque as libellemarque,e.datefin as datefin, e.datedebut as datedebut,
				dateconvention as dateconvention,
				,f.nommouvement as nommouvement, s.id as mouvementId, m.marque_id as marqueId,t.libelletypemateriel as libelletypemateriel, m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel, 
				m.caracteristiquemateriel as caracteristiqueMateriel, m.numeromateriel as numeroMateriel, m.commentaire as commentaire')
                ->from ('EleveMateriel e')
				->innerJoin('e.Eleve el ON el.id = e.eleve_id') //eleve_matériel
				->innerJoin('e.Materiel m ON m.id = e.materiel_id')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
                ->leftJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
			    ->leftjoin('el.Orientation o ON  e.id =  o.eleve_id')
				->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
				->where('e.materiel_id = ?', $materiel_id)
				->andWhere('e.datefin >=?', date('Y-m-d', time()));
                return $q->fetchArray();	
	}
}
