<?php

class UrlHandler
{
	/**
	 * retourne l'url associee au module, à l'action et au tableau de parametres fournit
	 *
	 * @param String $module
	 * @param String $action
	 * @param String $tabParam
	 * @return String
	 */
	public static function genUrl($module, $action, $tabParam=array())
	{
		$url = sfContext::getInstance()->getController()->genUrl($module."/".$action.self::getChaineParametres($tabParam), true);
		return self::purgerUrl($url);
	}
	
	
	

	/**
	 * retourne une chaine reprewsentabnt les parametres &jh=khk  ....
	 *
	 * @param String[]
	 * @return String
	 */
	private static function getChaineParametres($tab)
	{
		$chaine = "";
		$nbParametres = count($tab); 
		$i = 0;
		if ($nbParametres>0)
			$chaine.= "?";
		foreach($tab as $key => $vlr)
			{
			if (!is_array($vlr))
				{
				if ($i>0)
					$chaine .= "&";
				$chaine .= $key."=".$vlr;
				$i++;
				}
			}
		return $chaine;
	}
	
	
/**
	 * enleve les caracteres à la con ajoutés par les serveurs apaches chainés mal configurés en prod
	 *
	 * @param String $url
	 * @return String
	 */
	private static function purgerUrl($url)
	{
		$tailleUrl = strlen($url);
		$urlRes = "";
		$trouve = false;
		$i = 0;
		while ($i<$tailleUrl && $url[$i]!=",")
			{
			$urlRes .= $url[$i];
			$i++;
			}
		if ($i<$tailleUrl)
			{
			//recherche du 1er slash
			while ($i<$tailleUrl && $url[$i]!="/")
				{
				$i++;
				}
		
		while ($i<$tailleUrl)
			{
			$urlRes .= $url[$i];
			$i++;
			}
				
			}
		return $urlRes;
		
	}
}

?>