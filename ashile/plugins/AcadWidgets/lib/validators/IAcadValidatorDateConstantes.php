<?php

interface IAcadValidatorDateConstantes
{
	
	const FORMAT_FR = "@(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})@";
	const FORMAT_EN = "@(?P<year>\d{4})-(?P<month>\d{2})-(?P<day>\d{2})@";
	
}
?>