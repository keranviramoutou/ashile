<?php

/**
 * demandemateriel actions.
 *
 * @package    ash
 * @subpackage demandemateriel
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandematerielActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
        $this->demandemateriels = Doctrine_Core::getTable('DemandeMateriel')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->demande_materiel);
    }

    public function executeList(sfWebRequest $request)
    {
        $this->demandemateriels = Doctrine_Core::getTable('DemandeMateriel')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
		$this->countdemande = count($this->demandemateriels);
    }

    public function executeNew(sfWebRequest $request)
    {
       $dm = new Demandemateriel();
        
       $dm->setMdphId($this->getRequestParameter('mdph_id'));
  
        // --- la date de création de la demande à la date du jour ---
       $dm->setDateDemandeMateriel(date('Y-m-d',time()));
        
       $this->form = new DemandeMaterielForm($dm);
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DemandeMaterielForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($demandemateriel = Doctrine_Core::getTable('DemandeMateriel')->find(array($request->getParameter('id'))), sprintf('Object demande_materiel does not exist (%s).', $request->getParameter('id')));
        $this->form = new DemandeMaterielForm($demandemateriel);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($demande_materiel = Doctrine_Core::getTable('DemandeMateriel')->find(array($request->getParameter('id'))), sprintf('Object demande_materiel does not exist (%s).', $request->getParameter('id')));
        $this->form = new DemandeMaterielForm($demande_materiel);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
        $this->forward404Unless($demandemateriel = Doctrine_Core::getTable('DemandeMateriel')->find($request->getParameter('id')), sprintf('Object demandemateriel does not exist (%s).', $request->getParameter('id')));
        $demandemateriel->delete();

        $this->redirect('demandemateriel/index?mdph_id=' . $request->getParameter('mdph_id'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form_param = $request->getParameter($form->getName());
        $form->bind($form_param, $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $demandemateriel = $form->save();

            $this->getUser()->setFlash('succes', 'Demande matériel enregistrée avec succès');
            $this->redirect('demandemateriel/edit?id=' . $demandemateriel->getId());
        }else{
		  $this->getUser()->setFlash('error', 'Demande matériel non enregistrée ');
		}
    }

}
