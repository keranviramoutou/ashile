<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthComponents.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: components.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardAuthComponents extends BasesfGuardAuthComponents
{
	public function configure()
	{
		// condition l'user connecté existe dans la table sfGuardUser
		$monUser = SfGuardUserTable::retrieveByUsernameOrEmailAddress($_SERVER['HTTP_CTEMAIL']);
		if($monUser){
			$this->getUser()->signIn($monUser, true);
 
		}
	}
}
