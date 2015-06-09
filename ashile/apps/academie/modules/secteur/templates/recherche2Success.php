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

<?php //echo phpinfo() ?>
	
	<div id="recherche2_secteur">
		<fieldset> 
         <div class='aide' onClick="<?php echo url_for('eleve_avs/aide') ?>"> </div> 		
		<h3>Gestion des Personnels > Gestion des Affectations
		<form action="<?php echo url_for('secteur/recherche2'); ?>" method="POST">
        <table>
		<tfoot>
								
						
						      Liste des élèves sans personnel acc. pour le secteur&nbsp;&nbsp;:
								<select id="valSecteurId" name="secteur_id" >
								<?php foreach($secteurs as $secteur) { ?>		

							    <option value="<?php echo $secteur['secteur_id']; ?>" 
									<?= ( $secteur['secteur_id'] == $eleve_avss[0]['secteur_id'] ? 'selected="selected"' : '' ) ?>>
									<?php echo $secteur['libellesecteur']; ?>
								</option></h3>
								
								<?php	} ?>
								</select>
						        <br></br>
					     <br> <input type="submit" value="Rechercher" />&nbsp;  <input type="button" value="Retour" onclick="history.go(-1)"> &nbsp;&nbsp;</br>
					
					
					 
	   </tfoot>

      </table>
      </form>
        <br></h3>*  le secteur ND permet d'afficher les élèves en attente de changement de scolarisation (changement de secteur)
	    <br>&nbsp;&nbsp;si la date d'observation n'est pas renseignée, la date retenue est la date du jour.</br> 

    </fieldset>

	

<?php if($_POST['secteur_id']) { 

	echo '<div>';
	include_partial('eleve_avs/index1', array('eleve_avss' => $eleve_avss)); 
	echo '<div>';
	
 } ?>
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