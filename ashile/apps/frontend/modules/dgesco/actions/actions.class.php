<?php

/**
 * dgesco actions.
 *
 * @package    ash
 * @subpackage dgesco
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class dgescoActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
		$anneescolaire = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
		
		
		        $this->dgescos  = Doctrine_Query::Create()
               ->select('d.id as Dgesco_Id,q.id as id,q.question as question,d.libelle_reponse as libelle_reponse,q.num_question as num_question')
                ->from('Dgesco d')
				->innerjoin('d.Question q ON q.id = d.question_id')
				->where('d.eleve_id=?', $request->getParameter('eleve_id'))
                ->andWhere('d.anneescolaire_id=?', $anneescolaire->getId())
				->orderby('q.num_question ')
                ->execute();
				$this->count_dgesco =count($this->dgescos);		


	    $secteur_user = $this->getUser()->getAttribute('secteur');		
		
		//année scolaire en cours
		///////////////////////////
		$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
		

		//définition de la clef de cryptage
		/////////////////////////////////////		
		$this->clef_cryptage = $anneeScolaire.'azertyazertyazerty'.$secteur_user;
    }
	    public function executeComplete(sfWebRequest $request)
    {
	
				
		//remplissage des questions non renseignées avec la réponse "SANS OBJET"
		/////////////////////////////////////////////////////////////////////////
		$secteur_user = $this->getUser()->getAttribute('secteur');		
		
		//année scolaire en cours
		///////////////////////////
		$anneescolaire = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
		

		//définition de la clef de cryptage
		/////////////////////////////////////		
		$clef_cryptage = $anneescolaire->getDatedebutanneescolaire().'azertyazertyazerty'.$secteur_user;
		
		
		//liste des lignes de l'enquête (questions) sans réponse saisie
		//------------------------------------------------------------
		        $dgesco  = Doctrine_Query::Create()
               ->select('d.id as dgesco_id,q.id as id,q.question as question,d.libelle_reponse as libelle_reponse,q.num_question as num_question,d.question_id as question_id,d.reponse_id as reponse_id')
                ->from('Dgesco d')
				->innerjoin('d.Question q ON q.id = d.question_id')
				->where('d.eleve_id=?', $request->getParameter('eleve_id'))
                ->andWhere('d.anneescolaire_id=?', $anneescolaire->getId())
			    ->andWhere('d.libelle_reponse IS NULL or d.reponse_id IS NULL')
                ->execute();
				$count_dgesco = count($dgesco);	
			
			$flag2 = "RAS2";	
		    $flag1 = "RAS1";			
            
		if ($count_dgesco > 0){		
			 foreach ( $dgesco as  $dgescos)
            {
			//recherche de la réponse contenant "Sans objet" correspondant à la question de l'enquête
			  $reponse = Doctrine_Query::Create()
               ->select('r.question_id as question_id,r.id as reponse_id,r.libelle_reponse as libelle_reponse,r.reponse as reponse')
                ->from('Reponse r')
				->where('r.question_id =?', $dgescos['question_id'])
				->andwhere ('r.reponse LIKE "%SANS OBJET%" ')
				->limit(1)
                ->execute();
			  $count_reponse = count($reponse);
			
				$flag1 = "44444444 compte&nbsp;;".$count_reponse;
			 if($count_reponse === 1){
			 
			//Modification de la réponse_id si non renseigné eavec la réponse  "sans objet" correspondant à la question
					$majRep = Doctrine_Query::Create()
					->update('Dgesco d')
					->set('d.reponse_id', '?',$reponse[0]['reponse_id'])
					->where('d.id = ?', $dgescos['dgesco_id'])
					->andwhere ('d.libelle_reponse IS NULL')
					->execute();
					
				$flag2 = "good !!!!!";
			
				//cryptage de la réponse dans le champs libelle_reponse
				//------------------------------------------------------
				$libelle_reponse_crypte = $this->cryptage($reponse[0]['reponse'],$clef_cryptage);
				
			
				// --- la mise a jour de libelle_reponse avec la réponse sans objet-----------		
				//-----------------------------------------------------------------------------	
					$maj_libelle_reponse = Doctrine_Query::Create()
					->update('Dgesco d')
					->set('d.libelle_reponse', '?',$libelle_reponse_crypte )
					->where('d.id = ?', $dgescos['dgesco_id'])
					->execute();
			 } //test si réponse "SANS OBJET" existe
			}	//fin foreach		
			$this->getUser()->setFlash('notice','Les questions pour lesquelles vous ne souhaitez pas saisir de réponse sont passées à "SANS OBJET"'.$count_dgesco);
		}else{
		$this->getUser()->setFlash('error','impossible de faire ce traitement , il n\'y a pas de question sans réponse renseignée !!');
		}
        //$this->redirect('eleve/edit?eleve_id='.$request->getParameter('eleve_id'));
	
       $this->redirect('dgesco/index?eleve_id='.$request->getParameter('eleve_id').'#div_dgesco');
    }
	
	  public function executeIndex1(sfWebRequest $request)
  {
	
		
        $this->dgescos  = Doctrine_Query::Create()
               ->select('d.id as DgescoId,q.id as id,o.id as OrientId,d.eleve_id as EleveId,q.question as question,d.libelle_reponse as libelle_reponse,a.datedebutanneescolaire as anneescolaire,e.nom as nom
			    ,e.prenom as prenom,s.libellesecteur as libellesecteur,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,
				e.nom as nom,e.prenom as prenom,e.datenaissance as datenaissance ')
                ->from('Dgesco d')
		//		->innerjoin('d.Reponse r ON r.id = d.reponse_id')
				->innerjoin('d.Question q ON q.id = d.question_id')
				->innerjoin('d.Anneescolaire a ON a.id = d.anneescolaire_id')
			    ->innerjoin('d.Eleve e ON e.id = d.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
                ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
                ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->where ('d.eleve_id=?',$request->getParameter('eleve_id'))
				->fetcharray();		
		}
		
		
 public function executeMessage(sfWebRequest $request)
  {
   //message données DGESCO bien enregistrée
   $this->getUser()->setFlash('notice','réponse(s) de l\'enquête enregistrée(s)');
   $this->redirect('dgesco/list1');
    }
    public function executeList(sfWebRequest $request)
  {
      //liste globale des résultats de l'enquête par secteur
		//--------------------------------------------------
			
			//Dernière scolarisation
			//-----------------------
				$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
				$deb = $annee->getDatedebutanneescolaire();
				$fin = $annee->getDatefinanneescolaire();
				
				
		 $secteur = $this->getUser()->getAttribute('secteur');		
		 $this->dgescos  = Doctrine_Query::Create()
               ->select('d.id as DgescoId,o.id as OrientId,d.eleve_id as EleveId,a.datedebutanneescolaire as anneescolaire,e.nom as nom
			    ,e.prenom as prenom,s.libellesecteur as libellesecteur,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,s.id as secteur_id')
                ->from('Dgesco d ')
				->innerjoin('d.Anneescolaire a ON a.id = d.anneescolaire_id')
			    ->innerjoin('d.Eleve e ON e.id = d.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
                ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
                ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->where('s.id =?',$secteur->getId())
				->andWhere('o.datedebut >=?', $deb)
               ->andWhere('o.datefin <=?', $fin)
				->groupby('d.eleve_id')
				->fetcharray();	
				
				
		 //liste et compte le nombre de question utilisées dans l'enquête 
		//-------------------------------------------------------
        $this->questions  = Doctrine_Query::Create()
	    ->select('q.question as question,q.id as question_id,q.num_question as num_question')
		->from('question q')
		->where ('q.id in (SELECT d.question_id FROM dgesco d GROUP BY d.question_id)')
		->fetcharray();	
		 $this->nbquestions = count( $this->questions );
		
		//année scolaire en cours
		///////////////////////////
		$this->anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
					
		$this->clef_cryptage = $this->anneeScolaire.'azertyazertyazerty'.$this->dgescos[0]['libellesecteur'];
  }
  

     public function executeList1(sfWebRequest $request)
	{
  	//Saisie en masse des réponses à l'Enquête DGESCO
	/////////////////////////////////////////////////
	
	
	   	//compte le nombre de question utilisées dans l'enquête 
		//-------------------------------------------------------
        $questions  = Doctrine_Query::Create()
	    ->select('q.question as question,q.id as question_id')
		->from('question q')
		->where ('q.id in (SELECT d.question_id FROM dgesco d GROUP BY d.question_id)')
		->fetcharray();
        $this->nbquestions =count($questions );		
		
		
		//Dernière scolarisation
		//-----------------------
				$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
				$deb = $annee->getDatedebutanneescolaire();
				$fin = $annee->getDatefinanneescolaire();
		
		//liste globale des résultats de l'enquête par secteur
		//--------------------------------------------------
		
		$secteur = $this->getUser()->getAttribute('secteur');		
        $this->dgescos  = Doctrine_Query::Create()
               ->select('d.id as dgesco_id,o.id as OrientId,d.eleve_id as EleveId,a.datedebutanneescolaire as anneescolaire,e.nom as nom
			    ,e.prenom as prenom,s.libellesecteur as libellesecteur,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,
				s.id as secteur_id,q.question as question,q.id as question_id,r.id as reponse_id,r.reponse as reponse,d.libelle_reponse as libelle_reponse,q.num_question as num_question')
                ->from('Dgesco d ')
				->innerjoin('d.Anneescolaire a ON a.id = d.anneescolaire_id')
				->innerjoin('d.Question q ON q.id = d.question_id')
				->leftjoin('d.Reponse r ON r.id = d.reponse_id')
			    ->innerjoin('d.Eleve e ON e.id = d.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
                ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
                ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->where('s.id =?',$secteur->getId())
				->andWhere('o.datedebut >=?', $deb)
               ->andWhere('o.datefin <=?', $fin)
				->orderby('et.rne,e.nom,d.id')
				->fetcharray();	
				
		 //construction de la clef de cryptage
		//-----------------------------------
		
		//année scolaire en cours
		///////////////////////////
		$this->anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
				
		$this->clef_cryptage = $this->anneeScolaire.'azertyazertyazerty'.$this->dgescos[0]['libellesecteur'];
			 
	 if(strlen($request->getParameter('lesreps')) > 1 ){
	 
	 
	    //construction de la clef de cryptage
		//-----------------------------------
		
		//année scolaire en cours
		///////////////////////////
		$this->anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
				
		$this->clef_cryptage = $this->anneeScolaire.'azertyazertyazerty'.$this->dgescos[0]['libellesecteur'];
		
		//Récupération de la liste des réponses
		//---------------------------------------
		//$this->getUser()->setFlash('notice','gggaaaqqq'.$request->getParameter('lesreps'));
		
		
	   	$listrep =explode(",",$request->getParameter('lesreps') );
		$count=count($listrep) ;
		$listrep= array_chunk($listrep, 2) ; //redimensionne la variable en tableau à 2 dimensions
	
		if($count == 2){
		$limit = 1;
		}else{
		$limit = $count -1;
		}

			
       	// --- la mise a jour de réponse_id -----------		
        //--------------------------------------------		
        for($ligne = 0; $ligne < count($listrep); $ligne++) {

					$majRep = Doctrine_Query::Create()
					->update('Dgesco d')
					->set('d.reponse_id', '?',$listrep[$ligne][1] )
					->where('d.id = ?', $listrep[$ligne][0])
				//	->andwhere ('d.libelle_reponse = "" ')
					->execute();
		
				//recherche du libelle de la réponse
				//-------------------------------------
				$reponse = Doctrine_Query::create()
				->select('r.id as id,r.reponse as reponse')
				->from('Reponse r')
				->where('r.id = ?', $listrep[$ligne][1])
				->limit(1)
				->execute();
				
		
				//cryptage de la réponse dans le champs libelle_reponse
				//------------------------------------------------------
				$libelle_reponse_crypte = $this->cryptage($reponse[0]['reponse'],$this->clef_cryptage);
			
				// --- la mise a jour de libelle_reponse-----------		
				//---------------------------------------------------	
					$maj_libelle_reponse = Doctrine_Query::Create()
					->update('Dgesco d')
					->set('d.libelle_reponse', '?',$libelle_reponse_crypte )
					->where('d.id = ?', $listrep[$ligne][0])
				//	->andwhere ('d.libelle_reponse = "" ')
					->execute();	

				// --- mise à jour reponse_id a blanc-----------		
				//---------------------------------------------------	
				/*	$maj_libelle_reponse = Doctrine_Query::Create()
					->update('Dgesco d')
					->set('d.reponse_id', 'NULL' )
					->where('d.id = ?', $listrep[$ligne][0])
					->execute();  */
                					

		}
		  $this->getUser()->setFlash('notice','réponse(s) de l\'enquête enregistrée(s)');
		 $this->getUser()->setAttribute('dgesco',1);
		 $this->redirect('dgesco/message?eleve_id='.'tutu');  //affichage message dans popup
		 	//$this->getUser()->setFlash('error','listrep '.$listrep[0][1].' id '.$listrep[0][0].' count '.$reponse[0]['reponse'].'clef'.$this->clef_cryptage);
		}
		
  }
    public function executeShow(sfWebRequest $request)
    {
        $this->dgesco = Doctrine_Core::getTable('Dgesco')->find(array($request->getParameter('id')));
        //$this->reponse = Doctrine::getTable('Reponse')->findOneById($this->dgesco->getReponseId());
               
        $this->forward404Unless($this->dgesco);
    }
	
	
	

    public function executeNew(sfWebRequest $request)
    {
		$anneescolaire = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
	
        $dgesco = new Dgesco();
        $dgesco->setEleveId($request->getParameter('eleve_id'));
        $dgesco->setAnneescolaireId($anneescolaire->getId());
        $this->form = new DgescoForm($dgesco);
    }

    public function executeAjaxReponse(sfWebRequest $request)
    {
        //$reponses = Doctrine_Core::getTable('Reponse')->findByQuestionId($request->getParameter('question_id'));
		//recherche du degré établissement scolarité en cours
		
		$dersco = Doctrine_Core::getTable('Orientation')->getDerSco($request->getParameter('eleve_id'));
		        $reponses  = Doctrine_Query::Create()
               ->select('*')
                ->from('Reponse r ')
				->where('r.degreteabsco = ?',1 )
				->fetcharray();	
        return $this->renderPartial('dgesco/selectReponse', array('reponses' => $reponses, 'selected' => $request->getParameter('selected')));
    }
    

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DgescoForm();

		//$this->form->setLibellereponse($this->getUser()->getAttribute('reponse'));

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {

	// je commence pas tester user connecté (est il  connu par l'appli?)
	$user = Doctrine_core::getTable('sfGuardUser')
		->findOneByEmailAddress($_SERVER['HTTP_CTEMAIL']);
			
	// on cherche le secteur de l'utilisateur (un secteur = un utilisateur)
			$secteur = Doctrine_core::getTable('Secteur')
			->findOneBySfguarduserId($user->getId());
				
	//année scolaire en cours
	///////////////////////////
	$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
				
	$this->clef_cryptage = $anneeScolaire.'azertyazertyazerty'.$secteur;
				
    $this->forward404Unless($dgesco = Doctrine_Core::getTable('Dgesco')->find(array($request->getParameter('id'))), sprintf('Object dgesco does not exist (%s).', $request->getParameter('id')));
    //affectation d'une variable question_id utilisé pour récupéré le numéro de la question dans DgescoForm.class.php
    $this->getUser()->setAttribute('question_id',$dgesco->getQuestionId());
	 $this->form = new DgescoForm($dgesco);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($dgesco = Doctrine_Core::getTable('Dgesco')->find(array($request->getParameter('id'))), sprintf('Object dgesco does not exist (%s).', $request->getParameter('id')));
        $this->form = new DgescoForm($dgesco);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($dgesco = Doctrine_Core::getTable('Dgesco')->find(array($request->getParameter('id'))), sprintf('Object dgesco does not exist (%s).', $request->getParameter('id')));
        $dgesco->delete();

        $this->redirect('dgesco/index?eleve_id='. $dgesco->getEleveId());
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $param = $request->getParameter($form->getName());
        $form->bind($param, $request->getFiles($form->getName()));
        if ($form->isValid()) {
   
            $dgesco = $form->save();
			
				//recherche de la réponse
				//-------------------------------------
				$reponse = Doctrine_Query::create()
				->select('r.id as id,r.reponse as reponse')
				->from('Reponse r')
				->where('r.id = ?', $dgesco->getReponseId())
				->limit(1)
				->execute();
				
				//libelle du secteur de l'ERF
				//////////////////////////////////
				$secteur_user = $this->getUser()->getAttribute('secteur');
				
				//année scolaire en cours
				///////////////////////////
				$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
				
				//contruction dela clef de cryptage
				///////////////////////////////////
				$clef_cryptage = $anneeScolaire.'azertyazertyazerty'.$secteur_user;
				
		 /////////////////////////////////////////////////////////////////////		
         //cryptage de la réponse et mise à blan de reponse_id table DGESCO
		 /////////////////////////////////////////////////////////////////////
			
			if($reponse[0]['reponse']){
			
			    //mise à jour  et cryptage de la réponse littérale  et mise à blanc de réponse_id
				//----------------------------------------------------------------------------------
				// $dgesco->setLibelleReponse($reponse[0]['reponse']);
				 $dgesco->setLibelleReponse($this->cryptage($reponse[0]['reponse'],$clef_cryptage));
				// $dgesco->setReponseId(); //remise à blanc de la réponse selectionnée désactivée le temps de l'enquête
		        
			
			}
				 $dgesco->save();
			    //recherche de la question sauvegardée
				//------------------------------------------
				$question_recherche = Doctrine_Query::create()
				->select('q.num_question as num_question,q.id as question_id')
				->from('question q')
				->where('q.id =?', $dgesco->question_id)
				->limit(1)
				->execute();
				
				 $this->getUser()->setFlash('dgescoSuccess', 'Réponse à la question n° '.$question_recherche[0]['num_question'].' enregistrée avec succès');
			
			
			
			    //recherche de la question suivante à traiter
				//------------------------------------------
				$dgesco_recherche = Doctrine_Query::create()
				->select('q.id as dgesco_id,q.question_id as question_id,q.reponse_id as reponse_id,q.eleve_id as eleve_id')
				->from('dgesco q')
				->where('q.id !=?', $dgesco->id)
				->andwhere('q.eleve_id =?', $dgesco->eleve_id)
				->andwhere('q.question_id !=?', $dgesco->question_id)
				->andwhere('q.reponse_id is Null')
				->limit(1)
				->execute();
				$count_recherche = count($dgesco_recherche);
				
				
            
			if($count_recherche == 1 ){ //passage à la question suivante pour le même élève reponse_id non renseignée
				$this->redirect('dgesco/edit?id=' .$dgesco_recherche[0]['dgesco_id'].'&eleve_id='.$dgesco->getEleveId().'#div_dgesco');
			}else{
					$this->redirect('dgesco/index?id=' . $dgesco->getId().'&eleve_id='.$dgesco->getEleveId().'#div_dgesco');
				 
			}
           // $this->redirect('dgesco/index?id=' . $dgesco->getId().'&eleve_id='.$dgesco->getEleveId().'#div_dgesco');
			
	
			
        }else{
		//$this->getUser()->setFlash('dgescoSuccess', 'erreur');
		}
		 

    }
	
	 protected function cryptage($reponse,$clef) {
		// on crypte le champ reponse
		//$data = $this->getReponse();
		// -- creation d'une clef unique et temporaire (une par / an)
	   
		try {
				$options = Array (
					'encryption_key' => $clef,
					'data_to_encrypt' => $reponse
				);
		
			$e = new AES($options);
			$enc = $e->encrypt();
			//$dec = $e->decrypt();
			
			//$this->setReponse($enc);
			//echo "The encrypted Base64/AES string is:  ".$enc."<br />The decrypted Base64/AES string is:  ".$dec;
		   
		}catch(Exception $e){
			 return $e->getMessage();
		}
	    return $enc;
    }
	
public function executeAide(){}	

}
