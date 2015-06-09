<?php
/*******************************************************************************
 * Projet : ASH -- Application destinée à la gestion des élèves Handicapés de
 * l'ile de la Réunion, pour l'académie de la Réunion 
 * 
 * 04/2011 - 12/2011
 * 
 * Auteurs : R.GRAVANT; F.GELEZ
 * 
 * développé avec Symfony 1.4 et Doctrine 2
 * 
 * *****************************************************************************
 */
 //echo phpinfo();

// je commence par déclarer "date_default_timezone" car ce n'est pas renseigné dans php.ini 
// et cela provoque des messages d'erreurs
	date_default_timezone_set("Indian/Reunion");
	// on chhange la durée de la session PHP
	ini_set('session.cookie_lifetime', '36000');
	ini_set("session.gc_maxlifetime", '36000');
	ini_set('session.cache_expire', '600');
	// -----------------------------------------




	// declaration du fichier nécéssaire qui pointera vers la bibliotheque symfony  
	require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

	// création d'un objet $configuration qui contiendra tous les parametres de l'appli et redirection vers l'appli
	// et on redirige l'utilisateur sur l'application 'Accueil'
	$configuration = ProjectConfiguration::getApplicationConfiguration('accueil', 'prod', false);
	sfContext::createInstance($configuration)->dispatch();


  
 
