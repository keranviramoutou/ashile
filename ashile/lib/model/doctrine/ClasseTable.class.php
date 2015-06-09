<?php

/**
 * ClasseTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ClasseTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ClasseTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Classe');
    }
    
	
		public function getExecclasse($etabId){
         //$user = sfContext::getInstance()->getUser();
       // $t = departementTable::getInstance();
        $q = Doctrine_Query::create()
                        ->select ('*')
						 ->from('Classe c')
						->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
						->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
                        ->where( 'e.id = ?', $etabId );
        return $q->execute();
    
		}
	 
}
