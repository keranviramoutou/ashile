<div class='aide' onClick="<?php echo url_for('materiel/aide') ?>"> </div> 
<fieldset><legend>Matériels > Edition d'une fiche matériel</legend>
		<?php echo 'Type du matériel :&nbsp;<strong>'.$form->getObject()->getTypemateriel().'</strong>&nbsp;Marque :&nbsp; <strong>'.$form->getObject()->getMarque().'</strong>&nbsp&nbsp n°:<strong> '.$form->getObject()->getNumeromateriel().'</strong>' ?>
</fieldset>

<fieldset>
<table>
	<tr>
		<td style="width: 40%; position:top">
			<?php 
					include_partial('form', array('form' => $form));
			?>
		</td>
		<td style="width: 30%; position:top">
			<?php	
					include_partial('eleveMateriel', array('eleveMateriel' => $eleveMateriel));
			?>
		</td>
	</tr>
	<tr>
		<td colspan = '2'>
			<?php
						// --- un partial de liste des mouvements de ce materiel ---
					//	include_partial('mouvementsMateriel', array('mouvements' => $mouvements, 'materiel'=>$materiel));
			?>
		</td>
	</tr>
</table>
</fieldset>
<?php  include_partial('mouvementsMateriel', array('mouvements' => $mouvements, 'materiel'=>$materiel,'eleveMateriel' => $eleveMateriel)); ?>

