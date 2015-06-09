<?php

/**
 * Etabnonsco form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class EtabnonscoForm extends BaseEtabnonscoForm
{
  public function configure()
  {
   $this->widgetSchema['nometabnonsco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
   $this->widgetSchema['adresseetabnonscobat'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
   $this->widgetSchema['adresseetabnonscorue'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));
   $this->widgetSchema['faxetabnonsco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 80px;'));
   $this->widgetSchema['emailetabnonsco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 250px;'));
   
   
        // on commence par declarer les champs du formulaire
        $this->widgetSchema->setLabels(array(
            'nometabnonsco'     => 'Nom de l\'&eacute;tablissement :',
            'adresseetabnonscorue' => 'Adresse de l\'&eacute;tablissement :',
            'teletabnonsco'    	=> 'T&eacute;l&eacute;phone :',
            'faxetabnonsco'		=>	'Fax :',
            'emailetabnonsco'	=>	'Email',
            ));

  }
}
