<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>


<?php echo 'création d\'un mouvement' ?>
<?php echo '<br><br><br><br>'; ?>

	<form action="javascript:maFonction()">
		
						       <br>Type de mouvement &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<select id="mouvementId" name="typemouv" style="width: auto;">
								<option value = "">	</option>
								<?php foreach($mouvements as $mouvement) { ?>		
								<option  value ="<?php echo $mouvement['nommouvement']; ?>"
								
								<?php echo ( $mouvement['nommouvement'] == $_POST['mouvemenet_id'] ? 'selected="selected"' : '' ) ?>>
								<?php	echo $mouvement['nommouvement']; ?>
								</option>
								<?php	} ?>
								</select>
		<br><br>Date début du mouvement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="maj" style="width:80px" id="calendrier"></br>
		
	<br>&nbsp;&nbsp;&nbsp;<input type="submit" value="Ajout mouvement" style="float: left" onClick="maFonction()">
	 
	</form>
	
	<script>
	
	/* ---- fonction qui envoie les materiel attribué selectionnés pour edition convention */
	
	function maFonction() {

				var lesMats = [];
				var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
				var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';
               	var materiel_id = '<?php echo $materiels[0]['materiel_id'] ?>';
	    
				if (HTTP_HOST == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) //portail.ac-reunion.fr
				  {
						 var url_dest = 'https://portail.ac-reunion.fr/ashile/academie.php/mouvement_materiel/new?materiel_id= ' ;
				
				} else if (HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '192.168.220.3' ) { 
						 var url_dest = 'https://portail.ac-reunion.fr/ashilep/academie.php/mouvement_materiel/new?materiel_id= ' ;
				  } 
				
				 if ( HTTP_HOST  == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ) // accueil.in.ac-reunion.fr
				  {
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashile/academie.php/mouvement_materiel/new?materiel_id=';
				 
				 } else if( HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ){
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashilep/academie.php/mouvement_materiel/new?materiel_id=' ;
				  }    
	             else{ var url_dest ='toto';}
			
	
		   datemouvement = document.getElementById("calendrier").value ;
			 var url_dest =  url_dest+materiel_id+"";
			mouvement_id = document.getElementById("mouvementId").value ;
			var url_dest =  url_dest+materiel_id+"&mouvement_id="+mouvement_id+"$datemouvement="+datemouvement+"";
            alert (datemouvement); 
	       document.location.replace(url_dest);   //redirection vers l'affichage de la convention
		//window.location="http://accueil.in.ac-reunion.fr/ashilep/academie.php/mouvement_materiel/new?materiel_id="+eleveId+"&lesMats="+lesMats+""; 
	}
</script>

	<!-- Script pour DatePicker -->
	<script>
		$j(function() {
		$j( "#calendrier" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		});
	</script>
	<!---------------------------->