<?php

/**
 * suiviDSM actions.
 *
 * @package    ash
 * @subpackage suiviDSM
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class suiviDSMActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->demande_avss = Doctrine_Core::getTable('DemandeAvs')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->demande_avs = Doctrine_Core::getTable('DemandeAvs')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->demande_avs);
  }

 public function executeList(sfWebRequest $request)
        {

        // demande acc. notifiée en attente de moyen DSM et valides à la date du jour
		//--------------------------------------------------------------------

        $this->demande_avss = Doctrine_Query::create()
                        ->select('e.id as EleveId,d.id as demandeavs_id,m.id as mdph_id,d.decisioncda as decisioncda,d.datedebutnotif as datedebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,d.daterecepdemanderf as daterecepdemanderf,d.datedemanddsm as datedemanddsm,d.datedecidsm as datedecidsm,d.datetransdecierf as datetransdecierf,
						e.nom as nomeleve,e.prenom as prenomeleve,e.datenaissance as datenaissance,e.numeromdph as numeromdph,e.etat_acc as etat_acc,se.libellesecteur as secteur')
                        ->from('Demandeavs d')
                        ->innerjoin('d.Mdph m ON d.mdph_id = m.id')
                        ->innerjoin('m.Eleve e ON m.eleve_id = e.id')
						->leftJoin('e.Secteur se ON se.id = e.secteur_id')
                        ->where('d.datedecisioncda IS NOT NULL') // il existe une date de décision cda
                        ->andwhere('d.decisioncda = 1')
						->andwhere('e.etat_acc is null or e.etat_acc >= "'.date('Y-m-d',time()).'"')
						->andWhere('d.datefinnotif >=?', date('Y-m-d', time()))
					//	->andwhere('d.datetransdecierf IS NULL')// il n'y a pas encore de moyen dispo
                     // ->andwhere('d.traite  = 0 ')
						->andwhere ('e.id not in ( select eleve_id from eleve_avs where datefin IS NULL OR datefin >= "'.date('Y-m-d', time()).'")')
						 //->andwhere('d.etat = FALSE ')
                        ->fetcharray();
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
    $request->checkCSRFProtection();

    $this->forward404Unless($demande_avs = Doctrine_Core::getTable('DemandeAvs')->find(array($request->getParameter('id'))), sprintf('Object demande_avs does not exist (%s).', $request->getParameter('id')));
    $demande_avs->delete();

    $this->redirect('demandeavs/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
        $form_param = $request->getParameter($form->getName());
        $form->bind($form_param, $request->getFiles($form->getName()));
		
		
        if ($form->isValid()) {
            $demande_avs = $form->save();
			
			
		  //récupération de la fiche de l'élève
          //--------------------------------------
               				$fiche_eleve = Doctrine_Query::create()
							->select('e.nom as nom,e.prenom as prenom,e.secteur_id as secteur_id,e.id as eleve_id')
							->from('Eleve e')
							->innerjoin('e.Mdphs m on m.eleve_id = e.id')
							->where('m.id = ?', $demande_avs->getMdphId())
							->limit(1)
							->fetchArray();
							
           $this->getUser()->setFlash('notice', 'Modification(s) enregistrée(s) avec succès');
           $this->redirect('suiviDSM/edit?id=' . $demande_avs->getId(). '&mdph_id='. $demande_avs->getMdphId().'&eleve_id='.$fiche_eleve[0]['eleve_id'].'&eleve_nom='.$fiche_eleve[0]['nom'].'&eleve_prenom='.$fiche_eleve[0]['prenom'].'&retour=1');
        }
  }
}
