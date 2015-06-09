<?php

/**
 * mail actions.
 *
 * @package    ash
 * @subpackage mail
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mailActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->mails = Doctrine_Core::getTable('mail')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
	 $mail = new Mail();
     $this->form = new mailForm();
  }
  
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new mailForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($mail = Doctrine_Core::getTable('mail')->find(array($request->getParameter('id'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id')));
    
    $this->form = new mailForm($mail);
  }
   public function executeEnvoimessage(sfWebRequest $request)
      {
	            //sauvegarde du message avant envoi par mail
				//$mail = new Mail();
				//$mail->setMouvementId($remis[0]['id']);
				//$mail->save();
				$destinataire = Doctrine_Query::create()
                ->select('s.id,s.id as sf_id,s.libellesecteur as libellesecteur,sf.email_address as adresse_mail')
                ->from('Secteur s')
				->innerJoin('s.sfguarduser sf ON sf.id = s.sfguarduser_id')
                ->where('s.sfguarduser_id=?',$request->getParameter('destinataire'))
                ->execute();
	  
	            //envoi du mail
			    //---------------
				$message = Swift_Message::newInstance()
				->setFrom('acad@ac-reunion.fr')
				->setTo($destinataire[0]['adresse_mail'])
				->setSubject($request->getParameter('sujet') )
				->setBody($request->getParameter('texte') );
				$this->getMailer()->send($message);
				$this->getUser()->setFlash('notice', 'message envoyé à  : '.$destinataire[0]['adresse_mail']);
				
				$this->redirect('mail/edit?id='.$request->getParameter('mail_id'));
	  
   }
  
    public function executeEnvoimail(sfWebRequest $request)
  {
 	
        if($request->getParameter('user_id')){
 	   	// je commence par récupérer le secteur de l'utilisateur connecté.
		//-----------------------------------------------------------------
        $this->destinataire = Doctrine_Query::create()
                ->select('s.id,s.id as sf_id,s.libellesecteur as libellesecteur,sf.email_address as adresse_mail')
                ->from('Secteur s')
				->innerJoin('s.sfguarduser sf ON sf.id = s.sfguarduser_id')
                ->where('s.sfguarduser_id=?',$request->getParameter('user_id'))
                ->execute();
				
		 if($request->getParameter('modules') ){
		        $this->eleve = Doctrine_Query::create()
                ->select('e.id as eleve_id,e.nom as nom,e.prenom as prenom,e.datenaissance as datenaissance')
                ->from('eleve e')
                ->where('e.id=?',$request->getParameter('eleve_id'))
				->limit(1)
                ->fetcharray();
		 
		 }
			 if($request->getParameter('materiel_id') ){
		        $this->materiel = Doctrine_Query::create()
				->select ('m.id as id, q.libellemarque as marque,s.datefin as datefin, f.nommouvement as nommouvement, s.id as mouvementId,
				m.marque_id as marqueId,t.libelletypemateriel as libelletypemateriel, m.typemateriel_id as typeMaterielId, m.libellemateriel as libelleMateriel,
				m.caracteristiquemateriel as caracteristiqueMateriel,c.libellecatmateriel as libellecatmateriel,
				m.numeromateriel as numeroMateriel, m.commentaire as commentaire')
                ->from('Materiel m')
                ->leftjoin('m.Typemateriel t ON  t.id =  m.typemateriel_id')
                ->leftjoin('m.Marque q ON  q.id =  m.marque_id')
			   ->leftjoin('m.Catmateriel c ON  c.id =  m.catmateriel_id')
                ->leftJoin('m.MouvementMateriel s ON s.materiel_id = m.id')
                ->leftJoin('s.Mouvement f ON f.id = s.mouvement_id')
				->where ('m.id = ?', $request->getParameter('materiel_id'))
				->limit(1)
                ->fetcharray();
				 }
		if($request->getParameter('avs_id')){
		        $this->avs= Doctrine_Query::create()
                ->select('a.id,a.nom as avsnom,a.prenom as avsprenom')
                ->from('avs a')
                ->where('a.id=?',$request->getParameter('avs_id'))
				->limit(1)
                ->fetcharray();
		 
		 }

		}
		
		if($request->getParameter('destinataire') && $request->getParameter('user_id')  ){ //envoi du mail
		
		       //sauvegarde du mail envoyé
			   //-------------------------
		            $mail = new Mail();
					$date = date('Y-m-d', time()) ;
					$mail->setEleveId($request->getParameter('eleve_id'));
					$mail->setSfguarduserId($request->getParameter('sf_id'));
					$mail->setSujet($request->getParameter('sujet'));
					$mail->setTexte($request->getParameter('corps'));
					$mail->setDate($date);
					$mail->save();
					
                //envoi du mail
			    //---------------
				$message = Swift_Message::newInstance()
				 ->setFrom('acad@ac-reunion.fr')
				  //->setTo($destinataire[0]['email_address'])
				 // ->setTo($request->getParameter('destinataire') )
				 ->setTo('aide.handicap.ecole@ac-reunion.fr' )
				  //->setSubject($mail->getSujet())
				 ->setSubject($request->getParameter('sujet') )
				  //->setBody($mail->getTexte());
				 ->setBody($request->getParameter('corps') );
				$this->getMailer()->send($message);
				$this->getUser()->setFlash('notice', 'message envoyé à l\'ERF :'.$request->getParameter('user_id'));
				$this->redirect('mail/email');
		}
	   
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($mail = Doctrine_Core::getTable('mail')->find(array($request->getParameter('id'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id')));
    $this->form = new mailForm($mail);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($mail = Doctrine_Core::getTable('mail')->find(array($request->getParameter('id'))), sprintf('Object mail does not exist (%s).', $request->getParameter('id')));
    $mail->delete();
	$message ='message daté du '.date('d-m-Y',strtotime($mail->getDate())).' supprimé sujet :' .' '.$mail->getSujet() .' - ERF destinataire :'.$mail->getSfGuardUser();
   $this->getUser()->setFlash('notice',$message );

    $this->redirect('mail/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
	
    if ($form->isValid())
    {
		
		$mail = $form->save();
		
		// --- envoie du mail à l'eref concerné (secteur) ------------------------------------------
	/*
		$destinataire = $form->getObject()->getDestinataire($form->getObject()->getEleveId());
		$message = Swift_Message::newInstance()
				  ->setFrom('acad@ac-reunion.fr')
				  //->setTo($destinataire[0]['email_address'])
				  ->setTo('regis.gravant@gmail.com')
				  //->setSubject($mail->getSujet())
				  ->setSubject('test')
				  //->setBody($mail->getTexte());
				  ->setBody('ddddddddd ddddddddd dddddddddd');
		 
		$this->getMailer()->send($message);
		
		$this->redirect($mail->getRoute($destinataire['secteur_id']));

		// -----------------------------------------------------------------------------------------
	*/
	
	 //  $this->redirect('eleve_avs/edit?id='.$form->getobject()->getId()); 
	  $this->getUser()->setFlash('notice', 'message enregistré avec succès');
	   $this->redirect('mail/edit?id='.$mail->getId());
        
     }
  }
  public function executeAide(){}	
  
}
