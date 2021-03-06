<?php

/**
 * Mail
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Mail extends BaseMail
{
	
	public function getDestinataire($eleveId)
	{
		//$secteur_id = Doctrine::getTable('Eleve')->find($this->getEleveId())->getSecteurId();
		$eleve = Doctrine::getTable('Eleve')->findOneById($eleveId);
		$secteur_id = $eleve->getSecteurId();
			
		$destinataire = Doctrine_Query::Create()
				->select ('s.id as secteur_id,u.id as user_id,u.email_address as email_address,u.username as username')
				->from('secteur s')
				->innerJoin('s.sfguarduser u ON u.id = s.sfguarduser_id')
				->where('s.id= ?', $secteur_id)
				->fetchArray();
		
		return $destinataire;
	}
	
	public function getLeSujet($nomModule)
	{ 
			switch($nomModule)
		{
			case 'eleve_avs':
					$sujet = "Attribution d'un Avs ";
			break;
			
			case 'eleve_materiel':
					$sujet = "Attribution d'un materiel ";
			break;
			
			case 'orientation':
					$sujet = "Attribution d'une orientation";
			break;
		}
		return $sujet;
	}
	
	public function getLeTexte($nomModule)
	{
		return "VOILA LE TEXT";
	}

	public function getRoute()
	{
		return 'eleve_avs/secteur?secteur_id=11';
		//return $module+$secteur_id;
	}

}
