<?php

/**
 * avs actions.
 *
 * @package    ash
 * @subpackage avs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class avsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->avss = Doctrine_Core::getTable('Avs')
      ->createQuery('a')
      ->execute();
  }
  
  


  public function executeShow(sfWebRequest $request)
  {
    $this->avs = Doctrine_Core::getTable('Avs')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->avs);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AvsForm();
  }
    public function executeRecherche(sfWebRequest $request)
  {
    		$avs_nom = '%'.$_POST['nom_avs'].'%'; 
            $avs_nomjf = '%'.$_POST['avs_nomjf'].'%'; 			
			$avs_prenom = '%'.$_POST['prenom_avs'].'%';
			
			
  	 //recherche sur le nom  usuel
     //--------------------------------------
			
	if ($request->isMethod('post')){
		 if(null != $_POST['nom_avs']|| null != $_POST['prenom_avs']) //recherche sur le nom
		 {
   
			$this->resultat = Doctrine_Query::Create()
			->select ('a.id as id,nom as nom,prenom as prenom,date_naissance as datenaissance,a.nom_nais as nom_nais,a.id as avs_id')
			->from('Avs a')
			->where('a.nom LIKE ?', $avs_nom)
			->andwhere ('a.prenom LIKE ?', $avs_prenom)
			->fetchArray(); 
			$this->existavss = count($this->resultat);	
			if($this->existavss > 60) {
			$this->getUser()->setFlash('notice','plus de 60 lignes de résultat retournées, affiner votre recherche  pour: ' .$_POST['nom_avs'].' '.$_POST['prenom_avs']); 
            $this->redirect('avs/recherche?avs_nom='.$avs_nom);
			}
		}	
		if(null != $_POST['avs_nomjf'] || null != $_POST['prenom_avs'])  //recherche sur le nom de jeune fille
		 {
   
			$this->resultat = Doctrine_Query::Create()
			->select ('id as id,nom as nom,prenom as prenom,date_naissance as datenaissance,a.nom_nais as nom_nais,a.id as avs_id')
			->from('Avs a')
			->where ('a.nom_nais LIKE ?', $avs_nomjf)
			->andwhere ('a.prenom LIKE ?', $avs_prenom)
			->fetchArray(); 
			$this->existavss = count($this->resultat);	
			if($this->existavss > 60) {
			$this->getUser()->setFlash('notice','plus de 60 lignes de résultat retournées, affiner votre recherche  pour: ' .$_POST['avs_nomjf'].' '.$_POST['prenom_avs']); 
            $this->redirect('avs/recherche?avs_nomjf='.$avs_nomjf);
			}
			 
           //  $this->form = new AvsForm($resultat,$avs_nom,$contrat_avss,$existcontratavs);
		}
			 
           //  $this->form = new AvsForm($resultat,$avs_nom,$contrat_avss,$existcontratavs);
		
	}else{
		if($request->getParameter('avs_nom')){ 
		$this->resultat = Doctrine_Query::Create()
				->select ('a.id as id,nom as nom,prenom as prenom,date_naissance as datenaissance,a.nom_nais as nom_nais,a.id as avs_id')
				->from('Avs a')
				->where ('a.nom LIKE ?', $request->getParameter('avs_nom'))
			//	->andwhere ('a.prenom LIKE ?', $avs_prenom)
				->fetchArray(); 
				$this->existavss = count($this->resultat);
		
		}
	 
		if($request->getParameter('avs_nomjf')){ 
		$this->resultat = Doctrine_Query::Create()
				->select ('id as id,nom as nom,prenom as prenom,date_naissance as datenaissance,a.nom_nais as nom_nais,a.id as avs_id')
				->from('Avs a')
				->where ('a.nom_nais LIKE ?', $request->getParameter('avs_nomjf'))
			//	->andwhere ('a.prenom LIKE ?', $avs_prenom)
				->fetchArray(); 
				$this->existavss = count($this->resultat);	
		}			
	 
	}
	

  }
  
   public function executeComment()
{
 
	if(!$this->getRequest()->isXmlHttpRequest()):
 
		$this->getResponse()->setContent('<p align="center">Error: This page may only be accessed via Ajax Request.</p>');
 
	else:
 
		$contrat = new Mail();
		//$contrat->setCommentText($this->getRequestParameter('comment'));
 
		//$contrat->save();
 
		$this->getResponse()->setContent('<p align="center">NOTE ADDED</p>');
 
	endif;
 
	return sfView::NONE;
} 

  
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AvsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
	 	  // Liste des contrats pour l'avs selectionné
		  //-------------------------------------------
		   $this->ContratEnCour = Doctrine_Query::Create()
				->select ('a.nom as avsnom,a.prenom as avsprenom,c.id as contratId,a.id as avsid,
				c.temps_hebdo as temps_hebdo,c.date_debut_contrat as date_debut_contrat,c.date_fin_contrat as date_fin_contrat,et.id as etid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,tc.typecontrat as typecontrat')
				->from('ContratAvs c')
				->innerJoin('c.Avs a ON a.id = c.avs_id')
				->leftjoin('c.Etabsco et ON  et.id = c.etabsco_id')
				->leftjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->leftjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
				->where('c.avs_id =?',$request->getParameter('id'))
				->orderBy('id','DESC')
				->fetcharray();
			  $this->count_ContratEnCour = count($this->ContratEnCour);
			  
		$this->forward404Unless($avs = Doctrine_Core::getTable('Avs')->find(array($request->getParameter('id'))), sprintf('Object avs does not exist (%s).', $request->getParameter('id')));
		$this->form = new AvsForm($avs);
	

  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($avs = Doctrine_Core::getTable('Avs')->find(array($request->getParameter('id'))), sprintf('Object avs does not exist (%s).', $request->getParameter('id')));
    $this->form = new AvsForm($avs);
    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    		
  // liste de tout les contrats  pour l'avs selectionne
	 //-----------------------------------------------------
	$ListContrat = Doctrine_Core::getTable('ContratAvs')->ListeContratsAcc($request->getParameter('id'));
	$existContrat =count($ListContrat);
	$this->forward404Unless($avs = Doctrine_Core::getTable('Avs')->find(array($request->getParameter('id'))), sprintf('Object avs does not exist (%s).', $request->getParameter('id')));
    $avs_nom =$avs->getNom(); 
    $avs_prenom =$avs->getPrenom();  
  
	if ($existContrat == 0)
	{
	
    $avs->delete();
	$this->getUser()->setFlash('notice','Avs supprimé : ' .$avs_nom.' '.$avs_prenom); 
     $this->redirect('avs/recherche');
	}else{
	$this->getUser()->setFlash('error','impossible de le supprimer,il existe des contrats pour cette avs: ' .$avs_nom.' '.$avs_prenom); 
     $this->redirect('avs/recherche?avs_nom='.$avs_nom);
	}
	
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
	
    if ($form->isValid())
    {
      $avs = $form->save();
	  $this->getUser()->setFlash('notice','Enregistrement sauvegardé pour :'.$form->getobject()); // Pour les messages
	  

	   $this->redirect('avs/edit?id='.$form->getobject()->getId().'&avs_nom='.$avs->nom.'&avs_prenom='.$avs->prenom); 
	  //$this->redirect('avs/recherche?avs_nom='.$form->getobject()->getNom());
	  
    }
  }
  
  
   public function executeAide(){}
}
