<?php

/**
 * BilanTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class BilanTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object BilanTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Bilan');
    }
	
    public function getBilanSansDate($mdph_id)
	{
	
  //liste des bilans sans date pour un dossier mdph donné 
  //-----------------------------------------------------
			$q = $this->createQuery('c')
			            ->select('b.*,n.libellenaturebilan as libellenaturebilan')
			            ->from('Bilan b')
						->leftjoin('b.Naturebilan n ON n.id = b.naturebilan_id')
						->where('b.mdph_id=?',$mdph_id) 
						->andwhere('b.date_bilan IS NULL');
			return $q->fetchArray();
	
	}

	public function getBilanAvecDate($mdph_id)
	{
	
  //liste des bilans sans date pour un dossier mdph donné 
  //-----------------------------------------------------
			$q = $this->createQuery('c')
			            ->select('b.*,n.libellenaturebilan as libellenaturebilan')
			            ->from('Bilan b')
						->leftjoin('b.Naturebilan n ON n.id = b.naturebilan_id')
						->where('b.mdph_id=?',$mdph_id) 
						->andwhere('b.date_bilan IS NOT NULL');
			return $q->fetchArray();
	
	}
	public function getBilan($mdph_id)
	{
  //liste des bilans  pour un dossier mdph donné 
  //-----------------------------------------------
			$q = $this->createQuery('c')
			            ->select('*')
			            ->from('Bilan b')
						->leftjoin('b.Naturebilan n ON n.id = b.naturebilan_id')
						->where('b.mdph_id=?',$mdph_id) ;
			return $q->fetchArray();
	
	}
	
}