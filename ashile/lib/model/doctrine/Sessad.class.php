<?php

/**
 * Sessad
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ash974
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Sessad extends BaseSessad
{
	public function __toString()
	{
		return $this->getId().' - '.$this->getEtabnonsco().' - '.$this->getEtabnonsco()->getTypeetablissementnonsco().' '. $this->getTypesessad();
	}
}
