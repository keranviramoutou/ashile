<?php
 
class KDuree
{
private $dureeTotale;


/**
 * Construit une duree avec le nb de jours passe en parametre
 *
 * @param int $duree
 */
public function __construct($duree)
{
$this->setDureeTotale($duree);
}

/**
 * Met à jopur la durée en nombre de jours
 *
 * @param int $duree
 */
public function setDureeTotale($duree)
{
$this->dureeTotale = $duree;	
}

/**
 * Retourne la durée en nombre de jours
 *
 * @return int
 */
public function getDureeTotale()
{
return $this->dureeTotale;	
}

/**
 * toString
 *
 * @return String
 */
public function __toString()
{
return $this->getNbAnnees()."a ".$this->getNbMois()."m ".$this->getNbJours()."j";
}

/**
 * Retourne le nombre de jours
 *
 * @return int
 */
public function getNbJours()
{
$nbJours = ($this->getDureeTotale()%360)%30;
return $nbJours;
}

/**
 * Retourne le nombre de mois
 *
 * @return int
 */
public function getNbMois()
{
$nbMois = floor(($this->getDureeTotale()%360)/30);
return $nbMois;
}

/**
 * Retourne le nomber d'années
 *
 * @return int
 */
public function getNbAnnees()
{
if ($this->getDureeTotale()<360)
	$nbAnnee = 0;
else $nbAnnee = floor($this->getDureeTotale()/360);
return $nbAnnee;
}

}

?>