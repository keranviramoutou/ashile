<?php
 
class mesComponents extends sfComponents
{
  public function executeEmail(sfWebRequest $request)
  {
	  /**
	   * variables eleve_id, nomModule à passer !! 
	   */
	  
			// ****** ENVOIE AUTOMATIQUE DE L'EMAIL A EREF **************************************
			$destinataire = $form->getObject()->getDestinataire($form->getObject()->getEleveId());
			$message = Swift_Message::newInstance()
				  ->setFrom('acad@ac-reunion.fr')
				  ->setTo($destinataire[0]['email_address']) //->setTo('eref.ash@ac-reunion.fr')
				  ->setSubject($nomModule)
				  ->setBody('s mmmmmmmm rr ppp');
		 
			$this->getMailer()->send($message);
			// ***********************************************************************************

			
			// ----- ENREGISTREMENT AUTOMATIQUE DE L'EMAIL EN BDD --------------------------------
			$mail = new Mail();
			$mail->setEleveId($form->getObject()->getEleveId());
			$mail->setSfGuardUserId($destinataire[0]['email_address']);
			$mail->setDate(date('Y-m-d', time()));
			$mail->setSujet($nomModule);
			$mail->setTexte("STRINNNGggg");
			
			$this->form = new mailForm($mail);
			
			//$mail->save();
  }
  
}
