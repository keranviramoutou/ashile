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
  
		//liste globale des résultats de l'enquête
		//-----------------------------------------
        $this->dgescos  = Doctrine_Query::Create()
               ->select('d.id as DgescoId,o.id as OrientId,d.eleve_id as EleveId,e.nom as nom
			    ,e.prenom as prenom,s.libellesecteur as libellesecteur,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab ')
                ->from('Dgesco d ')
			//	->innerjoin('d.Anneescolaire a ON a.id = d.anneescolaire_id')
			    ->innerjoin('d.Eleve e ON e.id = d.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
                ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
                ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->groupby('d.eleve_id')
				->fetcharray();	
				
       	//compte le nombre de question de l'enquête
		//-----------------------------------------
        $this->questions  = Doctrine_Query::Create()
		->select('d.question')
		->from('Question d')
		->fetcharray(); 
         		
		 
	/*	//if($request->getParameter('eleve_id')){		
                $this->dgescos_detail  = Doctrine_Query::Create()
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
      //  } */
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
				
          
				
	//année scolaire en cours
	///////////////////////////
	$this->anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
				
	$this->clef_cryptage = $this->anneeScolaire.'azertyazertyazerty'.$this->dgescos[0]['libellesecteur'];

  }
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DgescoForm();
  }
  
    public function executeVidagedgesco(sfWebRequest $request)
  {
    //répertoire d'export de la table dgesco
	//--------------------------------------
	
    $uploadDir = sfConfig::get('sf_upload_dir') ;
	$this->fichier = 'dgesco-'.date('d-m-Y', time()).'.csv';
    $this->outstream = $uploadDir . '/exportbase/'.$this->fichier;
	
	 
	   $this->delimiter = ';';
	   $this->enclosure = '"';
	   $this->charset   = array('db' => 'UTF-8', 'ms' => 'WINDOWS-1252//TRANSLIT');
	   
	   sfConfig::set('sf_web_debug', false);
	   sfConfig::set('sf_escaping_strategy', false);
	   sfConfig::set('sf_charset', $this->options['ms'] ? $this->charset['ms'] : $this->charset['db']);
	 //   $this->getUser()->setFlash('notice','succès !!'.$_POST['vidage']);
	
	if($_POST['vidage'] == 1){
	
		// to modify the CSV output format in case of extreme necessity
		//$this->options = array('ms' => $request->hasParameter('ms'));

   
		$this->lines = Doctrine_Query::Create()
                ->select('id,eleve_id,anneescolaire_id,question_id,libelle_reponse,reponse_id')
                ->from('Dgesco d')
				->fetcharray();
   
 
 
	 //  $this->redirect('dgesco/vidagedgesco');
	 }else{
	 //$this->getUser()->setFlash('error','abandon de la procédure!!'.$_POST['vidage']); 
	 }
	
  }
  
      public function executeSupprindividuelle(sfWebRequest $request)
  {
  
		  if($_POST['eleve_id'] ){ // saisie des paramètres ok
		   
		    //recherche de l'élève pourqui on doit générer les questions de l'enquête DGESCO
			//-------------------------------------------------------------------------------
			$this->eleves = Doctrine_Query::Create()
			->select('*')
			->from ('Eleve e')
			->where('e.id = ?',$_POST['eleve_id'])
			->fetcharray();
			$count_eleve = count($this->eleves);   	


   	       	if ($count_eleve == 0 ){	
				 $this->getUser()->setFlash('error','l\'élève avec l\'Id ' .$_POST['eleve_id'] .' n\'existe pas dans la base !!'); 
				 $this->redirect('dgesco/supprindividuelle');
			}else{			
		  
		  	//recherche si l'élève est dans l'enquête DGESCO
			//----------------------------------------------
				$this->dgesco  = Doctrine_Query::Create()
				->select('*')
				->from ('Dgesco d')
				->where('d.eleve_id = ?',$_POST['eleve_id'])
				->fetcharray();
				$count_dgesco = count($this->dgesco);
				
		       	if ($count_dgesco == 0 ){	
				 $this->getUser()->setFlash('error','élève n\'est pas  actuellement dans le fichier d\'enquête, impossible de supprimer l\'enquête pour '.$this->eleves[0]['nom'].' '.$this->eleves[0]['prenom'].' ('.$this->eleves[0]['id'].' )'); 
				 $this->redirect('dgesco/supprindividuelle');
				}else{

				  $dgesco1 = Doctrine_Core::getTable('Dgesco')->findByEleveId($_POST['eleve_id']);
				  $dgesco1->delete();
				  $this->getUser()->setFlash('notice','les questions de l\'enquête DGESCO pour l\'élève :'.$this->eleves[0]['nom'].' '.$this->eleves[0]['prenom'].' ('.$this->eleves[0]['id'].' )'.' sont supprimées définitivement'); 
				  $this->redirect('dgesco/supprindividuelle?eleve_id='.$_POST['eleve_id']);
				  }
				
			 //Suppression des questions pour l'élève concerné dans l'enqûte DGESCO
				
				}//fin de test élève dans enquête DGESCO
				
			} //fin de test elève existe dans la base
		  
		  
  }
    public function executeGenerationindividuelle(sfWebRequest $request)
  {
  	if ($request->getParameter('flag')){ 
				if($_POST['eleve_id'] ){ // saisie des paramètres ok
				
						//année scolaire en cours
						//////////////////////////
						$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
							
						//liste des questions à créer pour chaque élève
						////////////////////////////////////////////////
						$this->questions = Doctrine_Query::Create()
									->select('q.id as question_id,q.question as question')
									->from('Question q')
									->execute();
						
						 //recherche si l'élève est dans l'enquête DGESCO
						 //----------------------------------------------
						$this->dgesco  = Doctrine_Query::Create()
						->select('*')
						->from ('Dgesco d')
						->where('d.eleve_id = ?',$_POST['eleve_id'])
						->fetcharray();
						$count_dgesco = count($this->dgesco);
						 
						//recherche de l'élève pourqui on doit générer les questions de l'enquête DGESCO
						//-------------------------------------------------------------------------------
						$this->eleves = Doctrine_Query::Create()
						->select('*')
						->from ('Eleve e')
						->where('e.id = ?',$_POST['eleve_id'])
						->fetcharray();
						$count_eleve = count($this->eleves);
				        
		                //recherche de la scolarité
						//-------------------------
						$this->orientation = Doctrine_Core::getTable('orientation')-> getDerSco($_POST['eleve_id']);
						$count_orientation = count($this->orientation);
						
						
						if ($count_eleve == 0 ){						//test élève existe et scolarisé dans l'année en cours

						   $this->getUser()->setFlash('error','élève inexistant !!'); 
					
							}else{							//élève existe
							
						  if($count_orientation == 0){
						   $this->getUser()->setFlash('error','élève n\'a de pas de scolarité en cours à la date du jour , imposible de générer l\'enquête !!'); 
						   }else{ //scolarité oridnaire ok
						
							// Ajout des questions à l'enquête DGESCO pour l'élève selectionné
							//---------------------------------------------------------------

							if ($count_dgesco == 0 && count($this->questions) > 0 ){
								foreach ($this->eleves as $eleve)
								{
									foreach ($this->questions as $question)
									{
										 $newdgesco = new Dgesco();
										 $newdgesco->setArray(array(
																'eleve_id'	=>$eleve['id'],
																'anneescolaire_id'	=> $anneeScolaire,
																'question_id'		=>	$question['question_id']
																));
										 $newdgesco->save();
				
									}
								}
								$this->getUser()->setFlash('notice',count($this->questions).' questions générée(s) dans la table Dgesco '.$count_orientation.' pour l\'élève : '.$this->eleves[0]['nom'].' '.$this->eleves[0]['prenom'].' ('.$this->eleves[0]['id'].' )'); // Pour les message	
							}else{
							$this->getUser()->setFlash('error','Génération des questions déjà effectuée!!! pour cet(te) élève : '.$this->eleves[0]['nom'].' '.$this->eleves[0]['prenom'].' ('.$this->eleves[0]['id'].' )'); // Pour les message}
							}
						}
						} //fin de test élève existe
						
				}else { //saisie des paramètres ok
				    $this->getUser()->setFlash('error','Saisir l\'identifiant de l\'élève'); 
				}
        } //fin de test flag
			
  }
  
  public function executeGeneration(sfWebRequest $request)
  {
  
       //Génération du questionnaire pour chaque élève scolarisé dans l'année en cours
	   //------------------------------------------------------------------------------
        $this->eleves = Doctrine_Core::getTable('Eleve')-> getListEleves();
	    //année scolaire en cours
		///////////////////////////
		$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
		
		//liste des questions à créer pour chaque élève
		////////////////////////////////////////////////
		$this->questions = Doctrine_Query::Create()
                ->select('q.id as question_id,q.question as question')
                ->from('Question q')
				->execute();
				
		$dgesco = Doctrine_Core::getTable('Dgesco');
		
		if (count($dgesco) == 0 && count($this->questions) > 0){
	        foreach ($this->eleves as $eleve)
            {
				foreach ($this->questions as $question)
				{
				
				    $newdgesco = new Dgesco();
					 $newdgesco->setArray(array(
											'eleve_id'	=>$eleve['id'],
											'anneescolaire_id'	=> $anneeScolaire,
							     			'question_id'		=>	$question['question_id']
											));
				     $newdgesco->save();

		
			}

			}
			$this->getUser()->setFlash('notice','nombre de ligne créés dans la table Dgesco :'.count($dgesco)); // Pour les message	
		}else{$this->getUser()->setFlash('error','Génération déjà effectuée, '.count($dgesco).' ligne(s) déja créés dans la table Dgesco : impossible de refaire la génération !!!, il faut vider la table DGESCO avant de refaire la génération'); // Pour les message}
		}

			
  }
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DgescoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($dgesco = Doctrine_Core::getTable('Dgesco')->find(array($request->getParameter('id'))), sprintf('Object dgesco does not exist (%s).', $request->getParameter('id')));
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
    $request->checkCSRFProtection();

    $this->forward404Unless($dgesco = Doctrine_Core::getTable('Dgesco')->find(array($request->getParameter('id'))), sprintf('Object dgesco does not exist (%s).', $request->getParameter('id')));
    $dgesco->delete();

    $this->redirect('dgesco/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $dgesco = $form->save();

      $this->redirect('dgesco/edit?id='.$dgesco->getId());
    }
  }
  public function executeAide(sfWebRequest $request){}
}
