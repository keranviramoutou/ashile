<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>



<!--
		<script>	
		  // ------- CHAMP SECTEUR ------------------------------
		  
			$j(document).ready(function(){
		  // première fonction qui surveille les secteurs selectionnés
			   $j("#valSecteurId").change(function() {
					var name = $j("#valSecteurId option:selected");
					var secteurJS = name[0];
					
					// on a le secteur on fait klk chose
					alert(' secteur n° '+secteurJS.value);  // mode debug					   
					

						  
				});
			});
						

			// --------------------------------------------------
			

			
			
		</script>
-->

<div>
	
<?php $titre = 'Liste des prises en charge pour le secteur de  : &nbsp' ?>
 
	
	
	<?php if($_POST['secteur_id']){	?>

		 
		 <?php if($_POST['secteur_id'] != '24'){ 
		 $titre = 'Liste des Affectations pour le Secteur de : &nbsp' ; 
		 } ?>
	<?php   }else{$_POST['secteur_id'] ='' ;	 } ?>	 
  
	<div id="recherche1_secteur">
		<fieldset>  
		<div class='aide' onClick="<?php echo url_for('eleve/aide') ?>"> </div> 
		<h3> Gestion des Affectations 
		<form action="<?php echo url_for('secteur/recherche1'); ?>" method="POST">
        <table>
		<tfoot>
						 
						
						         <br><?php echo $titre ?>
								<select id="valSecteurId" name="secteur_id" >
								<?php foreach($secteurs as $secteur) { ?>		
							    <option value="<?php echo $secteur['secteur_id']; ?>" 
									<?= ( $secteur['secteur_id'] == $eleve_avss[0]['secteur_id'] ? 'selected="selected"' : '' ) ?>>
									<?php echo $secteur['libellesecteur']; ?>
									</option>
								</option></h3>
								<?php	} ?>
								</select>
						<br>
						

						
					     <br> <input type="submit" value="Rechercher" />&nbsp;  <input type="button" value="Retour" onclick="history.go(-1)"> &nbsp;&nbsp;</br>
					
					
					 
	   </tfoot>

      </table>
      </form>
        
	    <br></br> 

    </fieldset>



<?php if($_POST['secteur_id']) { ?>
	<?php if( $_POST['secteur_id'] != '24') {
	echo '<div>';
	include_partial('eleve_avs/secteur', array('eleve_avss' => $eleve_avss)); 
	echo '<div>';
	};
	?>	

<?php } ?>
	
</div>	



<script>
var src = "<?php echo url_for('eleve/aide') ?>";

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
