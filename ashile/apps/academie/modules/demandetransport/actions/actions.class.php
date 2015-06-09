<?php

/**
 * demandetransport actions.
 *
 * @package    ash
 * @subpackage demandetransport
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandetransportActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$this->page = 'en attente de traitement';

	  // demande transport sans decision de la CDA
        //--------------------------------
	    $this->demande_transports = Doctrine_Query::Create()
			->select('*')
			->from('DemandeTransport t')
                        ->innerjoin('t.Mdph m ON m.id = t.mdph_id')
                        ->innerjoin('m.Eleve e ON m.eleve_id = e.id')
			->where('Datedecisioncda IS NULL' )
			->execute();
  }
  
  	public function executeList(sfWebRequest $request)
	{

	// demande de transport notifiée en attente de moyen et valides à la date du jour
	$this->demande_transports = Doctrine_Query::create()
			->Select('*')
			->from('DemandeTransport d')
            ->innerjoin('d.Mdph m ON d.mdph_id = m.id')
            ->innerjoin('m.Eleve e ON m.eleve_id = e.id')
			->where('d.datedecisioncda IS NOT NULL') // il existe une date de decision cda
			->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
			->andwhere ('e.id not in ( select eleve_id from sessad_obtenu  where datefin IS NULL OR datefin >= "'.date('Y-m-d', time()).'")')
			->execute();
	}

  public function executeShow(sfWebRequest $request)
  {
    $this->demande_transport = Doctrine_Core::getTable('DemandeTransport')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->demande_transport);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new DemandeTransportForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DemandeTransportForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($demande_transport = Doctrine_Core::getTable('DemandeTransport')->find(array($request->getParameter('id'))), sprintf('Object demande_transport does not exist (%s).', $request->getParameter('id')));
    $this->form = new DemandeTransportForm($demande_transport);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($demande_transport = Doctrine_Core::getTable('DemandeTransport')->find(array($request->getParameter('id'))), sprintf('Object demande_transport does not exist (%s).', $request->getParameter('id')));
    $this->form = new DemandeTransportForm($demande_transport);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
   // $request->checkCSRFProtection();

    $this->forward404Unless($demande_transport = Doctrine_Core::getTable('DemandeTransport')->find(array($request->getParameter('id'))), sprintf('Object demande_transport does not exist (%s).', $request->getParameter('id')));
    $demande_transport->delete();

    $this->redirect('demandetransport/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $demande_transport = $form->save();
	    $this->getUser()->setFlash('notice', 'Enregistré avec succès');

		}			
	    

      $this->redirect('demandetransport/edit?id='.$demande_transport->getId());
    }
  
}
