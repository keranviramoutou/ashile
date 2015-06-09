<?php

/**
 * type_contrat_avs actions.
 *
 * @package    ash
 * @subpackage type_contrat_avs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class type_contrat_avsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->type_contrat_avss = Doctrine_Core::getTable('TypeContratAvs')
      ->createQuery('a')
      ->execute();
  }
  public function executeIndex1(sfWebRequest $request)
  {
    $this->type_contrat_avss = Doctrine_Core::getTable('TypeContratAvs')
      ->createQuery('a')
      ->execute();
  }
  
    public function executeRecherche(sfWebRequest $request)
  {
  
    if($_POST['typecontrat_id']){
	 $typecontrat_id = '%'.$request->getPostParameter('typecontrat_id').'%';
	 }
	   if ($request->isMethod('post')){ 
	   
	     if ($_POST['typecontrat_id'] != '999'){ 
	    //selection des avs qui ont au moins un contrat de type selecctionné
		//------------------------------------------------------------------
		$this->contrat_avss = Doctrine_Query::Create()
					->select ('a.id as id,c.id as contrat,tc.id as typecontratId,Id,nom as nom,prenom as prenom,date_naissance as date_naissance,tel1 as tel1,tel2 as tel2,email as email,tc.typecontrat as typecontrat')
					->from('Avs a')
					->innerJoin('a.ContratAvs c ON a.id = c.avs_id')
					->innerjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
					->where('a.id in (select avs_id from contrat_avs c )')
					->andwhere('c.typecontratavs_id = ?', $request->getPostParameter('typecontrat_id'))
					->fetchArray(); 
	   //--------------------------------------------------------------------------------------
	    }
		}
		
	    	//les AVS qui n'ont  pas de contrat
			//----------------------------------
		   		$this->contrat_sans = Doctrine_Query::Create()
                ->select ('id as id,nom as nom,prenom as prenom,date_naissance as date_naissance,tel1 as tel1,tel2 as tel2,email as email')
                ->from('Avs a')
                ->where('id not in (select avs_id from contrat_avs)')
                ->fetchArray();
				$this->count_sans_contrat = count($this->contrat_sans);
	
	   
	   	 //selection des types de contrat avec le nombre par type
		//--------------------------------------------------------
	  		$this->type_contrat_avss = Doctrine_Query::Create()

					->select ('c.typecontratavs_id as typecontratId,count(c.id) total,tc.typecontrat as typecontrat,tc.id as tcId')
					->from('ContratAvs c')
					->innerjoin('c.TypeContratAvs tc ON tc.id = c.typecontratavs_id')
				//	->andwhere('c.typecontratavs_id = ?', $request->getPostParameter('typecontrat_id'))
					->groupby ('c.typecontratavs_id')
					->fetchArray();  


  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TypeContratAvsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TypeContratAvsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($type_contrat_avs = Doctrine_Core::getTable('TypeContratAvs')->find(array($request->getParameter('id'))), sprintf('Object type_contrat_avs does not exist (%s).', $request->getParameter('id')));
    $this->form = new TypeContratAvsForm($type_contrat_avs);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($type_contrat_avs = Doctrine_Core::getTable('TypeContratAvs')->find(array($request->getParameter('id'))), sprintf('Object type_contrat_avs does not exist (%s).', $request->getParameter('id')));
    $this->form = new TypeContratAvsForm($type_contrat_avs);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($type_contrat_avs = Doctrine_Core::getTable('TypeContratAvs')->find(array($request->getParameter('id'))), sprintf('Object type_contrat_avs does not exist (%s).', $request->getParameter('id')));
    $type_contrat_avs->delete();

    $this->redirect('type_contrat_avs/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $type_contrat_avs = $form->save();

      $this->redirect('type_contrat_avs/edit?id='.$type_contrat_avs->getId());
    }
  }
}
