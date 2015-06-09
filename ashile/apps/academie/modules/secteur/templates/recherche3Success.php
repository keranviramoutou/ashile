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

	<div id="recherche3_secteur">
		<h3> Matériels > Bon de livraison ou mise à jour date remise du matériel à l'ERF </h3>
		<fieldset>  
		
		<form action="<?php echo url_for('secteur/recherche3'); ?>" method="POST">
        <table>
		<tfoot>
								<div class='aide' onClick="<?php echo url_for('eleve_materiel/aide') ?>"> </div> 

                               	
						       secteur de&nbsp;&nbsp;:
								<select id="valSecteurId" name="secteur_id" >
								
								<?php foreach($secteurs as $secteur) { ?>		
								<?php // if( $secteur['secteur_id'] != $Materielnonlivre[0]['secteur_id']) {?>
								<?php echo 'val'.$val ;?>
								<?php //} ?>
			
								
								<!-- option  par défaut  -->
							
								    <option value="<?php echo $secteur['secteur_id']; ?>" 
									<?= ( $secteur['secteur_id'] == $Materielnonlivre[0]['secteur_id'] ? 'selected="selected"' : '' ) ?>>
									<?php echo $secteur['libellesecteur']; ?>
									</option></h3>
								<?php	} ?>
								

								</select>
						        <br>

								</br>
					     <br> <input type="submit" value="Rechercher" />&nbsp;  <input type="button" value="Retour" onclick="history.go(-1)"> &nbsp;&nbsp;</br>
					
					
					 
	   </tfoot>

      </table>
      </form>


    </fieldset>

	</div>

<?php if($_POST['secteur_id']) { 

	

	echo '<div>';
	include_partial('eleve_materiel/livraison', array('Materielnonlivre' => $Materielnonlivre)); 
	echo '<div>';
	
 } ?>
	
	



<script>
var src = "<?php echo url_for('eleve_materiel/aide') ?>";

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