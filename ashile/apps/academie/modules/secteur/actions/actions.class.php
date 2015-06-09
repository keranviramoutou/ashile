<?php

/**
 * secteur actions.
 *
 * @package    ash
 * @subpackage secteur
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class secteurActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->secteurs = Doctrine_Core::getTable('secteur')
      ->createQuery('a')
      ->execute();
  }

    public function executeRecherche(sfWebRequest $request)
  {
 
	if($_POST['secteur_id']){
	 $secteur = '%'.$request->getPostParameter('secteur_id').'%';
	 }
	   if ($request->isMethod('post')){
  
	   if (null != $_POST['secteur_id'] ){
	   
		 if( $_POST['secteur_id'] != '24') //liste des élèves par secteur
		 {
           $this->eleves = Doctrine_Core::getTable('Eleve')->getListElevesparSecteur($request->getParameter('secteur_id'));
	     }
	   
 
	   	 if( $_POST['secteur_id'] == '24' ) //élèves en attente de changement d'orientation 
		 {

        $annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $deb = $annee->getDatedebutanneescolaire();
        $fin = $annee->getDatefinanneescolaire();
	
        $this->eleves = Doctrine_query::create()
               ->select('e.id as eleve_id,e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,e.secteur_id as secteur_id,s.libellesecteur as libellesecteur,e.id as eleveId,
			   e.ine as ine,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab,o.id as orienId')
                ->from('Orientation o')
                ->innerJoin('o.Eleve e ON e.id = o.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
               ->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->where('t.nomtypeetablissement LIKE "%IEN%"')
			  ->andWhere('o.datedebut >=?', $deb)
               ->andWhere('o.datefin <=?', $fin)
				->orderBy('libellesecteur,et.nometabsco ASC,e.nom')
               ->addOrderBy('e.nom')
               ->fetchArray();
		$this->existeleve =count($this->eleves);
		
	   }
      }
	   }
	   
	//liste des Secteurs
	//--------------------
	$this->secteurs = Doctrine_Query::Create()
		->select('id as secteur_id,libellesecteur as libellesecteur')
		->from('Secteur s')
		->orderBy('libellesecteur')
		->fetcharray(); 
	
	} 
    public function executeRecherche1(sfWebRequest $request) //liste des affectation d'AVS par secteur
  {
 
	if($_POST['secteur_id']){
	 $secteur = '%'.$request->getPostParameter('secteur_id').'%';
	 }
	   if ($request->isMethod('post')){
	  
	  
	   if (null != $_POST['secteur_id'] ){

       // liste des élèves accompagnés par secteur
	   //------------------------------------------
		$secteur_id = $request->getParameter('secteur_id');
		$this->eleve_avss =Doctrine_Core::getTable('EleveAvs')->getListeEleveparSecteur($request->getParameter('secteur_id'));

      }
	   
	   }
	   
	//liste des Secteurs
	//--------------------
	$this->secteurs = Doctrine_Query::Create()
		->select('id as secteur_id,libellesecteur as libellesecteur')
		->from('Secteur s')
		->orderBy('libellesecteur')
		->fetcharray(); 
	
	} 
	
    public function executeRecherche2(sfWebRequest $request) //liste des AVS sans acc. par secteur
  {
 
	if($_POST['secteur_id']){
	 $secteur = '%'.$request->getPostParameter('secteur_id').'%';
	 }
	   if ($request->isMethod('post')){
	  
	  
	   if (null != $_POST['secteur_id'] ){

   		$secteur_id = $request->getParameter('secteur_id');
	   //liste des élèves sans personnel accompagnant
	   //---------------------------------------------
		$this->eleve_avss =Doctrine_Core::getTable('EleveAvs')->getEleveSansAcc($request->getParameter('secteur_id'));

      }
	   
	   }
	   
	//liste des Secteurs
	//--------------------
	$this->secteurs = Doctrine_Query::Create()
		->select('id as secteur_id,libellesecteur as libellesecteur')
		->from('Secteur s')
		->orderBy('libellesecteur')
		->fetcharray(); 
	
	} 
 
     public function executeRecherche3(sfWebRequest $request) //liste des AVS sans acc. par secteur
  {
    //liste des matériels par secteur pour éditon des bon de livraison demande matériel à affecté
	//----------------------------------------------------------------------------------------------
	if($_POST['secteur_id']){
	 $secteur = '%'.$request->getPostParameter('secteur_id').'%';
	 }
	   if ($request->isMethod('post')){
	  
	   if (null != $_POST['secteur_id'] ){
        
		
   		$secteur_id = $request->getParameter('secteur_id');
	   //liste des matériels non livrés dateremiserf non renseignée
		$this->Materielnonlivre = Doctrine_Query::Create()
			->select('s.id as secteur_id,etab.id as etabsco_id, e.id as eleve_id,t.id as typemateriel_id, 
			e.id as eleve_id, m.id as mdph_id, o.id as orientation_id, d.id as demandemateriel_id, 
			e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve,
			t.libelletypemateriel as typemateriel, e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, 
			m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur,
            em.datedebut as datedebut,em.datefin as datefin,em.id a elevemateriel_id,ma.numeromateriel as numeromateriel,			
			tr.id as traitemen_id,ca.libellecatmateriel as libellecatmateriel,ma.id as materiel_id,mr.libellemarque as libellemarque,
			em.dateremiseerf as dateremiserf,
			etab.nometabsco as nometabsco,etab.rne as rne,ty.id as type_id,ty.nomtypeetablissement as typetab')
			->from('DemandeMateriel d')
                        ->innerJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->innerJoin('m.Eleve e ON m.eleve_id = e.id')
					    ->innerJoin('d.Traitement tr ON d.traitement_id = tr.id')
						->innerJoin('d.Materiel ma ON d.materiel_id = ma.id')
						->innerJoin('ma.EleveMateriel em ON em.materiel_id = ma.id')
						->leftJoin('ma.Catmateriel ca ON ma.catmateriel_id = ca.id')
						->leftJoin('ma.Marque mr ON mr.id = ma.marque_id ')						 
						->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('d.Typemateriel t ON t.id = d.typemateriel_id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
						->leftjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
						->where('e.secteur_id = ?', $request->getParameter('secteur_id'))
						->andwhere('e.id = em.eleve_id')
						->andwhere('tr.libelletraitement LIKE "%AFFECTE%"')
						->fetchArray();
			   
		
	 $this->existconventionsMateriel = count($this->Materielnonlivre);
	   }
	 }
	//liste des Secteurs
	//--------------------
	$this->secteurs = Doctrine_Query::Create()
		->select('id as secteur_id,libellesecteur as libellesecteur')
		->from('Secteur s')
		->orderBy('libellesecteur Asc')
		->fetcharray(); 
	
	} 
    public function executeRecherche4(sfWebRequest $request) //liste des élèves par secteur, résultat enquête DGESCO
  {
 
	if($_POST['secteur_id']){
	 $secteur = '%'.$request->getPostParameter('secteur_id').'%';
	 }
	   if ($request->isMethod('post')){
	  
	  
	   if (null != $_POST['secteur_id'] ){

      
		$secteur_id = $request->getParameter('secteur_id');
		
		//liste globale des résultats de l'enquête par secteur
		//--------------------------------------------------
        $this->dgescos  = Doctrine_Query::Create()
               ->select('d.id as DgescoId,o.id as OrientId,d.eleve_id as EleveId,a.datedebutanneescolaire as anneescolaire,e.nom as nom
			    ,e.prenom as prenom,s.libellesecteur as libellesecteur,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,count(d.id) as titi,s.id as secteur_id ')
                ->from('Dgesco d ')
				->innerjoin('d.Anneescolaire a ON a.id = d.anneescolaire_id')
			    ->innerjoin('d.Eleve e ON e.id = d.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
                ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
                ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->where('s.id =?',$secteur_id)
				->groupby('d.eleve_id')
				->fetcharray();	
				
				
		 //compte le nombre de question de l'enquête
		//-----------------------------------------
		 //compte le nombre de question utilisées dans l'enquête 
		//-------------------------------------------------------
        $this->questions  = Doctrine_Query::Create()
	    ->select('q.question as question,q.id as question_id,q.num_question as num_question')
		->from('question q')
		->where ('q.id in (SELECT d.question_id FROM dgesco d GROUP BY d.question_id)')
		->fetcharray();	 
		
		//année scolaire en cours
		///////////////////////////
		$this->anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours()->getDatedebutanneescolaire();
					
		$this->clef_cryptage = $this->anneeScolaire.'azertyazertyazerty'.$this->dgescos[0]['libellesecteur'];

      }
	   
	   }
	   
	//liste des Secteurs
	//--------------------
	$this->secteurs = Doctrine_Query::Create()
		->select('id as secteur_id,libellesecteur as libellesecteur')
		->from('Secteur s')
		->orderBy('libellesecteur')
		->fetcharray(); 
	
	} 
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new secteurForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new secteurForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($secteur = Doctrine_Core::getTable('secteur')->find(array($request->getParameter('id'))), sprintf('Object secteur does not exist (%s).', $request->getParameter('id')));
    $this->form = new secteurForm($secteur);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($secteur = Doctrine_Core::getTable('secteur')->find(array($request->getParameter('id'))), sprintf('Object secteur does not exist (%s).', $request->getParameter('id')));
    $this->form = new secteurForm($secteur);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($secteur = Doctrine_Core::getTable('secteur')->find(array($request->getParameter('id'))), sprintf('Object secteur does not exist (%s).', $request->getParameter('id')));
    $secteur->delete();

    $this->redirect('secteur/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $secteur = $form->save();

      $this->redirect('secteur/edit?id='.$secteur->getId());
    }
  }
}
