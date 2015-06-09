<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>




		<script>	
		  // ------- CHAMP SECTEUR ------------------------------
		  
			$j(document).ready(function(){
		  // première fonction qui surveille les secteurs selectionnés
			   $j("#valSecteurId").change(function() {
					var name = $j("#valSecteurId option:selected");
					var secteurJS = name[0];
					
					// on a le secteur on fait klk chose
					//alert(' secteur n° '+secteurJS.value);  // mode debug					   
					  
				});
			});

			// --------------------------------------------------
		
		</script>


<div>
		<div class='aide' onClick="<?php echo url_for('eleve/aide') ?>"> </div> 
        <h3> Eleves > Liste des élèves par Secteur : <?php echo $eleves[0]['libellesecteur'] ?></h3>	
		<br>
	

	<div id="recherche_eleve">
		<fieldset>  
		
		<form action="<?php echo url_for('secteur/recherche'); ?>" method="POST">
        <table>
		<tfoot>
						<br>  </br> 
						
						         <br>Liste des secteurs &nbsp;&nbsp;&nbsp;:
								<select id="valSecteurId" name="secteur_id" >
								<?php foreach($secteurs as $secteur) { ?>		
								<option  value ="<?php echo $secteur['secteur_id']; ?>"
								<?= ( $secteur['secteur_id'] == $eleves[0]['secteur_id'] ? 'selected="selected"' : '' ) ?>>
								<?php echo $secteur['libellesecteur']; ?>
								</option>
								<?php	} ?>
								</select>
						<br>
						

						
					     <br> <input type="submit" value="Rechercher" />&nbsp;  <input type="button" value="Retour" onclick="history.go(-1)"> &nbsp;&nbsp;</br>
					
					
					 
	   </tfoot>

      </table>
      </form>
  

    </fieldset>

	</div>

<?php if($_POST['secteur_id']) { ?>
	<?php if( $_POST['secteur_id'] != '24') {
	echo '<div>';
	include_partial('orientation/secteur', array('eleves' => $eleves)); 
	echo '<div>';
	};
	?>	
	
	<?php if($_POST['secteur_id'] == '24') {  //secteur = ND demande de changement de secteur d'orientation
	echo '<div>';
	include_partial('orientation/secteur', array('eleves' => $eleves)); 
	echo '<div>';
	};
	?>	
<?php } ?>
	
	



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
