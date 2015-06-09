<?php

require_once dirname(__FILE__).'/../lib/secteuretabscoGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/secteuretabscoGeneratorHelper.class.php';

/**
 * secteuretabsco actions.
 *
 * @package    ash
 * @subpackage secteuretabsco
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class secteuretabscoActions extends autoSecteuretabscoActions
{
	public function executeShow(sfWebRequest $request)
	{
		$this->test = $request->getParameter('secteur_id');
	}
}
