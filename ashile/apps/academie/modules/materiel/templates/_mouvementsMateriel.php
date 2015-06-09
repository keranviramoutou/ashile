<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>

<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ mouvements",
               "sZeroRecords":    "Aucun matériels; afficher",
               "sInfo":           "Affichage du mouvement _START_ &agrave; _END_ sur _TOTAL_ mouvements",
               "sInfoEmpty":      "Affichage du matériel; 0 sur 0 matériel(s)",
               "sInfoFiltered":   "(filtr&eacute; de _MAX_ matériels au total)",
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



<div id="eleve_materiel"> 

	<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
	  <thead>
		<tr>
				<tr>   
					 <th>Mouvement</th>
					 <th>Date de debut </th>
					 <th>Date de fin </th>
					 <th>Notes</th>
				</tr>
		</tr>
	  </thead>
			<tbody>
				<?php foreach ($mouvements as $mouvement): ?>
				<tr>
				     <td><?php if($mouvement['datefin'] =='') { ?>
				     <a href="<?php echo url_for('mouvement_materiel/edit?id='.$mouvement['mouvementmateriel_id'].'&materiel_id='.$mouvement['materiel_id']) ?>"><?php echo  $mouvement['nommouvement']  ?></a>
					  <?php echo link_to('Supprimer', 'mouvement_materiel/delete?id='.$mouvement['mouvementmateriel_id'].'&materiel_id='.$mouvement['materiel_id'], array('method' => 'delete', 'confirm' => 'Are you sure?','popup = 1')) ?>
					  </td>
					  <?php }else{ ?>
					  <?php echo  $mouvement['nommouvement']  ?>
					  <?php } ?>
					</a></td>
					<td><?php echo format_date($mouvement['datedebut'],'dd/MM/yyyy') ?></td>
					<td><?php echo format_date($mouvement['datefin'],'dd/MM/yyyy') ?></td>
						<td><?php echo $mouvement['notes']?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
	</table>
<script>
// -------------------------------------------------------------------------------------------------
function winPopApplication(url, width, height, isScrollable) {
	if (width == null) width = '800';
	if (height == null) height = '450';
	popupwinApplication = window.open (url, '',	  'toolbar=no'
												+ ',width='+width
												+ ',height='+height
												+ ',directories=no'
												+ ',status=no'
												+ ',scrollbars='+(isScrollable?'yes':'no')
												+ ',menubar=yes'
										);
	if (popupwinApplication && popupwinApplication.focus) popupwinApplication.focus();
	return false;
}

</script>