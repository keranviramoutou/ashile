<?php

/**
 * question actions.
 *
 * @package    ash
 * @subpackage question
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class questionActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->questions = Doctrine_Query::Create()
                ->select('q.id as question_id,q.question as libellequestion,q.num_question as num_question')
                ->from('Question q')
				//->leftjoin('q.Reponses r ON q.id = r.question_id')
				->fetcharray();
  }

  public function executeNew(sfWebRequest $request)
  {
    
	
   
	$this->form = new questionForm($reponse);

	
  }
  
  
     public function executeShow(sfWebRequest $request)
  {
      $this->question = Doctrine_Core::getTable('question')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->question);
	
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
 
    $this->form = new questionForm();
  
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($question = Doctrine_Core::getTable('question')->find(array($request->getParameter('id'))), sprintf('Object question does not exist (%s).', $request->getParameter('id')));
    $this->form = new questionForm($question);
	$this->reponse  = Doctrine_Query::create()
	->select('*') 
	->from('reponse')
	->where('question_id =?',$request->getParameter('id'))
	->orderBy('reponse.id','DESC')
	->fetcharray();
	 $this->count_reponses =count($this->reponse);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($question = Doctrine_Core::getTable('question')->find(array($request->getParameter('id'))), sprintf('Object question does not exist (%s).', $request->getParameter('id')));
    $this->form = new questionForm($question);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
  
    $request->checkCSRFProtection();
	
	$this->forward404Unless($question = Doctrine_Core::getTable('question')->find(array($request->getParameter('id'))), sprintf('Object question does not exist (%s).', $request->getParameter('id')));	
	//recherche des questions avec la question à supprimer 
	//-----------------------------------------------------
     $this->dgescos  = Doctrine_Query::Create()
               ->select('d.id as DgescoId ')
                ->from('Dgesco d ')
				->where ('d.question_id=?',$question->getId())
				->fetcharray();	  

    
   	$count_question = count($this->dgescos);
	
	if ($count_question == 0){	
	
    $this->getUser()->setFlash('notice', 'Question supprimée avec succès !');	
     $question->delete();
	
	}else{
	 $this->getUser()->setFlash('error', 'Impossible de supprimer la question : "'.$question->getQuestion().'", elle est utilisée dans l\'enquête DGESCO !!! ');
	}

    $this->redirect('question/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $question = $form->save();
    $this->getUser()->setFlash('notice', 'Question enregistrée n°'.$question->getNumQuestion().' - libellé : '.$question->getQuestion().' avec succès');
      //$this->redirect('question/edit?id='.$question->getId());
	     $this->redirect('question/index');
    }
  }
  public function executeAide(){}
}


