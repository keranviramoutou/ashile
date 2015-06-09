<?php

/**
 * Reponse form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ReponseForm extends BaseReponseForm
{
  public function configure()
  {
	// on fait en sorte que seules les reponses liées aux questions soient proposées
	
	   /*  $this->widgetSchema['question_id'] = new sfWidgetFormDoctrineChoice(array(
                   'model' => $this->getRelatedModelName('Question'),
                   'query' => $query,
					//'table_method' => array('method' => 'getEleveAvecCDA', 'type' =>1),
					//'method' => 'getEleveCda', //method définie dans eleve.class.php retourne les champs affichés dans le select
                    'add_empty' => 'Selectionner :',
                )); 
				
					$query = Doctrine_Query::create()
					 ->select ('q.id as question_id')
					->from('Question q')
	      			->Where('question_id =?', 2)	; */
					
	//		  $this->setWidget('question_id', new sfWidgetFormInputHidden());
    //          $this->setValidator('question_id', new sfValidatorString());
	
$this->widgetSchema['question_id'] =  new sfWidgetFormInputHidden();
$this->widgetSchema['reponse'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
$this->widgetSchema['degreetabsco'] = new sfWidgetFormInputText(array(), array("style"=>'width: 40px;'));
$this->widgetSchema['num_reponse'] = new sfWidgetFormInputText(array(), array("style"=>'width: 40px;'));
$this->widgetSchema['libelle_reponse'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));	 


 $choixListe = array('0'=> 'Tous les degrés','1' => '1er Degré', '2'=> '2nd Degré' );
 $this->widgetSchema['degreetabsco'] = new sfWidgetFormSelect(
            array(
                'multiple' => false,
                'choices' => array('degré'=>$choixListe
                ),
              )
        );

  }
}
