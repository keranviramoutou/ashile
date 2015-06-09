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
               "sLengthMenu":     "Afficher _MENU_ &eacute;l&egrave;ves",
               "sZeroRecords":    "Aucun &eacute;l&egrave;ve &agrave; afficher",
               "sInfo":           "Affichage de l'&eacute;l&egrave;ve _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&egrave;ves",
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

<h3>Liste des materiels attribués à la date du jour sans convention</h3>
<p>(date de fin d'attribution supérieure ou égale à la date du jour)</p>
	<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
	  <thead>
		<tr>
          <th>Secteur</th>
          <th>Etab affect.</th>
		  <th>Eleve</th>
          <th>Date naiss.</th>
          <th> Matériel attrribue </th> 
		  <th>Date signature convention</th>
		  <th>Début du prêt</th>
		  <th>Fin du prêt</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach ($elevemateriels as $elevemateriel): ?>
		<tr>
                <td><?php echo $elevemateriel['libellesecteur'] ?></td>
                <td><?php echo $elevemateriel['rne'] ?></td>
				<td><?php echo $elevemateriel['Eleve']['nom'].'&nbsp-&nbsp'.$elevemateriel['Eleve']['prenom'] ?></a></td>
				<td><?php echo format_date($elevemateriel['Eleve']['datenaissance'],'dd/MM/yyyy') ?></td>
				<td><a href="<?php echo url_for('eleve_materiel/edit?id='.$elevemateriel['id'].'&eleve_id='.$elevemateriel['eleve_id'].'&materiel_id='.$elevemateriel['materiel_id']); ?>"><?php  echo $elevemateriel['libellemateriel']  ?></a></td>
				<td><?php echo format_date($elevemateriel['dateconvention'],'dd/MM/yyyy') ?></td>
				<td><?php echo format_date($elevemateriel['datedebut'],'dd/MM/yyyy') ?></td>
				<td><?php echo format_date($elevemateriel['datefin'],'dd/MM/yyyy') ?></td>
		</tr>
		<?php endforeach; ?>
	  </tbody>
	</table>
