<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ Avs",
               "sZeroRecords":    "Aucun &eacute;l&eagrave;ve &agrave; afficher",
               "sInfo":           "Affichage de l'Avs _START_ &agrave; _END_ sur _TOTAL_ Avs",
               "sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
               "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
               "sInfoPostFix":    "",
               "sSearch":         "Rechercher&nbsp;:",
               "sLoadingRecords": "Téchargement...",
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

	<h3>Gestion des Personnels acc. > Personnels avec un Contrat</h3>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		<thead>
			<tr>   
				<th>Avs</th>
				<th>Contrat</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($contrat_avss as $contrat_avs): ?>
				<tr onClick="window.location='<?php echo url_for('contrat_avs/list?avs_id='.$contrat_avs['id']) ?>'">
				               <td><a href="<?php echo url_for('avs/edit?id='. $contrat_avs['id']) ?>"><?php echo $contrat_avs['nom'].'   '. $contrat_avs['prenom'] ?></a>&nbsp;                              
							  <?php echo 'né(e) le '.format_date($contrat_avs['date_naissance'],'dd/MM/yyyy') ?></td>
                               <td> <?php echo link_to('Créer', 'contrat_avs/new?avs_id=' . $contrat_avs['id'] ) ?>
							   <?php echo link_to('Editer', 'contrat_avs/list?avs_id=' . $contrat_avs['id'] ) ?> </td>
							   

				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>



<?php
function link_to_frontend($name, $parameters)
{
    return sfProjectConfiguration::getActive()->generateFrontendUrl($name, $parameters);
}
?>


