<?php

/**
 * TransportobtenuTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class TransportobtenuTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object TransportobtenuTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Transportobtenu');
    }
		public function TransportaTraiter($secteur_id)
	{
	
		    //liste des transports alloués non traités
		//-----------------------------------------
				$res = Doctrine_Query::create()
                ->select('t.id as transportobtenu_id,d.id as demandetransport_id,t.datedebut as datedebut,t.datefin as datefin,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,
				a.libelletransport as libelletransport,t.transport_id as transport_id,	e.nom as nom,e.prenom as prenom,e.id as eleve_id,m.id as mdph_id')
                ->from('Transportobtenu t')
                ->innerjoin('t.DemandeTransport d ON d.id = t.demandetransport_id')
			    ->innerjoin('t.Transport a ON a.id = t.transport_id')
				->innerjoin('d.Mdph m ON m.id = d.mdph_id')
				->innerjoin ('m.Eleve e ON e.id = m.eleve_id')
				//->Where('a.libelletransport LIKE "%ND%" ');
			    ->where('t.datedebut is null')
				->andwhere('e.secteur_id =?', $secteur_id)
				 ->andWhere('e.datesortie IS NULL or e.datesortie>=?', date('Y-m-d', time()));
				return $res->fetchArray();
	}
	
	
	 public function TransportaTraiterEleve($eleve_id)
	{
	
		  //liste des transports alloués non traités pour l'élève selectionné
		//-----------------------------------------------------------------------
				$res = Doctrine_Query::create()
                ->select('t.id as transportobtenu_id,d.id as demandetransport_id,t.datedebut as datedebut,t.datefin as datefin,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,
				a.libelletransport as libelletransport,t.transport_id as transport_id,	e.nom as nom,e.prenom as prenom,e.id as eleve_id,m.id as mdph_id')
                ->from('Transportobtenu t')
                ->innerjoin('t.DemandeTransport d ON d.id = t.demandetransport_id')
			    ->innerjoin('t.Transport a ON a.id = t.transport_id')
				->innerjoin('d.Mdph m ON m.id = d.mdph_id')
				->innerjoin ('m.Eleve e ON e.id = m.eleve_id')
				->where('t.eleve_id=?',$eleve_id)
				//->AndWhere('a.libelletransport LIKE "%ND%" ');
			   ->andwhere('t.datedebut is null');
				return $res->fetchArray();
	}
}