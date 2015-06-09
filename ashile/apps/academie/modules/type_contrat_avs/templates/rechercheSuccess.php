<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>




		<script>	
		  // ------- CHAMP SECTEUR ------------------------------
		  
			$j(document).ready(function(){
		  // première fonction qui surveille les secteurs selectionnés
			   $j("#valtypecontrat").change(function() {
					var name = $j("#valtypecontrat option:selected");
					var secteurJS = name[0];
					
					// on a le secteur on fait klk chose
					//alert(' secteur n° '+secteurJS.value);  // mode debug					   
					

						  
				});
			});
						

			// --------------------------------------------------
			

			
			
		</script>


<div>

<?php //echo phpinfo() ?>
     
	<?php if($_POST['typecontrat_id']){	
	
		if($_POST['typecontrat_id'] == '999'){
		 $titre = '<h3> Gestion des Personnel acc. > Liste des AVS sans contrat' ; 
		} else{ 
		$titre = '<h3> Gestion des Personnel acc. > Liste des A : &nbsp'. $contrat_avss[0]['typecontrat'] ; 
		};
		
   }else{$_POST['typecontrat_id'] ='' ;	 } ?>	
   
         <h3> <?php echo $titre ?></h3>
	<div id="recherche_eleve">
		<fieldset>  
		
		<form action="<?php echo url_for('type_contrat_avs/recherche'); ?>" method="POST">
        <table>
		<tfoot>
								<div class='aide' onClick="<?php echo url_for('contrat_avs/aide') ?>"> </div> 
						
						       Liste des types de contrat &nbsp;&nbsp;&nbsp;:
								<select id="valtypecontrat" name="typecontrat_id" >
								
								<?php foreach($type_contrat_avss as $type_contrat_avs) { ?>	
                         		<option  value ="<?php echo $type_contrat_avs['tcId']; ?>">
								<?php echo $type_contrat_avs['typecontrat'].'&nbsp;('.$type_contrat_avs['total'].')'; ?>
								</option>
								<?php	} ?>
								<option value ="999"> <?php echo 'Avs sans contrat'.'&nbsp;('.$count_sans_contrat.')'; ?> </option>
								</select>
						        <br></br>
					     <br> <input type="submit" value="Rechercher" />&nbsp;  <input type="button" value="Retour" onclick="history.go(-1)"> &nbsp;&nbsp;</br>
					
					
					 
	   </tfoot>

      </table>
      </form>
        <br>*  le secteur ND permet d'afficher les élèves en attente de changement de scolarisation (changement de secteur)
	    <br>&nbsp;&nbsp;si la date d'observation n'est pas renseignée, la date retenue est la date du jour.</br> 
		<br> le nombre entre parenthèse qui suit le type de contrat représente le nombre total dans la base de contrat du type selectionné</br>

    </fieldset>

	</div>

<?php if($_POST['typecontrat_id'] != '999') { 

	echo '<div>';
	include_partial('contrat_avs/typecontrat', array('contrat_avss' => $contrat_avss)); 
	echo '<div>';
	
 } ?>

<?php if($_POST['typecontrat_id'] == '999') { 

	echo '<div>';
	include_partial('contrat_avs/index1', array('contrat_sans' => $contrat_sans)); 
	echo '<div>';
	
 } ?> 
	



<script>
var src = "<?php echo url_for('contrat_avs/aide') ?>";

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