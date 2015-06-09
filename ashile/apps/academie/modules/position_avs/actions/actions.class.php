<?php

/**
 * position_avs actions.
 *
 * @package    ash
 * @subpackage position_avs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class position_avsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->position_avss = Doctrine_Core::getTable('PositionAvs')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->position_avs = Doctrine_Core::getTable('PositionAvs')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->position_avs);
  }

  public function executeNew(sfWebRequest $request)
  {
  
     //$this->setLayout(false);
	 //$this->addJavascript('jquery.ui.datepicker-fr.js');
	// ----------- on trouve le contrat_avs en cours ------------
	$contratAvsId = $request->getParameter('contratavs_id');
	
     //récupération des informations concernant l'avs et le contrat selectionné
	//-----------------------------------------------------------------------
			$this->avs = Doctrine_Query::create()
			->select ('a.nom as nom,a.prenom as prenom,a.date_naissance as date_naissance,a.tel1 as tel1,a.tel2 as tel2,c.id as contratId,a.id as avsid,c.temps_hebdo as temps_hebdo,c.date_debut_contrat as date_debut_contrat,c.date_fin_contrat as date_fin_contrat,et.id as etid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,tc.typecontrat as typecontrat')
			->from('ContratAvs c')
			->innerJoin('c.Avs a ON a.id = c.avs_id')
			->leftjoin('c.Etabsco et ON  et.id = c.etabsco_id')
			->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
			->innerjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
			->where('c.id = ?', $contratAvsId)
			->limit(1)
			->fetchArray();
	
	// ----------- on crée un objet positionAvs
	$positionAvs = new PositionAvs();
	// ----------- on donne le contratAvsid a cet objet ---------
	$positionAvs->setContratavsId($contratAvsId); 
	// ----------- on crée le form por cet objet ----------------
	
	 // passage de la variable 'contratavs_id'
	//---------------------------------------
     $this->getUser()->setAttribute('contratavs_id', $contratAvsId);
	// passage de l'attribut
	sfContext::getInstance()->getUser()->setAttribute('contratavs_id', $contratAvsId); //variable globale utilisée dans le processform pour mettre à jour la date de fin la dernière position 
    $this->form = new PositionAvsForm($positionAvs);
  }
  public function executeMessage(sfWebRequest $request)
  {
  
    //Récupération de l'information sur la position créé
					$this->info_position = Doctrine_Query::create()
						->select('p.contratavs_id as contratavs_id,p.datedebut as datedebut,p.datefin as datefin,t.id as type_id,t.libelletypepositionavs as libelletypepositionavs')
						->from('PositionAvs p')
						->innerjoin('p.TypePositionAvs t On t.id = p.typepositionavs_id ')
						->where('p.id = ?', $request->getParameter('position_id'))
						->fetchArray();
    }
  
  public function executePopup(sfWebRequest $request)
  {
  
      
     //$this->setLayout(false);
	 //$this->addJavascript('jquery.ui.datepicker-fr.js');
	// ----------- on trouve le contrat_avs en cours ------------
	$contratAvsId = $request->getParameter('contratavs_id');

	// ----------- on crée un objet positionAvs
	$positionAvs = new PositionAvs();
	// ----------- on donne le contratAvsid a cet objet ---------
	$positionAvs->setContratavsId($contratAvsId); 
	// ----------- on crée le form por cet objet ----------------
	
	 // passage de la variable 'contratavs_id'
	//---------------------------------------
     $this->getUser()->setAttribute('contratavs_id', $contratAvsId);
	// passage de l'attribut
	sfContext::getInstance()->getUser()->setAttribute('contratavs_id', $contratAvsId); //variable globale utilisée dans le processform pour mettre à jour la date de fin la dernière position 
    $this->form = new PositionAvsForm($positionAvs);

    
  }
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PositionAvsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
   
	 //récupération des informations concernant l'avs et le contrat selectionné
	//-----------------------------------------------------------------------
			$this->avs = Doctrine_Query::create()
			->select ('a.nom as nom,a.prenom as prenom,p.id as position_id,a.date_naissance as date_naissance,a.tel1 as tel1,a.tel2 as tel2,c.id as contratId,a.id as avsid,c.temps_hebdo as temps_hebdo,c.date_debut_contrat as date_debut_contrat,c.date_fin_contrat as date_fin_contrat,et.id as etid,et.rne as rne,et.nometabsco as etab,t.nomtypeetablissement as typetab,tc.typecontrat as typecontrat')
			->from('ContratAvs c')
			->innerJoin('c.Avs a ON a.id = c.avs_id')
			->leftjoin('c.Etabsco et ON  et.id = c.etabsco_id')
			->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
			->innerjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
			->innerjoin('c.PositionAvss p ON c.id = p.contratavs_id')
			->where('p.id = ?', $request->getParameter('id'))
			->limit(1)
			->fetchArray(); 
			
    $this->forward404Unless($position_avs = Doctrine_Core::getTable('PositionAvs')->find(array($request->getParameter('id'))), sprintf('Object position_avs does not exist (%s).', $request->getParameter('id')));
    $this->form = new PositionAvsForm($position_avs);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($position_avs = Doctrine_Core::getTable('PositionAvs')->find(array($request->getParameter('id'))), sprintf('Object position_avs does not exist (%s).', $request->getParameter('id')));
     
  

   $this->form = new PositionAvsForm($position_avs);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($position_avs = Doctrine_Core::getTable('PositionAvs')->find(array($request->getParameter('id'))), sprintf('Object position_avs does not exist (%s).', $request->getParameter('id')));
    $position_avs->delete();
    $message = 'Suppression réussie de la position n°'. $request->getParameter('id').' du contrat n° '.$request->getParameter('contratavs_id');
  	$this->getUser()->setFlash('notice',$message );
    $this->redirect('contrat_avs/edit?id='.$request->getParameter('contratavs_id'));
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {   
		$position_id = $form->getValue('id');
	
	      if ($form->isNew()){
		  
	         //récupération de la dernière position pour le contrat selectionné
			 //----------------------------------------------------------------
			 $contratavs_id =  $this->getUser()->getAttribute('contratavs_id'); //récupération de la variable globale définit plus haut par sfContext::getInstance()->getUser()
	    				$res = Doctrine_Query::create()
							->select('p.contratavs_id as contratavs_id,MAX(p.id) as id')
							->from('PositionAvs p')
							->groupBy('p.contratavs_id')
							->having('p.contratavs_id = ?',  $contratavs_id)
							->fetchArray();
			$count_res = count($res);
			$position_avs = $form->save();
							
			
			$this->getUser()->setFlash('notice',$message );
			
			//mise à jour de la date de fin de la dernière position du contrat avec la date de début de la nouvelle position
			//----------------------------------------------------------------------------------------------------------------
			// --- la mise a jour date debut du nouveau mouvement = date fin du mouvement précedent

				$majDate = Doctrine_Query::create()
						->update('PositionAvs p ')
						->set('p.datefin','?' , $position_avs->getDatedebut() )
						->where('p.id = ?', $res[0]['id']);

				$majDate->execute();
				$this->redirect('position_avs/message?position_id='.$position_avs->getId());  //affichage message dans popup
		}else{		
        $position_avs = $form->save();
		$this->getUser()->setFlash('notice', 'Position modifiée avec succès');
		$this->redirect('contrat_avs/edit?id='.$position_avs->getContratavsId());
		}
		
    }
  }
}
