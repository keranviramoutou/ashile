<?php

class AcadWidgetFormInputDate extends sfWidgetFormInput
{

	/**
	 * precise si les javascripts necessaires on été intégrés ou non
	 *
	 * @var boolean
	 */
	private static $jsImportes = false;
	
	/**
	 * appelé par le constructeur
	 *
	 * @param String[] $options
	 * @param String[] $attributes
	 */
	public function configure($options = array(), $attributes = array())
	{
		parent::configure($options, $attributes);
		//affichage / integration des js du calendar et de son css
		if (!self::$jsImportes)
			{
			sfContext::getInstance()->getResponse()->addJavascript("/sf/calendar/calendar.js");
			sfContext::getInstance()->getResponse()->addJavascript("/sf/calendar/lang/calendar-fr.js");
			sfContext::getInstance()->getResponse()->addJavascript("/sf/calendar/calendar-setup.js");
			sfContext::getInstance()->getResponse()->addStylesheet("/sf/calendar/skins/aqua/theme.css");
			self::$jsImportes = true;
			}
	}
	
	/**
	 * affiche la widget date academique
	 *
	 * @param String $name
	 * @param Object $value
	 * @param String[] $attributes
	 * @param String[] $errors
	 * @return String
	 */
	public function render($name, $value = null, $attributes = array(), $errors = array())
	{
		$date = new KDate();
		try
			{
			$date->updateDateSysteme($value);
			}
		catch (Exception $e)
			{
			try
				{
				$date->updateDateUtilisateur($value);
				}
				catch(Exception $e){}
			}
		if (!isset($attributes["size"]))
			$attributes["size"] = 12;
		$idHtml = $this->convertNameToId($name);
		$triggerName = $this->convertIdToTriggerName($idHtml);
		$strHtml = parent::render($name, $date->getDateUtilisateur(), $attributes, $errors);
		$strHtml .= "<button type=\"button\" disabled=\"disabled\" onclick=\"return false\" id=\"".$triggerName."\">...</button>
			          <script type=\"text/javascript\">
    					document.getElementById(\"".$triggerName."\").disabled = false;
    					Calendar.setup({
      						inputField : \"".$idHtml."\",
      						ifFormat : \"%d/%m/%Y\",
      						daFormat : \"%d/%m/%Y\",
      						button : \"".$triggerName."\"
    						});
  						</script>";
		return $strHtml;
	}

	/**
	 * retourne l'identifiant HTML à partir du nom fournit
	 *
	 * @param String $name
	 * @return String
	 */
	private function convertNameToId($name)
	{
	$tailleName = strlen($name);
	$str = "";
	$i = 0;
	while ($i<$tailleName && strcmp($name[$i], "[") != 0)
		{
		$str.=$name[$i];
		$i++;
		}
	$i++;
	if ($i<$tailleName)
		$str .= "_";
	while ($i<$tailleName-1)
		{
		$str .= $name[$i];
		$i++;
		}
	return $str;
	}

	
	/**
	 * retourne l'id du trigger associé au boutonCalendar à partir de l'id HTML de la balise textInput
	 *
	 * @param String $idHtml
	 * @return String
	 */
	private function convertIdToTriggerName($idHtml)
	{
		return "trigger_".$idHtml;
	}

}

?>