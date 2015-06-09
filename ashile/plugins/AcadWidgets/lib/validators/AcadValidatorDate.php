<?php

class AcadValidatorDate extends sfValidatorDate implements IAcadValidatorDateConstantes 
{

	public function __construct($options = array(), $messages = array())
	{
		if (!isset($options["date_format"]))
			$options["date_format"] = self::FORMAT_FR;
		if (!isset($messages["bad_format"]))
			$messages["bad_format"] = "Vous devez saisir la date au format JJ/MM/AAAA.";
		if (!isset($messages["invalid"]))
			$messages["invalid"] = "Vous devez saisir la date au format JJ/MM/AAAA.";
		if (!isset($messages["required"]))
			$messages["required"] = "Vous devez saisir la date.";
		parent::__construct($options, $messages);
	}

}

?>