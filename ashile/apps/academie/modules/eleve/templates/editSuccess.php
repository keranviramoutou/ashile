<?php   use_helper('Date') ?>
<?php //use_helper('jQuery') ?>
<?php //include_partial('message') ?>


<?php


	
	 //controle de la quotité horaire disponible pour l'élève
	 //-----------------------------------------------------
	    $affichage= ''; 
	    if($existTotalquotiteeleve && $existAvs  ){
		$diff = $totalquotiteeleve[0]['quotiteeleve'] - $demande_avs[0]['quotitehorrairenotifie'] ;
		if ($diff <= 0){
		$affichage=  '<FONT COLOR="green" ><strong> &nbsp<-------&nbsp'.'<blink><strong> il reste&nbsp'.abs($diff).' Heure(s) à affecter</FONT></strong></blink> ';
		}else{
		$affichage = '<FONT COLOR="red" ><strong> &nbsp<-------&nbsp'.'<blink><s<FONT COLOR="red" >'.abs($diff).'&nbsp&nbspHeure(s) en trop affectée(s) !</FONT></strong></blink> ';
		}
		}
		echo '<h3> Elèves > Fiche élève</h3>';
	 
        echo '<fieldset><legend><h3>Synthèse </h3></legend>';
         echo '<p><i> vous traitez l\'éleve :<strong> '.$form->getObject().'</strong>';
		 
         	if($or):
				echo '&nbsp&nbspEtablissement frequenté&nbsp:&nbsp <strong> '.
				$or[0]['typetab'].'&nbsp;'.$or[0]['nometabsco'].'</strong>&nbsp&nbsp Niveau scolaire :&nbsp<strong>'.$or[0]['nomniveauscolaire'].'</strong>&nbsp&nbspClasse :&nbsp&nbsp<strong>'.$or[0]['nomtypeclasse'].'</strong></i></p>';
			    echo '<p> - Secteur de l\'établissement :&nbsp;<strong>'.$secteur_etab[0]['libellesecteur'].'</strong></p>'      ;
			endif;
		     if ($existAvs)
			 {
			 echo ' - Dossier MDPH n°&nbsp :<strong> '.$demande_avs[0]['MdphId'].'</strong>&nbsp&nbsp Dernière Demande de contrat type : <strong>'.$demande_avs[0]['naturecontrat'].'</strong>&nbspen cours notifiée du &nbsp:&nbsp<strong>'.format_date($demande_avs[0]['datedebutnotif'],'dd/MM/yyyy').'</strong>&nbsp&nbspau&nbsp&nbsp<strong>'.format_date($demande_avs[0]['datefinnotif'],'dd/MM/yyyy')
			 .'</strong>&nbsp-&nbspDécision de la CDA du:&nbsp<strong>'.format_date($demande_avs[0]['datedecisioncda'],'dd/MM/yyyy').'</strong><p>- Quotité Horaire Notifiée par la CDA&nbsp:&nbsp<strong>'.$demande_avs[0]['quotitehorrairenotifie'].'&nbspHeure(s)</strong>';
			  }

			if($existTotalquotiteeleve)
			{

			echo '<p>- Quotité Total affectée à l\'élève<strong>&nbsp '.' </strong>  à la date du jour :&nbsp<strong>'.$totalquotiteeleve[0]['quotiteeleve'].'&nbspHeure(s)&nbsp '.$affichage.'</p></strong>';
			}
			
			
  echo '</fieldset>';

?>


<?php
	echo '<fieldset><div>';
		include_partial('form', array('form' => $form));
	echo '</div></fieldset>';
	
	
	// inclusion du partial 'eleveavs'	------------------------
	if($existEleveAvs):		
		echo  '<div><fieldset><div id=contratAvs>'; 
			include_partial('EleveAvs', array('EleveAvs' => $EleveAvs));  
		echo '</div></fieldset></div>';
?>
	<!-------- Champ de saisie de date pour cloturer tout les accompagnements de cet eleve ------->
 
		<div style="background:#B0C4DE;">	

		<form action="<?php echo url_for('@EleveMaj?id='.$EleveAvs[0]['id']); ?>" method="POST">
			<?php echo'Clôture de(s) accompagnement(s) pour l\'élève :&nbsp&nbsp<strong>'. $form->getObject().'</strong>'?>
			à la date du &nbsp&nbsp <input type="date" name="maj" value="<?php echo date('Y-m-d', time()) ?>" />
			<p> la date de fin d'affectation sera mise à jour  à la date saisie si la date de fin d'affectation est supérieure à la date du jour</p>
			<p><input type="submit" value="Clôturer" /></p>
		</form>
		</div>
<?php endif;?>


	
