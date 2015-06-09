<?php

require_once dirname(__FILE__).'/../symfony-1.4.13/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{

  public function setup()
  {
	$this->enablePlugins('sfTCPDFPlugin','sfPhpExcelPlugin','sfDoctrinePlugin','sfDoctrineGuardPlugin','sfJQueryUIPlugin','sfJqueryReloadedPlugin','sfFormExtraPlugin','ahDoctrineEasyEmbeddedRelationsPlugin','sfSslRequirementPlugin', 'sfAdminThemejRollerPlugin','isicsBreadcrumbsPlugin');
    //sfWidgetFormSchema::setDefaultFormFormatterName('list');	
  }

}
