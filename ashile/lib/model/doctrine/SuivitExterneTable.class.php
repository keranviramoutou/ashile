<?php

/**
 * SuivitExterneTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class SuivitExterneTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object SuivitExterneTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('SuivitExterne');
    }
	
	public function getSuiviexterneencourEleve($eleveId)

	{
				$q =Doctrine_Query::Create()
				->select('n.id as naturesuiviext_id,n.libellenaturesuiviext as libellenaturesuiviext,s.id as suiviexterne_id,s.datedebutpriseencharge as datedebutpriseencharge,s.datefinpriseencharge as datefinpriseencharge')
                -> from('SuivitExterne s')
                ->innerJoin('s.Naturesuiviext n ON s.naturesuiviext_id = n.id')
				->where('s.eleve_id=?',$eleveId)
				->andWhere('s.datefinpriseencharge IS NULL OR s.datefinpriseencharge >=?', date('Y-m-d', time()))
			    ->orderby('s.id desc') ;
				 return $q->fetchArray();
	}
}