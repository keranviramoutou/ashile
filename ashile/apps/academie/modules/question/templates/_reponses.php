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
               "sLengthMenu":     "Afficher _MENU_ matériel(s) alloué(s)  ",
               "sZeroRecords":    "Aucun mouvement &agrave; afficher",
               "sInfo":           "Affichage du matériel _START_ &agrave; _END_ sur _TOTAL_ matériel(s) alloué(s)",
               "sInfoEmpty":      "Affichage du matériel alloué 0 &agrave; 0 sur 0 matériel(s) alloué(s)",
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

<h3>Listes des Réponses</h3><br>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
			<thead>
				<tr>   
					 <th>id réponse</th>
					 <th>Codage de la réponse</th>
					 <th>libéllé réponse</th>
					 <th>reponse</th>
					 <th>Scolarité de degré</th>

				</tr>
			</thead>
			<tbody>
				<?php foreach ($reponse as $reponses): ?>
				<tr>

				    <td><a href="<?php echo url_for('reponse/edit?id='.$reponses['id'].'&question_id='.$reponses['question_id']) ?>"><?php echo $reponses['id'] ?></td>
				    <td><?php echo $reponses['num_reponse']  ?></td>
				    <td><?php echo $reponses['libelle_reponse']  ?></td>
				    <td><?php echo $reponses['reponse'] ?></td>
					<td><?php echo $reponses['degreetabsco'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
        </table>
		


