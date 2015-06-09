<?php

/**
 * professeur actions.
 *
 * @package    ash
 * @subpackage professeur
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class professeurActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
        $this->personnes = Doctrine_Core::getTable('Personne')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        
        // Recuperation de l'id correspondant à l'enseignant
        $roleId = Doctrine_Core::getTable('Role')->find('1')->getId();
        // Ajout de ce roleId au role_id de la personne en cours
        $personne = new Personne();
        $personne->setRoleId($roleId);
        $this->form = new PersonneForm($personne);
        $this->orientation = $request->getParameter('orientation');
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new PersonneForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($personne = Doctrine_Core::getTable('Personne')->find(array($request->getParameter('id'))), sprintf('Object personne does not exist (%s).', $request->getParameter('id')));
        $this->form = new PersonneForm($personne);
        $this->orientation = $request->getParameter('orientation');
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($personne = Doctrine_Core::getTable('Personne')->find(array($request->getParameter('id'))), sprintf('Object personne does not exist (%s).', $request->getParameter('id')));
        $this->form = new PersonneForm($personne);
        $this->orientation = $request->getParameter('orientation');
        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $orientation = Doctrine_Core::getTable('Orientation')->find($request->getParameter('orientation'));
        $orientation->setPersonneId(null);
        $orientation->save();
        //$this->forward404Unless($personne = Doctrine_Core::getTable('Personne')->find(array($request->getParameter('id'))), sprintf('Object personne does not exist (%s).', $request->getParameter('id')));
        //$personne->delete();
        //Suppression dans orientation
        
        $this->redirect('professeur/new?orientation=' . $orientation->getId());
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $personne = $form->save();
            // Ajout de personne_id à l'orientation en cours
            $orientation = Doctrine_Core::getTable('Orientation')->find($request->getParameter('orientation'));
            $orientation->setPersonneId($personne->getId());
            $orientation->save();
            $this->redirect('professeur/edit?id=' . $personne->getId() . '&orientation=' . $orientation->getId());
        }
    }

}
