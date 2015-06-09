<?php

/**
 * mouvement_materiel actions.
 *
 * @package    ash
 * @subpackage mouvement_materiel
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mouvement_materielActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->mouvement_materiels = Doctrine_Core::getTable('MouvementMateriel')
      ->createQuery('a')
      ->execute();
  }
  

  public function executeNew(sfWebRequest $request)
  {
	$materielId = $request->getParameter('materiel_id');
	
	//selection d'un matériel avec ses mouvements
	//---------------------------------------------
	$this->materiels= Doctrine_Core::getTable('Materiel')->getMateriel($materielId);
	$count_mat = count($this->materiels);
	
	sfContext::getInstance()->getUser()->setAttribute('materiel_id', $materielId); //variable globale utilisée dans le processform pour mettre à jour la date de fin du dernier mouvement du matériel,
	
	$mouvementmateriel = new MouvementMateriel();
	$mouvementmateriel->setMaterielId($materielId);  
    $this->form = new MouvementMaterielForm($mouvementmateriel,$this->materiels);
	
	
  }
  public function executePopup(sfWebRequest $request)
  {
    
     //$this->setLayout(false);
	 //$this->addJavascript('jquery.ui.datepicker-fr.js');
	// ----------- on trouve le contrat_avs en cours ------------
	$materielId = $request->getParameter('materiel_id');

	// ----------- on crée un objet mouvementmateriel
	$mouvementmateriel = new MouvementMateriel();
	// ----------- on donne le contratAvsid a cet objet ---------
	$mouvementmateriel->setMaterielId($materielId); 
	// ----------- on crée le form por cet objet ----------------
	
	 
	// passage de l'attribut
	sfContext::getInstance()->getUser()->setAttribute('materiel_id', $materielId); 
    $this->form = new MouvementMaterielForm($mouvementmateriel);
   
  }
  
   public function executeMessage(sfWebRequest $request)
  {
      //affichage message de sauvegarde enregistrement
    }
  
    public function executeAjoutMouvement(sfWebRequest $request)
  {
			$materielId = $request->getParameter('materiel_id');
			
			//selection d'un matériel avec ses mouvements
			//---------------------------------------------
			$this->materiels= Doctrine_Core::getTable('Materiel')->getMateriel($materielId);
			$this->count_mat = count($this->materiels);
			
    		$this->mouvements = Doctrine_Query::create()
					->select('*')
					->from('Mouvement')
					->fetchArray();
	
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MouvementMaterielForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mouvement_materiel = Doctrine_Core::getTable('MouvementMateriel')->find(array($request->getParameter('id'))), sprintf('Object mouvement_materiel does not exist (%s).', $request->getParameter('id')));
    $this->form = new MouvementMaterielForm($mouvement_materiel);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mouvement_materiel = Doctrine_Core::getTable('MouvementMateriel')->find(array($request->getParameter('id'))), sprintf('Object mouvement_materiel does not exist (%s).', $request->getParameter('id')));
    $this->form = new MouvementMaterielForm($mouvement_materiel);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($mouvement_materiel = Doctrine_Core::getTable('MouvementMateriel')->find(array($request->getParameter('id'))), sprintf('Object mouvement_materiel does not exist (%s).', $request->getParameter('id')));
    $mouvement_materiel->delete();
     $this->getUser()->setFlash('notice', 'mouvement supprimé avec succès pour le matériel '.$mouvement_materiel->getMateriel().' mouvement de type : ' .$mouvement_materiel->getMouvement().' du '.date('d/m/Y',strtotime($mouvement_materiel->getDatedebut())));
    //$this->redirect('mouvement_materiel/index');

      $myValue = $request->getParameter('popup'); //test récupération d'unevariable passer dans un link
    
         $this->redirect('materiel/edit?id='.$mouvement_materiel->getMaterielId());
  
	
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
	    
	 //récupération des valeurs saisies avant sauvegarde
     //---------------------------------------------------------	 
			$mouvement_id = $form->getValue('mouvement_id');
			$materiel_id = $form->getValue('materiel_id');
			$datedebut = $form->getValue('datedebut');
			
	//rechercher du libelle du mouvement
    //-----------------------------------
      $libellemouve = Doctrine_Query::create()
	              -> select ('m.nommouvement as nommouvement')
				  ->from('Mouvement m')
				  ->where('m.id = ?',$mouvement_id)
				  ->fetchArray();
     	
			
	  // -- recherche du dernier mouvement de ce materiel ----
	  //--------------------------------------------------------
	  $materiel_id = $this->getUser()->getAttribute('materiel_id');//récupération de la variable globale définit plus haut par sfContext::getInstance()->getUser()
	  	    				$res = Doctrine_Query::create()
							->select('p.materiel_id as materiel_id,MAX(datedebut) as datedebut,MAX(p.id) as id')
							->from('Mouvementmateriel p')
							->where('p.datefin is null')
							->groupBy('p.materiel_id')
							->having('p.materiel_id = ?', $materiel_id)
							->fetchArray();
					         $count_res = count($res);
							 
	  //selection du dernier mouvement------
	  //------------------------------------
	  	  	    			$dermouv = Doctrine_Query::create()
							->select('m.datefin as datefin, t.nommouvement a nommouvement,m.id as MouvId,t.id as typeId')
							->from('Mouvementmateriel m')
							->innerjoin('m.Mouvement t ON t.id = m.mouvement_id')
							->where('m.id = ?', $res[0]['id'])
							->fetchArray();
					         $count_dermouv = count($res);
  
	   // contrôle que le dernier mouvement et de type différent à celui saisie
	   //-----------------------------------------------------------------------

		if($dermouv[0]['typeId'] !=  $mouvement_id)
		{
		$mouvement_materiel = $form->save(); //sauvegarde de l'enregistrement saisi
		
	      $this->getUser()->setFlash('notice', 'mouvement enregistré avec succès'. $form->getObject()->getMouvement());
	  	    if($count_res > 0 ){	
				
		//mise à jour de la date de fin du dernier mouvement avec la date de de début du nouveau mouvement créé
		//-------------------------------------------------------------------------------------------------------
	

				$majDate = Doctrine_Query::create()
						->update('Mouvementmateriel p ')
						->set('p.datefin','?' , $mouvement_materiel ->getDatedebut())
						->where('p.id = ?', $dermouv[0]['MouvId']);
					

				$majDate->execute();
			}
		

		
		  if($count_res > 0 )
		  {
		   $this->redirect('mouvement_materiel/message');
		 //  $this->getUser()->setFlash('notice', 'mouvement enregistré avec succès'.'  le précédent mouvement clôturé à la date du '. $mouvement_materiel->getDatedebut());
		  }else{
		  $this->redirect('mouvement_materiel/message');  //affichage message dans popup
	      // $this->getUser()->setFlash('notice', 'mouvement enregistré avec succès');
		   
		  }
	      $this->redirect('materiel/edit?id='.$mouvement_materiel->getMaterielId());
    	}else{  // test si mouvement de type différent
	     $this->getUser()->setFlash('error','impossible d\'enregistrer ce mouvement le précedent du '.  $datedebut.' est du même type : '. $libellemouve[0]['nommouvement']);
		 $this->redirect('materiel/edit?id='.$materiel_id);
		} // fin de test si mouvement de type différent	 
  
	 
	 
	 
    }
  }
}
