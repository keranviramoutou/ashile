<?php

/**
 * sfGuardUser form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {

        $this->widgetSchema['created_at'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));
        $this->widgetSchema['updated_at'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true));

        // ici on donne un aspect plus ergonomique aux labels du formulaire
        $this->widgetSchema->setLabels(array(
            'first_name' => 'Nom :',
            'last_name' => 'Prénom :',
            'username' => 'Pseudo :',
            'algorithm' => 'Algorithme:',
            'password' => 'Mot de passe :',
            'is_active' => 'Actif :',
            'created_at' => 'Date de creation :',
            'updated_at' => 'Date de mise a jour :',
            'notes' => '',	
	));

	unset($this['is_super_admin'], $this['groups_list'], $this['permissions_list'], $this['last_login'], $this['password']);

  }
}
