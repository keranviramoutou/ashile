<?php

/**
 * menu actions.
 *
 * @package    labo
 * @subpackage menu
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class menuActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');

  }
  
    public function executeMention(sfWebRequest $request)
  {

  }
  
      public function executeCondition(sfWebRequest $request)
  {

  }
}