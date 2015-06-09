<?php

/**
 * demandeorientation actions.
 *
 * @package    ash
 * @subpackage demandeorientation
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandeorientationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  
    $this->page = ' en attente de traitement';
    $this->demande_orientations = Doctrine_Query::create()
			->select('d.id as id, de.id as demijournee_id, de.libelledemijournee as libelledemijournee, e.id as EleveId, e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve, e.numeromdph as numeromdph, o.id as orientation_id, s.id as secteur_id, s.libellesecteur as libellesecteur, etab.id as etablissement_id, etab.nometabsco as nometabsco, c.id as classeext_id, c.libelle_classe_ext as libelle_classe_ext, m.id as mdph_id, m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier')
			->from('Demandeorientation d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
                        ->leftJoin('d.Classeext c ON c.id = d.classeext_id ')
                        ->leftJoin('d.Demijournee de ON de.id = d.demijournee_id')
						->where('d.datedecisioncda IS NULL')
						->orWhere('d.datedecisioncda=?', '')
						->orWhere('d.datedecisioncda <= 0000-00-00')
						->fetchArray();
						
  }

	public function executeList(sfWebRequest $request)
	{
    $this->demande_orientation = Doctrine_Query::create()
			->select('d.id as id, de.id as demijournee_id, de.libelledemijournee as libelledemijournee, e.id as EleveId, e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve, e.numeromdph as numeromdph, o.id as orientation_id, s.id as secteur_id, s.libellesecteur as libellesecteur, etab.id as etablissement_id, etab.nometabsco as nometabsco, c.id as classeext_id, c.libelle_classe_ext as libelle_classe_ext, m.id as mdph_id, m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier')
		    ->from('Demandeorientation d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
                        ->leftJoin('d.Classeext c ON c.id = d.classeext_id ')
                        ->leftJoin('d.Demijournee de ON de.id = d.demijournee_id')
						->where('d.datedecisioncda IS NULL')
						->orWhere('d.datedecisioncda=?', '')
						->orWhere('d.datedecisioncda <= 0000-00-00')
						->fetchArray();
		}

  public function executeShow(sfWebRequest $request)
  {
    $this->demande_orientation = Doctrine_Core::getTable('DemandeOrientation')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->demande_orientation);
  }

  public function executeNew(sfWebRequest $request)
  {
	$demandeOrientation = new DemandeOrientation();
	$demandeOrientation->setMdphId($request->getParameter('mdph-id'));  
    $this->form = new DemandeOrientationForm($demandeOrientation);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DemandeOrientationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($demande_orientation = Doctrine_Core::getTable('DemandeOrientation')->find(array($request->getParameter('id'))), sprintf('Object demande_orientation does not exist (%s).', $request->getParameter('id')));
    
    $this->form = new DemandeOrientationForm($demande_orientation);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($demande_orientation = Doctrine_Core::getTable('DemandeOrientation')->find(array($request->getParameter('id'))), sprintf('Object demande_orientation does not exist (%s).', $request->getParameter('id')));
    $this->form = new DemandeOrientationForm($demande_orientation);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($demande_orientation = Doctrine_Core::getTable('DemandeOrientation')->find(array($request->getParameter('id'))), sprintf('Object demande_orientation does not exist (%s).', $request->getParameter('id')));
    $demande_orientation->delete();

    $this->redirect('demandeorientation/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
	  $form->save();
	  $this->getUser()->setFlash('notice', 'Enregistré avec succés');

    }else{
		foreach($form->getErrorSchema()->getErrors() as $e)
		{
			$this->getUser()->setFlash('error',  $e->__toString()); // Pour les message echo $e->__toString();          
		}
		// ------------------------------------v
	}
		    $this->redirect('demandeorientation/edit?id='.$form->getObject()->getId().'&mdph_id='.$form->getObject()->getMdphId());
  }
  public function executeAide(){}	
}


	