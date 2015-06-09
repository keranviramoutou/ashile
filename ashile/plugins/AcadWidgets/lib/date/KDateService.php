<?php
 
class KDateService extends KDate
{
/**
 * Retourne la durée entre la date et $date en fonctino des cntraintes de gestion*
 * 1an = 12 mois, 1 mois=30 jours, ...
 *
 * @param KDate $date
 * @return KDuree
 */
public function getDuree($date)
{
if (strcmp($this->getDateSysteme(), $date->getDateSysteme())<0)
	$duree = $this->calculDuree($this, $date);
else $duree = $this->calculDuree($date, $this);
return $duree;
}

/**
 * calcule la durée entre dateDeb et dateFin
 *
 * @param KDate $dateDeb
 * @param KDate $dateFin
 * @return KDuree
 */
private function calculDuree($dateDeb, $dateFin)
{
$nbAnnee = 0;
$nbMois = 0;
$nbJour = 0;
$aDeb = $dateDeb->getAnnee();
$mDeb = $dateDeb->getMois();
$jDeb = $dateDeb->getJour();
$aFin = $dateFin->getAnnee();
$mFin = $dateFin->getMois();
$jFin = $dateFin->getJour();
if ($jDeb<=$jFin)
	{
	$deltaMois = 0;
	$deltaJour = 1;
	if ($jDeb==30 && $jFin==31)
		$deltaJour = 0;
	if ($mFin==2)//si fervier ajouter
		if ($aFin!=2000 && ($aFin%4)!=0)//si annee 2000 et non bissextile
			$deltaJour += 2;
		else $deltaJour ++;
	if ($jFin == 31)
		$jFin = 30;		
	$nbJour = $jFin-$jDeb+$deltaJour;
	}
else 
	{
	$deltaMois = 1;
	if ($jDeb==31)
		$nbJour = 1;
	else $nbJour = 30 - ($jDeb - 1);
	//controle sur février
	$deltaJour = 0;
	if ($mFin==2)//si fervier ajouter
		if ($aFin!=2000 && ($aFin%4)!=0)//si annee 2000 et non bissextile
			{
			if ($jFin == 28)
				$deltaJour = 2;
			}
		else 
			if ($jFin == 29)
				$deltaJour = 1;
	$nbJour += $jFin + $deltaJour;//pas de ponderation 30 / 31 sur jor fin car jDeb>jFin
	//$nbJour += $jFin;//pas de ponderation 30 / 31 sur jor fin car jDeb>jFin
	}
$moisDeb =$mDeb+$deltaMois; 
if ($moisDeb<=$mFin)
	{
	$deltaAnnee = 0;
	$nbMois = $mFin-($moisDeb);
	}
else
	{
	$deltaAnnee = 1;
	$nbMois = 12+$mFin-($moisDeb);
	}
$nbAnnee = $aFin - ($aDeb+$deltaAnnee);
$nbJourTotal = $nbAnnee * 360 + $nbMois * 30 + $nbJour;
return new KDuree($nbJourTotal);
}
	
public function __toString()
{
	return parent::__toString();
}
}

?>