²<?php

/**
 * PiecesDossier form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PiecesDossierForm extends BasePiecesDossierForm
{

    public function configure()
    {
		$this->widgetSchema->setLabels(array(
		'libellepiece' => 'piece',
		'restitue' => 'restitue',
		));
    // on redéfinit  mdph_id     
    $this->setWidget('mdph_id', new sfWidgetFormInputHidden());
    $this->setValidator('mdph_id', new sfValidatorString());
  
  
  /************ MODIF DU 25/03/2014 *******************************      
        if ($this->object->exists()) {
            $this->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
            $this->validatorSchema['delete'] = new sfValidatorPass();
        }
   *****************************************************************/ 
            $this->widgetSchema['daterecep'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['daterecep'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
   
	   $this->widgetSchema['libellepiece'] = new sfWidgetFormInputText(array(), array("style"=>'width: 350px;'));

    }

}
