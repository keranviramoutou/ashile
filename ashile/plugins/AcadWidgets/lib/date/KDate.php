<?php
 
class KDate extends Objet implements IDate
{

protected $dateSysteme;
protected $dateUtilisateur;

/**
 * Constructeur
 *
 */
public function __construct()
{
$this->setDateSysteme("0000-00-00");
$this->setDateUtilisateur("00/00/0000");	
}

/**
 * Retourne la date au format système : yyyy-mm-dd
 *
 * @return String
 */
public function getDateSysteme()
{
return $this->dateSysteme;	
}


/**
 * Retourne la date au format utilisateur (dd/mm/yyyy ou "" si date=00/00/0000)
 *
 * @return String
 */
public function getDateUtilisateur()
{
if (!strcmp($this->dateUtilisateur, "00/00/0000"))
	$date = "";
else $date = $this->dateUtilisateur;
return $date;
}

/**
 * Met à jour la date système et la date utilisateur
 *
 * @param String $date
 * @throws KDateException
 */
public function updateDateSysteme($date)
{
if (strlen($date) != 10 || !is_numeric($date[0]) || !is_numeric($date[1]) || !is_numeric($date[2]) || !is_numeric($date[3]) || !is_numeric($date[5]) || !is_numeric($date[6]) || !is_numeric($date[8]) || !is_numeric($date[9]) || $date[4] != "-" || $date[7] != "-")
	throw new KDateException("Erreur date Système : struct");
else 
	{
	$jour = substr($date, 8, 2);
	$mois= substr($date, 5, 2);
	$annee= substr($date, 0, 4);
	if (!$this->validerDate($jour, $mois, $annee))
		throw new KDateException("Erreur date Système : semantique");
	}
$this->setDateSysteme($date);
$this->setDateUtilisateur($this->convertDateSysteme());
}

/**
 * Retourne vrai si els dates sont egales
 *
 * @param KDate $date
 * @return boolean
 */
public function egal(KDate $date)
{
$egal = false;
if (strcmp($this->getDateSysteme(), $date->getDateSysteme()) == 0)	
	$egal = true;
return $egal;
}


/**
 * Retourne vrai si  la date est superrieure à $date
 *
 * @param KDate $date
 * @return boolean
 */
public function superrieur($date)
{
$res =  false;
if (strcmp($this->getDateSysteme(), $date->getDateSysteme())>0)
	$res = true;
return $res;
}

/**
 * Retourne vrai si  la date est superrieure ou égale à $date
 *
 * @param KDate $date
 * @return boolean
 */
public function superrieurOuEgal($date)
{
$res =  false;
if (strcmp($this->getDateSysteme(), $date->getDateSysteme())>=0)
	$res = true;
return $res;
}


/**
 * Met à jour la date utilisateur et la date système
 *
 * @param String $date
 * @throws KDateException
 */
public function updateDateUtilisateur($date)
{
if (strlen($date) != 10 || !is_numeric($date[0]) || !is_numeric($date[1]) || !is_numeric($date[3]) || !is_numeric($date[4]) || !is_numeric($date[6]) || !is_numeric($date[7]) || !is_numeric($date[8]) || !is_numeric($date[9]) || $date[2] != "/" || $date[5] != "/")
	throw new KDateException("Erreur saisie date utilisateur");
else
	{
	$jour = substr($date, 0, 2);
	$mois= substr($date, 3, 2);
	$annee= substr($date, 6, 4);
	if (!$this->validerDate($jour, $mois, $annee))
		throw new KDateException("Erreur saisie date utilisateur");
	}
$this->setDateUtilisateur($date);
$this->setDateSysteme($this->convertDateUser());
}

/**
 * MAJ la date système
 *
 * @param String $date
 */
protected function setDateSysteme($date)
{
$this->dateSysteme = $date;
}

/**
 * MAJ la date utilisateur
 *
 * @param String $date
 */
protected function setDateUtilisateur($date)
{
$this->dateUtilisateur = $date;	
}

/**
 * Transforme la date système en date utilisateur
 *
 * @return String
 */
protected function convertDateSysteme()
{
$jour = $this->getJour();
$mois= $this->getMois();
$annee= $this->getAnnee();;
$dateUsr = $jour."/".$mois."/".$annee;
return $dateUsr;
}

/**
 * Transforme la date utilisateur en date systeme
 *
 * @return String
 */
protected function convertDateUser()
{
$jour = substr($this->getDateUtilisateur(), 0, 2);
$mois= substr($this->getDateUtilisateur(), 3, 2);
$annee= substr($this->getDateUtilisateur(), 6, 4);
$dateSys = $annee."-".$mois."-".$jour;
return $dateSys;
}

/**
 * retiourne le nombre d'années
 *
 * @return int
 */
protected function getAnnee()
{
return substr($this->getDateSysteme(), 0, 4);
}

/**
 * retourne le nopmbre de mois
 *
 * @return int
 */
protected function getMois()
{
return substr($this->getDateSysteme(), 5, 2);
}

/**
 * retourne le nombre de jours
 *
 * @return int
 */
protected function getJour()
{
return substr($this->getDateSysteme(), 8, 2);	
}

/**
 * toString
 *
 * @return String
 */
public function __toString()
{
return $this->getDateUtilisateur();	
}

/**
 * Modifie la date actuelle en focntion du nombre d'années, de mois et de jours
 *
 * @param int $nbAnnees
 * @param int $nbMois
 * @param int $nbJours
 */
public function updateDate($nbAnnees, $nbMois=0, $nbJours=0)
{
$jour = substr($this->getDateUtilisateur(), 0, 2);
$mois= substr($this->getDateUtilisateur(), 3, 2);
$annee= substr($this->getDateUtilisateur(), 6, 4);
$dateSys = date("Y-m-d", mktime(0, 0, 0, $mois+$nbMois, $jour+$nbJours, $annee+$nbAnnees));
$this->updateDateSysteme($dateSys);	
}

/**
 * Modife la date et lui donne pour valeru la date courante
 *
 */
public function setDateDuJour()
{
$this->setDateSysteme(date("Y-m-d"));
$this->setDateUtilisateur(date("d/m/Y"));
}

/**
 * retourne vrai si la date passée en parametre est coherente
 *
 * @param int $jour
 * @param int $mois
 * @param int $annee
 * @return boolean
 */
protected function validerDate($jour, $mois, $annee)
{
$dateOk = true;
if ($jour < 0 || $jour > 31)
	$dateOk = false;
if ($dateOk && ($mois < 0 || $mois > 12))
	$dateOk = false;
//if ($dateOk && ($annee < 1900 || $annee > 2100))
if ($dateOk && $annee < 1900)
	$dateOk = false;
return $dateOk;
}

}
?>