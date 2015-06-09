<?php

/**
 * reponse actions.
 *
 * @package    ash
 * @subpackage reponse
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reponseActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->reponses = Doctrine_Core::getTable('reponse')
      ->createQuery('a')
      ->execute();
  }
  
    public function executePopup(sfWebRequest $request)
  {
    $userId = sfContext::getInstance()->getUser()->getGuardUser()->getId();
     $this->getUser()->setAttribute('reponse',1); //gestion du retour
   	 $reponse = new Reponse();
	  $reponse->setDegreetabsco('0');
      $reponse->setQuestionId($request->getParameter('question_id'));
	 $this->form = new reponseForm($reponse);
  //  $this->redirect('reponse/message?question_id='.$request->getParameter('question_id'));
    
  }
  
  
      public function executeMessage(sfWebRequest $request)
  {
      //affichage du message de confirmation de création d'une réponse
     //récupération info question
	 
  	      $this->info_question = Doctrine_Query::Create()
                ->select('q.id as question_id,q.question as libellequestion,q.num_question as num_question')
                ->from('Question q')
				->where('q.id =?',$request->getParameter('question_id'))
				->limit(1)
				->fetcharray();
 
	   //récupération info question
	     	     $this->info_reponse = Doctrine_Query::Create()
                ->select('r.id as reponse_id,r.libelle_reponse as libellereponse,r.degreetabsco as degreetabsco')
                ->from('Reponse r')
				->where('r.id =?',$request->getParameter('reponse_id'))
				->limit(1)
				->fetcharray();
				// $this->redirect('question/edit?id='. $this->info_question[0]['question_id']);
    }

  public function executeShow(sfWebRequest $request)
  {
    $this->reponse = Doctrine_Core::getTable('reponse')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->reponse);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new reponseForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new reponseForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
   $this->getUser()->setAttribute('reponse',0); //gestion du retour
        //récupération info question
	    //-------------------------------
  	      $this->info_question = Doctrine_Query::Create()
                ->select('q.id as question_id,q.question as libellequestion,q.num_question as num_question')
                ->from('Question q')
				->where('q.id =?',$request->getParameter('question_id'))
				->limit(1)
				->fetcharray();
 
    $this->forward404Unless($reponse = Doctrine_Core::getTable('reponse')->find(array($request->getParameter('id'))), sprintf('cette réponse n\'existe pas !!', $request->getParameter('id')));
    $this->form = new reponseForm($reponse);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($reponse = Doctrine_Core::getTable('reponse')->find(array($request->getParameter('id'))), sprintf('Object reponse does not exist (%s).', $request->getParameter('id')));
    $this->form = new reponseForm($reponse);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
   // $request->checkCSRFProtection();
    
    $this->forward404Unless($reponse = Doctrine_Core::getTable('reponse')->find(array($request->getParameter('id'))), sprintf('Object reponse does not exist (%s).', $request->getParameter('id')));
  
  //recherche des questions avec la réponse à suprimer
	//-----------------------------------------------------
     $this->dgescos  = Doctrine_Query::Create()
               ->select('d.id as DgescoId ')
                ->from('Dgesco d ')
				->where ('d.reponse_id=?',$reponse->getId())
				->fetcharray();	   
				
	$count_reponse = count($this->dgescos )	;
	
	if ($count_reponse == 0){			
     $reponse->delete();
	 $this->getUser()->setFlash('notice', 'réponse : '.$reponse->getReponse(). ' supprimée avec succès');
	}else{
	 $this->getUser()->setFlash('error', 'Impossible de supprimer la réponse :'.$reponse->getReponse().',elle est utilisé dans l\'enquête DGESCO: ');
	}
	
    $this->redirect('question/edit?id='.$reponse->getQuestionId());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $reponse = $form->save();
	
   	   if($this->getUser()->getAttribute('reponse') === 1){ //on vient de la popup de création d'une réponse
	   $this->getUser()->setFlash('notice', 'réponse enregistrée avec succès'.$this->getUser()->getAttribute('reponse'));
		  $this->redirect('reponse/message?question_id='. $reponse->getQuestionId());
	   }else{
      $this->redirect('question/edit?id='.$reponse->getQuestionId());
	  }
    }
  }
}
