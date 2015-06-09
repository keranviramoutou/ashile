<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>


<div>
	
<?php 	 $titre = 'Réponses à l\'enquête DGESCO pour le Secteur de : &nbsp' ;  ?>
 
	
	
	<?php if($_POST['secteur_id']){	?>

		 
		 <?php if($_POST['secteur_id'] != '24'){ 
		 $titre = 'Réponses à l\'enquête DGESCO pour le Secteur de : &nbsp' ; 
		 } ?>
	<?php   }else{$_POST['secteur_id'] ='' ;	 } ?>	 
  
	<div id="recherche1_secteur">
		<fieldset>  
		<div class='aide' onClick="<?php echo url_for('eleve/aide') ?>"> </div> 
		<h3> Enquête DGESCO </h3>
		<form action="<?php echo url_for('secteur/recherche4'); ?>" method="POST">
        <table>
		<tfoot>
						 
						
						         <br><?php echo $titre ?>
								<select id="valSecteurId" name="secteur_id" >
								<?php foreach($secteurs as $secteur) { ?>		
							    <option value="<?php echo $secteur['secteur_id']; ?>" 
									<?= ( $secteur['secteur_id'] == $dgescos[0]['secteur_id'] ? 'selected="selected"' : '' ) ?>>
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
</div>	

<div style='width:800pt; overflow: auto' >
<?php if($_POST['secteur_id']) { ?>
	<?php if( $_POST['secteur_id'] != '24') {
	echo '<div>';
	include_partial('dgesco/secteur', array('dgescos' => $dgescos,'questions' => $questions,'clef_cryptage' => $clef_cryptage)); 
	echo '<div>';
	};
	?>	

<?php } ?>
	
</div>



<script>
var src = "<?php echo url_for('dgesco/aide') ?>";

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
