<?php

/**
 * AnneescolaireTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AnneescolaireTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AnneescolaireTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Anneescolaire');
    }
    
	public function getAnneeScolaireEnCours()
	{ 
		$maxId = Doctrine_Query::create()
					->select('MAX(id) as max')
					->from('Anneescolaire')
					->fetchOne();
		 return $this->find($maxId->getMax());
	}    


  
}
