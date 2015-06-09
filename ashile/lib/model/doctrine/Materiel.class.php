<?php

/**
 * Materiel
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ash974
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Materiel extends BaseMateriel
{
	public function __toString()
	{
		return $this->getTypemateriel().' de catégorie : '.$this->getCatmateriel().' - référence : '.$this->getLibellemateriel().' - marque : '.$this->getMarque().' - n°: '.$this->getNumeromateriel();
	}

    
    public function getDernierMouvId()
    {
		// on cherche le dernier mouvement du materiel
		$derMouvMat = Doctrine_Query::create()
					->select('MAX(c.id) , c.datefin, c.datedebut')
					->from('MouvementMateriel c')
					->groupBy('c.materiel_id')
					->having('c.materiel_id = ?', $this->getId())
					->fetchArray();
					
			return $derMouvMat[0]['MAX'];		
	}
	
	
	public function getDerElveMatId()
	{
		$derEleveMat = Doctrine_Query::create()
					->select('d.eleve_id as eleve_id, MAX(d.id)')
					->from('EleveMateriel d')
					->groupBy('d.materiel_id')
					->having('d.materiel_id = ?', $this->getId())
					->fetchArray();
					
			return $derEleveMat[0]['MAX'];							
	}	


}
