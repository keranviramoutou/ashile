<?php

/**
 * tuteur actions.
 *
 * @package    ash
 * @subpackage tuteur
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tuteurActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->tuteurs = Doctrine_Core::getTable('Tuteur')
                ->createQuery('a')
                ->where('a.eleve_id =?', $this->getRequestParameter('eleve_id'))
                ->execute();
    }

    public function executeShow(sfWebRequest $request) {
        $this->tuteur = Doctrine_Core::getTable('Tuteur')->find(array($request->getParameter('eleve_id'),
        $request->getParameter('responsableeleve_id')));
        $this->forward404Unless($this->tuteur);
    }

    public function executeNew(sfWebRequest $request) {
        $tuteur = new Tuteur();
        $tuteur->setEleveId($request->getParameter('eleve_id'));
		$eleve = $tuteur->getEleve();
         
        // initialisation des champs addresse du tuteur avec les champs addresse de l'eleve
			
      if($eleve->getAdresseelevebat()){
			$this->adresseBat = $eleve->getAdresseelevebat();
		}else{
		$this->adresseBat = "";
		}

		if($eleve->getAdresseleverue()){	
			$this->adresseRue = $eleve->getAdresseleverue();
		}else{
		$this->adresseRue = "";
		}
				
		if($eleve->getQuartierId()){	
			$this->quartierId = $eleve->getQuartierId();
		}else{
		$this->quartierId = "";
		}

		$this->nom = $eleve->getNom();	
		
		
		
		$this->form = new TuteurForm($tuteur);
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new TuteurForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($tuteur = Doctrine_Core::getTable('Tuteur')->find(array($request->getParameter('eleve_id'),
        $request->getParameter('responsableeleve_id'))), sprintf('Object tuteur does not exist (%s).', $request->getParameter('eleve_id'), $request->getParameter('responsableeleve_id')));
        sfContext::getInstance()->getUser()->setAttribute('typeResponsableEleveId', $tuteur->getTyperesponsableeleveId());
        $this->form = new TuteurForm($tuteur);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($tuteur = Doctrine_Core::getTable('Tuteur')->find(array($request->getParameter('eleve_id'),
            $request->getParameter('responsableeleve_id'))), sprintf('Object tuteur does not exist (%s).', $request->getParameter('eleve_id'), $request->getParameter('responsableeleve_id')));
        $this->form = new TuteurForm($tuteur);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

        $this->forward404Unless($tuteur = Doctrine_Core::getTable('Tuteur')->find(array($request->getParameter('eleve_id'),
        $request->getParameter('responsableeleve_id'))), sprintf('Object tuteur does not exist (%s).', $request->getParameter('eleve_id'), $request->getParameter('responsableeleve_id')));
        $tuteur->delete();
          $this->getUser()->setFlash('succes', 'Responsable supprimé avec succès');
        $this->redirect('tuteur/index?eleve_id=' . $request->getParameter(eleve_id));
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $tuteur = $form->save();
           // $this->updateTuteurLegal($tuteur);
            $this->getUser()->setFlash('succes', 'Responsable enregistré avec succès');
            
			$this->redirect('tuteur/index?eleve_id='. $tuteur->getEleveId());
			
        }
    }

    protected function updateTuteurLegal($tuteur) {
        if ($tuteur->getTuteurlegal() == '1') {
            Doctrine_Query::create()
                    ->update('Tuteur t')
                    ->set('t.tuteurlegal', 0)
                    ->where('t.eleve_id = ?', $tuteur->getEleveId())
                    ->andWhere('t.responsableeleve_id <> ?', $tuteur->getResponsableeleveId())
                    ->execute();
        }
    }
    
    public function executeAide()
    {
	}

}
