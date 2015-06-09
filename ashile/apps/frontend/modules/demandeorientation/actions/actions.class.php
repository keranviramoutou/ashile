


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

    protected function getListeOrientation(sfWebRequest $request)
    {
        return Doctrine_Query::Create()
						->select('d.id as demande_orientation_id, d.date_demande_orientation as date_demande_orientation, c.id as classeext_id, c.libelle_classe_ext as libelleclasseext,
						 d.datedebutnotif as datebutnotif,d.datefinnotif as datefinnotif,d.datedecisioncda as datedecisioncda,d.decisioncda as decisioncda,d.mdph_id as mdph_id,d.notes as notes')
                        ->from('DemandeOrientation d')
                        ->innerJoin('d.Classeext c ON c.id = d.classeext_id')
                        ->where('d.mdph_id=?', $request->getParameter('mdph_id'))
                        ->fetchArray();
    }

    public function executeIndex(sfWebRequest $request)
    {
		
        $this->demandeorientations = $this->getListeOrientation($request);
		$this->countdemande= count( $this->demandeorientations);
        $this->mdphId = $request->getParameter('mdph_id');
    }

    public function executeList(sfWebRequest $request)
    {
        $this->demandeorientations = $this->getListeOrientation($request);
		 $this->countdemande = count( $this->demandeorientations);
    }

    public function executeShow(sfWebRequest $request)
    {
	
	      $this->demandeorientations = Doctrine_Core::getTable('DemandeOrientation')->find($request->getParameter('id'));
       
          $exist = count($this->demandeorientations);         

        // si la demande a une décision cda on empèche la modification de cette demande
        $this->cda = 'NEW';
		
        if($exist > 0){
			$this->cda = 'EDIT';
			
		   if($this->demandeorientations->getDatedecisioncda() || $this->demandeorientations->getDecisioncda() == true) // il ne peut y avoir qu'une demande d'orientation en cours
		   {
			   $this->cda = 'SHOW';
		   }              
        }
       // $this->demandeorientation = Doctrine_Core::getTable('DemandeOrientation')->find(array($request->getParameter('id')));
        //$this->forward404Unless($this->demandeorientation);
    }

    public function executeNew(sfWebRequest $request)
    {
	
        $do = new Demandeorientation();
	   
		$do->setMdphId($this->getRequestParameter('mdph_id'));
      
        $do->setDateDemandeOrientation(date('Y-m-d', time()));
        $this->form = new DemandeorientationForm($do);
    }

    public function executeCreate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new DemandeorientationForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request)
    {
        $this->forward404Unless($demandeorientation = Doctrine_Core::getTable('DemandeOrientation')->find(array($request->getParameter('id'))), sprintf('Object demandeorientation does not exist (%s).', $request->getParameter('id')));
        $this->form = new DemandeorientationForm($demandeorientation);
    }

    public function executeUpdate(sfWebRequest $request)
    {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($demandeorientation = Doctrine_Core::getTable('Demandeorientation')->find(array($request->getParameter('id'))), sprintf('Object demandeorientation does not exist (%s).', $request->getParameter('id')));
        $this->form = new DemandeorientationForm($demandeorientation);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request)
    {
        //$request->checkCSRFProtection();

        $this->forward404Unless($demandeorientation = Doctrine_Core::getTable('DemandeOrientation')->find(array($request->getParameter('id'))), sprintf('Object demandeorientation does not exist (%s).', $request->getParameter('id')));
        $demandeorientation->delete();

        $this->redirect('demandeorientation/index?mdph_id=' . $request->getParameter('mdph_id'));
    }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
       $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid())
        {
		    
            //recherche des demandes d'orientation identique
			//-----------------------------------------------
	       $recherche_demande = Doctrine_Query::create()
		   ->select('*')
		   	->from('Demandeorientation d')
			->where('d.classeext_id= ?',$form->getValue('classeext_id'))
			->andwhere('d.mdph_id= ?',$form->getValue('mdph_id'))
			->andwhere('d.id != ?',$form->getValue('id'))
			->fetcharray();
			
		    $countdemande = count($recherche_demande );
		    if ($countdemande > 0 ){
			$this->getUser()->setFlash('error','une orientation de même type est déjà enregistrée sur ce dossier MDPH !');
			if ($form->isNew()){
				
			}else{
				$this->redirect('demandeorientation/edit?id='. $form->getValue('id').'&mdph_id=' . $form->getValue('mdph_id'));
			}
		
			}else{
		
            $demandeorientation = $form->save();
			$this->getUser()->setFlash('notice', 'Enregistré avec succès');
            $this->redirect('demandeorientation/edit?id=' . $demandeorientation->getId() . '&Mdph_id=' . $demandeorientation->getMdphId());
			}
        }else{
		$this->getUser()->setFlash('error', 'demande non enregistrée');
		}
    }

}
