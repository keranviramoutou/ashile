<?php use_helper('jQuery') ?>
<?php use_helper('Date') ?>

<div class='excel'>
<div id="recherche_eleve">

			  <?php if(strlen($info_eleve[0]['adresseeleverue']) > 0 || strlen($info_eleve[0]['adresseelevebat']) > 0){
			  $adres = $info_eleve[0]['adresseeleverue'].'&nbsp'.$info_eleve[0]['adresseelevebat'];
			  }else{
			  $adres ='<font  color="red">Pas d\'adresse !</font>';
			  } ?>
			
			  <?php if($info_eleve[0]['secteur_id'] ){
			 
			  }else{
			  echo '<font  color="red">Pas de secteur sur la fiche élève, impossible de générer la convention !</font>';
			  } ?>			
			  

<?php echo '<fieldset>Liste des matériels éditables sur une convention pour l\'élève :&nbsp;<br>'.$info_eleve[0]['nom'].'&nbsp;'.$info_eleve[0]['prenom'].'&nbsp<small>Secteur :&nbsp;'.$info_eleve[0]['libellesecteur']
.'</small><br> demaurant a :&nbsp'. $adres.'<br>'; ?>
  <?php if(!$eleve[0]['nometabsco']){
   echo '<font  color="red">élève non scolarisé!</font>';
  }else{
 echo 'scolarisé à :&nbsp;<small>'.$eleve[0]['typetab'].'&nbsp;'.$eleve[0]['nometabsco'].'<br></fieldset>'; }?>
 
 
<?php echo '<br><br><br><br>'; ?>

	<form action="javascript:maFonction(eleveId)">
		
	<?php	foreach($materiels as $materiel) { ?>
			  <?php if($materiel['prixachat'] > 0){
			  $prix = $materiel['prixachat'] ;
			  }else{
			  $prix ='<font  color="red">prix achat à ZERO !</font>';
			  } ?>
			  <?php if(strlen($materiel['numeromateriel']) > 0){
			  $num_mat = $materiel['numeromateriel'] ;
			  }else{
			  $num_mat ='<font  color="red">Pas de numéro de série !</font>';
			  } ?>
			<?php	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='groupMateriel' value='".$materiel['materiel_id']."'>".$materiel['typemateriel'].'&nbsp;- cat :&nbsp;'.$materiel['libellecatmateriel'].'&nbsp; n°: &nbsp;'. $num_mat.
				'&nbsp;-&nbsp;Prêt du &nbsp;'.format_date($materiel['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($materiel['datefin'],'dd/MM/yyyy').'&nbsp; Prix d\'achat :&nbsp;'.$prix.'<br>'; ?>
		<?php	} 	?>
		
	<br>&nbsp;&nbsp;&nbsp;<input type="submit" value="Génération de la Convention" style="float: left" onClick="maFonction('<?php echo $materiels[0]['eleve_id'] ?>')">
	 
	</form>

</div>
</div>
<h4><fieldset> Liste des convention(s)  déjà éditée(s) pour cet(te) élève </h4>
		<?php	foreach($conventionsMateriel as $conventionsMateriels)
			{ 
				 echo '<small>&nbsp;-&nbsp;Convention n°&nbsp;' ?> 
			<a onclick="window.open(this.href,'popupWindow','width=310,height=400,left=320,top=0');return false;" href="<?php echo $conventionsMateriels['chemin_conv']; ?>"><?php echo  $conventionsMateriels['numero_convention'].'</small>'; ?></a>	
        <?php echo '<small>&nbsp; signée le :&nbsp; '.format_date($conventionsMateriels['dateconvention'],'dd/MM/yyyy') .
		'<br>&nbsp;&nbsp;&nbsp;&nbsp;concernant le matériel de type: &nbsp;'.$conventionsMateriels['typemateriel'].'&nbsp; - cat :&nbsp;'.$conventionsMateriels['libellecatmateriel'].'&nbsp;réf : &nbsp;'.$conventionsMateriels['libellemateriel'].'&nbsp; n°&nbsp;:&nbsp;'.$conventionsMateriels['numeromateriel'].'</small><br>'; ?>
			<?php	} ?>

</fieldset>
<?php //phpinfo() ?>
<script>
	
	/* ---- fonction qui envoie les materiel attribué selectionnés pour edition convention */
	
	function maFonction(eleveId) {

				var lesMats = [];
				var REMOTE_ADDR = '<?php echo($_SERVER['REMOTE_ADDR']); ?>';
				var HTTP_HOST = '<?php echo($_SERVER['HTTP_HOST']); ?>';
	    
				if (HTTP_HOST == 'ashile2.ac-reunion.fr' && (REMOTE_ADDR == '192.168.220.3' || REMOTE_ADDR == '192.168.220.6')) //portail.ac-reunion.fr
				  {
						 var url_dest = 'https://portail.ac-reunion.fr/ashile/academie.php/eleve_materiel/pdf?eleve_id= ' ;
				
				} else if (HTTP_HOST  == 'ashile.ac-reunion.fr' && (REMOTE_ADDR == '192.168.220.3' || REMOTE_ADDR == '192.168.220.6') ) { 
						 var url_dest = 'https://portail.ac-reunion.fr/ashilep/academie.php/eleve_materiel/pdf?eleve_id= ' ;
				  } 
				
				 if ( HTTP_HOST  == 'ashile2.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ) // accueil.in.ac-reunion.fr
				  {
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashile/academie.php/eleve_materiel/pdf?eleve_id=';
				 
				 } else if( HTTP_HOST  == 'ashile.ac-reunion.fr' && REMOTE_ADDR == '172.31.176.121' ){
						 var url_dest = 'https://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve_materiel/pdf?eleve_id=' ;
				  }    
	             else{ var url_dest ='toto';}
			
	
			
			for (i=0;i<document.getElementsByName("groupMateriel").length;i++)
			{
				if(document.getElementsByName("groupMateriel")[i].checked)
				{
					lesMats[i] =document.getElementsByName("groupMateriel")[i].value;
				}
			}
			
			var url_dest =  url_dest+eleveId+"&lesMats="+lesMats+"";
           // alert ( location.href); 
	       document.location.replace(url_dest);   //redirection vers l'affichage de la convention
		//window.location="http://accueil.in.ac-reunion.fr/ashilep/academie.php/eleve_materiel/pdf?eleve_id="+eleveId+"&lesMats="+lesMats+""; 
	}
</script>


  
  
  
  
  
        
<!-- 
<button style="float: left" onClick="window.location.href='<?php echo url_for('eleve_materiel/pdf?eleve_id='.$materiel[0]['eleve_id']) ?>'">Edition de la Convention</button>
-->
