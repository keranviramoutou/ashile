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
 
		
<?php  if($_POST['etat']) {?>
<?php $titre = '&nbsp;'.$_POST['etat'].' </small>'; ?>
<?php }else{ ?>
<?php $titre=$titre ; ?>
<?php } ?>

<?php  if($_POST['typemat']) {?>
<?php $titre = $titre.'&nbsp;</small><small>de type :&nbsp;'.$_POST['typemat'].' </small>'; ?>
<?php }else{ ?>
<?php $titre=$titre ; ?>
<?php } ?>

<?php  if($_POST['maj']) {?>
<?php $titre = $titre.'&nbsp;<small> à la date du  &nbsp;'.$_POST['maj'].'</small>' ;?>
<?php }else{ $titre = ''; }?>

<?php $etat_materiel = '%'.$_POST['etat'].'%'; ?>


	<div id="recherche_materiel">
		<fieldset>  
				<div class='aide' onClick="<?php echo url_for('eleve_materiel/aide') ?>"> </div> 
		       <h3> Gestion Matériels > Recherche de matériel</h3>	
			   
		<form action="<?php echo url_for('eleve_materiel/recherche'); ?>" method="POST">
        <table>
		<tfoot>
				      <br>Etat du matériel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name='etat' >
						    <option value="CREATION"<?php echo ( $_POST['etat']== "CREATION" ? 'selected="selected"' : '' ) ?>>Créer</option>
						    <option value="STOCK"<?php echo ( $_POST['etat']== "STOCK" ? 'selected="selected"' : '' ) ?>>En stock</option>
							<option value="index"<?php echo( $_POST['etat']== "index" ? 'selected="selected"' : '' ) ?>>Attribués</option>
							<option value="Réparation"<?php echo ( $_POST['etat']== "Réparation" ? 'selected="selected"' : '' ) ?>>En réparation</option>
							<option value="Remis"<?php echo( $_POST['etat']== "Remis" ? 'selected="selected"' : '' ) ?>>Remis</option>

						</select> 
						</br> 
						
						         <br>Type matériel demandé à la MDPH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<select id="valSecteurId" name="typemat" style="width: auto;">
								<option value = "">	</option>
								<?php foreach($typemateriels as $typemateriel) { ?>		
								<option  value ="<?php echo $typemateriel['libelle']; ?>"
								
								<?= ( $typemateriel['libelle'] == $_POST['typemat'] ? 'selected="selected"' : '' ) ?>>
								<?php	echo $typemateriel['libelle']; ?>
								</option>
								<?php	} ?>
								</select>
						<br>
						<br>Date d'observation  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="maj" style="width:80px" id="calendrier"></br>
						<br>Libellé ou Numéro de série du matériel   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<input type="text" name="libelle_mat" value="<?php echo  $_POST['libelle_mat']?>" style="width:200px" ></br>
						
	
						
					    <br> <input type="submit" value="Rechercher" />&nbsp; &nbsp;&nbsp;<?php  echo button_to('Créer un Matériel', 'materiel/new' )  ?></br>
						 
	   </tfoot>

      </table>
      </form>
        <br>* la recherche à partir de l'état du matériel peut être combinée avec la date d'observation et le Type matériel demandé à la MDPH , 
	    <br>&nbsp;&nbsp;si la date d'observation n'est pas renseignée, la date retenue est la date du jour.</br> 
		<br> La recherche sur le libéllé ou Numéro de série du matériel est unique , elle ne prend pas en compte les autres critères de recherche</br>

    </fieldset>

	</div>
	<?php if($_POST['etat'] == "index" && strlen($_POST['libelle_mat']) == 0) {
	echo '<div>';
	include_partial($_POST['etat'], array('resultat' => $attribues)); 
	echo '<div>';
	};
	?>
		
	<?php if($_POST['etat'] == "STOCK" && strlen($_POST['libelle_mat']) == 0) {
	echo '<div>';
	include_partial('materiel/index', array('resultat' => $materiels)); 
	echo '<div>';
	};
	?>
	
	<?php if($_POST['etat'] == "Réparation" && strlen($_POST['libelle_mat']) == 0) {
	echo '<div>';
	include_partial('materiel/index', array('resultat' => $materiels)); 
	echo '<div>';
	};
	?>

	<?php if($_POST['etat'] == "Remis" && strlen($_POST['libelle_mat']) == 0) {
	echo '<div>';
	include_partial('materiel/index', array('resultat' => $materiels)); 
	echo '<div>';
	};
	?>	
	
	<?php if($_POST['etat'] == "CREATION" && strlen($_POST['libelle_mat']) == 0) {
	echo '<div>';
	include_partial('materiel/index', array('resultat' => $materiels)); 
	echo '<div>';
	};
	?>
		
	<?php if(strlen($_POST['libelle_mat']) != 0) {
	echo '<div>';
	include_partial('materiel/index', array('resultat' => $materiels)); 
	echo '<div>';
	};
	?>	
	
	<!-- Script pour DatePicker -->
	<script>
		$j(function() {
		$j( "#calendrier" ).datepicker({ dateFormat: 'dd-mm-yy'}); //'format_date' => ''  dd/mm/yy
		});
	</script>
	<!---------------------------->


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
