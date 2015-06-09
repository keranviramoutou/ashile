<?php

/**
 * Reunion form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReunionForm extends BaseReunionForm
{
  public function configure()
  {
        // ici on définit le format des champs de type date => on utilise un calendrier 'JQuery'
  
				 
				 
	          $this->widgetSchema['datereunion'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
		$this->validatorSchema['datereunion'] = new sfValidatorDate(   
			array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
				  "date_input"  => 'dd-MM-y',	
				  "date_output" => "Y-m-d",  //formate la valeur après validation pour envoie à la BDD
				 "required" =>  false));   
				 
			 
	$this->widgetSchema['libellereunion'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
        // on commence par declarer les champs du formulaire
        $this->widgetSchema->setLabels(array(
	"equipesuiviscolarite_id" => "Equipe de suivi de scolarité :",
	"libellereunion" 	=> "Intitulé ",
	"datereunion"		  =>  "Date ",
	"observation"		  =>  "Observations",
	"typereunion_id"		  =>  "Nature de la réunion",
            ));
			

	  $this->widgetSchema['typereunion_id'] = new sfWidgetFormDoctrineChoice(array(
	   'model' => $this->getRelatedModelName('TypeReunion'),
	  // 'query' => $query1,
		'add_empty'=>'',
		'order_by' => array('libelletypereunion', 'asc'),
	)); 
				
		//type reunion ordonné
		//---------------------
			$query1 = Doctrine_Query::create()
			->select('*')
			->from('TypeReunion t')
		    ->orderby ('t.libelletypereunion asc');

        // on redéfinit  eleve_id     
        $this->setWidget('eleve_id', new sfWidgetFormInputHidden());
        $this->setValidator('eleve_id', new sfValidatorString());
  }
}
