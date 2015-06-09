<?php

class accueilConfiguration extends sfApplicationConfiguration
{
  /** 
   * Get the routing for the given application 
   * 
   * Optionally set context values, using the $context parameter 
   * 
   * @see sfWebRequest::getRequestContext() 
   * 
   * @param string $application 
   * @param array $context 
   * 
   * @return sfRouting 
   */  
  public function getRouting($application, array $context = array())  
  {  
    $current_application = sfContext::getInstance()->getConfiguration()->getApplication();  
  
    sfContext::switchTo($application);  
  
    $factories = sfFactoryConfigHandler::getConfiguration(ProjectConfiguration::getActive()->getConfigPaths('config/factories.yml'));  
  
    $class = $factories['routing']['class'];  
    $params = $factories['routing']['param'];  
  
    $params['context'] = array_merge(sfContext::getInstance()->getRequest()->getRequestContext(), $context);  
  
    $routing = new $class($this->getEventDispatcher(), null, $params);  
  
    sfContext::switchTo($current_application);  
  
    return $routing;  
  } 
}
