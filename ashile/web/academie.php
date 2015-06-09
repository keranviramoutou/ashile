<?php

// this check prevents access to debug front controllers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.

//if (!in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1','172.31.181.139', '172.31.180.38')))
{
  //die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
	// if( $_SERVER['HTTP_HOST'] == 'ashile2.ac-reunion.fr')
	//{
	$configuration = ProjectConfiguration::getApplicationConfiguration('academie', 'prod', true);
	//}elseif( $_SERVER['HTTP_HOST'] != 'ashile2.ac-reunion.fr'){
	//$configuration = ProjectConfiguration::getApplicationConfiguration('academie', 'prod', true);
	//}
//$configuration = ProjectConfiguration::getApplicationConfiguration('academie', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
