<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>

<!---------------------- tableau JQuery eleves attribués à l avs ------------------------------------>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#Table').dataTable({
           "bJQueryUI": true,
           "sPaginationType": "full_numbers",
           "oLanguage" : {
               "sProcessing":     "Traitement en cours...",
               "sLengthMenu":     "'Afficher _MENU_ élèves  ",
               "sZeroRecords":    "Aucun &eacute;l&eagrave;ve &agrave; afficher",
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

		<?php 
			if($existeleveMns){
				echo 'Liste des élèves scolarisés dans l\'etablissement  '.$eleveMnss[0]['nomEtab'];
			}	
		 ?>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="Table">
			<thead>
				<tr>   
					 <th>Secteur</th>
					 <th>Eleve</th>
					 <th>Etablissement</th>
					 <th>Classe</th>
					 <th>Date de debut</th>
					 <th>Date de fin</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($eleveMnss as $eleveMns): ?>
				<tr>
				    <td><?php echo $eleveMns['secteur'] ?></td>
				    <td><?php echo $eleveMns['nom'].' '.$eleveMns['prenom'] ?></td>
				    <td><?php echo $eleveMns['nomEtab'] ?></td>
				    <td><?php echo $eleveMns['nomClasse'] ?></td>
				    <td><?php echo $eleveMns['debut'] ?></td>
				    <td><?php echo $eleveMns['fin'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
        </table>
 <!--------------------------------------------------------------------------------------->       
        

