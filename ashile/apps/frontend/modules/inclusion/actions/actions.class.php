<?php

/**
 * inclusion actions.
 *
 * @package    ash
 * @subpackage inclusion
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class inclusionActions extends sfActions
{
 

    public function executeIndex(sfWebRequest $request)
    {
        $this->inclusions = Doctrine_Core::getTable('Inclusion')
                ->createQuery('a')
                ->execute();
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->inclusion = Doctrine_Core::getTable('Inclusion')->find(array($request->getParameter('id')));
        $this->forward404Unless($this->inclusion);
    }

    public function executeNew(sfWebRequest $request)
    {
        $this->form = new InclusionForm();
        $this->orientation = $request->getParameter('orientation');
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new InclusionForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($inclusion = Doctrine_Core::getTable('Inclusion')->find(array($request->getParameter('id'))), sprintf('Object inclusion does not exist (%s).', $request->getParameter('id')));
        $this->form = new InclusionForm($inclusion);
        $this->orientation = $request->getParameter('orientation');
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($inclusion = Doctrine_Core::getTable('Inclusion')->find(array($request->getParameter('id'))), sprintf('Object inclusion does not exist (%s).', $request->getParameter('id')));
        $this->form = new InclusionForm($inclusion);
        $this->orientation = $request->getParameter('orientation');
        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
        $orientation = Doctrine_Core::getTable('Orientation')->find($request->getParameter('orientation'));
        $orientation->setInclusionId(null);
        $orientation->save();
        $this->forward404Unless($inclusion = Doctrine_Core::getTable('Inclusion')->find(array($request->getParameter('id'))), sprintf('Object inclusion does not exist (%s).', $request->getParameter('id')));
        $inclusion->delete();

        $this->redirect('inclusion/new?orientation=' . $orientation->getId());
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
		
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $inclusion = $form->save();
            $orientation = Doctrine_Core::getTable('Orientation')->find($request->getParameter('orientation'));
            $orientation->setInclusionId($inclusion->getId());
            $orientation->save();
            
            $this->getUser()->setFlash('succesInclusion', 'Inclusion enregistrée avec succés');
            //
            $this->redirect('inclusion/edit?id=' . $inclusion->getId() . '&orientation=' . $orientation->getId());
        }
    }

}
