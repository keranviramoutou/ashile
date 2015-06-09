<?php

/**
 * orientation actions.
 *
 * @package    Labo
 * @subpackage orientation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orientationActions extends sfActions
{
	// fonction qui va donner la liste d'etabsco autocomplete
	public function executeAjaxSection(sfWebRequest $request)
  	{
        $this->getResponse()->setContentType('application/json');
        $choices = array();
 
        if($request->hasParameter('q') and $request->hasParameter('limit'))
        {
            $q = $request->getParameter('q');
            $limit = $request->getParameter('limit');
        } else
        {
            throw sfException('q et limit doivent être définis dans la requête.');
        }
        $section = Doctrine::getTable('Etabsco')->getEtabAutocompletion($q, $limit)->getData() ;
        foreach($section  as $p)
        {
            $choices[$p->id] = $p->rne.' - '.$p->typeetab.' - '.$p->nometab;
			//$choices[$p->id] = $p->rne.' - '.$p->typeetab;
        }
 
        if($section != array())
        {
            return $this->renderText(json_encode($choices));
			//return $this->renderPartial('orientation/selectEtabsco', array('etabscos' => $etabscos, 'selected' => $request->getParameter('selected')));
        }
    }
  	
  public function executeBascule(sfWebRequest $request)
  {
  
     
       //récupération des élèves scolarisés
	   //--------------------------------------------------------
        $this->eleves = Doctrine_Core::getTable('Orientation')-> getListDerSco();
		$this->count_eleve= count( $this->eleves);
		
	    //année scolaire prochaine
		///////////////////////////
	    $annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $deb = $annee->getDatedebutanneescolaire();
        $fin = $annee->getDatefinanneescolaire();
		$this->deb_encours = $annee->getDatedebutanneescolaire();		 
		$this->fin_encours = $annee->getDatefinanneescolaire();
						
		//test si bascule déjà effectuée après année scolaire en cours
		//-------------------------------------------------------------
		$deja_bascule1 = Doctrine_query::create()
			->select('*')
			->from('Orientation o')
			->andWhere('o.datedebut >=?', $fin)
			->andWhere('o.datefin >=?', $fin)
			->fetchArray();
		$this->bascule1 = count($deja_bascule1);
		$this->bascule2 = count($deja_bascule1);
		
		if (strtotime( $_POST['datedebut']) && strtotime( $_POST['datefin'])){
		//test si basculé déjà effectuée avec les dates saisies
		//----------------------------------------------------
			$deja_bascule = Doctrine_query::create()
			->select('*')
			->from('Orientation o')
			->andWhere('o.datedebut =?',  date('Y-m-d',strtotime($_POST['datedebut'])))
			->andWhere('o.datefin =?', date('Y-m-d',strtotime( $_POST['datefin'])))
			->fetchArray();
			 $this->bascule1 = count($deja_bascule);
		}
  
		if ( $this->bascule1 == 0 ){//test bascule déjà faite 
  
					if ($request->isMethod('post')){
		
 						if (strtotime( $_POST['datedebut']) && strtotime( $_POST['datefin'])){
						
				        if (date('Y-m-d',strtotime( $_POST['datedebut'])) >= $fin && date('Y-m-d',strtotime( $_POST['datefin'])) >= $fin){
					          
      
								foreach ($this->eleves as $eleve)
									{
									$this->getUser()->setFlash('notice','Bascule en cours élève :'.$eleve['nom'].' '.$eleve['prenom'].' compteur '.$compte.' sur '.count( $this->eleves));
												$neworientation = new Orientation();
												$neworientation->setArray(array(
																		'eleve_id'	 => $eleve['eleve_id'],
																		'datedebut'	 => date('Y-m-d',strtotime($_POST['datedebut'])),
																		'datefin'	 => date('Y-m-d',strtotime($_POST['datefin'])),
																		'etabsco_id' =>	$eleve['etabsco_id'],
																		'notes'      => 'bascule année scolaire 2014-2015'
																		));
												 $neworientation->save();
									$compte++;

									}
										//compte le nombre de scolarité basculée par secteur
										//---------------------------------------------------
										 $this->orientation = Doctrine_query::create()
											->select('et.nometabsco as nometabsco,et.rne as rne,count(e.id) compte,e.secteur_id as secteur_id,s.libellesecteur as libellesecteur,e.id as eleveId,e.ine as ine,t.nomtypeetablissement as typetab,o.id as orienId')
											->from('Orientation o')
											->innerJoin('o.Eleve e ON e.id = o.eleve_id')
											->innerjoin('e.Secteur s ON s.id = e.secteur_id')
											->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
											->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
											->andWhere('o.datedebut =?', date('Y-m-d',strtotime( $_POST['datedebut'])))
											->andWhere('o.datefin =?',date('Y-m-d',strtotime( $_POST['datefin'])))
											->groupBy('e.secteur_id')
											->fetchArray();
											
										 $this->count_bascule = count($this->orientation);
										 
								$this->getUser()->setFlash('notice','Nombre de scolarités basculées : '.$compte.' sur '.count( $this->eleves)); // Pour les message
								$_POST['datedebut']=null;
								$_POST['datefin']=null;
		                }else{
						 if (date('Y-m-d',strtotime( $_POST['datedebut'])) < $fin){
						$this->getUser()->setFlash('error','la date de début de la nouvelle année '.date('d-m-Y',strtotime( $_POST['datedebut'])).' n\'est postérieure à la date de fin de l\'année scolaire  en cours '.date('d-m-Y',strtotime($fin))); 
						}
						if (date('Y-m-d',strtotime( $_POST['datefin'])) < $fin){
						$this->getUser()->setFlash('error','la date de fin de la nouvelle année '.date('d-m-Y',strtotime( $_POST['datefin'])).' n\'est postérieure à la date de fin de l\'année scolaire  en cours '.date('d-m-Y',strtotime($fin))); 
						}
						}

						}else{ //controle date de début et fin renseignée
						$this->getUser()->setFlash('error','impossible de faire la bascule saisir une date de début et de fin d\'année scolaire !!'); // Pour les message
						}


					} //test post
					
				}else{ //test bascule déjà effectuée
					
						$this->getUser()->setFlash('error','impossible de faire ,la bascule bascule déja effectuée pour '. $this->bascule2.' élève(s) !!!!! '); // Pour les message
				}
			
			
  }

  public function executeIndex(sfWebRequest $request)
  {
	  

        $annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $deb = $annee->getDatedebutanneescolaire();
        $fin = $annee->getDatefinanneescolaire();
		//$this->orientations = Doctrine_Core::getTable('Orientation');

        $this->eleves = Doctrine_query::create()
               ->select('e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,e.secteur_id as secteur_id,s.libellesecteur as libellesecteur,e.id as eleveId,e.ine as ine,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab,o.id as orienId')
                ->from('Orientation o')
                ->innerJoin('o.Eleve e ON e.id = o.eleve_id')
			->innerjoin('e.Secteur s ON s.id = e.secteur_id')
               ->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
                ->andWhere('o.datedebut >=?', $deb)
               ->andWhere('o.datefin <=?', $fin)
               ->andWhere('e.datesortie IS NULL')
			   ->andwhere('e.secteur_id = ?', $request->getParameter('secteur_id'))
               ->orderBy('libellesecteur,et.nometabsco ASC,e.nom')
               ->addOrderBy('e.nom')
               ->fetchArray();
  }
  
    public function executeList1(sfWebRequest $request)
  {
		//liste des scolarités pour un élève
		//-------------------------------------------
		$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $this->deb = $annee->getDatedebutanneescolaire();
        $this->fin = $annee->getDatefinanneescolaire();
		$this->eleves = Doctrine_Core::getTable('Orientation')-> getListeSco($request->getParameter('eleve_id'));
		$this->dersco1 = Doctrine_Core::getTable('Orientation')->getDerSco($request->getParameter('eleve_id'));
        
  }
  
  
  public function executeSecteur(sfWebRequest $request)
  {

        $annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $deb = $annee->getDatedebutanneescolaire();
        $fin = $annee->getDatefinanneescolaire();
	
        $this->eleves = Doctrine_query::create()
               ->select('e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,e.secteur_id as secteur_id,s.libellesecteur as libellesecteur,e.id as eleveId,e.ine as ine,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab,o.id as orienId')
                ->from('Orientation o')
                ->innerJoin('o.Eleve e ON e.id = o.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
               ->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->where('t.nomtypeetablissement LIKE "%IEN%"')
                ->orderBy('libellesecteur,et.nometabsco ASC,e.nom')
               ->addOrderBy('e.nom')
               ->fetchArray();
  }
  
  	public function executeAjaxNiveau(sfWebRequest $request)
    {
		$etab = Doctrine::getTable('Etabsco')->find($request->getParameter('etabsco_id'));
		//$etab_degre = $etab->getDegreetabsco()  ;
		$etab_type = $etab->getTypeetablissement()   ;
		if ( strstr($etab_type = $etab->getTypeetablissement(),'L') && !strstr($etab_type = $etab->getTypeetablissement(),'CLG')){ //si lycée
		
				$niveaus = Doctrine_Query::Create()
				->from('Niveauscolaire n')
				->where( 'n.degreetabsco LIKE "%LYC%"')
				->orderBy('n.ordre ASC')
      			->execute();
		
		}else{
			$niveaus = Doctrine_Query::Create()
				->from('Niveauscolaire n')
				->where( 'n.degreetabsco = ?', $etab_type)	
				->orderBy('n.ordre ASC')
				->execute();
				
	    }
						
		return $this->renderPartial('orientation/selectNiveau', array('niveaus' => $niveaus, 'selected' => $request->getParameter('selected')));						
	}
    /**
     * requete ajax pour avoir la liste des classe de etab
     *
     * @param sfWebRequest $request
     */
    public function executeAjaxClasse(sfWebRequest $request)
    {
		// selection par switch case des classes / etab clis ulis etc..
		
		$etab = Doctrine::getTable('Etabsco')->find($request->getParameter('etabsco_id'));
		
		// fonction qui retourne les classes CLIS ULIS ou ND en fonction du EtabInclusion_id de Etabsco

			// ---- on commence par récuperer inclusionetab de l'etablissement
			$etabInclu = Doctrine::getTable('Etabsco')->findOneById($etab->getId())->getEtabscoInclusion();
			// --- on retourne les classes concernées
	
			$Classe_clis_Ulis_ND = '*'.implode('* *', explode(' ', $etabInclu)).'*';

			
			if($etabInclu == 'ND') // --- l'etablissement est de type ND ( on prend toutes les classes sans les CLIS et ULIS)
			{
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->orderBy('tc.ordre');
			}
			
			//TRAITEMENT DES CLASSES POUR LE PREMIER DEGRE
			//////////////////////////////////////////////
			
			if($etabInclu == 'CLIS1 CLIS2'){	///etablissement avec une classe de CLIS1 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');
			}
			
			if($etabInclu == 'CLIS1'){	///etablissement avec une classe de CLIS1 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');
			}
			
			if($etabInclu == 'CLIS2'){	///etablissement avec une classe de CLIS2 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');	
			}
			
			if($etabInclu == 'CLIS3'){	///etablissement avec une classe de CLIS3 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');							
			}
   			if($etabInclu == 'CLIS4'){	///etablissement avec une classe de CLIS4 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1'.'%')	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->orderBy('tc.ordre');	
			}
			
			 if($etabInclu == 'CLIS1  CLIS4'){	 ///etablissement avec une classe de CLIS1 et CLIS4 et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->orderBy('tc.ordre');
			}
			
			
			  if($etabInclu == 'CLIS1 TED'){	 ///etablissement avec une classe de CLIS1 et CLIS TED et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS TED'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');
			}
			
			if($etabInclu == 'CLIS TED'){	///etablissement avec une classe de CLIS1 TED et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS1')	//permet de selectionner les classes 'CLIS1 TED'
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS2'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS3'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'CLIS4'.'%')
							->orderBy('tc.ordre');
			}
			

			
			//TRAITEMENT DES CLASSES POUR LE SECOND DEGRE
			//////////////////////////////////////////////
			
			 if($etabInclu == 'ULIS TFC'){	 ///etablissement avec une classe de ULIS TFC et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');
			}
			
			 if($etabInclu == 'ULIS TFM'){	 ///etablissement avec une classe de ULIS TFM et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');							
			}
			
			
			if($etabInclu == 'ULIS TFA'){	 ///etablissement avec une classe de ULIS TFA et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');
			}
			
			
			if($etabInclu == 'ULIS TFV'){	 ///etablissement avec une classe de ULIS TFV et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');
			}
			
			if($etabInclu == 'ULIS LP'){	 ///etablissement avec une classe de ULIS TFV et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFC'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFM'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->orderBy('tc.ordre');
			}
			
			
				if($etabInclu == 'ULIS TFC TFM'){	 ///etablissement avec une classe de ULIS TFC et TFM et les autres classes ordinaires
					$q = Doctrine_Query::Create()
							->from('Classe c')
							->innerjoin('c.Typeetablissement t on t.id = c.typeetablissement_id ')
							->innerjoin('t.Etabscos e on e.typeetablissement_id = t.id')
							->innerJoin('c.TypeClasse tc ON tc.id = c.typeclasse_id')
							->where( 'e.id = ?', $etab->getId() )
							//->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.$etabInclu.'%');	
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFV'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'TFA'.'%')
							->andWhere('tc.nomtypeclasse NOT LIKE ?', '%'.'LP'.'%')
							->orderBy('tc.ordre');
					
			}
			
			$classes = $q->execute();	
		
			

		 
		return $this->renderPartial('orientation/selectClasse', array('classes' => $classes, 'selected' => $request->getParameter('selected')));

    } 
    
  public function executeShow(sfWebRequest $request)
  {
    $this->orientation = Doctrine::getTable('Orientation')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->orientation);
  }

  public function executeNew(sfWebRequest $request)
  {
  
				$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
				$deb = $annee->getDatedebutanneescolaire();
				$fin = $annee->getDatefinanneescolaire();
				
				$eleveId = $request->getParameter('eleve_id'); 

	         //dernière scolarisation de l'élève en cours à la date du jour
			 //--------------------------------------------------------------
			   $this->eleve = Doctrine_Core::getTable('Orientation')->getDerSco($eleveId);
		    	 $this->existeleve = count($this->eleve);
			  
			   	 $this->existeleve = count($this->eleve);	
				 
			 	//historique scolarisation de l'élève en cours à la date du jour
				//---------------------------------------------------------------
				$this->scolarisation = Doctrine_Core::getTable('Orientation')->getHistoSco($eleveId);
			    $this->existhistosco = count($this->scolarisation);  
	
			
			    $this->existhistosco = count($this->scolarisation);  
			   
				//$this->eleve = Doctrine::getTable('Eleve')->findOneById($eleveId); 
				$orientation= new Orientation();
				sfContext::getInstance()->getUser()->setAttribute('eleve_id', $eleveId);
				$orientation->setEleveId($eleveId);
				//$orientation->setDatedebut(time());
				$orientation->setDatedebut($deb);
				$orientation->setDatefin($fin);
				sfContext::getInstance()->getUser()->setAttribute('eleve_id', $eleveId); //variable globale utilisée dans le processform pour mettre à jour la date de fin de la dernière scolarisation,
				$this->form = new OrientationForm($orientation,$this->existhistosco,$eleve, $this->eleve);
		
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new OrientationForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

    public function executeCloture(sfWebRequest $request)
  {
		$eleveId = $request->getParameter('eleve_id'); 
		$Id = $request->getParameter('id') ;
		
	    //dernière scolarisation de l'élève en cours à la date du jour
		//--------------------------------------------------------------
		$this->eleve = Doctrine_Core::getTable('Orientation')->getDerSco($eleveId);
		$this->existeleve = count($this->eleve);
		
		// ------- le date transmise par $POST --------
		$laDate = $_POST['maj'];
		
		if ($laDate){ // test si la date est saisie
		$q = Doctrine_Query::create()
					->update('orientation o')
					->set('o.datefin', '?', $laDate)
					//->where('o.eleve_id = '.$eleveId)
					->where('o.id = '.$Id);
	
		$rows = $q->execute();
		$this->getUser()->setFlash('notice', 'l\'orientation : '.'ont étaient clôturés avec succès à la date du ');//.format_date($laDate,'dd/MM/yyyy'));

		// --------------------------------------
		}else{
		$this->getUser()->setFlash('error', 'Pas de date saisie pour la clôture des affectations');
		}
		//$this->redirect('orientation/edit?id='.$request->getParameter('id'));
  }
  
  
  // fonction qui donne un parametre 'csecteur' à eleve pour dire dans edit orientation -> changement d'orientation. ---------
  public function executeCsecteur(sfWebRequest $request)
  {
    sfContext::getInstance()->getUser()->setAttribute('csecteur', '1');
    $this->redirect('orientation/edit?id='.$request->getParameter('id'));
  }
  // --------------------------------------------------------------------------------------------------------------------------
  
  
  public function executeEdit(sfWebRequest $request)
  {
			$eleveId = $request->getParameter('eleve_id'); 
			//liste des etab pour la liste autocomplete
			//------------------------------------------
			$this->etabs = Doctrine::getTable('Etabsco')->findAll();
			//dernière scolarisation de l'élève en cours à la date du jour
			//--------------------------------------------------------------
			$this->eleve = Doctrine_Core::getTable('Orientation')->getDerSco($eleveId);
		    $this->existeleve = count($this->eleve);
		   
			//historique scolarisation de l'élève en cours à la date du jour
			//---------------------------------------------------------------
			$this->scolarisation = Doctrine_Core::getTable('Orientation')->getHistoSco($eleveId);
			$this->existhistosco = count($this->scolarisation);  


			$this->forward404Unless($orientation = Doctrine::getTable('Orientation')->find(array($request->getParameter('id'))), sprintf('Object orientation does not exist (%s).', $request->getParameter('id')));
			
			$orientation->setClasseId($orientation->getClasseId());


			// 1) on trouve eleve
			$eleve = $orientation->getEleve();
			
			// 2) on trouve secteur_id
			$secteur = $eleve->getSecteur();
			
			// comme coté eref on donne l'attribut eleveId a user pour EtabscoTable.class
			sfContext::getInstance()->getUser()->setAttribute('secteur_id', $secteur->getId());
			$this->form = new OrientationForm($orientation,$this->eleve,$this->scolarisation,$this->existhistosco);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($orientation = Doctrine::getTable('Orientation')->find(array($request->getParameter('id'))), sprintf('Object orientation does not exist (%s).', $request->getParameter('id')));
    $this->form = new OrientationForm($orientation);
    //$this->getUser()->setFlash('error','Une erreur est survenue'); // Pour les erreurs
   // $this->getUser()->setFlash('notice','Modification scolarisation enregistrée'); // Pour les messages 
    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($orientation = Doctrine::getTable('Orientation')->find(array($request->getParameter('id'))), sprintf('Object orientation does not exist (%s).', $request->getParameter('id')));
    $eleve_id = $orientation->getEleveId()	;
	$orientation->delete();

   // $this->redirect('orientation/index');
	  $this->redirect('orientation/list1?eleve_id='.$eleve_id);
  }

    protected function processForm(sfWebRequest $request, sfForm $form)
    {
		//sfContext::getInstance()->getUser()->getAttribute('eleve');
				
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
		
		
			 //récupération de la dernière orientation en cours
			 //---------------------------------------------------
			 $eleve_id = $this->getUser()->getAttribute('eleve_id');//récupération de la variable globale définit plus haut par sfContext::getInstance()->getUser()
	    				$res = Doctrine_Query::create()
							->select('p.eleve_id as eleve_id,MAX(p.id) as id')
							->from('Orientation p')
							->groupBy('p.eleve_id')
							->having('p.eleve_id = ?', $eleve_id)
							->fetchArray();
					    $count_res = count($res);

 
					  

			
							
            $orientation = $form->save();
            
            // Mise a jour su secteur_id de eleve si l'orientation est dans secteur différent
            // 1) on cherche secteur de eleve
            $eleve = $orientation->getEleve();
		    $eleve_id = $orientation->getEleveId()	;
            $secteur_eleve = $eleve->getSecteurId();
			
			  //récupération de la fiche de l'élève
            //--------------------------------------
               				$fiche_eleve = Doctrine_Query::create()
							->select('e.nom as nom,e.prenom as prenom,e.id as eleve_id')
							->from('Eleve e')
							->where('e.id = ?', $eleve_id)
							->limit(1)
							->fetchArray();
			
			
            // 2)on chercher le secteur de etab
            $etab = $orientation->getEtabsco();
            $secteur_etab = Doctrine::getTable('SecteurEtabsco')->findOneByEtabscoId($etab->getId());
           

		   // on compare et on met à jour si le secteur de l'élève different du secteur de l'etab
			//------------------------------------------------------------------------------------
            if($secteur_eleve != $secteur_etab->getSecteurId())
            {
				Doctrine_Query::Create()
					->update('Eleve e')
					->set('e.secteur_id', $secteur_etab->getSecteurId())
					->where('e.id =?', $eleve->getId())
					->execute();
			}
            // -----------------------------------------------------------------------------------
            
			
	
		
			
	   //changement de secteur 
	   //-----------------------
	   
	   $this->etab = Doctrine_Core::getTable('Etabsco')->findOneByRne('9740061Y');
	   if(sfContext::getInstance()->getUser()->getAttribute('csecteur') == 1){ //si la date de fin est renseignée
		
		//création d'une nouvelle orientation sur l''etabsco ASH
		//-------------------------------------------------------
	//	$newscolarisation = new Orientation();
    //    $newscolarisation->setDatedebut($orientation->getDatefin());	
    //    $newscolarisation->setEtabscoId($this->etab->getId()) ;
	//	$newscolarisation->setClasseId($orientation->getClasseId());
	//	$newscolarisation->setEleveId($orientation->getEleveId());
	//	$newscolarisation->save();
		}
			
			
			
			if($count_res > 0  && $form->getObject()->isNew()){	
			
			//mise à jour de la date de fin de la dernière scolarisation  avec la date de début de la nouvelle scolarisation
			//seulement si l'enregistrement est nouveau
			//----------------------------------------------------------------------------------------------------------------
	

				$majDate = Doctrine_Query::create()
						->update('Orientation p ')
						->set('p.datefin','?' , $orientation->getDatedebut() )
						->where('p.id = ?', $res[0]['id']);

				$majDate->execute();
			}
		if($count_res > 0 )
		{
		$this->getUser()->setFlash('notice', 'Scolarisation enregistrée avec succès'.'  la dernière scolarisation clôturée à la date du '. date('d/m/Y',strtotime($orientation->getDatefin().$_POST['param'])));
		}else{
	        $this->getUser()->setFlash('notice', 'Scolarisation enregistrée avec succès');
		}
         
          // $this->redirect('orientation/edit?id=' . $orientation->getId(),array('scolarisation' => $scolarisation));
		//  $this->redirect('orientation/list1?eleve_id='.$eleve_id);
		   $this->redirect('eleve/recherche?eleve_nom='.$fiche_eleve[0]['nom'].'&eleve_prenom='.$fiche_eleve[0]['prenom'].'&eleve_id='.$fiche_eleve[0]['eleve_id'].'&flag_recherche=1');
        }else{
		if ($form['classe_id']->getvalue() == 0){
		 //récupération de la fiche de l'élève
          //--------------------------------------
               				$fiche_eleve = Doctrine_Query::create()
							->select('e.nom as nom,e.prenom as prenom,e.secteur_id as secteur_id,e.id as eleve_id')
							->from('Eleve e')
							->where('e.id = ?', $form['eleve_id']->getvalue())
							->limit(1)
							->fetchArray();
							
							
		 $this->getUser()->setFlash('error', 'pas de classe saisie, modifications pas prises en compte'.$form['eleve_id']->getvalue());
		 $this->redirect('orientation/edit?id='.$form['id']->getvalue().'&eleve_nom='.$fiche_eleve[0]['nom'].'&eleve_prenom='.$fiche_eleve[0]['prenom'].'&secteur='.$fiche_eleve[0]['secteur_id'].'&eleve_id='.$fiche_eleve[0]['eleve_id']);
		 }
		}
    }
	 public function executeAide(){}
}
