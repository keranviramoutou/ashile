<?php

/**
 * modnonsco actions.
 *
 * @package    labo
 * @subpackage modnonsco
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class modnonscoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

        $this->param = '0';
				 
		//Scolarité en milieu ordinaire en cours dans l'année scolaire 
		//----------------------------------------------------------------
		$this->orientations = Doctrine_core::getTable('Orientation')->getDerSco($this->getRequestParameter('eleve_id')) ;  

   //     $anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();

	    $this->modnonscos =  Doctrine_Query::create()
                ->select('a.datedebut as datedebut,a.datefin as datefin,a.quothorreff as quothorreff,e.nometabnonsco as nometabnonsco,a.id as modnonsco_id,e.id as etabnonsco_id
				,d.libelledemijournee as libelledemijournee,a.eleve_id as eleve_id,n.niveauscolaire as niveauscolaire,c.libelle_classe_spe as libelle_classe_spe')
			    ->from ('Modnonsco a')
				->innerjoin('a.Etabnonsco e on e.id = a.etabnonsco_id')
				->leftjoin('a.Niveauscolairespe n on n.id = a.niveauscolairespe_id')
				->leftjoin('a.Demijournee d on d.id = a.demijournee_id')
				->leftjoin('a.Classespe c on c.id = a.classespe_id')
				->where('a.eleve_id =?', $this->getRequestParameter('eleve_id'))
				->andwhere('a.datedebut <=?',date('Y-m-d', time()))
				->andWhere('a.datefin IS NULL OR a.datefin >=?', date('Y-m-d', time()))
				->fetcharray();

  }

    public function executeList(sfWebRequest $request)
    {
	
	 //Historique des scolarisations en milieu spécialisé
	 //--------------------------------------------------
        $this->param = '1';
        
        $anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();

    	    $this->modnonscos =  Doctrine_Query::create()
                ->select('a.datedebut as datedebut,a.datefin as datefin,a.quothorreff as quothorreff,e.nometabnonsco as nometabnonsco,a.id as modnonsco_id,e.id as etabnonsco_id
				,d.libelledemijournee as libelledemijournee,a.eleve_id as eleve_id,c.libelle_classe_spe as libelle_classe_spe')
			    ->from ('Modnonsco a')
				->innerjoin('a.Etabnonsco e on e.id = a.etabnonsco_id')
				->leftjoin('a.Demijournee d on d.id = a.demijournee_id')
				->leftjoin('a.Classespe c on c.id = a.classespe_id')
				->where('a.eleve_id =?', $this->getRequestParameter('eleve_id'))
				->andWhere('a.datedebut <?',date('Y-m-d', time()))
				->andWhere('a.datefin IS NULL OR a.datefin <=?', date('Y-m-d', time()))
				->fetcharray();
    }

  public function executeShow(sfWebRequest $request)
  {
	$this->param = $this->getRequestParameter('param');
    $this->modnonsco = Doctrine_Core::getTable('Modnonsco')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->modnonsco);
  }
  
    public function executeShowHisto(sfWebRequest $request)
    {
		$this->modnonsco = Doctrine_Core::getTable('Modnonsco')->find(array($request->getParameter('id')));
		$this->forward404Unless($this->modnonsco);		
	}

  public function executeNew(sfWebRequest $request) {
         

        $modnonsco = new Modnonsco();
        $modnonsco->setEleveId($this->getRequestParameter('eleve_id'));
        $this->form = new ModnonscoForm($modnonsco);
		
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
    $this->forward404Unless($modnonsco = Doctrine_Core::getTable('Modnonsco')->find(array($request->getParameter('id'))), sprintf('cette scolarisation en etablissement specialise n\'existe pas (%s).', $request->getParameter('id')));
    $this->form = new ModnonscoForm($modnonsco);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($modnonsco = Doctrine_Core::getTable('Modnonsco')->find(array($request->getParameter('id'))), sprintf('cette scolarisation en etablissement specialise n\'existe pas (%s).'));
    $this->form = new ModnonscoForm($modnonsco);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();
    $this->forward404Unless($modnonsco = Doctrine_Core::getTable('Modnonsco')->find(array($request->getParameter('id')
    )), sprintf('Object modnonsco does not exist (%s).',$request->getParameter('id')));
    $modnonsco->delete();

    $this->redirect('modnonsco/index?eleve_id=' . $request->getParameter('eleve_id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
			//Scolarité en milieu ordinaire en cours dans l'année scolaire 
			//----------------------------------------------------------------
			$this->orientations = Doctrine_core::getTable('Orientation')->getDerSco($form->getValue('eleve_id')); 
			
        if ($this->orientations[0]['libelledemijournee'] != 'Temps complet'){		//test si scolarité ordinaire à Temps complet !
			$modnonsco = $form->save();
			$this->getUser()->setFlash('succes', 'Scolarité en milieu spécialisé enregistrée avec succès');
			$this->redirect('modnonsco/edit?id='.$modnonsco->getId());
	  		}else{
			$this->getUser()->setFlash('error', 'Impossible de créer scolarité en milieu spécialisé, scolarité en cours en milieu ordinaire à Temps complet ');
			$this->redirect('modnonsco/index');
			}
	}
	// $this->redirect('modnonsco/index');
  }
  
  public function executeAide(){}
}
