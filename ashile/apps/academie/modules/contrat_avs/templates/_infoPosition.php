<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>


<!---------------------- tableau JQuery eleves attribués à l 'avs ------------------------------------>
<!----------------------------------------------------------------------------------------------------->
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#Table').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "'Afficher _MENU_ positions  ",
               "sZeroRecords":    "Aucun position; afficher",
               "sInfo":           "Affichage de la position_START_ &agrave; _END_ sur _TOTAL_ positions",
               "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
               "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
               "sInfoPostFix":    "",
               "sSearch":         "Rechercher&nbsp;:",
               "sLoadingRecords": "Téléchargement...",
               "sUrl":            "",
               "oPaginate": {
                   "sFirst":    "Premier",
                   "sPrevious": "Pr&eacute;c&eacute;dent",
                   "sNext":     "Suivant",
                   "sLast":     "Dernier"
               }
           }
       });
   } );
   
</script>


	<h4>Historique des Positions de ce Contrat</h4>
	<br>Seule une position en cours peut être supprimée ou modifiée( date de fin supérieure à la date du jour) </br>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="Table">
		<thead>
			<tr>  
					<th>Type Position</th>
					 <th>dates</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($position as $positions): ?>
				<tr>
					<td><?php if(format_date($positions['datefin'],'yyyy/MM/dd') >= format_date(time(),'yyyy/MM/dd') || !$positions['datefin'] ) {?>
					<a href="<?php echo url_for('position_avs/edit?id='.$positions['Id']) ?>" onclick="document.body.style.cursor='wait'"><?php echo $positions['libelletypepositionavs']; ?></a>
						<?php }else{ ?>
					<?php echo $positions['libelletypepositionavs']; ?>
						<?php } ?>
					<?php if(format_date($positions['datefin'],'yyyy/MM/dd') >= format_date(time(),'yyyy/MM/dd')) { ?>
					&nbsp;&nbsp;<?php echo '&nbsp;'.link_to('Supprimer','position_avs/delete?id='.$positions['id'].'&contratavs_id='.$positions['contratavs_id'], array('method' => 'delete', 'confirm' => 'Etes vous sur ?')) ?></td>
					<?php } ?>
					<td><?php echo 'du&nbsp;'.format_date($positions['datedebut'],'dd/MM/yyyy').'&nbsp;au&nbsp;'.format_date($positions['datefin'],'dd/MM/yyyy') ?></td>
							
				</tr>
			<?php endforeach; ?>
		
		</tbody>
	</table>








