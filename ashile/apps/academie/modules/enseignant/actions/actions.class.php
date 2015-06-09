<?php

/**
 * enseignant actions.
 *
 * @package    ash
 * @subpackage enseignant
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class enseignantActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
        $this->enseignants = Doctrine_Core::getTable('Enseignant')
                ->createQuery('a')
                ->execute();
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new EnseignantForm();
        $this->orientation = $request->getParameter('orientation');
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new EnseignantForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($enseignant = Doctrine_Core::getTable('Enseignant')->find(array($request->getParameter('id'))), sprintf('Object enseignant does not exist (%s).', $request->getParameter('id')));
        $this->form = new EnseignantForm($enseignant);
        $this->orientation = $request->getParameter('orientation');
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($enseignant = Doctrine_Core::getTable('Enseignant')->find(array($request->getParameter('id'))), sprintf('Object enseignant does not exist (%s).', $request->getParameter('id')));
        $this->form = new EnseignantForm($enseignant);
        $this->orientation = $request->getUrlParameter('orientation');
        $ii = $request->getUrlParameter('orientation');
        //throw new Exception($ii);
        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
        $orientation = Doctrine_Core::getTable('Orientation')->find($request->getParameter('orientation'));
        $orientation->setEnseignantId(null);
        $orientation->save();
        $this->forward404Unless($enseignant = Doctrine_Core::getTable('Enseignant')->find(array($request->getParameter('id'))), sprintf('Object enseignant does not exist (%s).', $request->getParameter('id')));
        $enseignant->delete();

        $this->redirect('enseignant/new?orientation=' . $orientation->getId());
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        //echo $request->getParameter('orientation');
        
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $enseignant = $form->save();
            $orientation = Doctrine_Core::getTable('Orientation')->find($request->getParameter('orientation'));
            $orientation->setEnseignantId($enseignant->getId());
            $orientation->save();
            $this->getUser()->setFlash('succesEnseignant', 'Enseignant enregistré avec succés');
            $this->redirect('enseignant/edit?id=' . $enseignant->getId() . '&orientation=' . $orientation->getId());
        }
    }

}
