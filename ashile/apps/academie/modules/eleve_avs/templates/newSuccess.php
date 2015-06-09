<?php use_helper('Date') ?>

<h3>Gestion des Personnels acc. > Affectation d\'un Personnel à un élève</h3>

<?php


    //controle de la quotité horaire disponible pour l'élève
	 //--------------------------------------------------
	    $affichage= ''; 
	    if($existTotalquotiteeleve && $existAvs  ){
		$diff = $totalquotiteeleve[0]['quotiteeleve'] - $demande_avs[0]['quotitehorrairenotifie'] ;
		if ($diff <= 0){
		$affichage=  '<FONT COLOR="green" ><strong> &nbsp<-------&nbsp'.'<blink><strong> il reste&nbsp'.abs($diff).' heures à affecter</FONT></strong></blink> ';
		}else{
		$affichage = '<FONT COLOR="red" ><strong> &nbsp<-------&nbsp'.'<blink><s<FONT COLOR="red" >'.abs($diff).'&nbsp&nbspheure(s) en trop affectée(s) !</FONT></strong></blink> ';
		}
		}
      //controle de la quotité horaire disponible pour l'avs
	 //------------------------------------------------------------
	    $affichageavs='';
	    if($existTotalquotiteavs && $existtotalquotitécontratAvs  ){
		$diffavs = $totalquotitécontratAvs[0]['temps_hebdo'] - $totalquotiteavs[0]['quotiteavs']  ;
		if ($diffavs >= 0){
		$affichageavs=  '<FONT COLOR="green" ><strong> &nbsp<-------&nbsp'.'<blink><strong> il reste&nbsp'.abs($diffavs).' heures à affecter</FONT></strong></blink> ';
		}else{
		$affichageavs = '<FONT COLOR="red" ><strong> &nbsp<-------&nbsp'.'<blink><s<FONT COLOR="red" >'.abs($diffavs).'&nbsp&nbspheure(s) effectuées en trop ! </FONT></strong></blink> ';
		}
		}

	echo '<div><fieldset>';
    if ($eleve){
	echo '<legend> Eleve :<strong> '.$eleve[0]['nom'].'&nbsp&nbsp'.$eleve[0]['prenom'].'</strong>&nbsp&nbsp né(e) le :&nbsp<strong>'.format_date($eleve[0]['datenaissance'],'dd/MM/yyyy').'</strong></legend>';
    }	
	 if ($existorientation > 0){
	 echo   '<br>Scolarisé(e) à &nbsp;<strong>'.$orientation[0]['typetab'].'&nbsp;'.$orientation[0]['nometabsco'].'</strong>&nbsp;du :&nbsp; <strong>'.format_date($orientation[0]['datedebut'],'dd/MM/yyyy').'</strong>&nbsp;au&nbsp;<strong> '.format_date($orientation[0]['datefin'],'dd/MM/yyyy').'</strong></br>';
	  echo '<br>Niveau scolaire :&nbsp;<strong>'.$orientation[0]['nomniveauscolaire'].'</strong>&nbsp;Classe :&nbsp;<strong>'.$orientation[0]['nomlongtypeclasse'].'</strong></br>';
	  echo '<br>Nbre de demi-journée<strong> :&nbsp;'.$orientation[0]['libelledemijournee'].'</strong></br>';
	  }
	if ($existAvs)
	 {
	
	 echo ' <legend>Dossier MDPH n°&nbsp :<strong> '.$demande_avs[0]['MdphId'].'</strong>&nbsp&nbsp Nature de l\'acc. demandée : <strong>'.$demande_avs[0]['naturecontrat'].'</strong>&nbspen cours notifiée du &nbsp:&nbsp<strong>'.format_date($demande_avs[0]['datedebutnotif'],'dd/MM/yyyy').'</strong>&nbsp&nbspau&nbsp&nbsp<strong>'.format_date($demande_avs[0]['datefinnotif'],'dd/MM/yyyy')
	 .'</strong>&nbsp-&nbspDécision de la CDA du :&nbsp<strong>'.format_date($demande_avs[0]['datedecisioncda'],'dd/MM/yyyy').'</strong><p>- Quotité Horaire Notifiée&nbsp:&nbsp<strong>'.$demande_avs[0]['quotitehorrairenotifie'].'</strong>';
	  }
  
     if($existTotalquotiteeleve)
	 {
	  echo '<p>- Quotité Total affectée à à l\'élève :&nbsp<strong>'.$eleve[0]['nom'].' </strong> au  :&nbsp<strong>'.format_date(time(),'dd/MM/yyyy').'</strong>&nbsp:&nbsp<strong>'.$totalquotiteeleve[0]['quotiteeleve'].'</strong>&nbspHeure(s)'.$affichage.'</p>';
      }
	  if($Avs){
		echo 'Accompagnant sélectionné :&nbsp;<strong>'.$Avs->getNom().'</strong>&nbsp;né(e) le :&nbsp;<strong>'.format_date($Avs->getDateNaissance(),'dd/MM/yyyy').'</strong>';
		}
	  echo '</fieldset></div>';

	// inclusion du partial 'contrats de l'Avs'	
/*	if($existContratAvs){		
		echo  '<div class=contratAvs><fieldset><div id=contratAvs>'; 
			include_partial('contratAvs', array('contratAvs' => $contratAvs)); 
		echo '</div></fieldset></div>';
	} */
	

		
	
?>


<?php include_partial('form', array('form' => $form, 'secteur_id' => $secteur_id, 'nomModule' => $nomModule, 'sfGuardUser' => $sfGuardUser)); 
	if($existEleveAvs){
          include_partial('EleveAvs', array('EleveAvs' => $EleveAvs));
    }	
?>
