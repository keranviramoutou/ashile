<?php

/**
 * DetailCommande form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DetailCommandeForm extends BaseDetailCommandeForm
{
  public function configure()
  {

	$this->widgetSchema['quantite'] = new sfWidgetFormInput(array('default' => 1));
	$this->setValidator('quantite', new sfValidatorNumber());	

	$this->widgetSchema['datelivraison'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',));
	$this->validatorSchema['datelivraison'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));

        $this->widgetSchema->setLabels(array(
	'typemateriel_id' => 'Type de materiel',
	'datelivraison' => 'Date de livraison:',
	));

		/*
        $this->embedRelations(array(
            'Commande' => array(
                'considerNewFormEmptyFields' => array(),
                'noNewForms' => true,
                'newFormLabel' => false,
                'formClassArgs' => array(array('ah_add_delete_checkbox' => false)),
            )
        ));
        */
			$this->setWidget('commande_id', new sfWidgetFormInputHidden());
			$this->setValidator('commande_id', new sfValidatorString());        
  }
}
