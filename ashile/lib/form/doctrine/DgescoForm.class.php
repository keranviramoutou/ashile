<?php

/**
 * Dgesco form.
 *
 * @package    ash974
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DgescoForm extends BaseDgescoForm
{

    public function configure()
    {
        $this->setWidget('eleve_id', new sfWidgetFormInputHidden());
        $this->setValidator('eleve_id', new sfValidatorString());
        
        
        $this->widgetSchema['anneescolaire_id'] = new sfWidgetFormInputHidden();
        $this->setDefault('anneescolaire_id', Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getId());
 
       
        $this->widgetSchema['reponse_id']->setLabel('Reponse :');
		
		
        $this->widgetSchema['reponse_id']->setOption('add_empty', 'Choisissez une réponse');
        $this->widgetSchema['reponse_id']->setAttribute('id', 'reponse');
		
		//Dernière scolarisation pour récupérer le degré de l'établissement scolaire
		//et selectionner ensuite les réponses qui sont du même degré scolaire
		// si degreetabsco de reponse = 0 alors toutes les réponses sont affichées
	   //-------------------------------------------------------------------------
				$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
				$deb = $annee->getDatedebutanneescolaire();
				$fin = $annee->getDatefinanneescolaire();
		      

			  $eleve_id = sfContext::getInstance()->getUser()->getAttribute('eleve_id');
			  
			//Récupération de la variable définit dans l'action edit du module Dgesco (frontend)
			$question_id = sfContext::getInstance()->getUser()->getAttribute('question_id');   
			   
	    		$dersco =  Doctrine_Query::create()
               ->select('o.id as orienId,et.degreetabsco as degreetabsco,e.id as eleve_id')
               ->from('Orientation o')
               ->innerJoin('o.Eleve e ON e.id = o.eleve_id')
               ->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
               ->andWhere('o.datedebut >=?', $deb)
               ->andWhere('o.datefin <=?', $fin)
			   ->andwhere('o.eleve_id = ?', $eleve_id)
			   ->andWhere('o.datefin >=?', date('Y-m-d', time()))
			   ->execute();
			   
			 //selection des réponses qui ont le même degré que l'établissement de la scolarité en cours  
			   $choix_reponse = Doctrine_Query::create()
			  ->select('*')
			  ->from('Reponse r')
			  ->where('r.degreetabsco = ?',$dersco[0]['degreetabsco'])
			  ->andwhere('r.question_id = ?',$question_id);
			  
			  
			 //selection des réponses en fonction de la question 
			   $choix_reponse1 = Doctrine_Query::create()
			  ->select('*')
			  ->from('Reponse r')
			  ->andwhere('r.question_id = ?',$question_id);
			 
			  
			  $choix_reponse2 = Doctrine_Query::create()
			  ->select('*')
			  ->from('Reponse r')
			  ->innerJoin('r.Question q ON r.question_id = q.id')
			  ->andwhere('r.question_id = ?',$question_id)
			  ->andwhere('r.degreetabsco != ?',0)
			  ->execute();
			  $count_choixrep = count($choix_reponse2);
			   
		if($count_choixrep != 0){	 
        //si degre etabsco renseigné sur la réponse
        		
		$this->widgetSchema['reponse_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Reponse',
					'query' => $choix_reponse,
                    'add_empty' => '',
                ));
        }else{
		 //si degre etabsco renseigné sur la réponse
				$this->widgetSchema['reponse_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Reponse',
					'query' => $choix_reponse1,
			        'add_empty' => '',
                ));
		}
	
		$this->widgetSchema['question_id']->setLabel('Question :');
        $this->widgetSchema['question_id']->setOption('add_empty', 'Choisissez une question');
        $this->widgetSchema['question_id']->setAttribute('id', 'question');
		$this->widgetSchema['question_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Question',
                    'add_empty' => 'Choisissez',
					
                ),array("style"=>'width: 200px;'));
		
        
        $this->widgetSchema['libelle_reponse'] = new sfWidgetFormInputText(array(), array("style"=>'width: 200px;','maxlength' => '100'));
        $this->widgetSchema['libelle_reponse']->setLabel('Réponse complémentaire :');
        $this->setDefault('libelle_reponse', $this->getOption('libelle_reponse'));
        
        $this->validatorSchema->setOption('allow_extra_fields', true);
        $this->useFields(array('eleve_id', 'anneescolaire_id', 'question_id', 'reponse_id', 'libelle_reponse'));
		
		
		// Recuperation de eleve_id depuis le form eleve
        $eleve_id = sfContext::getInstance()->getUser()->getAttribute('eleve_id');
	
			//Récupération des reponses éléves
		
			 $res1s = Doctrine_Query::create()
						->select('d.question_id as question_id')
						->from('Dgesco d')
						->Where('d.eleve_id =?',  $eleve_id)
                        ->execute()	;					
             $count_rep = count( $res1s);
			 
		    $message='Chosissez une question';	 
		
	if( sfContext::getInstance()->getActionName() == 'new'){		 
        if( $count_rep > 0  ) {
		
        $resArrays = array();
        $i = 0;
        //stockage des questions dans un tableau
         foreach ($res1s as $res1) {
             $resArrays[++$i] = $res1['question_id'];
		
        }	
		
		echo '<br>'.$resArrays[0];

			  $res2s = Doctrine_Query::create()
						->select('*')
						->from('Question q')
						->WhereNotIn('q.id ', $resArrays);	
						
		if(count($res2) == 0){
		$message = 'plus de question à renseigner';
		}

		$this->widgetSchema['question_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Question',
                    'query' => $res2s,
                    'add_empty' => $message,
                ));

        } // fin count_rep
	}else{
		$this->widgetSchema['question_id'] = new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Question',
                //    'query' => $query,
                    'add_empty' => 'Choisissez',
                ));
    }
				
			 if(sfContext::getInstance()->getConfiguration()->getApplication() == 'frontend')
        {
		// on enlève la réf à la quetion Id Id qui est connue
		//-------------------------------------------------------
			 $this->setWidget('question_id', new sfWidgetFormInputHidden());
	    }	
		
    }
	
 public function executeAide(){}
}
