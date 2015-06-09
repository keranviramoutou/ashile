<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>



<?php echo '<fieldset><h4>Conventions Pour ce matériel</h4>' ?>

   		<table cellpadding="0" cellspacing="0" border="0" class="display" id="conv">
			<thead>
				<tr>   
					 <th>Eleve</th>
					 <th>convention signée le</th>
					 <th>N° convention </th>
				
				</tr>
			</thead>
			<tbody>
				<?php foreach ($conventionsMateriel as $conventionsMateriels): ?>
				<tr>
				    <td><?php echo  $conventionsMateriels['nomEleve'].'('.$conventionsMateriels['ine'].')'; ?></td>
				    <td><?php echo  format_date($conventionsMateriels['dateConvention'],'dd/MM/yyyy') ?></td>
				    <td><?php echo $conventionsMateriels['numero_convention'] ?></td>
				 
				</tr>
				<?php endforeach; ?>
			</tbody>
        </table>
        </fieldset>
 <!--------------------------------------------------------------------------------------->  

