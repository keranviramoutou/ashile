<?php

class frontendConfiguration extends sfApplicationConfiguration
{

    protected $academieRouting = null;

    public function generateAcademieUrl($name, $parameters = array())
    {
				  if ($_SERVER['HTTP_HOST'] == 'ashile2.ac-reunion.fr' && ($_SERVER['REMOTE_ADDR'] == '192.168.220.6' || $_SERVER['REMOTE_ADDR'] == '192.168.220.3') ) //portail.ac-reunion.fr
				  {
						 return 'https://portail.ac-reunion.fr/ashile/academie.php' . $this->getAcademieRouting()->generate($name, $parameters);
				
				} elseif ($_SERVER['HTTP_HOST'] == 'ashile.ac-reunion.fr' && ($_SERVER['REMOTE_ADDR'] == '192.168.220.6' || $_SERVER['REMOTE_ADDR'] == '192.168.220.3') ){
				
						 return 'https://portail.ac-reunion.fr/ashilep/academie.php' .$this->getAcademieRouting()->generate($name, $parameters);
				  } 
				
				 if ($_SERVER['HTTP_HOST'] == 'ashile2.ac-reunion.fr' && $_SERVER['REMOTE_ADDR'] == '172.31.176.121' ) //accueil accueil.in.ac-reunion.fr
				  {
						 return 'https://accueil.in.ac-reunion.fr/ashile/academie.php' . $this->getAcademieRouting()->generate($name, $parameters);
				 
				 } elseif($_SERVER['HTTP_HOST'] == 'ashile.ac-reunion.fr' && $_SERVER['REMOTE_ADDR'] == '172.31.176.121' ) {
				 
						 return 'https://accueil.in.ac-reunion.fr/ashilep/academie.php' . $this->getAcademieRouting()->generate($name, $parameters);
				  } 
    }

    public function getAcademieRouting()
    {
        if (!$this->academieRouting) {
            $this->academieRouting = new sfPatternRouting(new sfEventDispatcher());

            $config = new sfRoutingConfigHandler();
            $routes = $config->evaluate(array(sfConfig::get('sf_apps_dir') . '/academie/config/routing.yml'));

            $this->academieRouting->setRoutes($routes);
        }

        return $this->academieRouting;
    }

    public function configure()
    {
		sfWidgetFormSchema::setDefaultFormFormatterName('paragraph');
    }

}
