<?php

/**
 * mdph actions.
 *
 * @package    labo
 * @subpackage mdph
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mdphActions extends sfActions
{

    public function executeIndex(sfWebRequest $request)
    {
        $this->mdphs = Doctrine_Core::getTable('Mdph')
                ->createQuery('a')
                ->where('a.eleve_id =?', $this->getRequestParameter('eleve_id'))
				->orderby('a.id DESC')
                ->execute();
					
    }

    public function executeShow(sfWebRequest $request)
    {
        $this->mdph = Doctrine_Core::getTable('Mdph')->find(array($request->getParameter('id')));

	//on regarde les demandes de ce dossier et si elles sont traitées
	$dossier = $this->mdph;
	
	$this->forward404Unless($this->mdph);
    }

    public function executeNew(sfWebRequest $request)
    {
        $mdph = new Mdph();
        // Recuperation de eleve_id transmis par url depuis _index de mdph, la fonction getUrlParameter qui fait le boulot
        $mdph->setEleveId($request->getUrlParameter('eleve_id'));

	// à la création c'est la date du jour qui est prise par default
	//$mdph->setDatecreationpps(Date());

        $this->form = new MdphForm($mdph);
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new MdphForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
	      	//vérification présence demande d'orientations
	      $this->demandeorientations =  Doctrine_Query::Create()
						->select('d.id as demande_orientation_id, d.date_demande_orientation as date_demande_orientation, c.id as classeext_id, c.libelle_classe_ext as libelleclasseext,
						 d.datedebutnotif as datebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,d.decisioncda as decisioncda,d.mdph_id as mdph_id,d.notes as notes')
                        ->from('DemandeOrientation d')
                        ->innerJoin('d.Classeext c ON c.id = d.classeext_id')
                        ->where('d.mdph_id=?', $request->getParameter('id'))
                        ->fetchArray();
						
		$this->count_demandeorientations = count( $this->demandeorientations);
		
		
		//vérification présence demande de matériel
		$this->demandemateriels = Doctrine_Core::getTable('DemandeMateriel')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('id'))
                ->execute();
		$this->count_demandemateriels = count($this->demandemateriels);
		
		
		//vérification présence pièces complémentaires
	     $this->bilans =  Doctrine_Core::getTable('Bilan')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('id'))
				 ->execute();
		$this->count_bilans = count($this->bilans );
		
		
		//vérification accompagnement scolaire
		  $this->demandeavs = Doctrine_Core::getTable('DemandeAvs')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('id'))
                ->execute();
	     		$this->count_demandeavs = count($this->demandeavs);
				
		//vérification demande sessad
     	        $this->demandesessads = Doctrine_Core::getTable('DemandeSessad')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('id'))
                ->execute();
         $this->count_demandesessads = count($this->demandesessads);
		 
		//vérification demande transport
		
		   $this->demandetransport = Doctrine_Core::getTable('DemandeTransport')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('id'))
                ->execute();
      	 $this->count_demandetransport = count($this->demandetransport);		

 		//vérification autres pièces
		
		   $this->autrepiece = Doctrine_Core::getTable('PiecesDossier')
                ->createQuery('a')
                ->where('a.mdph_id=?', $this->getRequestParameter('id'))
                ->execute();
      	 $this->count_autrepiece = count($this->autrepiece);	
	    
        $this->forward404Unless($mdph = Doctrine_Core::getTable('Mdph')->find(array($request->getParameter('id'))), sprintf('ce dossier n\'existe pas (%s).', $request->getParameter('id')));
        $this->form = new MdphForm($mdph);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($mdph = Doctrine_Core::getTable('Mdph')->find(array($request->getParameter('id'))), sprintf('Object mdph does not exist (%s).', $request->getParameter('id')));
        $this->form = new MdphForm($mdph);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();
        $this->forward404Unless($mdph = Doctrine_Core::getTable('Mdph')->find(array($request->getParameter('id'))), sprintf('Object mdph does not exist (%s).', $request->getParameter('id')));
        try{
			$mdph->delete();
			$this->redirect('mdph/index?eleve_id='.$this->getRequestParameter('eleve_id'));
		}catch(Exception $e){
			$this->getUser()->setFlash('erreurDelMdph', $mdph->controleDelete());
		}
		 $this->redirect('mdph/edit?id=' . $mdph->getId());    
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $mdph = $form->save();
            $this->getUser()->setFlash('succes', 'Enregistré avec succès');
            $this->redirect('mdph/edit?id=' . $mdph->getId());
        }
    }
    
    public function executeAide(){}

}
