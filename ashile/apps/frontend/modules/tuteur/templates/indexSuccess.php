<?php use_helper('jQuery') ?>
<?php use_stylesheet('data_table.css') ?>

<?php if ($sf_user->hasFlash('succes')): ?>
    <div class="flash_notice"><?php echo $sf_user->getFlash('succes') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
    <div class="flash_error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif; ?>
<div class= 'aide' onClick="aide_responsable()"></div> 
<?php $i = 1 ?>
 <fieldset >
	<legend>Liste des représentants légaux</legend>
		<table cellpadding="0" cellspacing="10" border="0" class="display" id="maTable" width="100%">
			<thead>
				<tr>
					<th>Identité</th>
					<th>R. L.</th>
					<th></th>
					<th>Téléphone 1</th>
					<th>Téléphone 2</th>
					<th>Mail</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($tuteurs as $tuteur): ?>
					<tr onclick="<?php echo jq_remote_function(array('url' => 'tuteur/edit?eleve_id=' . $tuteur->getEleveId() . '&responsableeleve_id=' . $tuteur->getResponsableeleveId(), 'update' => 'div_tuteur', 'method' => 'get')) ?>;document.body.style.cursor='wait'" class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>" style="cursor: pointer; color: #000; background:#e0e0e0">
						<!--td><a href="<?php echo url_for('tuteur/edit?eleve_id=' . $tuteur->getEleveId() . '&responsableeleve_id=' . $tuteur->getResponsableeleveId()) ?>"><?php echo $tuteur->getEleveId() ?></a></td>
						<td><a href="<?php echo url_for('tuteur/edit?eleve_id=' . $tuteur->getEleveId() . '&responsableeleve_id=' . $tuteur->getResponsableeleveId()) ?>"><?php echo $tuteur->getResponsableeleveId() ?></a></td-->
						<td><?php echo $tuteur->getResponsableEleve()->getNom() . '&nbsp;' . $tuteur->getResponsableEleve()->getPrenom() ?></td>
												<td><?php if ($tuteur->getTuteurlegal() == 1){ ?>
												 <input type="checkbox" name="tuteur" value="tuteur" checked="checked" disabled="disabled"  >&nbsp;&nbsp;
												 <?php  } else {?> 
												 <input type="checkbox" name="tuteur" value="tuteur" disabled="disabled"  >&nbsp;&nbsp;
												<?php } ?></td>
					<!--	<td><?php echo $tuteur->getTuteurlegal() == 1 ? 'Oui' : 'Non' ?></td> -->
						<td><?php echo $tuteur->getTypeResponsableEleve() ?></td>
					    <td><?php echo $tuteur->getResponsableEleve()->getTel1()  ?></td>
						<td><?php echo $tuteur->getResponsableEleve()->getTel2()  ?></td>
						<td><?php echo $tuteur->getResponsableEleve()->getEmail()  ?></td>
					</tr>
					<?php $i++ ?>
				<?php endforeach; ?>
				<?php if ($i == 1): ?>
					<tr><td colspan="4" style="font-style: italic">Cet élève n'a pas de responsable</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
		</fieldset>
<?php echo jq_button_to_remote('Nouveau Responsable', array('url' => 'tuteur/new?eleve_id=' . $sf_request->getParameter('eleve_id'), 'update' => 'div_tuteur')) ?>


<script>

		
	function aide_responsable() {
	var src = "<?php echo url_for('tuteur/aide') ?>";
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