<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>


<fieldset><legend>Eleves ayant eu ce materiel attribué</legend>
		<table cellpadding="0" cellspacing="0" border="0" class="display" >
			<thead>
			<tr> 
					 <th>Eleve</th>
					 <th>Date du prêt</th>
					 <th>Date retour</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($eleveMateriel as $eleveMateriels): ?>
	 			<tr class="<?php echo fmod('', 2) ? 'even' : 'odd'   ?>" >
				    <td><?php echo $eleveMateriels['nomeleve'] .'&nbsp&nbsp'.$eleveMateriels['prenomeleve'] ?></td>
					<td><?php echo format_date($eleveMateriels['datedebut'],'dd/MM/yyyy') ?></td>
					<td><?php echo format_date($eleveMateriels['datefin'],'dd/MM/yyyy') ?></td>

				</tr>
				<?php endforeach; ?>
			</tbody>
        </table>
</fieldset>
 <!--------------------------------------------------------------------------------------->       
        

