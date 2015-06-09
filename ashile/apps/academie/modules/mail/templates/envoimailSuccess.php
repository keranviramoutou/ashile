<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<!-- Mail lancé depuis le module eleve_avs ,constitution du message du mail  -->
<?php if($sf_request->getParameter('modules') == 'eleve_avs' ){ 
		        if($sf_request->getParameter('datedebut') != '01-01-1900'){ 
			$datedebut = format_date($sf_request->getParameter('datedebut'),'dd/MM/yyyy') ;  
			$message = 'à partir du&nbsp;'.$datedebut;
		}else{
			$message ='jusqu\'au&nbsp;';
		}
		if($sf_request->getParameter('datefin') != '01-01-1900'){ 
			$datefin =format_date($sf_request->getParameter('datefin'),'dd/MM/yyyy') ;  
			$message= $message .$datefin ;
					}else{
			$message = $message;
		}   
		$corps = 'L\'avs&nbsp;'.$avs[0]['avsnom'].'&nbsp;'.$avs[0]['avsprenom'].'&nbsp;affecté &nbsp;'.$message.'&nbsp;pour une quotité horaire de &nbsp;'.$sf_request->getParameter('quotitehorraireavs').'&nbsp;Heure(s)'.'&nbsp;à l\'élève&nbsp;'.$eleve[0]['nom'].'&nbsp;'.$eleve[0]['prenom'].'&nbsp;né(e)le&nbsp'.format_date($eleve[0]['datenaissance'],'dd/MM/yyyy') ;  
		$sujet = 'Affectation d\'un AVS pour l\'élève&nbsp;'.$eleve[0]['nom'].'&nbsp;'.$eleve[0]['prenom'];
} ?>
<!-- ------------------------------------------------------------------------------  -->

<!-- Mail lancé depuis le module eleve_matériel ,constitution du message du mail  -->
<?php if($sf_request->getParameter('modules') == 'eleve_materiel' ){
        if($sf_request->getParameter('datedebut') != '01-01-1900'){ 
			$datedebut = format_date($sf_request->getParameter('datedebut'),'dd/MM/yyyy') ;  
			$message = 'du&nbsp;'.$datedebut;
		}else{
			$message ='jusqu\'au&nbsp;';
		}
		if($sf_request->getParameter('datefin') != '01-01-1900'){ 
			$datefin =format_date($sf_request->getParameter('datefin'),'dd/MM/yyyy') ;  
			$message= $message .$datefin ;
					}else{
			$message = $message;
		}
		echo 'num mat'.$sf_request->getParameter('materiel_id');
		$corps = 'L\'élève&nbsp;'.$eleve[0]['nom'].'&nbsp;'.$eleve[0]['prenom'].'&nbsp;né(e)le&nbsp'.format_date($eleve[0]['datenaissance'],'dd/MM/yyyy').
		'&nbsp;a en prêt le matériel n°&nbsp;'.$materiel[0]['numeroMateriel'].'&nbsp;de type :&nbsp'.$materiel[0]['libelletypemateriel'].'&nbsp;de catégorie :&nbsp;'.$materiel[0]['libellecatmateriel'].'&nbsp;affecté&nbsp;'.$message ;  
		$sujet = 'Prêt de matériel pour l\'élève&nbsp;'.$eleve[0]['nom'].'&nbsp;'.$eleve[0]['prenom'];
} ?>
		
	<fieldset>
	<form action="javascript:envoiMail()">
	<?php echo 'Secteur :&nbsp;'.$destinataire[0]['libellesecteur']?>
	<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;<br>Mail envoyé a :&nbsp;<strong>'.$destinataire[0]['adresse_mail'].'</strong>' ?>
	<br><br>&nbsp;&nbsp;Sujet du mail <br>&nbsp<input type="text" name="sujet" id="sujet_mail" value="<?php echo $sujet; ?>" style="width:400px;" ></br>
	<br><br>&nbsp;&nbsp;Corps du message; <br> &nbsp<textarea wrap="auto" rows="5" cols="8"name="corps" id="corps_mail" style="width:400px;"  ><?php echo $corps; ?></textarea><br><br>
	<br> <input type="submit" value="Envoi" onClick="envoiMail()" />&nbsp;  <input type="button" value="Retour" onclick="history.go(-1)"> </br>
	
	</form>
	</fieldset>
<script>	
	function envoiMail() {
//alert ('tititi');

	            var destinataire = '<?php echo($destinataire[0]['adresse_mail']); ?>';
	    		var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
				var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';
				var eleve_id = '<?php echo($eleve[0]['eleve_id']); ?>';
	           	var sf_id = '<?php echo($destinataire[0]['sf_id']); ?>';
				var user_id = '<?php echo($sf_request->getParameter('user_id')); ?>';
				if (HTTP_HOST == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) //portail.ac-reunion.fr
				  {
						 var url_dest = '"https://portail.ac-reunion.fr/ashile/academie.php/mail/envoimail?destinataire=" ' ;
				
				} else if (HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) { 
						 var url_dest = '"https://portail.ac-reunion.fr/ashilep/academie.php/mail/envoimail?destinataire=" ' ;
				  } 
				
				 if ( HTTP_HOST  == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ) // accueil.in.ac-reunion.fr
				  {
						 var url_dest = '"http://accueil.in.ac-reunion.fr/ashile/academie.php/mail/envoimail?destinataire=';
				 
				 } else if( HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ){
						 var url_dest = 'http://accueil.in.ac-reunion.fr/ashilep/academie.php/mail/envoimail?destinataire=' ;
				  }    
	             else{ var url_dest ='toto';}
				 

		sujet =document.getElementById("sujet_mail").value ;
		corps = document.getElementById("corps_mail").value ;
	
	
		
	    var url_dest =  url_dest+destinataire+"&sujet="+sujet+"&corps="+corps+"&eleve_id="+eleve_id+"&sf_id="+sf_id+"&user_id="+user_id+"";

	  document.location.replace(url_dest);
	 self.close(); ; 
	}
</script>