<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<!---------------------- tableau JQuery eleves attribués à l avs ------------------------------------>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "Afficher _MENU_ Personnels accompagnants",
               "sZeroRecords":    "Aucun &eacute;l&eagrave;ve &agrave; afficher",
               "sInfo":           "Affichage de l'accompagnant _START_ &agrave; _END_ sur _TOTAL_ accompagnants",
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
	<h3>Historique des accompagnements  </h3>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
			<thead>
			<tr>
				<th>Personnel accompagnant</th>
				<th>Quotite H.</th>
				<th>Etablissement</th>
				<th>Prise en charge du</th>
				<th>Au</th>
				<th>Affectation</th>
			</tr>
			</thead>
			<tbody>
				<?php foreach ($EleveAvs as $eleveAvss): ?>
	 			<tr class="<?php echo fmod($i, 2) ? 'even' : 'odd'   ?>" >
					   <td><?php echo Doctrine::getTable('Avs')->find($eleveAvss['avs_id']); ?></td>	
					   <td><?php echo $eleveAvss['quotitehorraireavs'].'&nbspH'; ?></td>
					   <td><?php echo $eleveAvss['rne'].'-'.$eleveAvss['etab'] ?></td>
					   <td><?php echo format_date($eleveAvss['datedebut'],'dd/MM/yyyy') ?></td>
					   <td><?php echo format_date($eleveAvss['datefin'],'dd/MM/yyyy') ?></td>
					   <td><a href="<?php echo url_for('eleve_avs/edit?id='.$eleveAvss['id'].'&eleve_id=' . $eleveAvss['EleveId'] . '&avs_id=' . $eleveAvss['avs_id']); ?>"><?php echo 'Modifier'  ?>
						&nbsp<?php echo link_to('Créer ', 'eleve_avs/new?eleve_id=' . $eleveAvss['EleveId'].'&avs_id=' . $eleveAvss['avs_id'] ) ?></a></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
        </table>
 <!--------------------------------------------------------------------------------------->       
        

