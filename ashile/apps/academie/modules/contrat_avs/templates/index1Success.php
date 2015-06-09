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
               "sZeroRecords":    "Aucun Avs &agrave; afficher",
               "sInfo":           "Affichage de l'avs _START_ &agrave; _END_ sur _TOTAL_ Avs",
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

		<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable">
		<thead>
			<tr>   
				<th>Avs</th>
                <th>date de Naissance</th>
				<th>téléphone</th>
				<th>téléphone</th>
				<th>email</th>
				<th>Contrat</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($contrat_sans as $contrat_sanss): ?>
				<tr onClick="window.location='<?php echo url_for('avs/edit?id='.$contrat_sanss['id']) ?>'">
				               <td><a href="<?php echo url_for('avs/edit?id='.$contrat_sanss['id']) ?>"><?php echo $contrat_sanss['nom'].'   '. $contrat_sanss['prenom'] ?></a></td>
                               <td><?php echo format_date($contrat_sanss['date_naissance'],'dd/MM/yyyy') ?></td>
							   <td><?php echo $contrat_sanss['tel1'] ?></td>
							   <td><?php echo $contrat_sanss['tel2'] ?></td>
							   <td><?php echo $contrat_sanss['email'] ?></td>
							   <td> <?php echo link_to('Créer', 'contrat_avs/new?avs_id=' . $contrat_sanss['id'] ); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

		 <br> <a href="<?php echo url_for('avs/new') ?>"> Création d'un AVS</a></br>
		 <br></br>

<?php

