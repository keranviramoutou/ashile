<?php

/**
 * eleveavs actions.
 *
 * @package    ash
 * @subpackage eleveavs
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class eleveavsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {

	  //$anneeScolaire =	Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
      $this->eleve_avss = Doctrine_Query::Create()
		->select ('avs.id as avs_id, avs.nom as avsnom, avs.prenom as avsprenom, e.id as eleve_id,e.nom as nom,e.prenom as prenom,a.quotitehorraireavs as quotitehorraireavs,a.datefin as datefin,a.datedebut as datedebut,
		    a.id as eleveavs_id ')
		->from('EleveAvs a')
		->innerJoin('a.Eleve e ON e.id = a.eleve_id')
		->innerJoin('a.Avs avs ON avs.id = a.avs_id')
	  //  ->leftJoin('avs.ContratAvs ca ON avs.id = ca.avs_id')
		// ->innerJoin('ca.TypeContratAvs ty ON ty.id = ca.typecontratavs_id')
        ->where('a.eleve_id =?', $request->getParameter('eleve_id'))
        //->andwhere('ca.date_fin_contrat > ?',$anneeScolaire->getDatedebutanneescolaire())
	//	->andwhere('ca.date_fin_contrat > ?',date('Y-m-d', time()))
		->orderby('datedebut desc,datefin desc')
		->fetcharray();
  }
  
      public function executeIndex1(sfWebRequest $request)
    {    
	   // liste des élèves accompagnés par secteur
	   //------------------------------------------
	    $this->user = $this->getUser();
	    $secteur = $this->getUser()->getAttribute('secteur');
		$secteur_id = $request->getParameter('secteur_id');
	  $this->eleve_avss =Doctrine_Core::getTable('EleveAvs')->getListeEleveparSecteur($secteur->getId());


    }
	
	

  public function executeShow(sfWebRequest $request)
  {
	$nondefinit = 'non definit';

    $this->eleve_avs = Doctrine_Core::getTable('EleveAvs')->findOneByEleveId($request->getParameter('eleve_id'));
    $this->forward404Unless($this->eleve_avs);
    $eleve_avs = $this->eleve_avs;


	// 1 resuperation de l'id avs
	$avsId = $eleve_avs->getAvsId();
	
	// telephone de avs--------------
	$this->tel1 = Doctrine::getTable('Avs')->findOneById($avsId)->getTel1();

	// etabsco de avs----------------

	// 2 etabsco

	$a = Doctrine_core::getTable('ContratAvs')
		 	->findOneByAvsId($avsId);
		 	
	if($a){ 
		$this->EtabAvs = $a->getEtabsco();
	}else{
		$this->EtabAvs = $nondefinit;
	}
	
	// nature contrat avs-----------
	$this->nature_contrat = Doctrine::getTable('ContratAvs')
		 	->findOneByAvsId($avsId)
     		->getNaturecontratavs();

		
	// 3 recuperation des dates debut et fin de contrat
	$ca = Doctrine_core::getTable('ContratAvs')
		->findOneByAvsId($avsId);

	if($ca){ 
		$this->dateDebutCont = $ca->getDateDebutContrat();
	 }else{
		$this->dateDebutCont = $nondefinit;
	} 

	if($ca){
		 $this->dateFinCont = $ca->getDateFinContrat();
	}else{
		$this->dateFinCont = $nondefinit;
	}

	// recuperation debut et fin d'attribution eleve/avs
	$this->dateDebutAttrib = $eleve_avs->getDatedebut();

	$this->dateFinAttrib = $eleve_avs->getDateFin();


  	$typecontrat = $ca->getTypeContratAvs();

	if($ca){
		 $this->typeContratAvs = $typecontrat;
	}else{
		$this->typeContratAvs = $nondefinit;
	}
/*
	// recuperation date changement position avs
	$e = Doctrine_core::getTable('AvsEmployeEtabsco')
		->findOneByAvsId($avsId);

	if($e){
		$this->ChangpositionAvs = $e->getUpdated_at();
	}else{
		$this->ChangpositionAvs = $nondefinit;
	}
*/
  }

  public function executeNew(sfWebRequest $request) {
        $eleve_id = $this->getRequestParameter('eleve_id');
        $elavs = new EleveAvs();
        $elavs->setEleveId($this->getRequestParameter('eleve_id'));
        $this->form = new EleveAvsForm();
    }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new EleveAvsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($eleve_avs = Doctrine_Core::getTable('EleveAvs')->find(array($request->getParameter('eleve_id'),
                          $request->getParameter('avs_id'))), sprintf('Object eleve_avs does not exist (%s).', $request->getParameter('eleve_id'),
                          $request->getParameter('avs_id')));
    $this->form = new EleveAvsForm($eleve_avs);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($eleve_avs = Doctrine_Core::getTable('EleveAvs')->find(array($request->getParameter('eleve_id'),
                          $request->getParameter('avs_id'))), sprintf('Object eleve_avs does not exist (%s).', $request->getParameter('eleve_id'),
                          $request->getParameter('avs_id')));
    $this->form = new EleveAvsForm($eleve_avs);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($eleve_avs = Doctrine_Core::getTable('EleveAvs')->find(array($request->getParameter('eleve_id'),
                          $request->getParameter('avs_id'))), sprintf('Object eleve_avs does not exist (%s).', $request->getParameter('eleve_id'),
                          $request->getParameter('avs_id')));
    $eleve_avs->delete();

    $this->redirect('eleveavs/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $eleve_avs = $form->save();

      $this->redirect('eleveavs/edit?eleve_id='.$eleve_avs->getEleveId().'&avs_id='.$eleve_avs->getAvsId());
    }
  }
  
  public function executeAide(sfWebRequest $request){}


 private function createObjectExcel()
    {
        $this->setLayout(false);
        $secteur = $this->getUser()->getAttribute('secteur');
        //$secteur = Doctrine_Core::getTable('Secteur')->find(1);
         $objPhpExcel = new PHPExcel();
        $anneeSco = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $objPhpExcel->setActiveSheetIndex(0);
        $sheet = $objPhpExcel->getActiveSheet();
		
						
	   // liste des élèves accompagnés par secteur
	   //------------------------------------------
	    $this->user = $this->getUser();
	    $secteur = $this->getUser()->getAttribute('secteur');
	    $eleves =Doctrine_Core::getTable('EleveAvs')->getListeEleveparSecteur($secteur->getId());

        PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
        // Les largeurs des colonnes
        $this->setColumnWidth($objPhpExcel);
        // Le titre
        $this->titreRender($objPhpExcel, 'Liste des élèves accompagnés du secteur (secteur : ' . $secteur->getId() . ') ' . $anneeSco->__toString());
        // Entete
          $this->setLayout(false);


			   

        $objPhpExcel = new PHPExcel();
        $anneeSco = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $objPhpExcel->setActiveSheetIndex(0);
        $sheet = $objPhpExcel->getActiveSheet();

        PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
        // Les largeurs des colonnes
        $this->setColumnWidth($objPhpExcel);
        // Le titre
        $this->titreRender($objPhpExcel, 'Liste des élèves accompagné(s) (secteur : ' . $secteur->getLibellesecteur().$this->eleves[0]['rne'] . ') ');
  
        $ligne = 2;
		$colonne = 1;
		//ligne entête
        //-------------
		        $this->celluleRender($objPhpExcel, 'A' . $ligne,'n° élève', null);
                $this->celluleRender($objPhpExcel, 'B' . $ligne, 'Nom', null);
                $this->celluleRender($objPhpExcel, 'C' . $ligne, 'Prénom', null);
                $this->celluleRender($objPhpExcel, 'D' . $ligne, 'date de Naissance', 'center');
				$this->celluleRender($objPhpExcel, 'E' . $ligne, 'sexe', null);
				
				//scolarité
				$this->celluleRender($objPhpExcel, 'F' . $ligne, 'Scolarité', null); 
				$this->celluleRender($objPhpExcel, 'G' . $ligne, 'Rne', null);

				
				//affectation
				$this->celluleRender($objPhpExcel, 'J' . $ligne, 'AVS', null); 
				$this->celluleRender($objPhpExcel, 'K' . $ligne,'Début affect ', null);
				$this->celluleRender($objPhpExcel, 'L' . $ligne,'Fin affect', null);
				$this->celluleRender($objPhpExcel, 'M' . $ligne,'Type demande d\'avs', null);
				
				//demande d'avs notifiée en cours
				$this->celluleRender($objPhpExcel, 'N' . $ligne,'Demande d\'avs  notifiée :quotité horaire notifiée', null);
				$this->celluleRender($objPhpExcel, 'O' . $ligne,'Demande d\'avs  notifiée : date décision CDA', null);
				$this->celluleRender($objPhpExcel, 'P' . $ligne,'Demande d\'avs  notifiée : date de début de notification', null);
				$this->celluleRender($objPhpExcel, 'Q' . $ligne,'Demande d\'avs  notifiée : date de fin de notification', null);
				$this->celluleRender($objPhpExcel, 'R' . $ligne,'Demande d\'avs  notifiée : type AVS', null);
				
				//contrat 
				$this->celluleRender($objPhpExcel, 'S' . $ligne,'Type du contrat ', null);
				$this->celluleRender($objPhpExcel, 'T' . $ligne,'début contrat ', null);
				$this->celluleRender($objPhpExcel, 'U' . $ligne,'fin contrat ', null);
				$this->celluleRender($objPhpExcel, 'V' . $ligne,'contrat quotité horaire hebdo ', null);
				
				
				
		foreach ($eleves as $eleve) {
		
		  
                $ligne++;
                // Preparation de données

                // Couleur de fond de cellule
                $couleurFond = $ligne % 2 == 0 ? 'FFD7E4BC' : 'FFEAF1DD';
                $sheet->getStyle('A' . $ligne . ':I' . $ligne)->getFill() //ligne avec fond de couleur
                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($couleurFond);
				$couleurFond = $ligne % 2 == 0 ? 'FFFFFF00':'FFF2F5A9';
                $sheet->getStyle('J' . $ligne . ':M' . $ligne)->getFill() //ligne avec fond de couleur
                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($couleurFond);
                // Preparation des cellules
                $this->celluleRender($objPhpExcel, 'A' . $ligne, $eleve['eleve_id'], 'center');
                $this->celluleRender($objPhpExcel, 'B' . $ligne, $eleve['nomeleve'], null);
                $this->celluleRender($objPhpExcel, 'C' . $ligne, $eleve['prenomeleve'], null);
                $this->celluleRender($objPhpExcel, 'D' . $ligne, $eleve['datenaissance'], 'center');
				$this->celluleRender($objPhpExcel, 'E' . $ligne, $eleve['sexe'], null);
				$this->celluleRender($objPhpExcel, 'F' . $ligne, $eleve['nomtypeetab'].' - '.$eleve['nometabsco'], null); 
				$this->celluleRender($objPhpExcel, 'G' . $ligne, $eleve['rne'], null);

				
				//affectation
				$this->celluleRender($objPhpExcel, 'J' . $ligne, $eleve['nomavs']. ' '.$eleve['prenomavs'], null); 
				$this->celluleRender($objPhpExcel, 'K' . $ligne, $eleve['datedebut'], null);
				$this->celluleRender($objPhpExcel, 'L' . $ligne, $eleve['datefin'], null);
				$this->celluleRender($objPhpExcel, 'M' . $ligne, $eleve['typedemande'], null);
				
				//dernière demande d'AVS notifiée à la date du jour
				$this->celluleRender($objPhpExcel, 'N' . $ligne, $eleve['quotitehorairenotifie'], null);
				$this->celluleRender($objPhpExcel, 'O' . $ligne,$eleve['datedecisioncda'], null);
				$this->celluleRender($objPhpExcel, 'P' . $ligne,$eleve['datedebutnotif'], null);
				$this->celluleRender($objPhpExcel, 'Q' . $ligne,$eleve['datefinnotif'], null);
				$this->celluleRender($objPhpExcel, 'R' . $ligne,$eleve['typedemande'], null);
			
				//contrat 
				$this->celluleRender($objPhpExcel, 'S' . $ligne, $eleve['typecontrat'], null);
				$this->celluleRender($objPhpExcel, 'T' . $ligne,$eleve['date_debut_contrat'], null);
				$this->celluleRender($objPhpExcel, 'U' . $ligne,$eleve['date_fin_contrat'], null);
				$this->celluleRender($objPhpExcel, 'V' . $ligne,$eleve['temps_hebdo'], null);
				
                // Transformation des cellules au format date français
                $sheet->getStyle('D' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('O' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('J' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('K' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('L' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('M' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('O' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('P' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
			    $sheet->getStyle('Q' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('T' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				$sheet->getStyle('U' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
				
                $this->celluleRender($objPhpExcel, 'E' . $ligne, $eleve['sexe'], 'center');
          

        }
      
        //Page setup
        $sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        $sheet->getPageSetup()->setHorizontalCentered(true);
        $sheet->getPageSetup()->setVerticalCentered(false);
        // Les marges
        $sheet->getPageMargins()->setTop(0.25);
        $sheet->getPageMargins()->setRight(0.25);
        $sheet->getPageMargins()->setLeft(0.25);
        $sheet->getPageMargins()->setBottom(0.25);
        return $objPhpExcel;
    }

    private function setColumnWidth(PHPExcel $objPhpExcel)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(18);
        $sheet->getColumnDimension('C')->setWidth(18);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(14);
        $sheet->getColumnDimension('G')->setWidth(11);
        $sheet->getColumnDimension('H')->setWidth(14);
        $sheet->getColumnDimension('I')->setWidth(14);
        $sheet->getColumnDimension('J')->setWidth(14);
        $sheet->getColumnDimension('K')->setWidth(14);
        $sheet->getColumnDimension('L')->setWidth(14);
    }

    private function titreRender(PHPExcel $objPhpExcel, $titre)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $sheet->mergeCells('A1:L1');
        $sheet->getStyle('A1')->getFont()->setName('Cambria');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(18);
        $sheet->getStyle('A1')->getFont()->getColor()->setARGB('FF1F497D');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue('A1', $titre);
    }

    private function etabRender(PHPExcel $objPhpExcel, $noLigne, $nomEtab)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $etabStyle = array(
            'font' => array(
                'bold' => true,
                'name' => 'Arial',
                'size' => 12,
                'color' => array('argb' => 'FF1F497D'),
            ),
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FF1F497D')
                )
            )
        );
        $sheet->mergeCells('A' . $noLigne . ':L' . $noLigne);
        $sheet->getStyle('A' . $noLigne . ':L' . $noLigne)->applyFromArray($etabStyle);
        $sheet->setCellValue('A' . $noLigne, 'Etablissement : ' . $nomEtab);
    }

    private function classeRender(PHPExcel $objPhpExcel, $noLigne, $nomClasse)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $classeStyle = array(
            'font' => array(
                'bold' => true,
                'name' => 'Arial',
                'size' => 11,
                'color' => array('argb' => 'FF1F497D'),
            ),
        );
        $sheet->mergeCells('A' . $noLigne . ':L' . $noLigne);
        $sheet->getStyle('A' . $noLigne)->applyFromArray($classeStyle);
        $sheet->setCellValue('A' . $noLigne, 'Classe : ' . $nomClasse);
    }

    private function enteteRender(PHPExcel $objPhpExcel, $noLigne)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $enteteStyle = array(
            'font' => array(
                'bold' => true,
                'name' => 'Arial',
                'size' => 10,
                'color' => array('argb' => '00000000'),
            ),
            'borders' => array(
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFFFFFF')
                ),
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FFFFFFFF')
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FFFFFFFF')
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FFFFFFFF')
                ),
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => array(
                    'argb' => 'FF98B957'
                )
            )
        );
        $sheet->getRowDimension($noLigne)->setRowHeight(30);
        $sheet->setCellValue('A' . $noLigne, 'INE');
        $sheet->getStyle('A' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('B' . $noLigne, 'NOM');
        $sheet->getStyle('B' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('C' . $noLigne, 'PRENOM');
        $sheet->getStyle('C' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('D' . $noLigne, 'DATE DE NAISSANCE');
        $sheet->getStyle('D' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('E' . $noLigne, 'SEXE');
        $sheet->getStyle('E' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('F' . $noLigne, 'DATE D\'ENVOI DOSSIER');
        $sheet->getStyle('F' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('G' . $noLigne, 'CLASSE INCLUSION');
        $sheet->getStyle('G' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('H' . $noLigne, 'TRANSPORT');
        $sheet->getStyle('H' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('I' . $noLigne, 'AVS');
        $sheet->getStyle('I' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('J' . $noLigne, 'SESSAD');
        $sheet->getStyle('J' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('K' . $noLigne, 'MATERIEL');
        $sheet->getStyle('K' . $noLigne)->applyFromArray($enteteStyle);
        $sheet->setCellValue('L' . $noLigne, 'AUTRES SUIVIS');
        $sheet->getStyle('L' . $noLigne)->applyFromArray($enteteStyle);
    }

    private function celluleRender(PHPExcel $objPhpExcel, $cellule, $value, $alignement)
    {
        $sheet = $objPhpExcel->getActiveSheet();
        $alignement = $alignement == 'center' ? PHPExcel_Style_Alignment::HORIZONTAL_CENTER : ($alignement == 'right' ? PHPExcel_Style_Alignment::HORIZONTAL_RIGHT : PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $celluleStyle = array(
            'font' => array(
                'name' => 'Arial',
                'size' => 10,
                'color' => array('argb' => '00000000'),
            ),
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('argb' => 'FFFFFFFF')
                )
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => $alignement
            ),
        );
        $sheet->getCell($cellule)->setValue($value);
        $sheet->getStyle($cellule)->applyFromArray($celluleStyle);
    }

    public function executeExcel(sfWebRequest $request)
    {
		ini_set('memory_limit', '256M');
		set_time_limit(60);
        $this->getResponse()->setHttpHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment;filename=eleves_accompagnés.xlsx');
        $this->getResponse()->setHttpHeader('Cache-Control', 'max-age=0');
        $objPhpExcel = $this->createObjectExcel();
        $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
        unset($objPhpExcel);
        $this->getResponse()->sendHttpHeaders();
        $objWriter->save('php://output');
        return sfView::NONE;
		//return $this->renderText("<html><body>Hello, World!</body></html>");
		 //$this->redirect('eleve/listEleve');
    }

    public function executePdf(sfWebRequest $request)
    {
		ini_set('memory_limit', '256M');
		set_time_limit(60);
		
        $this->getResponse()->setHttpHeader('Content-Type', 'application/pdf');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment;filename=eleves_accompagnés.pdf');
        $this->getResponse()->setHttpHeader('Cache-Control', 'max-age=0');
        $objPhpExcel = $this->createObjectExcel();
        $objPhpExcel->setActiveSheetIndex(0)->setShowGridlines(false);
        $objWriter = new PHPExcel_Writer_PDF($objPhpExcel);
        unset($objPhpExcel);
        $this->getResponse()->sendHttpHeaders();
        $objWriter->save('php://output');
        return sfView::NONE;
    }
}