<?php

/**
 * modnondco actions.
 *
 * @package    ash
 * @subpackage modnondco
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class modnonscoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	/*  
    $this->modnonscos = Doctrine::getTable('Modnonsco')
      ->createQuery('a')
      ->execute();
    */
    
    $this->modnonscos = Doctrine_Query::Create()
							->select('*')
							->from('Modnonsco m')
							->Where('m.datefin >=?', date('Y-m-d', time()))
							->orderBy('m.datedebut asc')
							->fetchArray();
	
	
  }
  
  public function executeNew(sfWebRequest $request)
  {
	$eleve = $request->getParameter('eleve_id');
	$classespe = $request->getParameter('classespe_id');
	$demijournee = $request->getParameter('demijournee_id');
	
	$modnonsco = new Modnonsco();
	$modnonsco->setEleveId($eleve);
	$modnonsco->setClassespeId($classespe);
	$modnonsco->setDemijourneeId($demijournee);

    $this->form = new ModnonscoForm($modnonsco);
    
    // passage de la variable 'demandeavs_id'
   	  $this->getUser()->setAttribute('demandeorientation_id', $request->getParameter('demandeorientation_id'));  
			
  }

  public function executeAjaxMns(sfWebRequest $request)
  {
	  // fonction Ajax qui permet d'afficher les eleves inscrits dans l'etab non sco selectionné
	  $this->eleveMnss = Doctrine_Query::Create()
								->select('m.id, e.id, s.id, et.id, cl.id, s.libellesecteur as secteur, e.nom as nom, e.prenom as prenom, et.nometabnonsco as nomEtab, cl.libelle_classe_spe as nomClasse, m.datedebut as debut, m.datefin as fin')
								->from('Modnonsco m')
								->innerJoin('m.Eleve e ON m.eleve_id = e.id')
								->innerJoin('e.Secteur s ON e.secteur_id = s.id')
								->innerJoin('m.Etabnonsco et ON m.etabnonsco_id = et.id')
								->innerJoin('m.Classespe cl ON cl.id = m.classespe_id')
								->where('m.etabnonsco_id = ?', $request->getParameter('etabnonsco_id'))
								->andWhere('m.datefin >= ?',  date('Y-m-d', time()))
								->fetchArray();
					
 		$this->existeleveMns = count($this->eleveMnss); 
        return $this->renderPartial('modnonsco/infoMns');			
  }	


  public function executeCreate(sfWebRequest $request)
  {

    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ModnonscoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($modnonsco = Doctrine::getTable('Modnonsco')->find(array($request->getParameter('id'))), sprintf('Object modnonsco does not exist (%s).', $request->getParameter('id')));
    
    $this->etabs = $modnonsco->getEtabnonscoId();
    
    $this->form = new ModnonscoForm($modnonsco);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($modnonsco = Doctrine::getTable('Modnonsco')->find(array($request->getParameter('id'))), sprintf('Object modnonsco does not exist (%s).', $request->getParameter('id')));
    $this->form = new ModnonscoForm($modnonsco);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($modnonsco = Doctrine::getTable('Modnonsco')->find(array($request->getParameter('id'))), sprintf('Object modnonsco does not exist (%s).', $request->getParameter('id')));
    $modnonsco->delete();

    $this->redirect('modnonsco/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $modnonsco = $form->save();
      $this->getUser()->setFlash('notice', 'Enregistré avec succés');
      // update 
      
      $demandeorientationId =  $this->getUser()->getAttribute('demandeorientation_id');
      if($demandeorientationId){
								Doctrine_Query::Create()
							->update('DemandeOrientation do')
							->set('do.traite', true)
							->where('do.id = ?', $demandeorientationId)
							->execute();
							 
	  }


    }
    // ---- test pour erreurs !!---------
		else{
			foreach($form->getErrorSchema()->getErrors() as $e)
			{
				$this->getUser()->setFlash('test',  $e->__toString()); // Pour les message echo $e->__toString();          
			}
			// ------------------------------------v

		  }
	$this->redirect('demandeorientation/list');	  
  }
}

