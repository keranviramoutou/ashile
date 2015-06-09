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
echo '<small>Situation au :&nbsp<strong>'.format_date(time(),'dd/MM/yyyy').'</strong></small>';
$enteteTableau = <<<EOT
		
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="Tab">
		<thead>
			<tr>
				<th>Temps Hebdo</th>
				<th>Type de Contrat</th>
				<th>Début C.</th>
				<th>Fin du C.</th>
			</tr>
		</thead>
        <tbody>
EOT;
    
    echo $enteteTableau;
    
    $foo = 0;
		    if(count($contratAvs)>0) {
			foreach ($contratAvs as $contratAvss): ?>
	 				<tr class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" >
						<td> <?php echo link_to($contratAvss['temps_hebdo'].'H', 'contrat_avs/edit?id=' . $contratAvss['contratId'] ) ?></td>
					   <td><?php echo $contratAvss['typecontrat']?></td>
					   <td><?php echo format_date($contratAvss['date_debut_contrat'],'dd/MM/yyyy') ?></td>
					   <td><?php echo format_date($contratAvss['date_fin_contrat'],'dd/MM/yyyy') ?></td>
				   </tr>
				   <?php $foo = 1; ?>
			<?php endforeach; ?>
			<?php }else{ echo 'pas de données ';}; ?>
		</tbody>
	</table>
	<p>
	
	<?php
    if($foo == 1){
	// echo link_to('Créer un  contrat ', 'contrat_avs/new?avs_id=' . $contratAvs[0]['avsid'] ).'&nbsp&nbsppour '.$contratAvs[0]['avsnom'] .'&nbsp;'.$contratAvs[0]['avsprenom'];
	};
	?>
<!---------------------------------------------------------------------------------->

