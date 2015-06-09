<?php use_stylesheet('data_table.css') ?>
<?php use_stylesheet('datatable_jui.css') ?>
<?php use_javascript('jquery.dataTables.min.js') ?>
<?php use_helper('Date') ?>
<?php use_helper('jQuery') ?>


<!---------------------- tableau JQuery eleves attribués à l avs ------------------------------------>
<script type="text/javascript">
   $j(document).ready(function() {
       oTable = $j('#maTable1').dataTable({
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

<h3>Demande matériel traitée</h3>

	<table cellpadding="0" cellspacing="0" border="0" class="display" id="maTable1">
	<thead>
    <tr>
      <th>N° MDPH</th>
      <th>Type du Matériel</th>
	  <th>Catégorie du Matériel</th>
      <th>Notification</th>
	  <th>Traitement</th>
      <th>Notes </th>

  
  </thead>
  
  <tbody>
    <?php 	foreach ($demande_materiel as $demande_materiels){ ?>
	<tr>
	<td>
	<?php echo $demande_materiels['MdphId']?>
	</td>
	<td>
	<?php echo $demande_materiels['typemateriel']?>
	</td>
	<td>
	<?php echo $demande_materiels['libellecatmateriel']?>
	</td>
	<td>
	<?php echo '- Décision CDA du :&nbsp;'.format_date($demande_materiels['datedecisioncda'],'dd/MM/yyyy').'<br>'?>
	<?php echo '- Notifiée du &nbsp;:&nbsp;'.format_date($demande_materiels['datedebutnotif'],'dd/MM/yyyy').'&nbsp;&nbsp;au&nbsp;&nbsp;'.format_date($demande_materiels['datefinnotif'],'dd/MM/yyyy') ?>
	</td>
	<td>
	<?php echo '<small>'.$demande_materiels['libelletraitement'].'</samll>'?>
	</td>
	<td>
	<?php echo $demande_materiels['notes']?>
	</td>

	</tr>
	<?php } ?>
   </tbody>
        </table>