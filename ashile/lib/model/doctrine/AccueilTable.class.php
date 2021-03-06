<?php

/**
 * AccueilTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AccueilTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AccueilTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Accueil');
    }

	public function getLastOne()
	{
		$q = Doctrine_Query::Create()
			//->select('MAX(a.id) as max_id, a.type as annonce')
			->select('a.id as id, a.type as annonce')
			->from('Accueil a')
			->orderBy('id ASC')
			->execute();
		return $q;	
	}
}
