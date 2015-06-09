<?php

/**
 * main actions.
 *
 * @package    labo
 * @subpackage main
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      
    $this->getUser()->setFlash('notice', sprintf('ok vous etes bien sur le frontend!'));  
    //$this->forward('default', 'module');
    $this->adresse1 = $request->getRemoteAddress();
    $this->adresse2 = $request->getUri();

    
     }
     
}
