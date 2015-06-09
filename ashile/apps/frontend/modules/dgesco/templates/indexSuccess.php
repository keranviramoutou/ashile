<?php use_helper('jQuery'); ?>
<?php use_stylesheet('data_table.css') ?>
<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif; ?>


<div class= 'aide' onClick="aide_dgesco()"></div>
<fieldset>
	<legend>Liste des Questions</legend>
	<?php if (count($dgescos) > 0): ?>
	<?php echo jq_button_to_remote('Completer "SANS OBJET"', array('url' => 'dgesco/complete?eleve_id=' . $sf_request->getParameter('eleve_id'), 'update' => 'div_dgesco'))?>
		<table  cellpadding="0" cellspacing="10" border="0" class="display" id="maTable">
			<thead>
				<tr>
				    <th>N° Dgesco</th>
					<th>Question</th>
					<th>Réponse</th>
			
				</tr>
			</thead>
			<tbody>
				<?php foreach ($dgescos as $dgesco): ?>
				     <?php if($dgesco['libelle_reponse']) { ?>
					 <tr onclick="<?php echo jq_remote_function(array('url' => 'dgesco/edit?id=' . $dgesco['Dgesco_Id'], 'update' => 'div_dgesco')) ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
					<?php }else{ ?>
					<tr onclick="<?php echo jq_remote_function(array('url' => 'dgesco/edit?id=' . $dgesco['Dgesco_Id'], 'update' => 'div_dgesco')) ?>" style="cursor: pointer; color: #000; background:#C0DCC0">
                    <?php } ?>	
                    <td> <?php echo $dgesco['num_question'] ?></td>					
					<td width="200px"><?php echo  $dgesco['question'].'&nbsp;'; ?></td>

						<td width="300px"><?php if($dgesco['libelle_reponse']){
						echo substr($dgesco->decryptage($dgesco['libelle_reponse'],$clef_cryptage),0,100) ;}else {echo 'non renseignée';}?></td>
						
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
</fieldset>		
    <br />
<?php else: ?>
  	<?php if ($count_dgesco == 0) {
	 echo '<b>Enquête non générée pour cet(te) élève</b><br><br><u>Motif :</u><br>la fiche élève créée ou la scolarité ordinaire a été mise à jour après la génération de l\'enquête DGESCO.<br> Demander alors à l\'ASH de générer pour cet(te) élève l\'enquête DGESCO</i></p>';
	}else{
    echo '<p><i>Cet(te) élève n\'entre pas dans le cadre de l\'enquête Dgesco</i></p><p> &nbsp;&nbsp;Motifs: <br>
	&nbsp;&nbsp;- Fin de prise en charge renseignée (onglet Elève) <br>
	&nbsp;&nbsp;- pas de scolarité en cours en établissement ordinaire <p>';
	}?>

<?php endif; ?>
<?php //echo jq_button_to_remote('Nouveau', array('url' => 'dgesco/new?eleve_id=' . $sf_request->getUrlParameter('eleve_id'), 'update' => 'div_dgesco')) ?>

<script>
	function aide_dgesco() {
	var src = "<?php echo url_for('dgesco/aide') ?>";
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