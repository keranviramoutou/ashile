<?php

/**
 * DemandeTransport
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ash
 * @subpackage model
 * @author     regis Gravant
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class DemandeTransport extends BaseDemandeTransport
{
    public function alerte()
    {
         //$niveauAlerte = array();

        if (date('Y-m-d',strtotime("-1 month",strtotime($this->getDatefinnotif()))) <= date('Y-m-d', time()) && date('Y-m-d',strtotime($this->getDatefinnotif())) >= date('Y-m-d', time()) ) 
		{
            // donnée à passer
			$niveauAlerte = 1;
            $niveauAlerte = 'notification arrive à échéance dans moins de 1 mois';
		} elseif (date('Y-m-d',strtotime($this->getDatefinnotif())) <= date('Y-m-d', time()) )  {
		   $niveauAlerte = 0;
			 $niveauAlerte = 'notification échéance dépassée';
        } elseif (date('Y-m-d',strtotime("-2 month",strtotime($this->getDatefinnotif()))) <= date('Y-m-d', time()) && date('Y-m-d',strtotime($this->getDatefinnotif())) >= date('Y-m-d', time())) {
            $niveauAlerte = 2;
			 $niveauAlerte = 'notification arrive à échéance dans moins de 2 mois';
			
        } elseif (date('Y-m-d',strtotime("-3 month",strtotime($this->getDatefinnotif()))) <= date('Y-m-d', time()) && date('Y-m-d',strtotime($this->getDatefinnotif())) >= date('Y-m-d', time())) {
            $niveauAlerte = 3;
			 $niveauAlerte = 'notification arrive à échéance dans moins de 2 mois';
        }
        return $niveauAlerte;
    }

}
