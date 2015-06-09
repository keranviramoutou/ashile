<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#Tab').dataTable({
           "bJQueryUI": false,
           "bFilter": false,
           "bPaginate": false,
           "bInfo": false,
           "sPaginationType": "full_numbers",
       
       });
   });
</script>


<?php 
$i = 1; 

$enteteTableau = <<<EOT
	<legend>Contrats de l'Avs</legend>
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tab">
		<thead>
			<tr>
				<th>Temps Hebdo</th>
				<th> Etablissement</th>
				<th>Datedebut</th>
				<th>Datefin</th>
			</tr>
		</thead>
        <tbody>
EOT;
    echo $enteteTableau;
			foreach ($contratAvs as $contratAvss): ?>
	 				<tr class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" >
					   <td><?php echo $contratAvss['temps_hebdo'].'H'; ?></td>
					   <td><?php echo $contratAvss['rne'].'-'.$contratAvss['etab'] ?></td>
					   <td><?php echo format_date($contratAvss['date_debut_contrat'],'dd/MM/yyyy') ?></td>
					   <td><?php echo format_date($contratAvss['date_fin_contrat'],'dd/MM/yyyy') ?></td>
				   </tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<!---------------------------------------------------------------------------------->

