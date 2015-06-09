<?php use_helper('Date') ?>
<?php // use_helper('jQuery') ?>
<?php $eleve_avs = $form->getObject(); ?>
		
						
<div class='aide' onClick="<?php echo url_for('eleve_avs/aide') ?>"> </div> 
<div id="eleve_avs_edit">

<?php //phpinfo(); ?>
<h3>Gestion des AVS > Affectation des AVS > Edition d'une affectation pour un élève</h3>
<?php
    //controle de la quotité horaire disponible pour l'élève
	 //--------------------------------------------------
	    $affichage= ''; 
	    if($existTotalquotiteeleve && $existAvs  ){
		$diff = $totalquotiteeleve[0]['quotiteeleve'] - $demande_avs[0]['quotitehorrairenotifie'] ;
		if ($diff <= 0){
		$affichage=  '<FONT COLOR="green" ><strong> &nbsp<-------&nbsp'.'<blink><strong> il reste&nbsp'.abs($diff).' heure(s) à affecter</FONT></strong></blink> ';
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
		$affichageavs = '<FONT COLOR="red" ><strong> &nbsp<-------&nbsp'.'<blink><s<FONT COLOR="red" >'.abs($diffavs).'&nbsp&nbspheure(s) effectuée(s) en trop ! </FONT></strong></blink> ';
		}
		}

	 echo '<div><fieldset>
				<legend> Eleve :<strong> '.$eleve_avs->getEleve()->getNom().'&nbsp&nbsp'.$eleve_avs->getEleve()->getPrenom().'</strong>&nbsp&nbspné(e) le :&nbsp<strong>'.format_date($eleve_avs->getEleve()->getdatenaissance(),'dd/MM/yyyy').'</strong>&nbsp&nbsp&nbspaccompagné(e) par : <strong>'.$eleve_avs->getAvs().'</strong></legend>';
	 
	 if ($existAvs > 0 )
	 {
	 echo ' -&nbsp;Dossier MDPH n°&nbsp :<strong> '.$demande_avs[0]['MdphId'].'</strong>&nbsp&nbsp Nature de l\'acc. demandée : <strong>'.$demande_avs[0]['naturecontrat'].'</strong>&nbspen cours notifiée du &nbsp:&nbsp<strong>'.format_date($demande_avs[0]['datedebutnotif'],'dd/MM/yyyy').'</strong>&nbsp&nbspau&nbsp&nbsp<strong>'.format_date($demande_avs[0]['datefinnotif'],'dd/MM/yyyy')
	 .'</strong>&nbsp;-&nbsp;<br>- Décision de la CDA du :&nbsp<strong>'.format_date($demande_avs[0]['datedecisioncda'],'dd/MM/yyyy').'</strong><p>- Quotité Horaire Notifiée par la CDA&nbsp:&nbsp<strong>'.$demande_avs[0]['quotitehorrairenotifie'].'</strong>&nbspHeure(s)';
	  }else{
	  echo '<div class="flash_notice">Pas de demande d\'accompagnement dossier MDPH en cours à la date du '.format_date(time(),'dd/MM/yyyy').'</div>';
	  }
	 if($existTotalquotiteeleve)
	 {
	  echo '<p>- Quotité Total affectée à à l\'élève :&nbsp<strong>'.$eleve_avs->getEleve().' </strong> au  :&nbsp<strong>'.format_date(time(),'dd/MM/yyyy').'</strong>&nbsp:&nbsp&nbsp&nbsp<strong>'.$totalquotiteeleve[0]['quotiteeleve'].'</strong>&nbspHeure(s)'.$affichage.'</p>';
	 }
	
	 
	 if($existTotalquotiteavs )
	 {
		echo '</strong><p>- Quotité Total réalisée par :&nbsp<strong>'.$eleve_avs->getAvs().' </strong> au  :&nbsp<strong>'.format_date(time(),'dd/MM/yyyy').'</strong>&nbsp:&nbsp&nbsp&nbsp<strong>'.$totalquotiteavs[0]['quotiteavs'].'</strong>&nbspHeure(s)'.$affichageavs.'</p>';
	 }	
		
		

	echo '</legend></fieldset></ div></div>';


	// inclusion du partial 'contrats de l'Avs'	
	//----------------------------------------
	if($existContratAvs){		
		//echo  '<div class=contratAvs><fieldset><div id=contratAvs>'; 
		//	include_partial('contratAvs', array('contratAvs' => $contratAvs)); 
		//echo '</div></fieldset></div>';
	}	

?>

<?php include_partial('form', array('form' => $form, 'secteur_id' => $secteur_id, 'nomModule' => $nomModule, 'sfGuardUser' => $sfGuardUser)); ?>
</div>
<?php //include_component('mail', 'email', array('test' => 'test')) ?>

<!--------- Script pour la fenetre d aide ----------->
<script>
var src = "<?php echo url_for('eleve_avs/aide') ?>";

$j(document).ready(function(){
        $j('.aide').click(function (){
                $j.modal('<iframe src="' + src + '" height="450" width="830" style="border:0">', {
                        closeHTML:"",
                        containerCss:{
                                backgroundColor:"#fff",
                                borderColor:"#fff",
                                height:450,
                                padding:0,
                                width:830
                        },
                        overlayClose:true
                });
        });
});

</script>
<?php 
	if($existEleveAvs){
		include_partial('EleveAvs', array('EleveAvs' => $EleveAvs)); ?>

	<!------------------------------------------------
	// --- un bouton qui arrete toutes les affectations pour un éléve ou un avs -----
	/*
	 *  ceci entraine plusieurs choses, 
	 * 	1) mettre une date de fin d'affectation à la date du jour sur le contrat_avs
	 *	et permettre de changer cette date avec le calendrier
	 */
	-------------------------------------------------->
	
	<!-- Script pour DatePicker -->
	<script>
		$j(function() {
		$j( "#calendrier" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		});
	</script>
	<!---------------------------->
	
<br>

	<div style="background:#B0C4DE">	
			
				<form action="<?php echo url_for('eleve_avs/miseAjour?id='.$eleve_avs->getId()); ?>" method="POST">
				<?php echo'Clôture de(s) accompagnement(s) pour le(s) élève(s) suivi(s) par :&nbsp<strong>'.$eleve_avs->getAvs()?>
					<div></strong>
						à la date du &nbsp &nbsp <input type="text" name="maj" id ="calendrier">

					</div>


					<p> la date de fin d'affectation sera mise à jour  à la date saisie si la date de fin d'affectation est supérieure à la date du jour</p>
					<?php $sujet1 =  'Mise à Jour de l\'affectation de '.$eleve_avs->getEleve().'accompagné par '.$eleve_avs->getAvs(); ?>
					<?php $textmessage = 'Quotité affectée '. $eleve_avs->getQuotitehorraireavs().'heure(s) pour l\'élève '.$eleve_avs->getEleve().'accompagné par '. $eleve_avs->getAvs().' du '.$eleve_avs->getDatedebut().' au '.$eleve_avs->getDatefin() ?>
					<?php //echo'Envoi mail :&nbsp<strong>'.$eleve_avs->getAvs()?>
					<?php echo link_to('Envoi Mail à l\'ERF du secteur', 'eleve_avs/EnvoiMail?id='.$eleve_avs->getId().'&sujet='.$sujet1.'&textmessage='.$textmessage ) ?>
					<p><input type="submit" value="Clôturer" /></p>
				</form>
	
	</div>	
  <?php  } ?>
		


