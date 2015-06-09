<?php

/**
 * clisUlis actions.
 *
 * @package    ash
 * @subpackage clisUlis
 * @author     regis Gravant
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class horsclisUlisActions extends sfActions
{

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    
    public function executeIndex(sfWebRequest $request)
    {
				
		  // initialisation du secteur
			$secteur = $this->getUser()->getAttribute('secteur'); // passé dans le module menu 
  	
		    //Dernière scolarisation
			//-----------------------------------------------------------------------
				$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
				$deb = $annee->getDatedebutanneescolaire();
				$fin = $annee->getDatefinanneescolaire();
	
			 	$this->classeHorsClisEtUlis = Doctrine_Query::create()
               ->select('j.id as j_id,ty.id as ty_id,c.id as classe_id,e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,e.secteur_id as secteur_id,s.libellesecteur as libellesecteur,e.id as eleveId,e.ine as ine,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab,
			   o.id as orienId,o.datedebut as datedebut,o.datefin as datefin,n.nomniveauscolaire as nomniveauscolaire,ty.nomtypeclasse as nomlongtypeclasse,
			   e.adresseelevebat as adres1,e.adresseleverue as adres2,j.libelledemijournee as libelledemijournee,e.sexe as sexe')
                ->from('Orientation o')
                ->innerJoin('o.Eleve e ON e.id = o.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
                ->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->leftJoin('o.Niveauscolaire n ON o.niveauscolaire_id = n.id')
				->leftJoin('o.Classe c ON o.classe_id = c.id')
				->leftJoin('c.TypeClasse ty ON c.typeclasse_id = ty.id')
				->leftJoin('o.Demijournee j ON o.demijournee_id = j.id')
				->where ('e.secteur_id=?',$secteur->getId() )
                ->andWhere('o.datedebut >=?', $deb)
                ->andWhere('o.datefin <=?', $fin)
			   ->andWhere('o.datefin >=?', date('Y-m-d', time()))
			  ->andWhere('ty.nomtypeclasse NOT LIKE "%CLIS%" and ty.nomtypeclasse NOT LIKE "%ULIS%"' )
			   ->andWhere('e.datesortie IS NULL or e.datesortie>=?', date('Y-m-d', time()))
               ->orderBy('et.nometabsco ASC,e.nom')
               ->addOrderBy('et.rne,ty.nomtypeclasse')
			   ->fetcharray();
    }

    public function executeList(sfWebRequest $request)
    {
		// initialisation du secteur
	  	$secteur = $this->getUser()->getAttribute('secteur');
	  	$this->classeClisEtUlis = $this->listerClassesClisEtUlis($secteur);		
	}

    private function listerClasseHorsClisEtUlis(Secteur $secteur)
    {
        // les etabs du secteur trouvés avec le table relation secteur/etabsco
        $eleves = $secteur->Eleves;
        $classeHorsClisEtUlis = array();

		foreach($eleves as $eleve){
			$orientations = $eleve->getOrientation();
			foreach($orientations as $key => $orientation){
				//echo $key.'--'.$orientation.'--';
				if($key == 'classe_id' && $orientation != ''){
					$classe = Doctrine::getTable('Classe')->findOneById($orientation);
					//echo '++'.$classe.'++';
					$uli = 'ULI';
					$posUli = strpos($classe->getTypeClasse() ->__toString(), $uli);

					$cli = 'CLI';
					$posCli = strpos($classe->getTypeClasse()->__toString(), $cli);

					if ($posUli === false && $posCli === false) {
						$classeHorsClisEtUlis[] = $classe;
					}
				
				}
			}
		}
        return $classeHorsClisEtUlis;
    }

    private function createObjectExcel()
    {
        $this->setLayout(false);
        $secteur = $this->getUser()->getAttribute('secteur');
        //$secteur = Doctrine_Core::getTable('Secteur')->find(1);
         $objPhpExcel = new PHPExcel();
        $anneeSco = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $objPhpExcel->setActiveSheetIndex(0);
        $sheet = $objPhpExcel->getActiveSheet();

        PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
        // Les largeurs des colonnes
        $this->setColumnWidth($objPhpExcel);
        // Le titre
        $this->titreRender($objPhpExcel, 'Liste des élèves hors CLIS/ULIS (secteur : ' . $secteur->getLibellesecteur() . ') ' . $anneeSco->__toString());
        // Entete
            $this->setLayout(false);
     // initialisation du secteur
	  	$secteur = $this->getUser()->getAttribute('secteur'); // passé dans le module menu 
	 	 
	  		
		    //Dernière scolarisation
			//-----------------------------------------------------------------------
				$annee = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
				$deb = $annee->getDatedebutanneescolaire();
				$fin = $annee->getDatefinanneescolaire();
				
				$classeHorsClisEtUlis = Doctrine_Query::create()
               ->select('j.id as j_id,ty.id as ty_id,c.id as classe_id,e.nom as nom,e.prenom as prenom,et.nometabsco as nometabsco,et.rne as rne,e.secteur_id as secteur_id,s.libellesecteur as libellesecteur,e.id as eleveId,e.ine as ine,e.datenaissance as datenaissance,t.nomtypeetablissement as typetab,
			   o.id as orienId,o.datedebut as datedebut,o.datefin as datefin,n.nomniveauscolaire as nomniveauscolaire,ty.nomtypeclasse as nomlongtypeclasse,
			   e.adresseelevebat as adres1,e.adresseleverue as adres2,j.libelledemijournee as libelledemijournee,e.sexe as sexe')
                ->from('Orientation o')
                ->innerJoin('o.Eleve e ON e.id = o.eleve_id')
				->innerjoin('e.Secteur s ON s.id = e.secteur_id')
                ->innerJoin('o.Etabsco et ON o.etabsco_id = et.id')
                ->innerjoin('et.Typeetablissement t ON t.id = et.typeetablissement_id')
				->leftJoin('o.Niveauscolaire n ON o.niveauscolaire_id = n.id')
				->leftJoin('o.Classe c ON o.classe_id = c.id')
				->leftJoin('c.TypeClasse ty ON c.typeclasse_id = ty.id')
				->leftJoin('o.Demijournee j ON o.demijournee_id = j.id')
				->where ('e.secteur_id=?',$secteur->getId() )
                ->andWhere('o.datedebut >=?', $deb)
                ->andWhere('o.datefin <=?', $fin)
			   ->andWhere('o.datefin >=?', date('Y-m-d', time()))
			   ->andWhere('ty.nomtypeclasse NOT LIKE "%CLIS%" and ty.nomtypeclasse NOT LIKE "%ULIS%"' )
               ->orderBy('et.nometabsco ASC,e.nom')
               ->addOrderBy('et.rne,ty.nomtypeclasse')
			   ->fetcharray();
			   

        $objPhpExcel = new PHPExcel();
        $anneeSco = Doctrine_Core::getTable('Anneescolaire')->getAnneeScolaireEnCours();
        $objPhpExcel->setActiveSheetIndex(0);
        $sheet = $objPhpExcel->getActiveSheet();

        PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
        // Les largeurs des colonnes
        $this->setColumnWidth($objPhpExcel);
        // Le titre
        $this->titreRender($objPhpExcel, 'Liste des élèves hors CLIS/ULIS (secteur : ' . $secteur->getLibellesecteur() . ') ' . $anneeSco->__toString());

   
        $ligne = 2;
		//ligne entête
        //----------------
		        $this->celluleRender($objPhpExcel, 'A' . $ligne,'n° élève', null);
                $this->celluleRender($objPhpExcel, 'B' . $ligne, 'Nom', null);
                $this->celluleRender($objPhpExcel, 'C' . $ligne, 'Prénom', null);
                $this->celluleRender($objPhpExcel, 'D' . $ligne, 'date de Naissance', 'center');
				$this->celluleRender($objPhpExcel, 'E' . $ligne, 'sexe', null);
				$this->celluleRender($objPhpExcel, 'F' . $ligne, 'Scolarité', null); 
				$this->celluleRender($objPhpExcel, 'G' . $ligne, 'Rne', null);
				$this->celluleRender($objPhpExcel, 'H' . $ligne,'Classe', null);
		
        foreach ($classeHorsClisEtUlis as $eleve) {

                $ligne++;
                // Preparation de données

                // Couleur de fond de cellule
                $couleurFond = $ligne % 2 == 0 ? 'FFD7E4BC' : 'FFEAF1DD';
                $sheet->getStyle('A' . $ligne . ':L' . $ligne)->getFill()
                        ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                        ->getStartColor()->setARGB($couleurFond);
                // Preparation des cellules
                $this->celluleRender($objPhpExcel, 'A' . $ligne, $eleve['ine'], 'center');
                $this->celluleRender($objPhpExcel, 'B' . $ligne, $eleve['nom'], null);
                $this->celluleRender($objPhpExcel, 'C' . $ligne, $eleve['prenom'], null);
                $this->celluleRender($objPhpExcel, 'D' . $ligne, $eleve['datenaissance'], 'center');
				$this->celluleRender($objPhpExcel, 'E' . $ligne, $eleve['sexe'], null);
				$this->celluleRender($objPhpExcel, 'F' . $ligne, $eleve['typetab'].' - '.$eleve['nometabsco'], null); 
				$this->celluleRender($objPhpExcel, 'G' . $ligne, $eleve['rne'], null);
				$this->celluleRender($objPhpExcel, 'H' . $ligne, $eleve['nomlongtypeclasse'], null);
				
                // Transformation de la cellule au format date
                $sheet->getStyle('D' . $ligne)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DDMMYYYY);
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
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment;filename=hors_clis_ulis.xlsx');
        $this->getResponse()->setHttpHeader('Cache-Control', 'max-age=0');
        $objPhpExcel = $this->createObjectExcel();
        $objWriter = PHPExcel_IOFactory::createWriter($objPhpExcel, 'Excel2007');
        unset($objPhpExcel);
        $this->getResponse()->sendHttpHeaders();
        $objWriter->save('php://output');
        return sfView::NONE;
    }

    public function executePdf(sfWebRequest $request)
    {
		ini_set('memory_limit', '256M');
		set_time_limit(60);
		
        $this->getResponse()->setHttpHeader('Content-Type', 'application/pdf');
        $this->getResponse()->setHttpHeader('Content-Disposition', 'attachment;filename=hors_clis_ulis.pdf');
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
