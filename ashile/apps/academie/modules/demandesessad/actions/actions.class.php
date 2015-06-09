<?php

/**
 * demandesessad actions.
 *
 * @package    ash
 * @subpackage demandesessad
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandesessadActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
		$this->page = ' en attente de traitement';
		// demande sessad
	    $this->demande_sessads = Doctrine_Query::create()
			->Select('d.id as demandesessad_id, e.id as eleve_id, m.id as mdph_id, t.id as typesessad_id, o.id as orientation_id, etab.id as etabsco_id, s.id as secteur_id, e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve, t.libelletypesessad as libelletypesessad, e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, 
			etab.nometabsco as nometabsco,etab.rne as rne,ty.nomtypeetablissement as typetab,ty.id as typeetabsco_id')
			->from('Demandesessad d')
                        ->innerjoin('d.Mdph m ON d.mdph_id = m.id') 
                        ->innerjoin('m.Eleve e ON m.eleve_id = e.id')
                        ->innerJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->innerJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
                        ->innerJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->innerJoin('d.Typesessad t ON t.id = d.typesessad_id')
						->leftjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
						->Where('datedebutnotif IS NULL' )
                        ->andwhere ('Datedecisioncda IS NULL' )
						->fetchArray();
    }

	public function executeList(sfWebRequest $request)
	{

	$this->page = ' en attente de moyen';
	// demande sessad notifiée en attente de moyen

	$this->demande_sessads = Doctrine_Query::create()
			->Select('d.id as demandesessad_id, d.datedecisioncda as datedecisioncda, s.libellesecteur as libellesecteur, etab.nometabsco as nometabsco, d.datedebutnotif as datedebutnotif, d.datefinnotif as datefinnotif, e.id as EleveId, m.id as mdph_id, t.id as typesessad_id, o.id as orientation_id, etab.id as etabsco_id, s.id as secteur_id, e.nom as nomeleve, e.prenom as prenomeleve, e.datenaissance as datenaissanceeleve, t.libelletypesessad as libelletypesessad, e.numeromdph as numeromdph, m.datecreationpps as datecreationpps, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier, s.libellesecteur as libellesecteur, etab.nometabsco as nometabsco')
			->from('Demandesessad d')
                        ->innerjoin('d.Mdph m ON d.mdph_id = m.id') 
                        ->innerjoin('m.Eleve e ON m.eleve_id = e.id')
                        ->innerJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->innerJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
                        ->innerJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->innerJoin('d.Typesessad t ON t.id = d.typesessad_id')
						->where('d.datedecisioncda IS NOT NULL') // il existe une date de decision cda
						->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
						->andwhere ('e.id not in ( select eleve_id from sessad_obtenu  where datefin IS NULL OR datefin >= "'.date('Y-m-d', time()).'")')
						->fetchArray();
	}
        


  public function executeNew(sfWebRequest $request)
  {
        $demandesessad = new Demandesessad();
        $demandesessad->setMdphId($this->getRequestParameter('mdph_id'));
        $this->form = new DemandeAvsForm($demandesessad);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new DemandesessadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  { 

 
    $this->forward404Unless($demandesessad = Doctrine_Core::getTable('Demandesessad')->find(array($request->getParameter('id'))), sprintf('Object demandesessad existe pas (%s).', $request->getParameter('id')));
    $this->form = new DemandesessadForm($demandesessad);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($demandesessad = Doctrine_Core::getTable('Demandesessad')->find(array($request->getParameter('id'))), sprintf('Object demandesessad does not exist (%s).', $request->getParameter('id')));
    $this->form = new DemandesessadForm($demandesessad);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($demandesessad = Doctrine_Core::getTable('Demandesessad')->find(array($request->getParameter('id'))), sprintf('Object demandesessad does not exist (%s).', $request->getParameter('id')));
    $demandesessad->delete();

    $this->redirect('demandesessad/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $demandesessad = $form->save();
	  $this->getUser()->setFlash('notice', 'Enregistré avec succés');
      $this->redirect('demandesessad/edit?id='.$demandesessad->getId());
    }
  }
}
