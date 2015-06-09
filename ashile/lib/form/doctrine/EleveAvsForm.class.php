<?php
 /** * EleveAvs form. *
  * @package ashile
  * @subpackage form 
  * @author Your name here 
  * @version SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmiath $
  */ 
class EleveAvsForm extends BaseEleveAvsForm
{

    public function configure()
    {
	
		$this->widgetSchema['quotitehorraireavs'] = new sfWidgetFormInput(array('default' => 1),array("style"=>'width: 20px;'));
		$this->widgetSchema['datedebut'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
	

        $this->validatorSchema['datedebut'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd-MM-y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" =>  false));
                     	
         $this->widgetSchema['datefin'] = new monWidgetFormDateJQueryUI(array('changeMonth' => true,'changeYear' => true,'date_format' => 'dd/MM/yyyy',),array('size' => 10));
         $this->validatorSchema['datefin'] = new sfValidatorDate(   
                array("date_format" => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~' , //regex,
	   				  "date_input"  => 'dd/MM/y',	
                      "date_output" => "Y/m/d",  //formate la valeur après validation pour envoie à la BDD
                     "required" => false)); 
	   
	   
        // selection des personnels accompagnant qui ont un contrat en cours a la date du jour
        // et qui nont pas de postion à la date du  jour
        //-----------------------------------------------------------------------------------
         $pos =  Doctrine_Query::Create()
         ->select('p.contratavs_id')
         ->from('PositionAvs p');

         $queryAvsValid = Doctrine_Query::Create()
		  ->select('a.nom as nom,c.date_fin_contrat as date_fin_contrat,c.commentaire as commentaire,c.temps_hebdo as temps_hebdo,
		  c.date_debut_contrat as date_debut_contrat,c.date_fin_contrat as date_fin_contrat')
          ->from('Avs a')
          ->innerjoin('a.ContratAvs c ON a.id = c.avs_id')
          ->where('c.date_fin_contrat > DATE(NOW())')
          ->andwhere ('a.id NOT IN (' . $pos . ')')
		  ->orderby ('a.nom,a.prenom');

        $this->widgetSchema['avs_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => $this->getRelatedModelName('Avs'),
                    'add_empty' => 'Choisissez avec un contrat valide...',
                    'query' => $queryAvsValid,
					'method' => 'getAvscontratenCours', //method définie dans avs.class.php retourne les champs affichés dans le select
                ));

        $this->setValidator('avs_id', new sfValidatorDoctrineChoice(array(
                    'model' => 'Avs',
                )));
		$this->validatorSchema['avs_id'] = new sfValidatorPass(); 
		
  
      
		  $this->setWidget('eleve_id', new sfWidgetFormInputHidden());
        $this->setValidator('eleve_id', new sfValidatorString());
		
        
        if (sfContext::getInstance()->getActionName() == 'edit' || sfContext::getInstance()->getActionName() == 'update' || sfContext::getInstance()->getActionName() == 'miseAjour' ){
			$this->setWidget('avs_id', new sfWidgetFormInputHidden());
			$this->setValidator('avs_id', new sfValidatorString());
		}
		
			//--- pour palier aux erreurs à l'enregistrement on crée un champ _csrf_token qui ne s'affiche pas -------
			//--------------------------------------------------------------------------------------------------------
			$this->setWidget('_csrf_token', new sfWidgetFormInputHidden());
			$this->widgetSchema['_csrf_token'] = new sfWidgetFormInputText(array(), array("style"=>'width: 0px;'));
			$this->setValidator('_csrf_token' , new sfValidatorString());
			//--------------------------------------------------------------------------------------------------------
			//--------------------------------------------------------------------------------------------------------
		
    }


    
    
}
