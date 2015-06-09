<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<br>
	<h1>Liste des Eleves suivi par un partenaire dans le cadre d'un suivi externe </h1>
	<form action="<?php echo url_for('specialiste/list'); ?>"  method="POST">

	<fieldset>
	                        
								
						         <br>Sélectionner le partenaire &nbsp;&nbsp;
								<select id="speid" name="specialiste_id" style="width: auto;">
								<option value = "">	</option>
								<?php foreach($specialiste as $specialistes) { ?>		
								<option  value ="<?php echo $specialistes['specialiste']; ?>"		
								<?= ( $specialistes['specialiste'] == $_POST['specialiste_id'] ? 'selected="selected"' : '' ) ?>>
								<?php	echo $specialistes['nom'].'&nbsp'.$specialistes['prenom'].'&nbsp;spécialité :&nbsp;'.$specialistes['libellespecialite']; ?>
								</option>
								<?php	} ?>
								</select>
							
						<br>	<br><input type="submit" value="Rechercher" onclick="document.body.style.cursor='wait'" />&nbsp;
	</fieldset>
	
	
	</form>
    <div>
	<?php if ($count_suivi_externe > 0 ){ ?>		
	<?php  include_partial('suivi_externe', array('suivi_externe' => $suivi_externe)); ?>
	
	<?php  } elseif($_POST['specialiste_id']){ ?>
	<?php echo 'pas de suivi externe pour&nbsp :' .$specialiste[0]['nom'].'&nbsp;'.$specialiste[0]['prenom'].'&nbsp; - spécialité :&nbsp;'.$specialiste[0]['libellespecialite'] ?>
	<?php } ?>
	</div>