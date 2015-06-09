<?php

/**
 * DemandeAvs actions.
 *
 * @package    ash
 * @subpackage DemandeAvs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DemandeAvsActions extends sfActions
{
	 public function executeDetail(sfWebRequest $request)
    {
		$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();		
        $this->demande_avss = Doctrine_Core::getTable('DemandeAvs')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
              //  ->andWhere('a.datefinnotif >?', $anneeScolaire->getDatedebutanneescolaire())	// condition la fin de notif                
                ->execute();
    }

    public function executeIndex(sfWebRequest $request)
    {
        $this->demande_avss = Doctrine_Core::getTable('DemandeAvs')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
		$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
     //   $this->demande_avss = Doctrine_Core::getTable('DemandeAvs')->findByMdphId($this->getRequestParameter('mdph_id'));
			$this->demande_avss = Doctrine_Query::create()
	 		->Select('d.id as DemandeAvsId,m.id as MdphId,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,
			d.quotitehorrairenotifie as quotitehorrairenotifie,n.naturecontrat as naturecontrat, d.decisioncda as decisioncda')
			->from('DemandeAvs d')
			->innerJoin('d.Mdph m ON m.id = d.mdph_id')
			->leftJoin('d.Naturecontratavs n ON d.naturecontratavs_id = n.id')
			->where('d.mdph_id=?', $this->getRequestParameter('mdph_id'))
		    ->execute();
 
    }

    public function executeList(sfWebRequest $request)
    {
		$anneeScolaire = Doctrine_core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $this->demande_avss = Doctrine_Core::getTable('DemandeAvs')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->andWhere('a.datefinnotif >?', $anneeScolaire->getDatedebutanneescolaire())	// condition la fin de notif
                ->execute();
		$this->countdemande = count($this->demande_avss);
    }

    public function executeNew(sfWebRequest $request)
    {
	    $da = new DemandeAvs();
	    // --- la date de création de la demande à la date du jour ---
	    $da->setDateDemandeAvs(date('Y-m-d',time())); 
	    if( !$request->getParameter('mdph_id')){
      
        $da->setMdphId($this->getRequestParameter('mdph_id'));
  
		}else{
		 $da->setMdphId($request->getParameter('mdph_id'));
		}
		
		//recherche du type avs à ND
		//-----------------------------
		
		 $typeavs = Doctrine_Query::create()
				->select('t.id as typeavs_id')
				->from('naturecontratavs t')
				->where('t.naturecontrat LIKE "%ND%"')
				->limit(1)
				->execute();
 
		 $da->setNaturecontratavsId($typeavs[0]['typeavs_id']);		 
         $this->form = new DemandeAvsForm($da);
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DemandeAvsForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($demande_avs = Doctrine_Core::getTable('DemandeAvs')->find(array($request->getParameter('id'))), sprintf('Cette demande n\'existe pas (%s).', $request->getParameter('id')));
        $this->form = new DemandeAvsForm($demande_avs);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($demande_avs = Doctrine_Core::getTable('DemandeAvs')->find(array($request->getParameter('id'))), sprintf('cette demande n\'existe pas (%s).', $request->getParameter('id')));
        $this->form = new DemandeAvsForm($demande_avs);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
        $this->forward404Unless($demande_avs = Doctrine_Core::getTable('DemandeAvs')->find($request->getParameter('id')), sprintf('cette demande n\'existe pas (%s).', $request->getParameter('id')));
        $demande_avs->delete();

        $this->redirect('demandeavs/new?mdph_id=' . $request->getParameter('mdph_id'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form_param = $request->getParameter($form->getName());
        $form->bind($form_param, $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $demande_avs = $form->save();
            $this->getUser()->setFlash('succes', 'Demande d\'accompagnement enregistrée avec succès');
            $this->redirect('demandeavs/edit?id=' . $demande_avs->getId(). '&mdph_id='. $demande_avs->getMdphId());
        }else{
			$this->getUser()->setFlash('error', 'Demande d\'accompagnement n\'est pas enregistrée ');
		}
    }

}
