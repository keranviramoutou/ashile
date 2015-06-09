<?php

/**
 * bilan actions.
 *
 * @package    ash
 * @subpackage bilan
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class bilanActions extends sfActions {

    function getBilanMdph(sfWebRequest $request) {
        $query = Doctrine_Core::getTable('Bilan')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'));
        return $query->execute();
    }

    public function executeIndex(sfWebRequest $request) {
        $this->bilans = $this->getBilanMdph($request);
    }

    public function executeList(sfWebRequest $request) {
        $this->bilans = $this->getBilanMdph($request);
		$this->countbilans=count($this->bilans);
		 $this->getUser()->setAttribute('mdph_id',$this->getRequestParameter('mdph_id'));
    }

    public function executeShow(sfWebRequest $request) {
        $this->bilan = Doctrine_Core::getTable('Bilan')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->bilan);
    }

    public function executeNew(sfWebRequest $request) {
        $bi = new Bilan();
        $bi->setMdphId($this->getRequestParameter('mdph_id'));
        $this->form = new BilanForm($bi);
		//gestion du retour sur la fiche élève dossier mdph  si on créé un nouvel spécialiste à partir des bilans
	      $this->getUser()->setAttribute('mdph_id',$this->getRequestParameter('mdph_id'));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new BilanForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($bilan = Doctrine_Core::getTable('Bilan')->find(array($request->getParameter('id'))), sprintf('il n\'y a pas de bilan (%s).', $request->getParameter('id')));
        $this->form = new BilanForm($bilan);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($bilan = Doctrine_Core::getTable('Bilan')->find(array($request->getParameter('id'))), sprintf('il n\'y a pas de bilan (%s).', $request->getParameter('id')));
        $this->form = new BilanForm($bilan);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        //$request->checkCSRFProtection();

        $this->forward404Unless($bilan = Doctrine_Core::getTable('Bilan')->find(array($request->getParameter('id'))), sprintf('il n\'y a pas de bilan (%s).', $request->getParameter('id')));
        $bilan->delete();

        $this->redirect('bilan/index?mdph_id=' . $request->getParameter('mdph_id'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form_param = $request->getParameter($form->getName());
        $form->bind($form_param, $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $bilan = $form->save();
            $this->getUser()->setFlash('succes', 'Enregistré avec succès');
            $this->redirect('bilan/edit?id=' . $bilan->getId() . '&Mdph_id=' . $bilan->getMdphId());
        }
    }

}
