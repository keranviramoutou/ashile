<?php

/**
 * demandeavs actions.
 *
 * @package    ash
 * @subpackage demandeavs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class demandeavsActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
		
	$this->page = 'en attente de traitement';
	// demande avs en attente de traitement par la CDA
	    $this->demande_avss = Doctrine_Query::create()
			->select('s.decisioncda as decisioncda, s.datedecisioncda as datedecisioncda, 
			etab.nometabsco as etabsco, etab.id as etabsco_id, o.id as orientation_id, se.libellesecteur as secteur,
			s.mdph_id as mdph_id,s.id as demandeavs_id,e.nom as nom,e.prenom as prenom,e.datenaissance as datenaissance,
			m.datecreationpps as datecreationpps,m.dateess as dateess,m.dateenvoiedossier as dateenvoiedossier,e.id as eleve_id,
			e.numeromdph as numeromdph,n.naturecontrat as naturecontrat,etab.rne as rne,ty.id as type_id,ty.nomtypeetablissement as typetab')
			->from('Demandeavs s')
                        ->leftJoin('s.Mdph m ON s.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Orientation o ON o.eleve_id = e.id')
                        ->leftJoin('e.Secteur se ON se.id = e.secteur_id')
                        ->leftJoin('o.Etabsco etab ON etab.id = o.etabsco_id')
					    ->innerjoin('etab.Typeetablissement ty ON ty.id = etab.typeetablissement_id')
                        ->leftJoin('s.Naturecontratavs n ON s.naturecontratavs_id = n.id')
			->where('Datedecisioncda IS NULL' )
			->fetcharray();
    }
	
	 public function executeList1(sfWebRequest $request)
    {
		
	$this->page = 'en attente de traitement';
	// historique des demandes d'avs traité pour un élève
	    $this->demande_avss = Doctrine_Query::create()
			->Select('d.id as DemandeAvsId,m.id as MdphId,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,
			d.decisioncda as decisioncda,d.quotitehorrairenotifie as quotitehorrairenotifie,naturecontrat as naturecontrat,e.etat_acc as etat_acc,e.nom as nom,e.prenom as prenom,e.datenaissance as datenaissance')
			->from('DemandeAvs d')
			->innerJoin('d.Mdph m ON m.id = d.mdph_id')
			->innerJoin('m.Eleve e ON e.id = m.eleve_id')
			->leftJoin('d.Naturecontratavs n ON d.naturecontratavs_id = n.id')
			->where('d.datedecisioncda IS NOT NULL')
			->andwhere('m.eleve_id=?', $this->getRequestParameter('eleve_id'))
			->fetcharray();
	$this->dersco1 = Doctrine_Core::getTable('Orientation')->getDerSco($request->getParameter('eleve_id'));
    }

	public function executeList(sfWebRequest $request)
	{

	$this->page = 'en attente de moyen';
	// demande avs traité par la CDA mais pas d'avs affecté
	//---------------------------------------------------

	$this->demande_avss = Doctrine_Query::create()
			->select('d.id as demandeavs_id, m.id as mdph_id, e.id as eleve_id, e.nom as nomeleve, e.prenom as prenomeleve, 
			e.datenaissance as datenaissanceeleve, s.id as secteur_id, o.id as orientation_id, et.id as etabsco_id, 
			e.numeromdph as numeromdph, m.id as mdph_id, m.dateess as dateess, m.dateenvoiedossier as dateenvoiedossier,
			d.datedecisioncda as datedecisioncda, e.etat_acc as etat_acc, d.datedebutnotif as datedebutnotif, 
			d.datefinnotif as datefinnotif, s.libellesecteur as secteur, et.nometabsco as etabsco,et.rne as rne,ty.id as type_id,ty.nomtypeetablissement as typetab')
			->from('Demandeavs d')
                        ->leftJoin('d.Mdph m ON d.mdph_id = m.id')
                        ->leftJoin('m.Eleve e ON m.eleve_id = e.id')
                        ->leftJoin('e.Secteur s ON s.id = e.secteur_id')
                        ->leftjoin('e.Orientation o ON  e.id =  o.eleve_id')
                        ->leftjoin('o.Etabsco et ON  et.id = o.etabsco_id')
					    ->leftjoin('et.Typeetablissement ty ON ty.id = et.typeetablissement_id')
						->where('d.datedecisioncda IS NOT NULL') // il existe une date de decision cda
						->andwhere('d.traite = 0') // il n'y a pas encore de moyen dispo
						 // ->orwhere('d.traite IS NULL')
						->fetcharray();
	}

    public function executeShow(sfWebRequest $request)
    {
        $this->demandeavss = Doctrine_Query::create()
                ->select('a.*,m.*')
                ->from('Demandeavs a')
                ->innerJoin('a.Mdph m ON a.mdph_id = m.id')
                ->where('a.mdph_id=?', $this->getRequestParameter('mdph_id'))
                ->execute();
 
    }

    public function executeNew(sfWebRequest $request)
    {
        $demandeavs = new Demandeavs();
        $demandeavs->setMdphId($this->getRequestParameter('mdph_id'));
        $this->form = new DemandeAvsForm($demandeavs);
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $request->setParameter('nomtypeavs_id', $request->getPostParameter('typeavs_id'));
        $this->form = new DemandeAvsForm();
        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($demandeavs = Doctrine_Core::getTable('DemandeAvs')->find(array($request->getParameter('id'))), sprintf('Object demandeavs does not exist (%s).', $request->getParameter('id')));
        if ($request->getParameter('retour') == 1) {
		$this->getUser()->setAttribute('retour',1);
		}else{
		$this->getUser()->setAttribute('retour',2);
		}
	
        $this->form = new DemandeAvsForm($demandeavs);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($demandeavs = Doctrine_Core::getTable('DemandeAvs')->find(array($request->getParameter('id'))), sprintf('Il n\'y a pas d\'AVS (%s).', $request->getParameter('id')));
        $this->form = new DemandeavsForm($demandeavs);

        $this->processForm($request, $this->form);
        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {

        $this->forward404Unless($demandeavs = Doctrine_Core::getTable('DemandeAvs')->find(array($request->getParameter('id'))), sprintf('Object demandeavs does not exist (%s).', $request->getParameter('id')));
        $demandeavs->delete();
		$message = 'Suppression réussie de la demande AVS n°'. $request->getParameter('id');
   	    $message = $message .' pour l\'élève : '. $request->getParameter('eleve_nom');
		$message = $message .' '.$request->getParameter('eleve_prenom');
		$this->getUser()->setFlash('notice',$message );
	    $this->redirect('eleve/recherche?eleve_nom='.$request->getParameter('eleve_nom').'&eleve_prenom='.$request->getParameter('eleve_prenom').'&flag_recherche=1');
       // $this->redirect('demandeavs/show?mdph_id=' . $request->getParameter('mdph_id'));
	
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form_param = $request->getParameter($form->getName());
        $form->bind($form_param, $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $demande_avs = $form->save();
			
	  	// recherche de l'eleve_id
		//--------------------------
			$mdph = Doctrine_Query::Create()
				->select('d.id as mdph_id,m.eleve_id as eleve_id,e.nom as nom,e.prenom as prenom')
				->from('DemandeAvs d')
				->innerJoin('d.Mdph m ON m.id = d.mdph_id')
				->innerJoin('m.Eleve e ON e.id = m.eleve_id')
				->where('d.id = ?', $demande_avs->getId())
				->limit(1)
				->fetcharray();
				
			$retour = $this->getUser()->getAttribute('retour');	// valeur définie dans l'action edit	
            $this->getUser()->setFlash('notice', 'Demande AVS enregistrée avec succès');
			// gestion du bouton Retour
			//------------------------------
			if ( $retour == 2){ //retour vers la liste des demandes AVS
				$this->redirect('demandeavs/edit?id=' . $demande_avs->getId(). '&mdph_id='. $demande_avs->getMdphId().'&eleve_nom='.$mdph[0]['nom'].'&eleve_prenom=' . $mdph[0]['prenom'].'&retour=2');
            } else { // retour vers la recherche élève
				$this->redirect('demandeavs/edit?id=' . $demande_avs->getId(). '&mdph_id='. $demande_avs->getMdphId().'&eleve_id='.$mdph[0]['eleve_id'].'&eleve_nom='.$mdph[0]['nom'].'&eleve_prenom=' . $mdph[0]['prenom'].'&retour=1'.'&flag_recherche=1');
			}
			
		
		}
		
    }

}
