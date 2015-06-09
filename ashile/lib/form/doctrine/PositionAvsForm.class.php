<?php

/**
 * PositionAvs form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PositionAvsForm extends BasePositionAvsForm
{
  public function configure()
  {
              //unset($this['contratavs_id']);
              //$this->widgetSchema['datedebut'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true,"culture" => sfContext::getInstance()->getUser()->getCulture(), 'format_date' => 'dd-MM-y'));
              //$this->widgetSchema['datefin'] = new sfWidgetFormDateJQueryUI(array('changeMonth' => true, 'changeYear' => true,"culture" => sfContext::getInstance()->getUser()->getCulture(), 'format_date' => 'dd-MM-y'));
              
	$this->widgetSchema['datedebut'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	$this->validatorSchema['datedebut'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));
	
	$this->widgetSchema['datefin'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	$this->validatorSchema['datefin'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD.
				 "required" =>  false));

        $this->setWidget('contratavs_id', new sfWidgetFormInputHidden());
        $this->setValidator('contratavs_id', new sfValidatorString());
	
  }
}
