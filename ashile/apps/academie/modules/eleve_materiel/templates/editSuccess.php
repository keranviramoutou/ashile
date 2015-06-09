<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<div id="materiel_eleve">
<?php
echo '<div><fieldset><legend> vous traitez l\'éleve :<strong> '.$form->getObject()->getEleve().'</strong></legend>';
?>
<?php if ($existdemande_materiel)	 { 	 ?>


	 <div class='aide' onClick="aide_eleve_materiel()"> </div> 
	 	 <?php echo '&nbsp;&nbsp;- Matériel selectionné : <strong>'.$form->getObject()->getMateriel().'&nbsp; '.'</strong>'; ?>
	 <?php if($countmaterielssansconv){ ?> <!-- affichage du lien pour l'édition de la convention -->
         <div class='excel' onClick="convention()"></div> 
    <?php } ?>
	<table>
	<tr>
		<td style="width: 40%; position:top">
			<?php 
			include_partial('form', array('form' => $form));
			?>
		</td>
		
		 
		
		<td style="width: 30%; position:top">
			<?php	
			if($existconventionsMateriel){
				 include_partial('conventions', array('conventionsMateriel'=> $conventionsMateriel)) ;
			}
			?>
		</td>
	</tr>
	</table><p></fieldset>
	 




	<?php  
	echo '</strong><p></fieldset>';
	}else{
	 echo '<div class="flash_error">Pas de demande de matériel dossier MDPH en cours à la date du&nbsp; '.format_date(time(),'dd/MM/yyyy').'</div>';
	 }
	
	?>

</div>

<div>

		   <?php
				include_partial('demandemateriel_eleve', array('demande_materiel' => $demande_materiel)) 
		    ?>	
</div>

<div>
		   <?php
				include_partial('materiel_eleve', array('materielEleve' => $materielEleve)) 
		    ?>	

</div>



<script>


	function convention() {
var src = "<?php echo url_for('eleve_materiel/conv?eleve_id='.$form->getObject()->getEleveId().'&materiel_id='.$form->getObject()->getMaterielId());?>";
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
	}

</script>
<script>


	function aide_eleve_materiel() {
	var src = "<?php echo url_for('eleve_materiel/aide') ?>";
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
	}

</script>
